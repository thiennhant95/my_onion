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
                order by m_grade.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
