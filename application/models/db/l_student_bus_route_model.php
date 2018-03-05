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
    public function get_data_student_class($student_class_id)
    {
        if($student_class_id==Null) return '';
       $params = array(
            $student_class_id,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT b.id,a.class_id,a.start_date,a.week_num,b.bus_route_go_id,
                          b.bus_route_ret_id,b.student_class_id,b.student_id
                   FROM l_student_class a , l_student_bus_route b  
                   WHERE  a.id = b.student_class_id  AND b.student_class_id =? AND b.delete_flg=? ';

        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        return $res->result_array();
    }

    /**
     * Function edit
     * Update information of an object by its ID
     * @param int $id the object ID
     * @param array $information object information
     * @return boolean
     * @access public
     * @author  Tran Thien Nhan Viet Vang JSC
     */
    public function edit_by_where($whereclause, $information,$table=NULL)
    {
        if($table == NULL)
            $table = 'l_student_bus_route';
        $this->db->where($whereclause);
        $this->db->update($table, $information);
        return $this->db->affected_rows() !== false;
    }

}
