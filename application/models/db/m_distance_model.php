<?php
class M_distance_model extends DB_Model {

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
     * Get list distance
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function get_list_distance($limit, $start)
    {
        $sql = 'select m_distance.id, m_distance.distance_code,m_distance.distance_name
                from m_distance
                where m_distance.delete_flg = 0 
                order by m_distance.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get list distance export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        $sql = 'select m_distance.distance_code,m_distance.distance_name
                from m_distance
                where m_distance.delete_flg = 0 
                order by m_distance.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
