<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends FRONT_Controller {
    /*
        ログイン成功しましたら、
        $this->session->set_userdata('user_account', ･･･);
        でuser_accountセッションにDBから読み出したアカウント情報を設定してください。
        /auth, /entry 以外にアクセス可能となります
    */

    /**
     * トップページ
     *
     * @param
     * @return
     *
    */
    public function index()
    {
        if ($this->error_flg) return;
        try
        {
            $user_session           = $this->session->userdata('user_account');
            if(!empty($user_session['id'])){
                redirect('/');
            } else {
                $tmp_cookie_user            = $this->input->cookie('info_user'); 
                $tmp_check_button           = $this->input->cookie('info_remember');
                $data_cookie                = [];
                $data_cookie['cookie_data'] = array('user_cookie' => $tmp_cookie_user, 'checked' => $tmp_check_button);
                $this->viewVar = $data_cookie;
            }
            front_layout_view('auth_index', $this->viewVar);
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_familly()
    {
        $data           = [];
        $user_session   = $this->session->userdata('user_account');
        if(!empty($user_session['id'])){

            $list_id_family = [];
            $this->load->model('db/m_student_model','m_student_model');
            $user_info      = $this->m_student_model->select_by_id($user_session['id'], $key = 'id', $tbl = 'm_student');
            $tel_number     = !empty($user_info[0]['tel_normalize']) ? (string)$user_info[0]['tel_normalize'] : '';
            $data['family'] =  $this->get_list_family($tel_number);
            
            foreach ($data['family'] as $key => $value) {
                array_push($list_id_family,$value['student_id']);
            }
            $data_family    = $this->m_student_model->get_name_family($list_id_family);
            $newdata        = array(
                'list_family'  => $data_family
            );

            $this->session->set_userdata($newdata);
            $data_session   = $this->session->userdata('list_family');
        }
    }
    public function get_list_family($tel_number)
    {
        $tel_number     = ' = '.$tel_number;
        $tel_tag        = ' = '."'tel'";
        $this->load->model('db/m_student_model','m_student_model');
        $where          = array('value' => $tel_number, 'tag' => $tel_tag);
        $data           = $this->m_student_model->get_list($where, $order = NULL, $tbl = 'l_student_meta');
        return $data;
    }
    public function login()
    {
        if ($this->error_flg) return;
        try
        {
            if(isset($_POST['user']) && isset($_POST['pass']))
            {
                $user       = trim($this->input->post('user'));
                $pass       = trim($this->input->post('pass'));
                $check_save = trim($this->input->post('check_save'));
                $this->load->model('db/m_student_model','student_model');

                if(isset($_SESSION['user_account']))
                {
                    $this->session->sess_destroy();
                }
                $data['rel']    = $this->student_model->check_account($user);
                $leng_rel       = count($data['rel']);
                if($leng_rel >= VALUE_NUMBER_RESULT)
                {
                    $hash_pass = $data['rel'][0]['password'];
                    $lock_flag = $data['rel'][0]['lock_flg'];
                    if(password_verify( $pass, $hash_pass))
                    {
                        if(($lock_flag == 0) ){
                            $id_user = $data['rel'][0]['id'];
                            $user_account_val = array(
                                'id'  => $id_user,
                                'email'     => $user,
                                'logged_in' => TRUE,
                            );
                            $this->session->set_userdata('user_account',$user_account_val);
                            $this->get_familly();
                            $this->load->helper('cookie');
                            if($check_save == 'true')
                            {
                                setcookie("info_user", $user, time()+60*60*2);
                                // setcookie("info_pass", $hash_pass , time()+60*60*2);
                                setcookie("info_remember", 1, time()+60*60*2);
                                // setcookie("info_user_id", $id_user, time() + 60*60*2 );
                            }else{
                                setcookie("info_user", '', time()+60*60*2);
                                setcookie("info_remember", 0, time()+60*60*2);
                            }
                            $data['status']     = "OK";
                        }else{
                            $data['status']     = "OK";
                            $data['lock_flag']  = $lock_flag;
                        }
                    }
                    else
                    {
                        $data['status'] = "FAIL";
                    }
                }
                else
                {
                    $data['status'] = "FAIL";
                }
                
                echo json_encode($data);
                die();
            }
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    /**
     * パスワードを忘れたら
     *
     * @param
     * @return
     *
    */
    public function forgot_password()
    {
        if ($this->error_flg) return;
        try
        {
            $data = [];
            $this->load->model('db/m_student_model','student_model');
            $this->load->model('sendmail_model','send_mail');
            if(isset($_POST['email']))
            {
                $this->session->sess_destroy('user_account');
                $email          = $this->input->post('email');
                $data['rel']    = $this->student_model->check_email_exits($email);
                $leng_rel = count($data['rel']);
               
                if($leng_rel == VALUE_NUMBER_RESULT)
                {
                    $user_name      = $data['rel']['0']['email'];
                    $password_tmp   = random_string('alnum', LENGTH_PASS_RAMDOM);
                    //khi regeister hoan thanh se lay thong ten khach hang de dua vao thay bang email
                    $pass_new       = $this->secured_hash($password_tmp, $email);
                    $this->edit_password_db($email, $pass_new);
                    $this->send_mail_pass($email, $user_name, $password_tmp);

                    $data['pass_enter'] = $password_tmp;
                    $data['pass_new']   = $pass_new;
                    $data['status']     = "OK";
                }
                else
                {
                    $data['status']     = "FAIL";
                }
                explog($data['status'], FLAG_EXP_LOG_FILE);
                echo json_encode($data);
                die();
            }
            front_layout_view('auth_forgot_password', $this->viewVar);
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function send_mail_pass($email_user, $user_name, $pass_new)
    {
        $string = $this->get_template_forget_pass();
        $macro = array(
                    'name_user' => $user_name,
                    'pass_new'  => $pass_new,
        );
        foreach ($macro as $key => $value) 
        {
            $string = str_replace("%{$key}%", $value, $string);
        }
        // send mail
        $this->send_mail->set_from('hanamigawasw@onionworld.sakura.ne.jp', 'Onion World');
        $this->send_mail->set_to($email_user);
        // $this->send_mail->set_bcc('an_tnh@vietvang.net');
        $this->send_mail->set_subject('パスワード再発行');
        $this->send_mail->set_message($string);
        $this->send_mail->send();
    }

    public function get_template_forget_pass()
    {
        $url_path = './mailbody/forgot-pass.txt';
        $content = read_file($url_path);
        return $content;
    }

    function secured_hash($input)
    {    
        $output = password_hash($input,PASSWORD_DEFAULT);
        return $output;
    }

    public function edit_password_db($email, $pass_new)
    {
        $status = $this->student_model->edit_forgot_pass($email, $pass_new);
        return $status;
    }
    /**
     * ロック
     *
     * @param
     * @return
     *
    */
    public function lock()
    {
        if ($this->error_flg) return;
        try
        {
            front_layout_view('auth_lock', $this->viewVar);

        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/front/auth.php */