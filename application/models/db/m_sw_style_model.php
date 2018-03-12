<?php
class M_sw_style_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_style($limit, $start)
    {
        $sql = 'select * from m_sw_style
                where m_sw_style.delete_flg = 0 
                order by m_sw_style.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        $sql = 'select style_code,style_name from m_sw_style
                where m_sw_style.delete_flg = 0 
                order by m_sw_style.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
