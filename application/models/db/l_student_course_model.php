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
    	if($student_id == NULL) return '';
    	$params = array(
    		$student_id,
    		END_DATE_DEFAULT
    	);
    	$query =" SELECT a.id as course_id,a.course_code , a.course_name ,a.short_course_name,a.start_date as course_startdate , 
	    			     a.end_date as course_enddate ,a.type ,a.regist_start_date,a.regist_end_date ,
					     b.id as student_course,b.student_id , b.start_date,b.end_date,b.join_date,b.start_date ,b.end_date 
				  FROM   m_course a  JOIN l_student_course b ON a.id=b.course_id 
				  WHERE  b.student_id = ? AND b.end_date = ? ";
		$res = $this->db->query($query,$params);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
    }

	public function getData_class_by_id($id = NULL){	
    	if($id == NULL ) return '';
    	$params = array(
    		$id ,
    		END_DATE_DEFAULT
    	);
    	$query ="   SELECT 
						a.id,a.course_id,
						a.student_id,b.id AS student_class_id,b.class_id,b.week_num,
						b.start_date ,b.end_date ,
						c.base_class_sign,c.class_name,c.class_code,c.`week`
					FROM
						l_student_course a,l_student_class b , m_class c 
					WHERE
						a.id = b.student_course_id  AND
						c.id = b.class_id AND
						a.id = ? AND
						b.end_date = ? ";

		$res = $this->db->query($query,$params);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
	}
	public function get_valid_course_by($course_id = NULL,$student_id =NULL){	
    	if($course_id == NULL || $student_id ==NULL ) return '';
    	$params = array(
    		$course_id,
    		$student_id ,
    		END_DATE_DEFAULT,
    		END_DATE_DEFAULT,
    	);
    	$query ="   SELECT 
						a.id,a.course_id,
						a.student_id,b.id AS student_class_id,b.class_id,b.week_num,
						b.start_date ,b.end_date ,
						c.base_class_sign,c.class_name,c.class_code,c.`week`
					FROM
						l_student_course a,l_student_class b , m_class c 
					WHERE
						a.id = b.student_course_id  AND
						c.id = b.class_id AND
						a.course_id =? AND a.student_id=?  AND
						a.end_date  = ? AND b.end_date  = ? ";

		$res = $this->db->query($query,$params);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
	}
	public function Update_course($array_course_join='')
	{
		if(isset($array_course_join['course_id'])&&isset($array_course_join['student_id']))
		{
			$student_id = $array_course_join['student_id'];
			$course_id = $array_course_join['course_id'];

			$sql = "SELECT id FROM l_student_course WHERE student_id = ? AND course_id != ? AND end_date = ?"; 
			$data = $this->db->query($sql, array(  $student_id , $course_id , END_DATE_DEFAULT))->result_array();
			if(count($data))
			{
				$id_old_student_course = $data[0]['id'];
				$current_date = date('Y-m-d');

				$sql = "SELECT start_date FROM m_course WHERE id = ? "; 
				$result = $this->db->query($sql, array( $course_id ))->result_array();

				$this->db->update('l_student_course', array( 'end_date' => $current_date ), array('id' => $id_old_student_course) );
				$this->db->insert('l_student_course', array( 'student_id' => $student_id , 'course_id' => $course_id , 'start_date' => $result[0]['start_date'] , 'end_date' => END_DATE_DEFAULT , 'join_date' => $current_date) ) ;
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

}
