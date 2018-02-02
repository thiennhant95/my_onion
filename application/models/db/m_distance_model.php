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
    function get_list_distance($limit, $start)
    {
        $sql = 'select m_distance.id, m_distance.distance_code,m_distance.distance_name
                from m_distance
                where m_distance.delete_flg = 0 
                order by m_distance.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        $sql = 'select m_distance.distance_code,m_distance.distance_name
                from m_distance
                where m_distance.delete_flg = 0 
                order by m_distance.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
