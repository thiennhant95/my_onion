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
        if( $student_class_id == NULL ) return '';
       $params = array(
            $student_class_id,
            END_DATE_DEFAULT ,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT b.id,a.class_id,a.start_date,a.week_num,b.bus_route_go_id,
                          b.bus_route_ret_id,b.student_class_id,b.student_id
                   FROM l_student_class a , l_student_bus_route b  
                   WHERE  a.id = b.student_class_id  AND b.student_class_id =? AND b.end_date = ? AND b.delete_flg = ?';

        $res = $this->db->query($query, $params);
        return $res->result_array();
    }
    public function Update_bus_route_join($bus_route_join)
    {
        
            $session_student = $this->session->userdata('admin_account');
            $admin_id = $session_student['id'];
            $current_date = date('Y-m-d');

            if( isset( $bus_route_join['base'] ) && $admin_id  != NULL )
            {
                $student_id = $bus_route_join['base']['student_id'];
                $course_id =  $bus_route_join['base']['course_id'];
                // if( !isset( $bus_route_join['arr'] ) && count($bus_route_join['arr']) > 0 )

                if( isset( $bus_route_join['arr'] ) && count($bus_route_join['arr']) > 0 )
                {
                    foreach ($bus_route_join['arr'] as $key => $value) {

                        $class_id = $value['class_id'];
                        $week_num = $value['week_num'];
                        $bus_course_go = $value['bus_course_go'];
                        $bus_stop_go = $value['bus_stop_go'];
                        $bus_course_ret = $value['bus_course_ret'];
                        $bus_stop_ret = $value['bus_stop_ret'];

                        $sql = " SELECT id FROM l_student_class WHERE student_id = ? AND class_id = ? AND week_num = ? AND end_date = ? "; 
                        $data_student_class = $this->db->query($sql, [ $student_id , $class_id ,  $week_num , END_DATE_DEFAULT ] )->result_array();

                        if( count($data_student_class) > 0)
                        {
                            $student_class_id = $data_student_class[0]['id'];
                            // search id of bus_route
                            $sql = "SELECT id FROM m_bus_route WHERE bus_course_id = ? AND bus_stop_id = ? AND delete_flg = ? "; 
                            $data_bus_route_go = $this->db->query($sql, [  $bus_course_go , $bus_stop_go  , DATA_NOT_DELETED ] )->result_array();
                            $bus_route_go_id = '' ;

                                if(count($data_bus_route_go) > 0)
                                {
                                    $bus_route_go_id = $data_bus_route_go[0]['id'];
                                }

                            $sql = " SELECT id FROM m_bus_route WHERE bus_course_id = ? AND bus_stop_id = ? AND delete_flg = ? "; 
                            $data_bus_route_ret = $this->db->query( $sql, [ $bus_course_ret , $bus_stop_ret  , DATA_NOT_DELETED ] )->result_array();
                            $bus_route_ret_id = '' ;

                                if(count($data_bus_route_ret) > 0)
                                {
                                    $bus_route_ret_id = $data_bus_route_ret[0]['id'];
                                }
                            // Update student bus route old record
                            $sql = " SELECT id , bus_route_go_id , bus_route_ret_id FROM l_student_bus_route WHERE student_id = ? AND student_class_id  = ? AND end_date = ? "; 
                            $data_bus_route = $this->db->query( $sql, [ $student_id , $student_class_id  , END_DATE_DEFAULT ] )->result_array();

                            if( count( $data_bus_route ) > 0 )
                            {
                                if(  ( $data_bus_route[0]['bus_route_go_id'] != $bus_route_go_id ) || ( $data_bus_route[0]['bus_route_ret_id'] != $bus_route_ret_id ) )
                                {
                                    $id_old = $data_bus_route[0]['id'];
                                    $this->db->update('l_student_bus_route', [ 'end_date' => $current_date , 'update_id' => $admin_id ], [ 'id' => $id_old ] );

                                    $this->db->insert('l_student_bus_route', [ 'student_id' => $student_id , 'student_class_id' => $student_class_id , 'bus_route_go_id' => $bus_route_go_id , 'bus_route_ret_id' => $bus_route_ret_id , 'start_date' => $current_date, 'end_date' => END_DATE_DEFAULT , 'create_id' => $admin_id , 'create_date' => date('Y-m-d H:i:s') ] ) ;
                                }
                            }
                            else
                            {
                                $this->db->insert('l_student_bus_route', [ 'student_id' => $student_id , 'student_class_id' => $student_class_id , 'bus_route_go_id' => $bus_route_go_id , 'bus_route_ret_id' => $bus_route_ret_id , 'start_date' => $current_date, 'end_date' => END_DATE_DEFAULT , 'create_id' => $admin_id , 'create_date' => date('Y-m-d H:i:s') ] ) ;
                            }
                        }
                    }
                    return TRUE;  
                    
                }
                else
                {
                    $sql = "SELECT id , start_date FROM l_student_course WHERE student_id = ? AND course_id = ? AND end_date = ? "; 
                    $data = $this->db->query( $sql, [  $student_id , $course_id , END_DATE_DEFAULT ] )->result_array();
                    if( $data )
                    {
                        $sql = " SELECT id   FROM l_student_class WHERE  student_course_id = ? AND student_id = ?  AND end_date = ? ";
                        $data_2 = $this->db->query( $sql , [  $data[0]['id'] , $student_id , END_DATE_DEFAULT ] )->result_array();
                        if( $data_2 )
                        {
                            foreach ( $data_2 as $key => $value ) {
                                $this->db->update('l_student_bus_route', [ 'end_date' => $current_date , 'update_id' => $admin_id ] , [ 'student_class_id' => $value['id'] ] );
                            }
                        }
                    }
                    return TRUE;       
                }  
                return FALSE;  
            }
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
