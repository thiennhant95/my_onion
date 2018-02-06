<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reschedule extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('db/l_student_reserve_change_model','student_reserve');
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_grade_model','grade');
        $this->load->library("pagination");

    }

    /**
     * 欠席振替申請一覧(1ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['course_list']=$this->course->get_list();
            $data['class_list']=$this->class->get_list();
            $data['grade_list']=$this->grade->get_list();
//            $data['student_reserve_list']=$this->student_reserve->get_list();
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/reschedule/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md pagination-main">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->student_reserve->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['student_reserve_list']=$this->student_reserve->get_list_student_reserve($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $this->viewVar=$data;
            $this->view(0);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 欠席振替申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/admin/reschedule.php */