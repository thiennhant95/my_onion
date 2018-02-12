<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends FRONT_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('db/l_student_request_model');
        $this->load->model('db/m_class_model');
        $this->load->model('student_model');
        $this->load->model('db/m_student_model','m_student_model');
        $this->load->model('db/l_student_meta_model', 'l_student_meta_model');
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
            $session_student = $this->session->userdata('user_account');
            $student_id = $session_student['id'];
            $data['list_request'] = $this->get_list_request($student_id);
            $this->viewVar = $data;

            front_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_list_request($student_id)
    {
        $data = $this->l_student_request_model->get_limit_request_student($student_id);
        return $data;
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
            $user_account = ( $this->session->userdata( 'user_account' ) ) ? ( $this->session->userdata( 'user_account' ) ) : '';
            if ( $user_account == '' ) {
                redirect('/auth');
            } else {
                $data['user_account'] = $user_account;
                $student_info = $this->student_model->get_student_data($user_account['id']);
                $data['s_info'] = $student_info;
                $data['school_grades'] = $this->configVar['school_grades'];
                if ( isset( $_POST['postal_code'] ) && isset( $_POST['address'] ) && isset( $_POST['phone_number'] ) && isset( $_POST['email_address'] ) ) {
                    if ( isset( $_POST['newpass'] ) && $_POST['newpass'] != '' ) {   
                        $arr_insert = array(
                            'email' => $_POST['email_address'],
                            'password' => password_hash( $_POST['newpass'], PASSWORD_DEFAULT ),
                            'tel_normalize' => $_POST['phone_number']
                        );
                    } else {
                        $arr_insert = array( 
                            'email' => $_POST['email_address'],
                            'tel_normalize' => $_POST['phone_number']
                        );
                    }
                    foreach ( $arr_insert as $k => $v ) {
                        if ( $v != '' ) $this->m_student_model->update_student_info( $user_account['id'], $k, $v );
                    }
                    $arr_insert_metas = array(
                        'zip' => $_POST['postal_code'],
                        'address' => $_POST['address'],
                        'emergency_tel' => $_POST['emergency_tel'],
                        'school_name' => $_POST['school_name'],
                        'school_grade' => $_POST['school_grade'],
                        'memo_to_coach' => $_POST['memo_to_coach'],
                        'tel' => $_POST['phone_number']
                    );
                    foreach ( $arr_insert_metas as $k => $v ) {
                        if ( count( $this->l_student_meta_model->select_student_meta( $user_account['id'], $k ) ) == 1 ) {
                            if ( $v != '' ) $this->l_student_meta_model->update_student_meta( $user_account['id'], $k, $v );
                        } else {
                            if ( $v != '' ) $this->l_student_meta_model->insert( array( 'student_id' => $user_account['id'], 'tag' => $k, 'value' => $v ) );
                        }
                    }
                    $data['update'] = 'success';
                    echo json_encode($data);
                    die();
                }
                $this->viewVar = $data;
                front_layout_view('request_change_base_info', $this->viewVar);
            }
            
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
            $user_session = $this->session->userdata('user_account');
            $id_user = $user_session['id'];
            $data['user'] = $this->get_info_user();
            
            $data['week'] = array('2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土','0' => '日','1' => '月');
            $data['class'] = array('0' => 'M','1' =>  'A', '2' => 'B', '3' => 'C', '4' => 'D', '5' => 'E', '6' => 'F');
            $data['class_of_course'] = [];
            $data['list_class_selected'] = [];

            if(!empty($data['user']['course']['nearest'])){
                $id_courser_join = (int)$data['user']['course']['nearest']['course_id'];
                $data['class_of_course'] = $this->get_list_class_by_course($id_courser_join);
                $data['list_class_selected'] = $this->get_list_class_of_student($id_courser_join, $id_user);
            }
            $data['html'] = $this->create_html_data($data);

            $this->viewVar = $data;
            front_layout_view('request_change_course', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function create_html_data($data)
    {
        $html = '';
        foreach ($data['week'] as $key_week => $value_name_day) {
            $html .= '<tr>';
                $html .= '<td>'.$value_name_day.'</td>';
                foreach ($data['class'] as $key_class => $value_name_class) {
                    $id_class = '';
                    $class_sign = '';
                    $flag_active = FALSE;
                    foreach ($data['class_of_course'] as $key_class_course => $value_class_course) {
                        
                        $list_week = [];
                        $list_week = explode(",",$value_class_course['week']);
                        if(($value_class_course['base_class_sign'] == $value_name_class) && in_array($key_week, $list_week)){
                            $flag_active = TRUE;
                            $id_class = $value_class_course['id'];
                            $class_sign = $value_class_course['class_code'];
                            break;
                        }
                    }
                    if($flag_active){
                        $flag_selected = FALSE;
                        foreach ($data['list_class_selected'] as $key_selected => $value_selected) {
                            if(($value_selected['week_num'] == $key_week) && ($id_class == $value_selected['class_id'])){
                                $flag_selected = TRUE;
                                break;
                            }
                        }
                        if($flag_selected){
                            $html .= '<td class= "selected '.$class_sign.'" id = "'.$key_week.'_'.$id_class.'">選択</td>';
                        }else{
                            $html .= '<td class= "'.$class_sign.'" id = "'.$key_week.'_'.$id_class.'">'.$class_sign.'</td>';
                        }
                    }else{
                        $html .= '<td class="disabled"></td>';
                    }
                }
            $html .= '</tr>';
        }
        return $html;
    }
    public function get_list_class_by_course($id_couser)
    {
        $where = array('course_id' => ' = '.$id_couser);
        $data =  $this->student_model->get_list($where, $order = NULL, $tbl = 'm_class');
        return $data;
    }
    public function get_list_class_of_student($id_course, $id_student)
    {
        $where = array('student_course_id' => ' = '.$id_course, 'student_id' => ' = '.$id_student);
        $data =  $this->student_model->get_list($where, $order = NULL, $tbl = 'l_student_class');
        return $data;
    }
    public function change_course_ajax()
    {
        if(isset($_POST['flag_change_coure'])){
            
            $user_session = $this->session->userdata('user_account');
            $id_user = $user_session['id'];
            $id_change_course =  $this->input->post('id_course');
            $data['week'] = array('2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土','0' => '日','1' => '月');
            $data['class'] = array('0' => 'M','1' =>  'A', '2' => 'B', '3' => 'C', '4' => 'D', '5' => 'E', '6' => 'F');
            $data['class_of_course'] = $this->get_list_class_by_course($id_change_course);
            $data['list_class_selected'] = $this->get_list_class_of_student($id_change_course, $id_user);
            
            $param['html'] = $this->create_html_data($data);
            die(json_encode($param));
        }
    }
    public function change_class_of_course_ajax()
    {
        if(isset($_POST['flag_change_class'])){

            $user_session = $this->session->userdata('user_account');
            $id_user = $user_session['id'];
            $id_change_course =  $this->input->post('id_course');
            $course_id_old = $this->input->post('id_course_old');
            $course_id_new =  $this->input->post('id_course_new');
            $list_class_old = $this->input->post('list_class_old');
            $list_class_new = $this->input->post('list_class_new');
            $date_change = $this->input->post('date_change');
            $array_data = array('date_change' => $date_change,'course_id_old' =>  $course_id_old, 'list_class_old' => $list_class_old,'course_id_new' =>  $course_id_new, 'list_class_new' => $list_class_new);
            $json_decode = json_encode($array_data);
            // check exits course
            if($this->l_student_request_model->check_exist_change_course($id_user)){
                $data['status'] = $this->l_student_request_model->update_type_request('course_change', $id_user, $json_decode);
            }else{
                $params = array('student_id' => $id_user, 
                    'type' => 'course_change',
                    'status' => 0,
                    'contents' => $json_decode
                );
                $this->l_student_request_model->insert($params, $tbl = 'l_student_request');
                $data['status'] = TRUE;
            }
            die(json_encode($data));
        }
    }
    public function get_info_user()
    {
        $user_session = $this->session->userdata('user_account');
        $id_user = $user_session['id'];
        $data = $this->student_model->get_student_data_detail($id_user);
        return  $data;
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