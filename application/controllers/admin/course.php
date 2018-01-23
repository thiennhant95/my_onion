<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_item_model','item');
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
            if ($this->input->post())
            {

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