<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_course_model','course');
        $this->load->library('form_validation');
    }

    /**
     * クラスマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['class_list']= $this->class->get_list();
            $data['course_list']=$this->course->get_list();
            $this->viewVar=$data;
            admin_layout_view('classes_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * クラス登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_class']=$this->class->select_by_id($id)[0];
            $data['course_list']=$this->course->get_list();
            $data['get_course']=$this->course->select_by_id($data['get_class']['course_id'])[0];
            if ($this->input->post()) {
                $id_course = $this->input->post('short_course_name');
                $data_course=$this->course->select_by_id($id_course)[0];
                echo $data_course['short_course_name'];
                echo $this->input->post('class_code');
                die();
                if($this->input->post('short_course_name') != $data['get_class']['class_code'])
                {
                    $is_unique =  '|is_unique[m_class#class_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('item_code', 'item_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'class_code' => $this->input->post('class_code'),
                        'class_name' => $this->input->post('class_name'),
                        'course_id'=>$this->input->post('course_id'),
                        'grade_manage_flg'=>$this->input->post('grade_manage_flg'),
                        'use_bus_flg'=>$this->input->post('use_bus_flg'),
                        'week'=>$this->input->post('week'),
                        'invalid_flg'=>$this->input->post('invalid_flg'),
                    );
                    $this->class->update_by_id($dataUpdate);
                    echo DATA_ON;
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo DATA_OFF;
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('classes_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file class.php */
/* Location: ./application/controllers/admin/class.php */