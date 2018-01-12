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

    public function check_account($name, $pwd)
    {
        $array = array('email' => $name, 'password' => $pwd);
        $this->db->select()
               ->from('m_student')
               ->where($array);
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

}
