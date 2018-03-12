<?php
class M_bus_stop_model extends DB_Model {

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
     * Get list bus stop
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function get_list_bus_stop($limit, $start)
    {
        $sql = 'select * from m_bus_stop
                where m_bus_stop.delete_flg = 0 
                order by m_bus_stop.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get list bus stop for export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        $sql = 'select bus_stop_code,bus_stop_name from m_bus_stop
                where m_bus_stop.delete_flg = 0 
                order by m_bus_stop.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }


}
