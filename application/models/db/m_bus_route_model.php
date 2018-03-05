<?php
class M_bus_route_model extends DB_Model {

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
     * Get list bus route for export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        $sql = 'select m_bus_course.bus_course_name,m_bus_route. 
                from m_bus_route JOIN m_bus_course ON m_bus_course.id = m_bus_route.bus_course_id 
                JOIN m_bus_stop ON m_bus_stop.id=m_bus_route.bus_stop_id
                where m_bus_route.delete_flg = 0 and m_bus_stop.delete_flg = 0 and m_bus_coure.delete_flg = 0  
                order by m_bus_route.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
