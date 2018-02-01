<?php
class M_class_model extends DB_Model {

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
     * l_student_class.idを指定してクラス情報を取得する
     * @param   integer l_student_class.id
     * @return  array   クラス情報
     */
    public function get_student_class($l_student_class_id) {
        $params = array(
            $l_student_class_id,
        );

        $query =  'SELECT c.* FROM m_class c ';
        $query .= 'LEFT JOIN l_student_class sc ON sc.class_id = c.id ';
        $query .= 'WHERE sc.id = ? ';
        $res = $this->db->query($query, $params);
        return $res->row_array();
    }

    function get_list_class($limit, $start)
    {
        $sql = 'select m_class.id,m_class.course_id,m_class.class_code,m_class.class_name,m_class.invalid_flg,m_class.grade_manage_flg,m_class.week,m_class.max_count,m_class.use_bus_flg from m_class JOIN m_course ON m_class.course_id = m_course.id 
                where m_class.delete_flg = 0 
                order by m_class.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
