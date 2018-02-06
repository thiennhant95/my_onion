<?php
class M_bus_course_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getData_Bus_stop_by_class_id($class_id = NULL)
    {	
    	if($class_id == NULL) return '';

    	$query =" SELECT m_bus_route.id as bus_route_id , m_bus_route.go_time , m_bus_route.ret_time , " ; 
		$query.="        m_bus_stop.id as bus_stop_id, m_bus_stop.bus_stop_code , m_bus_stop.bus_stop_name " ;
        $query.=" FROM   m_bus_course , m_bus_route , m_bus_stop  ";
        $query.=" WHERE  m_bus_route.bus_course_id = m_bus_course.id AND ";
		$query.="		 m_bus_route.bus_stop_id = m_bus_stop.id AND ";
		$query.="		  m_bus_course.delete_flg = '".DATA_NOT_DELETED."' AND ";
		$query.="		 m_bus_course.class_id = '".$class_id."'" ;
		$res = $this->db->query($query);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
    }
    public function getData_Bus_stop_by_id($id = NULL)
    {	
    	if($id == NULL) return '';

    	$query =" SELECT m_bus_stop.id as bus_stop_id, m_bus_stop.bus_stop_code , m_bus_stop.bus_stop_name ";
        $query.=" FROM   m_bus_course , m_bus_route , m_bus_stop  ";
        $query.=" WHERE  m_bus_route.bus_course_id = m_bus_course.id AND ";
		$query.="		 m_bus_route.bus_stop_id = m_bus_stop.id AND ";
		$query.="		 m_bus_course.delete_flg = '".DATA_NOT_DELETED."' AND ";
		$query.="		 m_bus_course.id = '".$id."'" ;
		$res = $this->db->query($query);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
    }


    function get_list_bus_course($limit, $start)
    {
        $sql = 'select m_bus_course.id,m_bus_course.bus_course_code,m_bus_course.bus_course_name,m_bus_course.max,m_class.class_name from m_bus_course JOIN m_class ON m_bus_course.class_id = m_class.id 
                where m_bus_course.delete_flg = 0 
                order by m_bus_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        $sql = 'select m_bus_course.bus_course_code,m_bus_course.bus_course_name,m_bus_course.max,m_class.class_name from m_bus_course JOIN m_class ON m_bus_course.class_id = m_class.id 
                where m_bus_course.delete_flg = 0 
                order by m_bus_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
