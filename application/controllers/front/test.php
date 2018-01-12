<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends FRONT_Controller {

    public function index() {
        $this->load->model('student_model');
        $result = $this->student_model->get_student_data(1);
        new dBug($result);
    }

    public function index2() {
        $this->load->model('db/m_course_model');
        $result = $this->m_course_model->is_course_limited_by_id(1);
        new dBug($result);
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/front/top.php */