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
            $date_start=START_DATE_DEFAULT;
        }
        if ($this->input->post('date_end'))
        {
            $date_end=date("Y-m-d",strtotime($this->input->post('date_end')));
        }
        else
        {
            $date_end=END_DATE_DEFAULT;
        }
        $this->db->select("SQL_CALC_FOUND_ROWS l_student_reserve_change.*,l_student_course.course_id,m_class.base_class_sign",FALSE);
        $this->db->from('l_student_reserve_change');
        $this->db->join('l_student_course','l_student_course.student_id=l_student_reserve_change.student_id');
        $this->db->join('l_student_class','l_student_class.student_id=l_student_reserve_change.student_id');
        $this->db->join('m_class','m_class.id=l_student_class.class_id');
        $this->db->where('l_student_reserve_change.delete_flg','0');
        $this->db->where('l_student_course.delete_flg','0');
        $this->db->where('l_student_class.delete_flg','0');
        $this->db->where('m_class.delete_flg','0');
        //search course
        $course=$this->input->post('course');
        if ($this->input->post('course')!=NULL)
        {
            foreach ($course as $row_course)
            {
                $this->db->or_having('l_student_course.course_id',$row_course);
            }
        }

        //search date
        $this->db->where('target_date >=',$date_start);
        $this->db->where('target_date <=',$date_end);

        //search type
        $type=$this->input->post('type');
        if ($type!=DATA_ON){$this->db->where('type', $type);}
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        global $student_reserve;
        $data=$query->result_array();

        //search class
        global $data_search_class;
        $class=$this->input->post('class');
        if ($this->input->post('class')!=NULL)
        {
            foreach ($data as $row_data) {
                foreach ($class as $row_class)
                {
                    if ($row_data['base_class_sign']==$row_class)
                    {
                        $data_search_class[]=$row_data;
                    }
                }
            }
            if ($data_search_class==NULL)
            {
                $data_search_class=array();
            }
        }
        else if ($this->input->post('class')==NULL)
        {
            $data_search_class=$data;
        }

        //search grade name
        global $data_search;
        $grade=$this->input->post('rank');
        if ($this->input->post('rank')!=NULL) {
            foreach ($data_search_class as $row_data) {
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
            $data_search=$data_search_class;
        }

        //join name student_meta
        $this->load->model('student_model','student');
        foreach ($data_search as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_reserve[]=$row;
        endforeach;
        if ($student_reserve==null)
        {
            $student_reserve=array();
        }

        //free text search
        global $data_return;
        $free_text_search=$this->input->post('content');
        if ($this->input->post('content')!=NULL) {
            foreach ($student_reserve as $row_data) {
                if (strlen(strstr($row_data['name'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
                if (strlen(strstr($row_data['reason'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
                if (strlen(strstr($row_data['student_id'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
            }
            if ($data_return==NULL)
            {
                $data_return=array();
            }
        }
        else if ($this->input->post('content')==NULL)
        {
            $data_return=$student_reserve;
        }
        //count and limit return
        $total=count($data_return);
        $data_change=array_slice( $data_return, $start, $limit);

        $data_return=null;
        $data_search_class=null;
        $data_search=null;
        $student_reserve=null;
        return array('0'=>$data_change,'1'=>$total);
    }


    /**
     * Export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function export_csv($limit=NULL,$start=NULL,$count=FALSE)
    {
        if ($this->input->post('date_start'))
        {
            $date_start=date("Y-m-d",strtotime($this->input->post('date_start')));
        }
        else
        {
            $date_start=START_DATE_DEFAULT;
        }
        if ($this->input->post('date_end'))
        {
            $date_end=date("Y-m-d",strtotime($this->input->post('date_end')));
        }
        else
        {
            $date_end=END_DATE_DEFAULT;
        }
        $this->db->select("SQL_CALC_FOUND_ROWS l_student_reserve_change.*,l_student_course.course_id,m_class.base_class_sign",FALSE);
        $this->db->join('l_student_course','l_student_course.student_id=l_student_reserve_change.student_id');
        $this->db->join('l_student_class','l_student_class.student_id=l_student_reserve_change.student_id');
        $this->db->join('m_class','m_class.id=l_student_class.class_id');
        $this->db->where('l_student_reserve_change.delete_flg','0');
        $this->db->where('l_student_course.delete_flg','0');
        $this->db->where('l_student_class.delete_flg','0');
        $this->db->where('m_class.delete_flg','0');
        //search course
        $course=$this->input->post('course');
        if ($this->input->post('course')!=NULL)
        {
            foreach ($course as $row_course)
            {
                $this->db->or_having('l_student_course.course_id',$row_course);
            }
        }

        //search date
        $this->db->where('target_date >=',$date_start);
        $this->db->where('target_date <=',$date_end);
        //search type
        $type=$this->input->post('type');
        if ($type!=DATA_ON){$this->db->where('type', $type);}
        $this->db->order_by("id", "desc");
        $query = $this->db->get('l_student_reserve_change');
        global $student_reserve;
        $data=$query->result_array();

        //search class
        global $data_search_class;
        $class=$this->input->post('class');
        if ($this->input->post('class')!=NULL)
        {
            foreach ($data as $row_data) {
                foreach ($class as $row_class)
                {
                    if ($row_data['base_class_sign']==$row_class)
                    {
                        $data_search_class[]=$row_data;
                    }
                }
            }
            if ($data_search_class==NULL)
            {
                $data_search_class=array();
            }
        }
        else if ($this->input->post('class')==NULL)
        {
            $data_search_class=$data;
        }

        //search grade name
        global $data_search;
        $grade=$this->input->post('rank');
        if ($this->input->post('rank')!=NULL) {
            foreach ($data_search_class as $row_data) {
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
            $data_search=$data_search_class;
        }

        //join name student_meta
        $this->load->model('student_model','student');
        foreach ($data_search as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_reserve[]=$row;
        endforeach;
        if ($student_reserve==null)
        {
            $student_reserve=array();
        }

        //free text search
        global $data_return;
        $free_text_search=$this->input->post('content');
        if ($this->input->post('content')!=NULL) {
            foreach ($student_reserve as $row_data) {
                if (strlen(strstr($row_data['name'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
                if (strlen(strstr($row_data['reason'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
                if (strlen(strstr($row_data['student_id'], $free_text_search)) > 0)
                {
                    $data_return[]=$row_data;
                }
            }
            if ($data_return==NULL)
            {
                $data_return=array();
            }
        }
        else if ($this->input->post('content')==NULL)
        {
            $data_return=$student_reserve;
        }
        //count and limit return
        $total=count($data_return);
        $data_change=array_slice( $data_return, $start, $limit);
        $data_return=null;
        $data_search_class=null;
        $data_search=null;
        $student_reserve=null;
            if($count==TRUE)
            {
                return $total;
            }
            else if ($count==FALSE) {
                foreach ($data_change as $row_student_reserve)
                {
                    $last_data['id']=$row_student_reserve['id'];
                    $last_data['student_id']=$row_student_reserve['student_id'];
                    $last_data['name']=$row_student_reserve['name'];
                    $last_data['type']=$row_student_reserve['type'];
                    $last_data['course_name']=$row_student_reserve['course_name'];
                    $last_data['class_name']=$row_student_reserve['class_name'];
                    $last_data['grade_name']=$row_student_reserve['grade_name'];
                    $last_data['dist_date']=$row_student_reserve['dist_date'];
                    $last_data['dist_class_name']=$row_student_reserve['dist_class_name'];
                    $last_data['contents']=json_decode($row_student_reserve['contents'],true)['contents'];
                    $last_data['reason']=$row_student_reserve['reason'];
                    $last_data['reason_text']=$row_student_reserve['reason_text'];
                    $last_data['reason']=$row_student_reserve['reason'];
                    $last_data['test']=$row_student_reserve['test'];
                    $last_data['status']=$row_student_reserve['status']==DATA_ON?'キャンセル':'';
                    $data_return_reserve[]=$last_data;
                }
                return  $data_return_reserve;
            }
    }
}
