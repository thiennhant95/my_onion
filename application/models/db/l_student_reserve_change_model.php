<?php
class L_student_reserve_change_model extends DB_Model {

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
     * Get list student reserve change
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function get_list_student_reserve($limit, $start)
    {
        $sql = 'select *
                from  l_student_reserve_change
                where l_student_reserve_change.delete_flg = 0 
                order by l_student_reserve_change.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        global $student_reserve;
        $data=$query->result_array();
        $this->load->model('student_model','student');
        foreach ($data as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_reserve[]=$row;
        endforeach;
        return $student_reserve;
    }

    /**
     * Get list Search student reserve change
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function get_list_student_reserve_search($limit,$start)
    {
        if ($this->input->post('date_start'))
        {
            $date_start=date("Y-m-d",strtotime($this->input->post('date_start')));
        }
        else
        {
            $date_start='1970/01/01';
        }
        if ($this->input->post('date_end'))
        {
            $date_end=date("Y-m-d",strtotime($this->input->post('date_end')));
        }
        else
        {
            $date_end='2100-01-01';
        }
        $this->db->select("SQL_CALC_FOUND_ROWS l_student_reserve_change.*,l_student_course.course_id,m_class.base_class_sign",FALSE);
        $this->db->join('l_student_course','l_student_course.student_id=l_student_reserve_change.student_id');
        $this->db->join('l_student_class','l_student_class.student_id=l_student_reserve_change.student_id');
        $this->db->join('m_class','m_class.id=l_student_class.class_id');
        $course=$this->input->post('course');
        if ($this->input->post('course')!=NULL)
        {
            foreach ($course as $row_course)
            {
                $this->db->or_like('l_student_course.course_id',$row_course);
            }
        }
        $class=$this->input->post('class');
        if ($this->input->post('class')!=NULL)
        {
            foreach ($class as $row_class)
            {
                $this->db->or_having('m_class.base_class_sign',$row_class);
            }
        }
        $this->db->where('target_date >=',$date_start);
        $this->db->where('target_date <=',$date_end);
        $type=$this->input->post('type');
        if ($type!=DATA_ON){$this->db->where('type', $type);}
        if ($this->input->post('content')!=NULL) {
            $free_text_search = $this->input->post('content');
            $this->db->or_like('contents', $free_text_search, 'none');
            $this->db->or_like('reason', $free_text_search, 'none');
            $this->db->or_like('reason_text', $free_text_search, 'none');
            $this->db->or_like('dist_class_name', $free_text_search, 'none');
            $this->db->or_like('l_student_reserve_change.student_id', $free_text_search, 'none');
        }
        $this->db->order_by("id", "desc");
//        $this->db->limit($limit, $start);
        $query = $this->db->get('l_student_reserve_change');
        global $student_reserve;
//        $query_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
//        $total=$query_total->row()->count;
        $data=$query->result_array();
        global $data_search;
        $grade=$this->input->post('rank');
        if ($this->input->post('rank')!=NULL) {
            foreach ($data as $row_data) {
                foreach ($grade as $row_grade) {
                    if ($row_data['grade_name']==$row_grade)
                    {
                        $data_search[]=$row_data;
                    }
                }
            }
            if ($data_search==NULL)
            {
                $data_search=array();
            }
        }
        else if ($this->input->post('rank')==NULL)
        {
            $data_search=$data;
        }

        $total=count($data_search);
        $data_search=array_slice( $data_search, $start, $limit);
        $this->load->model('student_model','student');
        foreach ($data_search as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_reserve[]=$row;
        endforeach;
        return array('0'=>$student_reserve,'1'=>$total);
    }


    public function export_csv($limit=NULL,$start=NULL,$count=FALSE)
    {
            if ($this->input->post('date_start'))
            {
                $date_start=date("Y-m-d",strtotime($this->input->post('date_start')));
            }
            else
            {
                $date_start='1970/01/01';
            }
            if ($this->input->post('date_end'))
            {
                $date_end=date("Y-m-d",strtotime($this->input->post('date_end')));
            }
            else
            {
                $date_end='2100-01-01';
            }
            $this->db->select("SQL_CALC_FOUND_ROWS l_student_reserve_change.id,l_student_reserve_change.student_id,l_student_reserve_change.type,l_student_reserve_change.course_name,l_student_reserve_change.class_name,l_student_reserve_change.grade_name,
                    l_student_reserve_change.target_date,l_student_reserve_change.dist_date,l_student_reserve_change.dist_class_name,l_student_reserve_change.contents,l_student_reserve_change.reason,l_student_reserve_change.reason_text,l_student_reserve_change.test,l_student_reserve_change.status,m_class.base_class_sign",FALSE);
            $this->db->join('l_student_course','l_student_course.student_id=l_student_reserve_change.student_id');
            $this->db->join('l_student_class','l_student_class.student_id=l_student_reserve_change.student_id');
            $this->db->join('m_class','m_class.id=l_student_class.class_id');
            $course=$this->input->post('course');
            if ($this->input->post('course')!=NULL)
            {
                foreach ($course as $row_course)
                {
                    $this->db->or_like('l_student_course.course_id',$row_course);
                }
            }
            $class=$this->input->post('class');
            if ($this->input->post('class')!=NULL)
            {
                foreach ($class as $row_class)
                {
                    $this->db->or_having('m_class.base_class_sign',$row_class);
                }
            }
            $this->db->where('target_date >=',$date_start);
            $this->db->where('target_date <=',$date_end);
            $type=$this->input->post('type');
            if ($type!=DATA_ON){$this->db->where('type', $type);}
            if ($this->input->post('content')!=NULL) {
                $free_text_search = $this->input->post('content');
                $this->db->or_like('contents', $free_text_search, 'none');
                $this->db->or_like('reason', $free_text_search, 'none');
                $this->db->or_like('reason_text', $free_text_search, 'none');
                $this->db->or_like('dist_class_name', $free_text_search, 'none');
                $this->db->or_like('l_student_reserve_change.student_id', $free_text_search, 'none');
            }
            $this->db->order_by("id", "desc");
            $query = $this->db->get('l_student_reserve_change');
            global $student_reserve;
            $data=$query->result_array();
            global $data_search;
            $grade=$this->input->post('rank');
            if ($this->input->post('rank')!=NULL) {
                foreach ($data as $row_data) {
                    foreach ($grade as $row_grade) {
                        if ($row_data['grade_name']==$row_grade)
                        {
                            $data_search[]=$row_data;
                        }
                    }
                }
                if ($data_search==NULL)
                {
                    $data_search=array();
                }
            }
            else if ($this->input->post('rank')==NULL)
            {
                $data_search=$data;
            }
            $total=count($data_search);
            $data_search=array_slice( $data_search, $start, $limit);
            $this->load->model('student_model','student');
            foreach ($data_search as $row):
                $data_student=$this->student->get_student_data($row['student_id'])['meta'];
                $row['name']=$data_student['name'];
                $student_reserve[]=$row;
            endforeach;
            if($count==TRUE)
            {
                return $total;
            }
            else if ($count==FALSE) {
                return $student_reserve;
            }
    }
}
