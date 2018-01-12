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

}
