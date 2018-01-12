<?php
class M_staff_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_account($name, $pwd)
    {
        $array = array('login_id' => $name, 'password' => $pwd);
        $this->db->select()
               ->from('m_staff')
               ->where($array);
		$query = $this->db->get()->result_array();
		return $query;
    }


}
