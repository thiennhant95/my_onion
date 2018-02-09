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

    /**
     * Get list student request change
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function get_list_request($limit, $start)
    {
        $sql = 'select *
                from  l_student_request
                where l_student_request.delete_flg = 0 
                order by l_student_request.id DESC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        global $student_request;
        $data=$query->result_array();
        $this->load->model('student_model','student');
        foreach ($data as $row):
            $data_student=$this->student->get_student_data($row['student_id'])['meta'];
            $row['name']=$data_student['name'];
            $student_request[]=$row;
        endforeach;
        return $student_request;
    }

}
