<?php
class M_subject_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_subject($limit, $start)
    {
        $sql = 'select * from m_subject
                where m_subject.delete_flg = 0 
                order by m_subject.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        $sql = 'select subject_code,subject_name from m_subject
                where m_subject.delete_flg = 0 
                order by m_subject.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }


}
