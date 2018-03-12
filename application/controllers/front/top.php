<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top extends FRONT_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model('db/l_student_class_model', 'l_student_class_model');
        $this->load->model('db/l_student_course_model', 'l_student_course_model');
        $this->load->model('db/m_request_message_model', 'm_request_message_model');
    }

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
            $user_session = $this->session->userdata('user_account');
            $id_user =  $user_session['id'];

            $data['class_pass'] = $this->get_info_class_pass_user();
            $data['name_class'] = '';
            if(!empty($data['class_pass']['class_id'])){
                $data['name_class'] = $this->get_name_class_pass($data['class_pass']['class_id']);
            }
            $data['time_join'] = $this->get_started_course($id_user);
            $data['message_nofication'] = $this->get_message_nofication();
            
            $this->viewVar = $data;
            front_layout_view('top_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
   
    public function get_info_class_pass_user()
    {
        $user_session = $this->session->userdata('user_account');
        $id_user =  $user_session['id'];
        $current_date = date('Y-m-d');
        $where = array('student_id' => $id_user, 'end_date !=' => END_DATE_DEFAULT);
        $data = $this->l_student_class_model->get_class_pass_student($where);
        return $data;
    }

    public function get_name_class_pass($id_class){
        $data = $this->l_student_class_model->get_name_class($id_class);
        if(!empty($data)){
            return $data['class_name'];
        }else{
            return -1;
        }
    }

    public function get_started_course($student_id)
    {
        $data = $this->l_student_course_model->get_time_join_course($student_id);
        if(!empty($data)){
            $date_start =  strtotime($data['start_date']);
            $date_now = strtotime(date('Y-m-d'));
            $subtract_date = $date_now - $date_start;
            $str_time = $this->time_elapsed_A($subtract_date);
            $str_time = str_replace("y"," 年",$str_time);
            $str_time = str_replace("m"," 月",$str_time);
            $str_time = str_replace("w"," 週",$str_time);
            $str_time = str_replace("d"," 日",$str_time);

            $rel = array('long_time' => $str_time, 'date_stated' => $data['start_date']);
            return $rel;
        }else{
            return -1;
        }
    }
    public function time_elapsed_A($secs){
        $bit = array(
            'y' => $secs / 31556926 % 12,
            'w' => $secs / 604800 % 52,
            'd' => $secs / 86400 % 7,
            'h' => $secs / 3600 % 24,
            'm' => $secs / 60 % 60,
            's' => $secs % 60
            );
            $ret = array();
        foreach($bit as $k => $v)
            if($v > 0)$ret[] = $v . $k;
            
        return join(' ', $ret);
    }
    
    public function get_message_nofication()
    {
        $my_array = array('type' => 'recess');
        $data = $this->m_request_message_model->get_message_notification($my_array);
        return $data;
    }


}

/* End of file auth.php */
/* Location: ./application/controllers/front/top.php */