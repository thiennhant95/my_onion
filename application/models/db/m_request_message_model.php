<?php
class M_request_message_model extends DB_Model {
     /**
     * construct
     * @param
     * @return
     */
     public function __construct() {
          parent::__construct();
          $this->load->database();
     }

     public function get_message_notification($my_array)
     {
          $this->db->select()
               ->from('m_request_message')
               ->where($my_array)
               ->order_by('create_date', 'DESC');
          $data = $this->db->get()->row_array();
          return $data;
     }
}