<?php
class L_student_request_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_exist_change_course($id)
    {
        $array = array('student_id' => $id, 'type' => 'course_change');
        $this->db->select()
               ->from('l_student_request')
               ->where($array);
        $query = count($this->db->get()->result_array());
        $status = FALSE;
        if($query > 0){
            $status = TRUE;
        }
        return $status;
    }

    public function update_type_request($type, $student_id, $data)
    {
        $this->db->trans_start();
        $where_arr = array('student_id' => $student_id ,'type' => $type); 
        $data_update = array('contents' => $data ,'status' => 0);
        $this->db->where($where_arr)
            ->update('l_student_request',  $data_update);
        $this->db->trans_complete();
        if($this->db->trans_complete()) 
        { 
            return TRUE;
            // $last_id_insert = $id;
        }
        else
        {
            return FALSE;
        }
    }

    public function get_limit_request_student($student_id)
    {
        $this->db->select()
            ->from('l_student_request')
            ->where('student_id', $student_id)
            ->order_by('create_date', 'DESC');
        $data = $this->db->get()->result_array();
        return $data;
    }

    /**
     * Get list student request change
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function get_list_request($limit, $start)
    {
        $this->db->select('SQL_CALC_FOUND_ROWS l_student_request.*',FALSE);
        $this->db->where('l_student_request.delete_flg','0');
        if ($this->input->post('status')=='2')
        {
            $this->db->where('l_student_request.status','2');
        }
        if ($this->input->post('status')=='1')
        {
            $this->db->where('l_student_request.status','1');
        }
        if ($this->input->post('status')=='0')
        {
            $this->db->where('l_student_request.status','0');
        }
        $this->db->order_by('l_student_request.id','desc');
        $this->db->limit($limit,$start);
        $query=$this->db->get('l_student_request');
        $query_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $total=$query_total->row()->count;
        global $student_request;
        $data=$query->result_array();
        $this->load->model('student_model','student');
        foreach ($data as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_request[]=$row;
        endforeach;
        //return 0 is list; return 1 is count list
        return array('0'=>$student_request,'1'=>$total);
    }

    /**
     * Search Get list student request change
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function search_get_list_request($limit, $start)
    {
        $this->db->select('SQL_CALC_FOUND_ROWS l_student_request.*',FALSE);
        $type=$this->input->post('type');
        if ($type!=DATA_ON){
            //type
            switch ($type)
            {
                case PRACTICE_COURSE:
                    $this->db->or_where('type',COURSE_CHANGE);
                    $this->db->or_where('type',EVENT_TRY);
                    break;
                case BUS_COURSE:
                    $this->db->or_where('type',BUS_CHANGE_ONCE);
                    $this->db->or_where('type',BUS_CHANGE_ETERNAL);
                    break;
                case NOTICE_OF_ABSENCE:
                    $this->db->where('type',RECESS);
                    break;
                case NOTICE_OF_WITHDRAWAL:
                    $this->db->where('type',QUIT);
                    break;
                case CHANGE_BASIC_INFORMATION:
                    $this->db->where('type',ADDRESS_CHANGE);
                    break;
            }
        }
        $this->db->where('l_student_request.delete_flg','0');
        // tab status
        if ($this->input->post('status')=='2')
        {
            $this->db->where('l_student_request.status','2');
        }
        if ($this->input->post('status')=='1')
        {
            $this->db->where('l_student_request.status','1');
        }
        if ($this->input->post('status')=='0')
        {
            $this->db->where('l_student_request.status','0');
        }
        $this->db->order_by('l_student_request.id','desc');
        $query=$this->db->get('l_student_request');
        global $student_request;
        $data=$query->result_array();
        //join student meta
        $this->load->model('student_model','student');
        foreach ($data as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_request[]=$row;
        endforeach;
        global $data_search;
        $free_text_search=$this->input->post('free_text_search');
        if ($this->input->post('free_text_search')!=NULL) {
            foreach ($student_request as $row_data) {
                    if (strlen(strstr($row_data['name'], $free_text_search)) > 0)
                    {
                        $data_search[]=$row_data;
                    }
                    if (strlen(strstr($row_data['message'], $free_text_search)) > 0)
                    {
                        $data_search[]=$row_data;
                    }
                    if (strlen(strstr($row_data['student_id'], $free_text_search)) > 0)
                    {
                        $data_search[]=$row_data;
                    }
            }
            if ($data_search==NULL)
            {
                $data_search=array();
            }
        }
        else if ($this->input->post('free_text_search')==NULL)
        {
            $data_search=$student_request;
        }

        if ($this->input->post('date_start'))
        {
            $date_start=date("Y-m",strtotime($this->input->post('date_start')));
        }
        else
        {
            $date_start=START_DATE_DEFAULT;
        }
        if ($this->input->post('date_end'))
        {
            $date_end=date("Y-m",strtotime($this->input->post('date_end')));
        }
        else
        {
            $date_end=END_DATE_DEFAULT;
        }
        global $request_data;
        foreach ($data_search as $data_date)
        {
            $data_content=json_decode($data_date['contents'],true);
            if ($date_start<=$data_content['date_change'] && $data_content['date_change']<=$date_end)
            {
                $request_data[]=$data_date;
            }
        }
        if ($request_data==null)
        {
                $request_data=array();
        }

        $total=count($request_data);
        $data_search_return=array_slice( $request_data, $start, $limit);

        return array('0'=>$data_search_return,'1'=>$total);
    }

    /**
     * export export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function export_csv($limit=NULL,$start=NULL,$count=FALSE)
    {
        $this->db->select('SQL_CALC_FOUND_ROWS l_student_request.*',FALSE);
        $type=$this->input->post('type');
        if ($type!=DATA_ON){
            //type
            switch ($type)
            {
                case PRACTICE_COURSE:
                    $this->db->or_where('type',COURSE_CHANGE);
                    $this->db->or_where('type',EVENT_TRY);
                    break;
                case BUS_COURSE:
                    $this->db->or_where('type',BUS_CHANGE_ONCE);
                    $this->db->or_where('type',BUS_CHANGE_ETERNAL);
                    break;
                case NOTICE_OF_ABSENCE:
                    $this->db->where('type',RECESS);
                    break;
                case NOTICE_OF_WITHDRAWAL:
                    $this->db->where('type',QUIT);
                    break;
                case CHANGE_BASIC_INFORMATION:
                    $this->db->where('type',ADDRESS_CHANGE);
                    break;
            }
        }
        $this->db->where('l_student_request.delete_flg','0');
        // tab status
        if ($this->input->post('status')=='2')
        {
            $this->db->where('l_student_request.status','2');
        }
        if ($this->input->post('status')=='1')
        {
            $this->db->where('l_student_request.status','1');
        }
        if ($this->input->post('status')=='0')
        {
            $this->db->where('l_student_request.status','0');
        }
        $this->db->order_by('l_student_request.id','desc');
        $query=$this->db->get('l_student_request');
        $data=$query->result_array();
        //join student meta
        global $student_request;
        $this->load->model('student_model','student');
        foreach ($data as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_request[]=$row;
        endforeach;
        //search free text
        global $data_search;
        $free_text_search=$this->input->post('free_text_search');
        if ($this->input->post('free_text_search')!=NULL) {
            foreach ($student_request as $row_data) {
                if (strlen(strstr($row_data['name'], $free_text_search)) > 0)
                {
                    $data_search[]=$row_data;
                }
                if (strlen(strstr($row_data['message'], $free_text_search)) > 0)
                {
                    $data_search[]=$row_data;
                }
                if (strlen(strstr($row_data['student_id'], $free_text_search)) > 0)
                {
                    $data_search[]=$row_data;
                }
            }
            if ($data_search==NULL)
            {
                $data_search=array();
            }
        }
        else if ($this->input->post('free_text_search')==NULL)
        {
            $data_search=$student_request;
        }
        //date search
        if ($this->input->post('date_start'))
        {
            $date_start=date("Y-m",strtotime($this->input->post('date_start')));
        }
        else
        {
            $date_start=START_DATE_DEFAULT;
        }
        if ($this->input->post('date_end'))
        {
            $date_end=date("Y-m",strtotime($this->input->post('date_end')));
        }
        else
        {
            $date_end=END_DATE_DEFAULT;
        }
        $student_request=null;
        global $request_data;
        foreach ($data_search as $data_date)
        {
            $data_content=json_decode($data_date['contents'],true);
            if ($date_start<=$data_content['date_change'] && $data_content['date_change']<=$date_end)
            {
                $request_data[]=$data_date;
            }
        }
        if ($request_data==null)
        {
            $request_data=array();
        }
        $data_search=null;
        $total=count($request_data);
        $data_search_return=array_slice( $request_data, $start, $limit);
        $request_data=null;
        if($count==TRUE)
        {
            return $total;
        }
        else if ($count==FALSE) {
            return $data_search_return;
        }
    }

    /**
     * Get_where
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function get_where($conditions = false,$start_index = NULL,$number = NULL,$order_by = NULL,$order_type = NULL)
    {
        if($conditions) {
            $this->db->where($conditions);
        }
        if($start_index !== NULL && $number !== NULL){
            $this->db->limit($number,$start_index);
        }

        if($order_by !== NULL && $order_type !== NULL){
            $this->db->order_by($order_by,$order_type);
        }
        $this->db->where('delete_flg','0');
        return $this->db->get('l_student_request')->result_array();
    }

}
