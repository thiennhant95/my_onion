<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends ADMIN_Controller {

    /**
     * 会員一覧(1ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $this->view(0);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    /**
     * 会員一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('member_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 会員編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $this->load->model('student_model');
            $data= $this->student_model->get_student_data_detail($id);
            admin_layout_view('member_edit', $data);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 会員詳細
     *
     * @param   
     * @return  
     *
    */
    public function detail($id = NULL) {
        if ($this->error_flg) return;
        try {
            $this->load->model('student_model');
            $data= $this->student_model->get_student_data_detail($id);
            admin_layout_view('member_detail', $data);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function UpdateInfoMember($id = NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/l_student_meta_model');
        $this->load->model('db/m_student_model');

        if($this->m_student_model->new_update_by_id($_POST['infodata'],$id)&&$this->l_student_meta_model->update_tagMeta($_POST['metadata'],$id))
        {
            echo "Successfully";
            exit();
        }
        else
        {
            echo "UnSuccessfully";
            exit();
        }
        
    }
    public function get_data_bus_stop($id=NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/m_bus_course_model');
        $result = $this->m_bus_course_model->getData_Bus_stop_by_id($id);
        echo json_encode($result);
    }
    public function getData_class_by_id_course($id=NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/m_course_model');
        $result = $this->m_course_model->getData_class_by_id($id);
        echo json_encode($result);
    }
    public function switch_course_view($student_id=NULL)
    {
        if ($student_id==NULL) return;
        $this->load->model('db/m_course_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/l_student_course_model');
        $course = array(
            'all'=>array(),
            'select'=> '',
        );
        $course_id = isset($_POST['course_id'])?$_POST['course_id']:'';
        if($course_id!='')
        {
            $allstudent_course = $this->l_student_course_model->getData_course_by_studentid($student_id);
            $datacourse = $this->l_student_course_model->getData_course_by_studentid($student_id);
            foreach ($datacourse as $index => $row) {

                $course['all'][$index] = $row;
                $classes = $this->m_course_model->getData_class_by_id($row['course_id']);
                foreach ($classes as $key => $value) {
                    $course['all'][$index]['class'][]=$value;
                }
               

                $classesjoin = $this->l_student_course_model->getData_student_class_by_studentcourse_id($row['student_course'],$student_id);
                foreach ($classesjoin as $key => $value) {
                    $course['all'][$index]['classjoin'][]=$value;
                }
                if($course_id==$row['course_id'])
                {
                    $course['select'] = $course['all'][$index];
                }
            }

        }
        
        echo json_encode($course);
    }

}

/* End of file member.php */
/* Location: ./application/controllers/admin/member.php */