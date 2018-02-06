<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends FRONT_Controller {

    /**
     * トップページ
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 基本情報変更
     *
     * @param   
     * @return  
     *
    */
    public function change_base_info() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_base_info', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バスコース変更
     *
     * @param   
     * @return  
     *
    */
    public function change_bus() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_bus', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース変更
     *
     * @param   
     * @return  
     *
    */
    public function change_course() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_course', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース変更申請完了
     *
     * @param   
     * @return  
     *
    */
    public function change_course_complete() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_course_complete', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 休会届
     *
     * @param   
     * @return  
     *
    */
    public function leave() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_leave', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function save_request_leave()
    {
        //$this->accountVar
        $idMember = 1;
        if(isset($_POST['start_date'])&&$_POST['start_date']!=''&&isset($_POST['end_date'])&&$_POST['end_date']!='')
        {
            
            $start_date = date_format(date_create($_POST['start_date'].'-1'),'Y-m-d');
            $end_date = date_format(date_create($_POST['end_date'].'-1'),'Y-m-d');
            $note = isset($_POST['note'])?$_POST['note']:'';
            $content = json_encode(['start_date'=>$start_date,'end_date'=>$end_date,'reason'=>$note]);
            $param = array('student_id'=>$idMember,'type'=>RECESS,'contents'=>$content,'message'=>$note);
            $this->load->model('db/l_student_request_model');
            $this->l_student_request_model->insert($param);
        }
        redirect('/request/complete');
    }

    /**
     * 退会届
     *
     * @param   
     * @return  
     *
    */
    public function withdrawal() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_withdrawal', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function save_request_withdrawal()
    {
        //$this->accountVar
        $idMember = 1;
        if(isset($_POST['quit_date'])&&$_POST['quit_date']!='')
        {
            $quit_date = date_format(date_create($_POST['quit_date']),'Y-m-d');
            
            $note = isset($_POST['note'])?$_POST['note']:'';
            $reason = [];
            if(isset($_POST['note'])&&count($_POST['reason'])>0)
            {
                foreach ($_POST['reason'] as $key => $value) {
                   $reason[]=$value;
                }
            }
            $content = json_encode(['quit_date'=>$quit_date,'reason'=>$reason,'memo'=>$note]);
            $param = array('student_id'=>$idMember,'type'=>QUIT,'contents'=>$content,'message'=>$note);
            $this->load->model('db/l_student_request_model');
            $this->l_student_request_model->insert($param);
        }
        redirect('/request/complete');
    }

    /**
     * イベント・短期教室参加申請
     *
     * @param   
     * @return  
     *
    */
    public function event() {
        if ($this->error_flg) return;
        try {
            $this->load->model('db/m_course_model');
            $data['Course_Limited'] = $this->m_course_model->get_Info_by_type(VALUE_COURSE_TYPE_LIMITED);
            front_layout_view('request_event', $data);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function save_request_event()
    {
        //$this->accountVar
        $idMember = 1;
        if(isset($_POST['event'])&&$_POST['event']!='')
        {
            $note = isset($_POST['note'])?$_POST['note']:'';
            $course_id = $_POST['event'];
            $param = array('student_id'=>$idMember,'course_id'=>$course_id,'contents'=>$note);
            $this->load->model('db/l_student_event_model');
            $this->l_student_event_model->insert($param);
            $content = json_encode(['course_id'=>$course_id,'memo'=>$note]);
            $param_2 = array('student_id'=>$idMember,'type'=>EVENT_TRY,'contents'=>$content,'message'=>$note);
            $this->load->model('db/l_student_request_model');
            $this->l_student_request_model->insert($param_2);
             redirect('/request/complete');
        }
        
    }

    /**
     * 申請完了
     *
     * @param   
     * @return  
     *
    */
    public function complete() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_complete', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file request.php */
/* Location: ./application/controllers/front/request.php */