<?php
class L_student_bus_route_model extends DB_Model {

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
     * 生徒ID,年月を指定して、バス乗車スケジュールを削除する。ただし振替操作で作成されたレコードは削除しない。
     * @param integer   生徒ID
     * @param integer   年
     * @param integer   月
     * @return 
     */
    public function delete_schedule($student_id, $year, $month, $day = '01') {
        $last_day = date("t", strtotime($year . '-' . $month . '-' . $day));
        $params = array(
            $student_id,
            $year . '-' . $month . '-01',
            $year . '-' . $month . '-' . $last_day,
            VALUE_TRANSFER_DEFAULT,
        );

        $query =  'DELETE FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ? AND transfer_flg = ? ';
        $this->db->query($query, $params);
    }

}
