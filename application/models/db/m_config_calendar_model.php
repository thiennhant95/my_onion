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

    public function get_info_class($id_std)
    {
        $my_array = array('l_student_course.student_id' => $id_std, 'l_student_course.end_date' => END_DATE_DEFAULT, 'l_student_class.end_date' => END_DATE_DEFAULT );
        $this->db->select('l_student_course.course_id, m_class.id, m_class.class_name, m_class.base_class_sign, m_class.start_time, m_class.end_time')
                ->from('l_student_course')
                ->join('l_student_class', 'l_student_class.student_course_id = l_student_course.course_id')
                ->join('m_class', 'm_class.id = l_student_class.class_id')
                ->where($my_array);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_class_of_course($id_course)
    {
        $my_array = array('m_class.course_id' => $id_course);
        $this->db->select('m_class.id, m_class.class_name, m_class.base_class_sign, m_class.start_time, m_class.end_time')
                ->from('m_class')
                ->where($my_array);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_course_current($id)
    {
        $my_array = array('student_id' => $id, 'end_date' => END_DATE_DEFAULT);
        $this->db->select('l_student_course.course_id')
                ->from('l_student_course')
                ->where($my_array);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function get_list_bus_name($id_class)
    {
       
        $my_array = array('m_bus_course.class_id' => $id_class);
        $this->db->select('m_bus_course.bus_course_name, m_bus_course.id')
                ->from('m_bus_course')
                ->where($my_array);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
