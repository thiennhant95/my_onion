<?php
class M_course_model extends DB_Model {

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
     * コースが無料体験コースかどうかチェックする
     * @param   integer コースID
     * @return  boolean TRUE:無料体験コース FALSE:無料体験コースでない
     */
    public function is_course_free_by_id($course_id) {
        $params = array(
            $course_id,
            VALUE_COURSE_TYPE_FREE,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT 1 AS result FROM m_course ';
        $query .= 'WHERE id = ? AND id IN (SELECT id FROM m_course WHERE `type` = ? AND delete_flg = ?) ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * コースが無料体験コースかどうかチェックする
     * @param   array   コース情報（m_courseのレコード）
     * @return  boolean TRUE:無料体験コース FALSE:無料体験コースでない
     */
    public function is_course_free($course) {
        if (isset($course['type']) && $course['type'] == VALUE_COURSE_TYPE_FREE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * コースが期間限定コースかどうかチェックする
     * @param   integer コースID
     * @return  boolean TRUE:期間限定コース FALSE:期間限定コースでない
     */
    public function is_course_limited_by_id($course_id) {
        $params = array(
            $course_id,
            VALUE_COURSE_TYPE_LIMITED,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT 1 AS result FROM m_course ';
        $query .= 'WHERE id = ? AND id IN (SELECT id FROM m_course WHERE `type` = ? AND delete_flg = ?) ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * コースが期間限定コースかどうかチェックする
     * @param   array   コース情報（m_courseのレコード）
     * @return  boolean TRUE:期間限定コース FALSE:期間限定コースでない
     */
    public function is_course_limited($course) {
        if (isset($course['type']) && $course['type'] == VALUE_COURSE_TYPE_LIMITED) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_list_course($limit, $start)
    {
        $sql = 'select * from m_course
                where m_course.delete_flg = 0 
                order by m_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }



}
