<?php
class M_item_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_item($limit, $start)
    {
        $sql = 'select m_item.id,m_item.item_code,m_item.item_name from m_item JOIN m_subject ON m_item.subject_id = m_subject.id 
                where m_item.delete_flg = 0 
                order by m_item.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
