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
    public function getData_course_by_studentid($studentid = NULL){	
    	if($studentid == NULL) return '';

    	$query =" SELECT a.id as course_id,a.course_code , a.course_name ,a.short_course_name,a.start_date as course_startdate , 
	    			     a.end_date as course_enddate ,a.type ,a.regist_start_date,a.regist_end_date ,
					     b.id as student_course,b.student_id  , b.start_date,b.end_date,b.join_date,b.start_date ,b.end_date 
				 FROM m_course a LEFT JOIN l_student_course b ON a.id=b.course_id 
				 WHERE b.student_id= '".$studentid."'";
		$res = $this->db->query($query);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
    }

	public function getData_student_class_by_studentcourse_id($id = NULL,$student_id=NULL){	
    	if($id == NULL || $student_id==NULL) return '';

    	$query ="   SELECT
						a.course_id,
						a.student_id,b.id AS student_class_id,b.class_id,b.week_num,
						b.start_date ,b.end_date ,
						c.base_class_sign,c.class_name,c.class_code,c.`week`
					FROM
						l_student_course a,l_student_class b , m_class c 
					WHERE
						a.id = b.student_course_id  AND
						c.id = b.class_id AND
						a.id ='".$id."' AND 
						a.student_id ='".$student_id."' ";
		$res = $this->db->query($query);
		if($res === FALSE )
		{
			logerr($params, $sql);
            throw new Exception();
		}
		$result = $res->result_array();
		$this->found_rows = count($result);
        return $result;
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
