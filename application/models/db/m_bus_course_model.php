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

    function get_list_bus_course($limit, $start)
    {
        $sql = 'select * from m_bus_course JOIN m_class ON m_bus_course.class_id = m_class.id 
                where m_bus_course.delete_flg = 0 
                order by m_bus_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
