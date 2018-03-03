<?php
class L_student_class_model extends DB_Model {

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
     * 生徒IDを指定して現在有効なクラス情報を取得する
     * @param   integer 生徒ID
     * @param   boolean TRUE:有効なレコードのみ FALSE:すべて
     * @return  array   クラス情報
     */
    public function get_student_class($student_id, $valid_flg = TRUE) {
        $params = array(
            $student_id,
            DATA_NOT_DELETED,
        );

        $query =  'SELECT * FROM l_student_class ';
        $query .= 'WHERE student_id = ? AND delete_flg = ? ';

        if ($valid_flg == TRUE) {
            $query .= 'AND (start_date BETWEEN ? AND ?) ';
            $query .= 'AND (end_date BETWEEN ? AND ?) ';
            $params[] = '0000-00-00';
            $params[] = get_date();
            $params[] = get_date();
            $params[] = '2199-12-31';
        }
        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }
    public function get_student_class_detail_by_id($id) {
        $params = array(
            $id,
            DATA_NOT_DELETED,
        );

        $query =  'SELECT a.id as class_id ,a.base_class_sign,a.class_code , a.class_name,a.course_id,a.invalid_flg,
                    b.student_id,b.week_num,b.start_date,b.end_date
                   FROM m_class a LEFT JOIN l_student_class b ON b.class_id = a.id  WHERE b.id = ?';

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }

    public function get_class_pass_student($where)
    {
        $this->db->select()
            ->from('l_student_class')
            ->where($where);
        $this->db->order_by('start_date', 'DESC');
        $data = $this->db->get()->row_array();
        return $data;
    }

    public function get_name_class($id_class){
        $this->db->select('class_name')
        ->from('m_class')
        ->where('id', $id_class);
        $data = $this->db->get()->row_array();
        return $data;
    }

    /**
     * Function edit
     * Update information of an object by its ID
     * @param int $id the object ID
     * @param array $information object information
     * @return boolean
     * @access public
     */
    public function edit_by_where($whereclause, $information,$table=NULL)
    {
        if($table == NULL)
            $table = 'l_student_class';
        $this->db->where($whereclause);
        $this->db->update($table, $information);
        return $this->db->affected_rows() !== false;
    }


}
