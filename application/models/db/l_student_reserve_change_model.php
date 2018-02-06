<?php
class L_student_reserve_change_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_student_reserve($limit, $start)
    {
        $sql = 'select *
                from  l_student_reserve_change
                where l_student_reserve_change.delete_flg = 0 
                order by l_student_reserve_change.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
