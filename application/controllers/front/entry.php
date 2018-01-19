<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends FRONT_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model('db/m_student_model','student_model');
        $this->load->model('db/l_student_meta_model', 'student_meta_model');
        $this->load->model('sendmail_model','send_mail');
    }

    /**
     * 連絡先入力画面
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            if(isset($_POST['user_name']) && isset($_POST['postal_code']) && isset($_POST['address']) && isset($_POST['phone_number']) && isset($_POST['email_address'])) {
                $email_exists = $this->student_model->check_email_exits($_POST['email_address']);
                $email_exists = count($email_exists);
                if ( $email_exists == 1 ) {
                    $data['insert'] = 'email_exists';
                } else {
                    $this->student_model->insert( array( 
                        'email' => $_POST['email_address'], 
                        'tel_normalize' => $_POST['phone_number'] 
                        ) 
                    );
                    $id_auto = $this->student_model->get_last_insert_id();
                    $reg_token = random_string( 'alnum', REGISTER_TOKEN_LENGTH );
                    $arr_insert = array( 
                        'name' => $_POST['user_name'], 
                        'zip' => $_POST['postal_code'], 
                        'address' => $_POST['address'], 
                        'tel' => $_POST['phone_number'], 
                        'token' => $reg_token
                    );
                    foreach ( $arr_insert as $key => $value ) {
                        $this->student_meta_model->insert(array('student_id' => $id_auto, 'tag' => $key, 'value' => $value));
                    }
                    $this->send_mail_register($_POST['email_address'], $_POST['user_name'], $reg_token);
                    $data['insert'] = 'success';
                }
                echo json_encode($data);
                die();
            }
            front_layout_view('entry_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * お申込みアンケート
     *
     * @param   
     * @return  
     *
    */
    public function questionnaire($token = '') {
        if ($this->error_flg) return;
        try {
            if ( isset( $_GET['token'] ) && $_GET['token'] != '' ) {
                $get_token = $_GET['token'];
                $token = $this->student_meta_model->check_token( $get_token );
                if ( count( $token ) != 1 ) {
                    $this->viewVar['check_error'] = 'error';
                    front_layout_view('entry_questionnaire', $this->viewVar);
                } else {
                    $student_id = $token[0]['student_id'];
                    $email_address = $this->student_model->select_student_field( $student_id, 'email' );
                    $metas = $this->student_meta_model->select_student_metas( $student_id );
                    $data = array();
                    foreach ( $metas as $key => $value ) {
                        $data[$value['tag']] = $value['value'];
                    }
                    $data['email_address'] = $email_address[0]['email'];
                    $data['student_id'] = $student_id;
                    // echo '<pre>'; print_r( $data ); echo '</pre>'; die();
                    $this->viewVar['entry_questionnaire'] = $data;
                    $this->viewVar['check_error'] = 'success';
                    front_layout_view('entry_questionnaire', $this->viewVar);
                }
            } else {
                $this->viewVar['check_error'] = 'error';
                front_layout_view('entry_questionnaire', $this->viewVar);
            }

            if(isset($_POST['name_kana']) && isset($_POST['birthday']) && isset($_POST['sex']) && isset($_POST['course_type'])) {
                $create_id = random_string( 'nozero', CREATE_ID_QUESTIONNAIRE_LENGTH);
                $arr_insert_meta_required = array( 
                    'name_kana' =>$_POST['name_kana'], 
                    'birthday' => $_POST['birthday'], 
                    'sex' => $_POST['sex'], 
                    'course_type' => $_POST['course_type']
                );
                foreach ( $arr_insert_meta_required as $key => $value ) {
                    $this->student_meta_model->insert(array('student_id' => $_POST['student_id'], 'tag' => $key, 'value' => $value));
                }
                $arr_insert_meta = array( 
                    'emergency_tel' => isset( $_POST['emergency_tel'] ) ? $_POST['emergency_tel'] : '', 
                    'school_name' => isset( $_POST['school_name'] ) ? $_POST['school_name'] : '', 
                    'parent_name' => isset( $_POST['parent_name'] ) ? $_POST['parent_name'] : '', 
                    'school_grade' => isset( $_POST['school_grade'] ) ? $_POST['school_grade'] : '', 
                    'bus_use_flg' => isset( $_POST['bus_use_flg'] ) ? $_POST['bus_use_flg'] : '',
                    'enquete' => isset( $_POST['enquete'] ) ? json_encode( $_POST['enquete'] ) : '',
                    'memo_to_coach' => isset( $_POST['memo_to_coach'] ) ? $_POST['memo_to_coach'] : ''
                );
                foreach ( $arr_insert_meta as $key => $value ) {
                    if ( $value != '' ) {
                        $this->student_meta_model->insert(array('student_id' => $_POST['student_id'], 'tag' => $key, 'value' => $value));
                    }
                }
                $email_address = $this->student_model->select_student_field( $_POST['student_id'], 'email' );
                $user_name = $this->student_meta_model->select_student_meta( $_POST['student_id'], 'name' );
                $update_token = $this->student_meta_model->update_student_meta( $_POST['student_id'], 'token', random_string( 'alnum', REGISTER_TOKEN_LENGTH ) );
                $update_student_info = $this->student_model->update_student_info( $_POST['student_id'], 'create_id', $create_id );
                // $this->send_mail_questionnaire( $email_address[0]['email'], $user_name[0]['name'], $create_id );
                $data = array();
                $data['create_id'] = $create_id;
                $data['insert'] = 'success';
                echo json_encode($data);
                die();
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

        /**
     * Send mail register function
     *
     * @param   
     * @return  
     *
    */

    public function send_mail_register($email_address, $user_name, $reg_token)
    {
        $string = $this->get_template_send_mail( 'register' );
        $macro = array('user_name' => $user_name, 'reg_token' => $reg_token);
        foreach ($macro as $key => $value) {
            $string = str_replace("%{$key}%", $value, $string);
        }
        // send mail
        $this->send_mail->set_from('hanamigawasw@onionworld.sakura.ne.jp', 'Onion World');
        $this->send_mail->set_to($email_address);
        $this->send_mail->set_bcc('tonnguyenhoangan@gmail.com');
        $this->send_mail->set_subject('【花見川スイミングクラブ】お申込みページのご案内');
        $this->send_mail->set_message($string);
        $this->send_mail->send();
    }

    /**
     * Send mail questionnaire function
     *
     * @param   
     * @return  
     *
    */

    public function send_mail_questionnaire($email_address, $user_name, $create_id)
    {
        $string = $this->get_template_send_mail( 'questionnaire' );
        $macro = array('create_id' => $create_id, 'user_name' => $user_name);
        foreach ($macro as $key => $value) {
            $string = str_replace("%{$key}%", $value, $string);
        }
        // send mail
        $this->send_mail->set_from('hanamigawasw@onionworld.sakura.ne.jp', 'Onion World');
        $this->send_mail->set_to($email_address);
        $this->send_mail->set_bcc('tonnguyenhoangan@gmail.com');
        $this->send_mail->set_subject('【花見川スイミングクラブ】ご登録完了のご案内');
        $this->send_mail->set_message($string);
        $this->send_mail->send();
    }

    /**
     * Get template mail function
     *
     * @param   
     * @return  
     *
    */

    public function get_template_send_mail($template_mail)
    {
        $url_path = './mailbody/' . $template_mail . '.txt';
        $content = read_file($url_path);
        return $content;
    }

}

/* End of file entry.php */
/* Location: ./application/controllers/front/entry.php */