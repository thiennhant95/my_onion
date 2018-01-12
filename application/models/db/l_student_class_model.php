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


}
