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
                        ' a.student_id , a.start_date as l_class_start_date , a.end_date as l_class_end_date ,  b.id as idClass, b.base_class_sign , b.class_name , b.class_code , '.
                        ' c.start_date as l_course_start_date ,c.end_date as l_course_end_date , c.join_date as l_course_join_date , d.id as idcourse , d.course_code, d.course_name  '.   
                     ' FROM l_student_class a , m_class b, l_student_course c , m_course d ' .           
                     ' WHERE '.      
                         ' a.class_id = b.id AND'.
                         ' a.student_course_id = c.id AND '.
                         ' a.student_id = c.student_id AND '.
                         ' c.course_id = d.id AND '.
                         ' b.delete_flg = ? AND '.
                         ' d.delete_flg = ? AND '.
                         ' a.end_date = ?  AND '.
                         ' c.end_date = ? AND ' .
                         ' a.student_id = ?  ORDER BY a.start_date  LIMIT 1';
            $result[ $key ]['info'] = array();                
            $res_2 = $this->db->query($query,[ DATA_NOT_DELETED , DATA_NOT_DELETED, END_DATE_DEFAULT , END_DATE_DEFAULT , $row['id'] ]);
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

    public function get_name_family($list_id)
    {
        $data = [];
        if(!empty($list_id)){
            $this->db->select('student_id, tag, value, delete_flg');
            $this->db->from('l_student_meta');
            foreach ($list_id as $key => $value) {
                $this->db->or_where('student_id', $value);
            }
            $this->db->having('tag','name_kana'); 
            $data = $this->db->get()->result_array();
            return $data;
        }
    }

    public function get_user_course_free()
    {
        
    }

}
