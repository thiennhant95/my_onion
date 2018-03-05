<?php
class M_config_calendar_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_list_intransfer()
    {
        $this->db->select()
        ->from('m_config_calendar')
        ->order_by('id', 'DESC')
        ->limit(1);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function edit_calender_intransfer($id, $contents)
    {
        $this->db->trans_start(); 
        $data = array(
                'contents' => $contents,
        );
        $this->db->where('id', $id);
        $this->db->update('m_config_calendar', $data);
        $this->db->trans_complete();
        if($this->db->schedule_system()) 
        { 
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function is_closed_date($data)
    {
        # code...
        $array = array('target_date' => $data, 'closed_flg' => 1);
        $this->db->select()
               ->from('schedule_system')
               ->where($array);
		$query = count($this->db->get()->result_array());
		return $query;
    }

    public function is_test_date($data)
    {
        # code...
        $array = array('target_date' => $data, 'test_flg' => 1);
        $this->db->select()
               ->from('schedule_system')
               ->where($array);
		$query = count($this->db->get()->result_array());
		return $query;
    }

    public function check_exits_date($data)
    {
        $array = array('target_date' => $data);
        $this->db->select()
               ->from('schedule_system')
               ->where($array);
		$query = $this->db->get()->result_array();
		return $query;
    }
    
    public function edit_schedule_system($id, $param)
    {
        $this->db->trans_start(); 
        $this->db->where('id', $id)
            ->update('schedule_system', $param);
        $this->db->trans_complete();
        if($this->db->trans_complete()) 
        { 
            return $id;
            // $last_id_insert = $id;
        }
        else
        {
            return FALSE;
        }
    }

    public function get_data_absent($date_min, $date_max)
    {   
        $array = array('target_date >=' => $date_min, 'target_date <=' => $date_max, 'closed_flg' => 1);
        $this->db->select()
               ->from('schedule_system')
               ->where($array);
		$query = $this->db->get()->result_array();
		return $query;
    }

    public function get_data_test($date_min, $date_max)
    {   
        $array = array('target_date >=' => $date_min, 'target_date <=' => $date_max, 'test_flg' => 1);
        $this->db->select()
               ->from('schedule_system')
               ->where($array);
		$query = $this->db->get()->result_array();
		return $query;
    }

    
    public function check_date_selected()
    {
        $date_selected = $this->input->post('start_date_selected');
        $cover_date = strtotime($date_selected);
        $my_array = array('target_date' => $date_selected);
        $this->db->select()
                ->from('schedule_system')
                ->where($my_array);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
