<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_item_model','item');
        $this->load->model('db/m_grade_model','grade');
        $this->load->library('form_validation');
    }

    /**
     * 練習コースマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['course_list']=$this->course->get_list();
            $data['item_list']=$this->item->get_list();

            $this->viewVar=$data;
            admin_layout_view('course_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_course']=$this->course->select_by_id($id)[0];
            $data['item_list']=$this->item->get_list();
            $data['grade_list']=$this->grade->get_list();
            if ($this->input->post())
            {
                if($this->input->post('course_code') != $data['get_course']['course_code'])
                {
                    $is_unique_code =  '|is_unique[m_course#course_code]';
                }
                else {
                    $is_unique_code =  '';
                }
                if($this->input->post('short_course_name') != $data['get_course']['short_course_name'])
                {
                    $is_unique_short =  '|is_unique[m_course#short_course_name]';
                }
                else {
                    $is_unique_short =  '';
                }
                $this->form_validation->set_rules('course_code', 'course_code', 'required|trim|xss_clean'.$is_unique_code);
//                $this->form_validation->set_rules('short_course_name', 'short_course_name', 'required|trim|xss_clean'.$is_unique_short);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'subject_code' => $this->input->post('subject_code'),
                        'subject_name' => $this->input->post('subject_name')
                    );
//                    $this->subject->update_by_id($dataUpdate);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar=$data;
            admin_layout_view('course_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_item($id = NULL)
    {
        if ($this->error_flg) return;
        try {
            $data_item= $this->item->select_by_id($id)[0];
            echo json_encode($data_item);
            die();
        }catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file course.php */
/* Location: ./application/controllers/admin/course.php */