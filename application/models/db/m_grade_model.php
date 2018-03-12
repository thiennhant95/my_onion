<?php
class M_grade_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_grade($limit, $start)
    {
        $sql = 'select * from m_grade
                where m_grade.delete_flg = 0 
                order by m_grade.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        $sql = 'select grade_code,grade_name from m_grade
                where m_grade.delete_flg = 0 
                order by m_grade.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
