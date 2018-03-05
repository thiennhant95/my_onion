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

        $query =  'SELECT * FROM l_student_class ';
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

        $query =  'SELECT a.id as class_id ,a.base_class_sign,a.class_code , a.class_name,a.course_id,a.invalid_flg,
                    b.student_id,b.week_num,b.start_date,b.end_date
                   FROM m_class a LEFT JOIN l_student_class b ON b.class_id = a.id  WHERE b.id = ?';

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }

    public function get_class_pass_student($where)
    {
        $this->db->select()
            ->from('l_student_class')
            ->where($where);
        $this->db->order_by('start_date', 'DESC');
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function get_name_class($id_class){
        $this->db->select('class_name')
        ->from('m_class')
        ->where('id', $id_class);
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function Update_class($course_class_join)
    {
        if($course_class_join['arr'])
        {
            $student_id = $course_class_join['base']['student_id'];
            $course_id = $course_class_join['base']['course_id'];
            $id_student_course ='';
            $start_date ='';
            $current_date = date('Y-m-d');

            $sql = "SELECT id , start_date FROM l_student_course WHERE student_id = ? AND course_id = ? AND end_date = ?"; 
            $data = $this->db->query($sql, array(  $student_id , $course_id , END_DATE_DEFAULT))->result_array();
            if($data)
            {
                $id_student_course = $data[0]['id'];
                $start_date = $data[0]['start_date'];
            }
                
            $sql = "SELECT id , student_course_id ,student_id , class_id ,week_num  FROM l_student_class WHERE  student_course_id = ? AND student_id = ?  AND end_date = ?";

            $subdata = $this->db->query($sql, array(  $id_student_course , $student_id  , END_DATE_DEFAULT ))->result_array();

            if(count($subdata)>0) 
            {
                $array_class_week = array();
                foreach ($subdata as $sub_key_1 => $sub_value_1) {
                    $ckeck = FALSE;
                    $id_old_student_class = $sub_value_1['id'];
                    foreach ($course_class_join['arr'] as $sub_key_2 => $sub_value_2) {
                        if($sub_value_1['class_id']===$sub_value_2['class_id'] && $sub_value_1['week_num']===$sub_value_2['week_num'])
                        {
                            $ckeck = TRUE;
                        }
                    }
                    if($ckeck===FALSE)
                    {
                        $this->db->update('l_student_class', array( 'end_date' => $current_date ), array('id' => $id_old_student_class) );
                    }
                }
            }


            foreach ($course_class_join['arr'] as $key => $value) {

                $class_id = $value['class_id'];
                $week_num = $value['week_num'];
                    
                $sql = "SELECT id FROM l_student_class WHERE  student_course_id = ? AND student_id = ? AND class_id = ? AND end_date = ?";
                $subdata = $this->db->query($sql, array(  $id_student_course , $student_id , $class_id , END_DATE_DEFAULT ))->result_array();

                if(!$subdata)
                {
                    $this->db->insert('l_student_class', array( 'student_course_id' => $id_student_course , 'student_id' => $student_id ,'class_id' => $class_id ,'week_num' => $week_num ,'start_date' => $start_date , 'end_date' => END_DATE_DEFAULT) ) ;
                }
                
            }

            $sql = "SELECT id  , student_id ,course_id , start_date , end_date FROM l_student_course a WHERE student_id = ? AND a.end_date = ? ORDER BY id DESC ";
            $subdata = $this->db->query($sql, array( $student_id  , $current_date ))->result_array();

            if(count($subdata)>0)
            {
                $id_old_student_course =  $subdata[0]['id'];
                if($id_student_course != $id_old_student_course)
                {
                    $sql = "SELECT id FROM l_student_class WHERE  student_course_id = ? AND student_id = ? AND end_date = ?";
                    $subdata_2 = $this->db->query($sql, array(  $id_old_student_course , $student_id  , END_DATE_DEFAULT ))->result_array();

                    if(count($subdata_2)>0)
                    {
                        foreach ($subdata_2 as $key => $value) {
                            $this->db->update('l_student_class', array( 'end_date' => $current_date ), array( 'id' => $value['id'] ) );
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
    public function edit_by_where($whereclause, $information,$table=NULL)
    {
        if($table == NULL)
            $table = 'l_student_class';
        $this->db->where($whereclause);
        $this->db->update($table, $information);
        return $this->db->affected_rows() !== false;
    }
}
