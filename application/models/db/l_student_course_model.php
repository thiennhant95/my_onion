<?php
class L_student_course_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function getData_course_valid_by_studentid($student_id = NULL){	
    	if( $student_id == NULL ) return '';
    	$params = array(
    		$student_id ,
    		END_DATE_DEFAULT ,
    		DATA_NOT_DELETED ,
    		DATA_NOT_DELETED , 
    		DATA_INVALID_NO
    	);
    	$query =" SELECT a.id as course_id , a.course_code , a.course_name , a.short_course_name , a.start_date as course_startdate , 
	    			     a.end_date as course_enddate ,a.type , a.regist_start_date , a.regist_end_date , a.practice_max,
						 a.cost_item_id , a.rest_item_id , a.bus_item_id ,
					     b.id as student_course,b.student_id , b.start_date , b.end_date , b.join_date , b.start_date , b.end_date 
				  FROM   m_course a  JOIN l_student_course b ON a.id = b.course_id 
				  WHERE  b.student_id = ? AND b.end_date = ? AND b.delete_flg = ? AND 
			  			 a.delete_flg = ? AND a.regist_end_date >= DATE_FORMAT( NOW(), '%Y%m%d' ) AND a.invalid_flg = ? ";
		$res = $this->db->query( $query,$params );
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
    }

	public function getData_class_by_id($id = NULL){	
    	if( $id == NULL || $id == '') return '';
    	$params = array( $id , DATA_NOT_DELETED  ,END_DATE_DEFAULT , DATA_NOT_DELETED , DATA_NOT_DELETED , DATA_INVALID_NO );
    	$query ="   SELECT 
						a.id , a.course_id,
						a.student_id , b.id AS student_class_id , b.class_id , b.week_num,
						b.start_date , b.end_date , c.max_count ,
						c.base_class_sign , c.class_name , c.class_code , c.`week`
					FROM
						l_student_course a , l_student_class b , m_class c 
					WHERE
						a.id = b.student_course_id  AND c.id = b.class_id AND a.id = ? AND a.delete_flg = ? AND 
						b.end_date = ? AND  b.delete_flg = ? AND 
						c.delete_flg = ? AND c.invalid_flg = ? " ;

		$res = $this->db->query( $query,$params )->result_array();
		 if( count($res) > 0 )
		 {
			foreach( $res as $index => $item )
			{
				$query = " SELECT COUNT( id ) as num_ber FROM l_student_class  WHERE  class_id = ? AND week_num = ? AND end_date = ?  ";
				$data =  $this->db->query($query , [ $item['class_id'] , $item['week_num'] , END_DATE_DEFAULT ])->result_array();
				if( count( $data ) > 0)
				{
					$res[ $index ][ 'week_full' ] = [ $item['week_num'] , $data[0]['num_ber'] ];
				}
			}
		 }
        return $res;
	}
	/**
     * Function get Data class join by course_id and student_id 
     * 
     * @access public
	 * @author  Bao - Viet Vang JSC
     */
	public function get_valid_course_by( $course_id = NULL , $student_id = NULL){	

    	if($course_id == NULL || $student_id ==NULL ) return '';
    	$params = array( $course_id , $student_id , END_DATE_DEFAULT , END_DATE_DEFAULT , DATA_NOT_DELETED , DATA_INVALID_NO );
    	$query ="   SELECT 
						a.id , a.course_id , a.student_id , b.id AS student_class_id , b.class_id , b.week_num , b.start_date , b.end_date ,
						c.base_class_sign , c.class_name , c.class_code , c.`week` , c.max_count
					FROM
						l_student_course a , l_student_class b , m_class c 
					WHERE 
						a.id = b.student_course_id  AND c.id = b.class_id AND
						a.course_id = ? AND a.student_id = ?  AND a.end_date  = ? AND b.end_date  = ? AND a.delete_flg = ? AND c.invalid_flg = ? " ;

		$res = $this->db->query($query,$params)->result_array();
		if( count($res) > 0 )
		{
		   foreach( $res as $index => $item )
		   {
			   $query = " SELECT COUNT( id ) as num_ber FROM l_student_class  WHERE  class_id = ? AND week_num = ? AND end_date = ?  ";
			   $data =  $this->db->query($query , [ $item['class_id'] , $item['week_num'] , END_DATE_DEFAULT ])->result_array();
			   if( count( $data ) > 0)
			   {
				   $res[ $index ][ 'week_full' ] = [ $item['week_num'] , $data[0]['num_ber'] ];
			   }
		   }
		}
        return $res;
	}
	public function Update_course($array_course_join='')
	{
		$session_student = $this->session->userdata('admin_account');
        $admin_id = $session_student['id'];

		if( isset( $array_course_join['course_id'] ) && isset( $array_course_join['student_id'] ) && $admin_id != NULL )
		{
			$student_id = $array_course_join['student_id'];
			$course_id = $array_course_join['course_id'];
			$_timestamp = date('Y-m-d H:i:s');

			$sql = " SELECT *  FROM m_course WHERE id = ? AND invalid_flg = ? AND delete_flg = ? "; 
			$result = $this->db->query( $sql, [ $course_id , DATA_INVALID_NO , DATA_NOT_DELETED ] )->result_array();
			if( count( $result ) == 0 ) return FALSE;
			$type = $result[0]['type'];
			$start_date =  $result[0]['type'] == VALUE_COURSE_TYPE_NORMAL ? date('Y-m-d') : $result[0]['start_date'] ;
			
			$sql = " SELECT id FROM l_student_course WHERE student_id = ? AND course_id != ? AND end_date = ? AND delete_flg = ?"; 
			$result_1 = $this->db->query( $sql, [ $student_id , $course_id , END_DATE_DEFAULT , DATA_NOT_DELETED ] )->result_array();
			if( count( $result_1 ) > 0 )
			{
				$id_old_student_course = $result_1[0]['id'];

				$this->db->update('l_student_course', [ 'end_date' => date('Y-m-d') , 'update_date' => $_timestamp , 'update_id' => $admin_id ], [ 'id' => $id_old_student_course ]);
				if( $type == VALUE_COURSE_TYPE_FREE )
					$this->db->insert('l_student_course', [ 'student_id' => $student_id , 'course_id' => $course_id , 'start_date' => $start_date , 'end_date' => END_DATE_DEFAULT  , 'join_date' => date( 'Y-m-d' ) , 'create_date' => $_timestamp ,'update_date' => $_timestamp , 'create_id' => $admin_id ] ) ;
				else
					$this->db->insert('l_student_course', [ 'student_id' => $student_id , 'course_id' => $course_id , 'start_date' => $start_date , 'end_date' => END_DATE_DEFAULT , 'create_date' => $_timestamp , 'update_date' => $_timestamp , 'create_id' => $admin_id ] ) ;
			}
			else{

				$sql = " SELECT id FROM l_student_course WHERE student_id = ? AND course_id = ? AND end_date = ? AND delete_flg = ?"; 
				$result_2 = $this->db->query( $sql, [ $student_id , $course_id , END_DATE_DEFAULT , DATA_NOT_DELETED ] )->result_array();
				
				if( count( $result_2 ) > 0  ) return TRUE;

				if( $type == VALUE_COURSE_TYPE_FREE )
					$this->db->insert('l_student_course', [ 'student_id' => $student_id , 'course_id' => $course_id , 'start_date' => $start_date , 'end_date' => END_DATE_DEFAULT , 'join_date' => date( 'Y-m-d' ) , 'create_date' => $_timestamp , 'update_date' => $_timestamp , 'create_id' => $admin_id ] ) ;
				else
					$this->db->insert('l_student_course', [ 'student_id' => $student_id , 'course_id' => $course_id , 'start_date' => $start_date , 'end_date' => END_DATE_DEFAULT ,  'create_date' => $_timestamp , 'update_date' => $_timestamp , 'create_id' => $admin_id ] ) ;
			}
			return TRUE;
		}
		return FALSE;
	}
	
	public function get_time_join_course($id_student)
	{
		$arr = array('student_id' => $id_student, 'end_date ' => END_DATE_DEFAULT);
		$this->db->select('start_date')
            ->from('l_student_course')
            ->where($arr);
        $this->db->order_by('start_date', 'ASC');
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
	 * @author  Tran Thien Nhan Viet Vang JSC
     */
    public function edit_by_where($whereclause, $information,$table=NULL)
    {
        if($table == NULL)
            $table = 'l_student_course';
        $this->db->where($whereclause);
        $this->db->update($table, $information);
        return $this->db->affected_rows() !== false;
    }

    public function check_change_course( $id, $course_id ) {
        $sql = "
            SELECT lsc.id
            FROM l_student_course lsc
            WHERE lsc.student_id = '$id'
            AND lsc.course_id = '$course_id'
            AND lsc.end_date = '" . END_DATE_DEFAULT . "'
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    public function update_course_change( $id, $date ) {
        $sql = "
            UPDATE l_student_course lsc
            SET lsc.end_date = '$date'
            WHERE lsc.student_id = '$id'
            AND lsc.end_date = '" . END_DATE_DEFAULT . "'
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return TRUE;
    }
}
