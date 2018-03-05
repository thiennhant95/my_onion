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

    /**
     * Get list item
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function get_list_item($limit, $start)
    {
        $sql = 'select m_item.id,m_item.item_code,m_item.item_name from m_item JOIN m_subject ON m_item.subject_id = m_subject.id 
                where m_item.delete_flg = 0 and m_subject.delete_flg=0
                order by m_item.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get list item export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        $sql = 'select m_item.item_code,m_item.item_name,m_subject.subject_name,m_item.sell_price,m_item.buy_price,m_item.left_num,m_item.type
                from m_item JOIN m_subject ON m_item.subject_id = m_subject.id 
                where m_item.delete_flg = 0 and m_subject.delete_flg=0
                order by m_item.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
