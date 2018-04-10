<?php

class L_student_class_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 生徒IDを指定して現在有効なクラス情報を取得する
     * @param   integer 生徒ID
     * @param   boolean TRUE:有効なレコードのみ FALSE:すべて
     * @return  array   クラス情報
     */
    public function get_student_class($student_id, $valid_flg = TRUE) {
        $params = array(
            $student_id,
            DATA_NOT_DELETED,
        );

        $query = 'SELECT * FROM l_student_class ';
        $query .= 'WHERE student_id = ? AND delete_flg = ? ';

        if ($valid_flg == TRUE) {
            $query .= 'AND (start_date BETWEEN ? AND ?) ';
            $query .= 'AND (end_date BETWEEN ? AND ?) ';
            $params[] = '0000-00-00';
            $params[] = get_date();
            $params[] = get_date();
            $params[] = '2199-12-31';
        }
        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }

    public function get_student_class_detail_by_id($id) {
        $params = array(
            $id,
            DATA_NOT_DELETED,
        );

        $query = 'SELECT a.id as class_id , a.base_class_sign,a.class_code , a.class_name , a.course_id , a.invalid_flg,
                    b.student_id,b.week_num,b.start_date,b.end_date
                   FROM m_class a LEFT JOIN l_student_class b ON b.class_id = a.id  WHERE b.id = ?';

        $res = $this->db->query($query, $params);
        return $res->result_array();
    }

    public function get_class_pass_student($where) {
        $this->db->select()
                ->from('l_student_class')
                ->where($where);
        $this->db->order_by('start_date', 'DESC');
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function get_name_class($id_class) {
        $this->db->select('class_name')
                ->from('m_class')
                ->where('id', $id_class);
        $data = $this->db->get()->row_array();
        return $data;
    }

    /**
     * function is_full_class check class is full or not full
     * @param   integer class_id
     * @param   integer week_num
     * @return  boolean   true :  full  , false : not full
     */
    public function is_full_class($class_id, $week_num) {
        if ($class_id == NULL || $class_id == '' || $week_num == '' || $week_num == NULL)
            return;

        $query = " SELECT ( SELECT COUNT( id )   FROM  l_student_class 
                            WHERE  class_id = ? AND week_num = ? AND end_date = ? ) 
                            as num_ber , m_class.max_count
                    FROM m_class WHERE m_class.id = ?  ";
        $data = $this->db->query($query, [$class_id, $week_num, END_DATE_DEFAULT, $class_id])->result_array();
        if (count($data) > 0) {
            if (intval($data[0]['num_ber']) < intval($data[0]['max_count']))
                return FALSE;
            return TRUE;
        }
    }

    /**
     * function Update_class use to update array old , new join class of student and old bus_route  of the student.
     * @param   array classjoin
     * @return  boolean   true or false
     */
    public function Update_class($course_class_join) {
        $session_student = $this->session->userdata('admin_account');
        $admin_id = $session_student['id'];

        if ($course_class_join['arr'] && $admin_id != NULL) {
            $student_id = $course_class_join['base']['student_id'];
            $course_id = $course_class_join['base']['course_id'];
            $id_student_course = '';
            $start_date = '';
            $current_date = date('Y-m-d');
            // search current course join
            $sql = "SELECT id , start_date FROM l_student_course WHERE student_id = ? AND course_id = ? AND end_date = ?";
            $data = $this->db->query($sql, [$student_id, $course_id, END_DATE_DEFAULT])->result_array();
            if ($data) {
                $id_student_course = $data[0]['id'];
                $start_date = ( $data[0]['start_date'] == INVALID_DATE ) ? $current_date : $data[0]['start_date'];
            }

            $sql = "SELECT id , student_course_id , student_id , class_id , week_num  FROM l_student_class WHERE  student_course_id = ? AND student_id = ?  AND end_date = ?";

            $subdata = $this->db->query($sql, [$id_student_course, $student_id, END_DATE_DEFAULT])->result_array();

            if (count($subdata) > 0) {
                $array_class_week = array();
                foreach ($subdata as $sub_key_1 => $sub_value_1) {

                    $ckeck = FALSE;
                    $id_old_student_class = $sub_value_1['id'];
                    foreach ($course_class_join['arr'] as $sub_key_2 => $sub_value_2) {
                        if (!$this->is_full_class($sub_value_2['class_id'], $sub_value_2['week_num'])) {
                            if ($sub_value_1['class_id'] == $sub_value_2['class_id'] && $sub_value_1['week_num'] == $sub_value_2['week_num']) {
                                $ckeck = TRUE;
                            }
                        }
                    }
                    if ($ckeck === FALSE) {
                        $this->db->update('l_student_class', ['end_date' => $current_date, 'update_id' => $admin_id], ['id' => $id_old_student_class]);
                        //update old bus_route
                        $sql = " SELECT id  FROM l_student_bus_route WHERE  student_class_id = ? AND student_id = ?  AND end_date = ?";
                        $data_bus_route = $this->db->query($sql, [$id_old_student_class, $student_id, END_DATE_DEFAULT])->result_array();
                        if ($data_bus_route) {
                            $this->db->update('l_student_bus_route', ['end_date' => $current_date, 'update_id' => $admin_id], ['id' => $data_bus_route[0]['id']]);
                        }
                    }
                }
            }


            foreach ($course_class_join['arr'] as $key => $value) {

                if (!$this->is_full_class($value['class_id'], $value['week_num'])) {
                    $class_id = $value['class_id'];
                    $week_num = $value['week_num'];

                    $sql = "SELECT id FROM l_student_class WHERE  student_course_id = ? AND student_id = ? AND class_id = ? AND week_num = ? AND end_date = ?";
                    $data_student_class = $this->db->query($sql, [$id_student_course, $student_id, $class_id, $week_num, END_DATE_DEFAULT])->result_array();

                    if (!$data_student_class) {
                        $this->db->insert('l_student_class', ['student_course_id' => $id_student_course, 'student_id' => $student_id, 'class_id' => $class_id, 'week_num' => $week_num, 'start_date' => $start_date, 'end_date' => END_DATE_DEFAULT, 'create_date' => date('Y-m-d H:i:s'), 'create_id' => $admin_id]);
                    }
                }
            }

            $sql = "SELECT id  , student_id ,course_id , start_date , end_date FROM l_student_course a WHERE student_id = ? AND a.end_date != ? ORDER BY id DESC ";
            $data_student_course = $this->db->query($sql, [$student_id, END_DATE_DEFAULT])->result_array();

            if (count($data_student_course) > 0) {
                $id_old_student_course = $data_student_course[0]['id'];
                if ($id_student_course != $id_old_student_course) {
                    $sql = "SELECT id FROM l_student_class WHERE  student_course_id = ? AND student_id = ? AND end_date = ?";
                    $subdata_2 = $this->db->query($sql, [$id_old_student_course, $student_id, END_DATE_DEFAULT])->result_array();

                    if (count($subdata_2) > 0) {
                        foreach ($subdata_2 as $key => $value) {
                            $this->db->update('l_student_class', ['end_date' => $current_date, 'update_date' => date('Y-m-d H:i:s'), 'update_id' => $admin_id], ['id' => $value['id']]);

                            $sql = "SELECT id FROM l_student_bus_route WHERE  student_class_id = ? AND student_id = ? AND end_date = ?";
                            $data_student_bus = $this->db->query($sql, [$value['id'], $student_id, END_DATE_DEFAULT])->result_array();

                            if (count($data_student_bus) > 0) {
                                $this->db->update('l_student_bus_route', ['end_date' => $current_date, 'update_date' => date('Y-m-d H:i:s'), 'update_id' => $admin_id], ['id' => $data_student_bus[0]['id']]);
                            }
                        }
                    }
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Function edit
     * Update information of an object by its ID
     * @param int $id the object ID
     * @param array $information object information
     * @return boolean
     * @access public
     * @author  Tran Thien Nhan Viet Vang JSC
     */
    public function edit_by_where($whereclause, $information, $table = NULL) {
        if ($table == NULL)
            $table = 'l_student_class';
        $this->db->where($whereclause);
        $this->db->update($table, $information);
        return $this->db->affected_rows() !== false;
    }

    function get_current_student_by_class_id($class_id, $week_num) {
        $sql = "
            SELECT COUNT(*) as current_student
            FROM l_student_class lsc
            WHERE  lsc.class_id = '$class_id' 
            AND lsc.week_num = '$week_num' 
            AND lsc.end_date = ?
        ";
        $query = $this->db->query($sql, [END_DATE_DEFAULT]);
        if ($query === FALSE) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    /**
     * 生徒IDを指定して現在有効なクラス情報を取得する
     * get_student_class()の置き換え用
     */
    public function get_class($student_id, $valid_flg = FALSE) {
        $where = array(
            'student_id =' => $student_id,
            'delete_flg =' => DATA_NOT_DELETED,
        );
        if ($valid_flg == TRUE) {
            $where = $where + array(
                'start_date <=' => get_date(),
                'end_date >=' => get_date()
            );
        }
        $this->db->select('*')
                ->from('l_student_class')
                ->where($where);
        return $this->db->get()->result_array();
    }

}
