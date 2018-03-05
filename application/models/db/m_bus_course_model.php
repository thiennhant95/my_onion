<?php
class M_bus_course_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function getData_Bus_stop_by_class_id($class_id = NULL)
    {	
    	if($class_id == NULL) return '';

    	$query =" SELECT m_bus_route.id as bus_route_id , m_bus_route.go_time , m_bus_route.ret_time , " ; 
		$query.="        m_bus_stop.id as bus_stop_id, m_bus_stop.bus_stop_code , m_bus_stop.bus_stop_name " ;
        $query.=" FROM   m_bus_course , m_bus_route , m_bus_stop  ";
        $query.=" WHERE  m_bus_route.bus_course_id = m_bus_course.id AND ";
		$query.="		 m_bus_route.bus_stop_id = m_bus_stop.id AND ";
		$query.="		  m_bus_course.delete_flg = '".DATA_NOT_DELETED."' AND ";
		$query.="		 m_bus_course.class_id = '".$class_id."'" ;
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
    public function getData_Bus_stop_by_id($id = NULL)
    {	
    	if($id == NULL) return '';

    	$query =" SELECT m_bus_stop.id as bus_stop_id, m_bus_stop.bus_stop_code , m_bus_stop.bus_stop_name ";
        $query.=" FROM   m_bus_course , m_bus_route , m_bus_stop  ";
        $query.=" WHERE  m_bus_route.bus_course_id = m_bus_course.id AND ";
		$query.="		 m_bus_route.bus_stop_id = m_bus_stop.id AND ";
		$query.="		 m_bus_course.delete_flg = '".DATA_NOT_DELETED."' AND ";
		$query.="		 m_bus_course.id = '".$id."'" ;
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

    public function get_data_class_and_bus_course($class_id)
    {
        if($class_id == NULL) return '';

        $query =" SELECT b.id ,b.class_id ,a.base_class_sign,a.class_code,a.class_name,a.delete_flg,b.bus_course_code,b.bus_course_name,b.max ";
        $query.=" FROM   m_class a , m_bus_course b  ";
        $query.=" WHERE  a.id = b.class_id AND  ";
        $query.="        a.delete_flg = '".DATA_NOT_DELETED."' AND ";
        $query.="        b.class_id = '".$class_id."'" ;
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

    /**
     * Get list bus course
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function get_list_bus_course($limit, $start)
    {
        $sql = 'select m_bus_course.id,m_bus_course.bus_course_code,m_bus_course.bus_course_name,m_bus_course.max,m_class.class_name 
                from m_bus_course JOIN m_class ON m_bus_course.class_id = m_class.id 
                where m_bus_course.delete_flg = 0 and m_class.delete_flg=0
                order by m_bus_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get list bus course export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        $sql = 'select m_bus_course.bus_course_code,m_bus_course.bus_course_name,m_bus_course.max,m_class.class_name 
                from m_bus_course JOIN m_class ON m_bus_course.class_id = m_class.id 
                where m_bus_course.delete_flg = 0 and m_class.delete_flg=0
                order by m_bus_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_student_class_change_bus( $student_id ) {
        $sql = "
            SELECT lsc.student_course_id, lsc.class_id, lsc.week_num, mc.class_name 
            FROM l_student_class lsc
            LEFT JOIN m_class mc
            ON lsc.class_id = mc.id 
            WHERE student_id = '$student_id' 
            AND end_date LIKE '%2199-12-31%' 
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function get_student_bus_route_change_bus( $student_id, $class_id ) {
        $sql = "
            SELECT lsbr.bus_route_go_id, lsbr.bus_route_ret_id 
            FROM l_student_bus_route lsbr
            WHERE  lsbr.student_id = '$student_id' 
            AND lsbr.student_class_id = '$class_id' 
            AND lsbr.end_date LIKE '%2199-12-31%' 
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function get_bus_course_change_bus( $bus_route_id ) {
        $sql = "
            SELECT mbr.bus_course_id, mbc.bus_course_name, mbr.route_order, mbr.bus_stop_id, mbs.bus_stop_name 
            FROM m_bus_route mbr
            LEFT JOIN m_bus_course mbc
            ON mbr.bus_course_id = mbc.id
            LEFT JOIN m_bus_stop mbs
            ON mbr.bus_stop_id = mbs.id
            WHERE mbr.id = '$bus_route_id'
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function get_bus_course_by_class_id( $class_id ) {
        $sql = "
            SELECT mbc.id, mbc.bus_course_name
            FROM m_bus_course mbc
            WHERE mbc.class_id = '$class_id'
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function get_bus_route_by_bus_course_id( $bus_course_id ) {
        $sql = "
            SELECT mbr.id, mbr.route_order, mbr.bus_stop_id, mbs.bus_stop_name
            FROM m_bus_route mbr
            LEFT JOIN m_bus_stop mbs 
            ON mbr.bus_stop_id = mbs.id
            WHERE mbr.bus_course_id = '$bus_course_id'
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function check_bus_exists( $student_id, $type ) {
        $sql = "
            SELECT *
            FROM l_student_request lsr
            WHERE lsr.student_id = '$student_id'
            AND lsr.type = '$type'
            AND lsr.status = 0
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return $query->result_array();
    }

    function update_bus_course_exists( $student_id, $type, $contents ) {
        $sql = "
            UPDATE l_student_request lsr
            SET contents = '$contents'
            WHERE lsr.student_id = '$student_id'
            AND lsr.type = '$type'
            AND lsr.status = 0
        ";
        $query = $this->db->query( $sql );
        if ( $query === FALSE ) {
            logerr($params, $sql);
            throw new Exception();
        }
        return TRUE;
    }
}
