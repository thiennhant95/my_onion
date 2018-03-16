<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends FRONT_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('db/l_student_request_model');
        $this->load->model('db/m_class_model');
        $this->load->model('student_model');
        $this->load->model('db/m_student_model','m_student_model');
        $this->load->model('db/l_student_meta_model', 'l_student_meta_model');
        $this->load->model('db/l_student_class_model', 'l_student_class_model');
        $this->load->model('db/l_student_bus_route_model', 'l_student_bus_route_model');
        $this->load->model('db/m_bus_route_model', 'm_bus_route_model');
        $this->load->model('db/m_bus_stop_model', 'm_bus_stop_model');
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
            $user_account = ( $this->session->userdata( 'user_account' ) ) ? ( $this->session->userdata( 'user_account' ) ) : '';
            if ( $user_account == '' ) {
                redirect('/auth');
            } else {
                $s_info = $this->student_model->get_student_data($user_account['id']);
                $s_class = $this->m_bus_course_model->get_student_class_change_bus( $user_account['id'] );
                // echo '<pre>'; print_r( $s_class ); echo '</pre>'; die();
                $check_bus = $this->m_bus_course_model->check_bus_exists( $user_account['id'], 'bus_change_eternal' );
                foreach ( $s_class as $k => $v ) {
                    $bus_go_ret = $this->m_bus_course_model->get_student_bus_route_change_bus( $user_account['id'], $v['class_id'] );
                    $check_bus_route_exists = $this->m_bus_course_model->check_bus_route_exists( $user_account['id'], $v['class_id'] );
                    if ( count( $bus_go_ret ) > 0 ) {
                        if ( count( $check_bus_route_exists ) > 0 ) {
                            $s_bus_course_go = $this->m_bus_course_model->get_bus_course_change_bus( $bus_go_ret[0]['bus_route_go_id'] );
                            $s_bus_course_ret = $this->m_bus_course_model->get_bus_course_change_bus( $bus_go_ret[0]['bus_route_ret_id'] );
                            $s_class[$k]['bus_course_go'] = $s_bus_course_go[0];
                            $s_class[$k]['bus_course_ret'] = $s_bus_course_ret[0];
                            $s_class[$k]['bus_course_go']['bus_route_go_id'] = $bus_go_ret[0]['bus_route_go_id'];
                            $s_class[$k]['bus_course_ret']['bus_route_ret_id'] = $bus_go_ret[0]['bus_route_ret_id'];
                            $s_class[$k]['list_bus_course'] = $this->m_bus_course_model->get_bus_course_by_class_id( $v['class_id'] );
                            $s_class[$k]['list_route_go'] = $this->m_bus_course_model->get_bus_route_by_bus_course_id( $s_class[$k]['bus_course_go']['bus_course_id'] );
                            $s_class[$k]['list_route_ret'] = $this->m_bus_course_model->get_bus_route_by_bus_course_id( $s_class[$k]['bus_course_ret']['bus_course_id'] );
                        }
                    } else {
                        $s_class[$k]['list_bus_course'] = $this->m_bus_course_model->get_bus_course_by_class_id( $v['class_id'] );
                        if ( count( $s_class[$k]['list_bus_course'] ) > 0 ) {
                            $s_class[$k]['list_route_go'] = $this->m_bus_course_model->get_bus_route_by_bus_course_id( $s_class[$k]['list_bus_course'][0]['id']);
                            $s_class[$k]['list_route_ret'] = $this->m_bus_course_model->get_bus_route_by_bus_course_id( $s_class[$k]['list_bus_course'][0]['id']);

                        } else {
                            $s_class[$k]['list_route_go'] = array();
                            $s_class[$k]['list_route_ret'] = array();
                        }
                    }
                }
                if ( isset( $_POST['bus_course_id'] ) ) {
                    $html_change_bus_course = $this->create_html_change_bus_course( $_POST['bus_course_id'] );
                    die( json_encode( $html_change_bus_course ) );
                }
                // update l_student_request
                if ( isset( $_POST['student_id'] ) ) {
                    if ( count( $check_bus ) == 0 ) {
                        $this->l_student_request_model->insert( 
                            array(
                                'student_id' => $_POST['student_id'],
                                'type' => 'bus_change_eternal',
                                'contents' => json_encode( $_POST['change_bus'] )
                            )
                        );
                        $result['change_bus'] = 'success';
                        die( json_encode( $result ) );
                    } else {
                        $update_change_bus = $this->m_bus_course_model->update_bus_course_exists( $_POST['student_id'], 'bus_change_eternal', json_encode( $_POST['change_bus'] ) );
                        if ( $update_change_bus == TRUE ) $result['change_bus'] = 'success';
                        else $result['change_bus'] = 'fail';
                        die( json_encode( $result ) );
                    }
                }
                $data = array();
                $data['s_info'] = $s_info;
                $data['s_class'] = $s_class;
                $data['check_bus'] = count( $check_bus );
                $this->viewVar = $data;
                front_layout_view('request_change_bus', $this->viewVar);
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }



    public function create_html_change_bus_course( $bus_course_id ) {
        $bus_route = $this->m_bus_route_model->select_by_id( $bus_course_id, 'bus_course_id', 'm_bus_route' );
        $bus_stop = $this->m_bus_stop_model->select_all( 'm_bus_stop' );
        $html_change_bus_course = '';
        foreach ( $bus_route as $k => $v ) {
            $html_change_bus_course .= '<option value="' . $v['id'] . '">【' . $v['route_order'] . '】 ';
                foreach ( $bus_stop as $k1 => $v1 ) {
                    if ( $v1['id'] == $v['bus_stop_id'] ) $html_change_bus_course .= $v1['bus_stop_name'];
                }
            $html_change_bus_course .= '</option>';
        }
        return $html_change_bus_course;
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

            if(!empty($data['user']['course']['valid'][0])){
                $id_courser_join = (int)$data['user']['course']['valid'][0]['course_id'];
                $data['class_of_course'] = $this->get_list_class_by_course($id_courser_join);
                $data['list_class_selected'] = $this->get_list_class_of_student($id_courser_join, $id_user);
                $data['practice_max'] = $this->l_student_request_model->get_practice_max($id_courser_join);
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
                $html .= '<th>'.$value_name_day.'</th>';
                foreach ($data['class'] as $key_class => $value_name_class) {
                    $id_class = '';
                    $class_sign = '';
                    $flag_active = FALSE;
                    foreach ($data['class_of_course'] as $key_class_course => $value_class_course) {
                        
                        $list_week = [];
                        $list_week = explode(",",$value_class_course['week']);
                        $to_string_key_week = (string)$key_week;
                        if(($value_class_course['base_class_sign'] == $value_name_class) && in_array($to_string_key_week, $list_week)){
                            $flag_active = TRUE;
                            $id_class = $value_class_course['id'];
                            $class_sign = $value_class_course['class_code'];
                            break;
                        }
                    }
                    if($flag_active){
                        $flag_selected = FALSE;
                        foreach ($data['list_class_selected'] as $key_selected => $value_selected) {
                            $name_tmp = (int)$value_selected['week_num'];
                            $value_class_selected = $value_selected['class_id'];
                            if(($value_class_selected == $id_class)&&($name_tmp ==  $key_week)){
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
        $where = array('student_course_id' => ' = '.$id_course, 'student_id' => ' = '.$id_student, 'end_date' => ' = "'.END_DATE_DEFAULT.'"');
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
            
            $data_max_practice = $this->l_student_request_model->get_practice_max($id_change_course);
            $param['practice_max'] = (!empty($data_max_practice)) ? $data_max_practice[0]['practice_max'] : NULL;
            $param['html'] = $this->create_html_data($data);
            die(json_encode($param));
        }
    }
    public function change_class_of_course_ajax()
    {
        if(isset($_POST['flag_change_class'])){

            $user_session = $this->session->userdata('user_account');
            $id_user = $user_session['id'];
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
            $user_session = $this->session->userdata('user_account');
            $id_user = $user_session['id'];

            $data['data_bus_list'] = $this->l_student_request_model->get_name_bus_route($id_user);
            $this->viewVar = $data;
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
        $user_session = $this->session->userdata('user_account');
        $id_user = $user_session['id'];
        $current_date = date('Y-m-d H:i:s');
        if(isset( $_POST['start_date'] )&& $_POST['start_date'] !='' && isset( $_POST['end_date'] ) && $_POST['end_date'] !='')
        {
            
            $start_date = date_format( date_create( $_POST['start_date'] ),'Y-m-d' );
            $end_date = date_format( date_create( $_POST['end_date']),'Y-m-d' );
            $note = isset( $_POST['note'] )? $_POST['note'] : '';
            $content = json_encode( ['start_date'=>$start_date ,'end_date'=>$end_date ,'reason'=>$note] );
            
            $result_search = $this->l_student_request_model->Search_request_notyet_processed( $id_user , RECESS );
            if( count( $result_search ) > 0 )
            {
                $id_old = $result_search[0]['id'];
                if($id_old > 0)
                {      
                     $params = array('student_id'=>$id_user , 'type'=>RECESS ,'contents'=>$content , 'update_date'=> $current_date);              
                    $this->db->update('l_student_request', $params , array( 'id'=>$id_old ) );  
                }
            }
            else
            {
               $params = array('student_id'=>$id_user , 'type'=>RECESS ,'contents'=>$content , 'create_date' => $current_date , 'update_date'=> $current_date );
               $this->db->insert( 'l_student_request', $params );
            }  
            echo 'success';
            exit();
        }
        echo '';
        exit();
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
        $user_session = $this->session->userdata('user_account');
        $id_user = $user_session['id'];
        $current_date = date('Y-m-d H:i:s');

        if( isset( $_POST['quit_date'] ) && $_POST['quit_date']!= '')
        {
            $quit_date = date_format( date_create( $_POST['quit_date'] ) , 'Y-m-d');
            $note = isset( $_POST['note'] )?$_POST['note']:'';
            $reason = [];
            if(isset($_POST['note']) && count($_POST['reason']) > 0)
            {
                foreach ($_POST['reason'] as $key => $value) {
                   $reason[] = $value;
                }
            }

            $content = json_encode(['quit_date' => $quit_date , 'reason'=>$reason , 'memo'=>$note]);
            $result_search = $this->l_student_request_model->Search_request_notyet_processed( $id_user , QUIT );
            if( count( $result_search ) > 0 )
            {
                $id_old = $result_search[0]['id'];
                if($id_old > 0)
                {                
                    $params = array( 'student_id' => $id_user , 'type' => QUIT , 'contents'=>$content ,'update_date'=>$current_date );   
                    $this->db->update('l_student_request', $params, array('id'=>$id_old ) );  
                }
            }
            else
            {
                $params = array( 'student_id' => $id_user , 'type' => QUIT , 'contents'=>$content ,'create_date'=>$current_date , 'update_date'=> $current_date );
                $this->db->insert( 'l_student_request', $params );
            }  
            echo 'success';
            exit();
        }
        exit();
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
            $data['Course_Limited'] = $this->m_course_model->getData_Course_valid();
            front_layout_view('request_event', $data);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function save_request_event()
    {
        //$this->accountVar
        $user_session = $this->session->userdata('user_account');
        $id_user = $user_session['id'];
        $current_date = date('Y-m-d H:i:s');
        if(isset( $_POST['event'] ) && $_POST['event'] != '')
        {
            $note = isset( $_POST['note'] ) ? $_POST['note']: '';
            $course_id = $_POST['event'];
            $result_search = $this->l_student_request_model->Search_request_notyet_processed( $id_user , EVENT_TRY );

            $content = json_encode( ['course_id'=>$course_id , 'memo' => $note] );
            
            if( count( $result_search ) > 0 )
            {
                $id_old = $result_search[0]['id'];
                if($id_old > 0)
                {       
                    $params = array( 'student_id' => $id_user , 'type'=>EVENT_TRY , 'contents' =>$content , 'update_date' =>$current_date );             
                    $this->db->update('l_student_request', $params, array( 'id'=>$id_old ) );   
                }
            }
            else{
               $params = array( 'student_id' => $id_user , 'type'=>EVENT_TRY , 'contents' =>$content , 'create_date' =>$current_date , 'update_date'=> $current_date );             
                $this->db->insert( 'l_student_request', $params );
            }  
            echo 'success';
            exit();
        }
        exit();
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
