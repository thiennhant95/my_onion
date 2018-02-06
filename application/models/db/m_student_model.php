<?php
class M_student_model extends DB_Model {

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
     * 生徒IDの家族会員を取得
     * @param integer   生徒ID
     * @return array    取得結果
     */
    public function get_family($student_id) {
        $params = array(
            $student_id,
            $student_id,
            DATA_NOT_DELETED,
        );
        $query  = 'SELECT * FROM m_student ';
        $query .= 'WHERE id != ? AND tel_normalize IN (SELECT tel_normalize FROM m_student WHERE id = ?) AND delete_flg = ? ';

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        $result = $res->result_array();

        // メタ情報を取得する
        $this->load->model('db/l_student_meta_model');
        foreach ($result as $key => $row) {
            $result[ $key ]['meta'] = array();
            $meta = $this->l_student_meta_model->select_by_id($row['id'], 'student_id');
            foreach ($meta as $row2) {
                $result[ $key ]['meta'][ $row2['tag'] ] = $row2['value'];
            }
        }
        return $result;
    }

    /**
     * 退会していない生徒IDを取得
     * @param integer   生徒ID
     * @return array    取得結果
     */
    public function get_no_quit_student($student_id = '') {
        $params = array(
            VALUE_STUDENT_STATUS_MEMBER,
            VALUE_STUDENT_STATUS_QUIT_WAIT,
            DATA_ON,
        );

        $query =  'SELECT id FROM m_student ';
        $query .= 'WHERE status IN (?, ?) AND delete_flg = ? ';
        if ($student_id > 0) {
            $params[] = $student_id;
            $query .= 'AND id = ? ';
        }

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }

    public function check_account($name)
    {
        $array = array('email' => $name);
        $array2 = array('id' => $name);
        $this->db->select()
               ->from('m_student')
               ->where($array)
               ->or_where($array2);
		$query = $this->db->get()->result_array();
		return $query;
    }

    public function check_email_exits($email)
    {
        $this->db->select()
            ->from('m_student')
            ->where('email', $email);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function edit_forgot_pass($email, $pass)
    {
        $this->db->trans_start(); 
        $data = array(
                'password' => $pass,
        );
        $this->db->where('email', $email);
        $this->db->update('m_student', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === TRUE) 
        { 
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function select_student_field( $id, $key ) {
        $array = array( 'id' => $id );
        $this->db->select( $key )->from( 'm_student' )->where( $array );
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function update_student_info( $student_id, $field, $value ) {
        $query = $this->db->update('m_student', array( $field => $value ), array( 'id' => $student_id ) );
        if ( $query === FALSE ) {
            return 'error';
        } else return 'success';
    }
    public function get_family_detail($student_id) {
        $params = array(
            $student_id,
            $student_id,
            DATA_NOT_DELETED,
        );
        $query  = 'SELECT * FROM m_student ';
        $query .= 'WHERE id != ? AND tel_normalize IN (SELECT tel_normalize FROM m_student WHERE id = ?) AND delete_flg = ? ';

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        $result = $res->result_array();
         foreach ($result as $key => $row) {

            $result[ $key ]['meta'] = array();
            $meta = $this->l_student_meta_model->select_by_id($row['id'], 'student_id');
            foreach ($meta as $row2) {
                $result[ $key ]['meta'][ $row2['tag'] ] = $row2['value'];
            }
            $query = ' SELECT '.
                        ' l_class.student_id , l_class.start_date as l_class_start_date,l_class.end_date as l_class_end_date , '.
                        ' m_class.id as idClass,m_class.base_class_sign,m_class.class_name,m_class.class_code ,'.
                        ' l_course.start_date as l_course_start_date ,l_course.end_date as l_course_end_date , l_course.join_date as l_course_join_date ,'.
                        ' m_course.id as idcourse,m_course.course_code,m_course.course_name '.
                    ' FROM l_student_class l_class , m_class , l_student_course l_course ,m_course '.
                                                             
                    ' WHERE '.      
                         ' l_class.class_id = m_class.id AND '.
                         ' l_class.student_course_id = l_course.id AND'.
                         ' l_class.student_id = l_course.student_id AND'.
                         ' l_course.course_id = m_course.id AND'.
                         ' l_class.start_date <= DATE_FORMAT(NOW(),"%Y-%m-%d") AND '.
                         ' l_class.delete_flg = 0 AND'.
                         ' l_class.student_id = ? '.
                         ' ORDER BY l_class.start_date ASC , l_class.end_date ASC LIMIT 1 ';
            $result[ $key ]['info'] = array();                
            $res_2 = $this->db->query($query, $row['id']);
            if ($res_2 === FALSE) {
                logerr($params, $query);
                throw new Exception();
            }
            $result_2 = $res_2->result_array();
            foreach ($result_2 as $row) {
                $result[ $key ]['info'][]=$row;
            }
        }
        return $result;
    }
    public function new_update_by_id($params, $id=NULL) {
        if($id==NULL) return false;
        if(isset($params['id'])) unset($params['id']);
        if(!isset($params['update_date'])) $params['update_date'] = date('Y-m-d H:i:s');
        $query = " UPDATE  ".$this->tbl." SET ";
        foreach ($params as $key => $value) {
            $query.= '`'.$key.'`'.' = '."'".$value."' ,";
        }
        $query = rtrim($query,",");
        $query.=" WHERE id= '".$id."'";
        if (FALSE === $this->db->query($query)) { 
            logerr($query);
            throw new Exception();
            return false;
        }
        return true;
    }
}
