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
            $this->login();
            $this->logout();
            front_layout_view('auth_index', $this->viewVar);
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function login()
    {
        if(isset($_POST['user']) && isset($_POST['pass']))
        {
            $user = trim($this->input->post('user'));
            $pass = trim($this->input->post('pass'));
            $check_save = trim($this->input->post('check_save'));
            $this->load->model('db/m_student_model','student_model');

            if(isset($_SESSION['user_account']))
            {
                $this->session->sess_destroy();
            }
            $data['rel'] = $this->student_model->check_account($user);
            $leng_rel = count($data['rel']);
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
                        
                        if($check_save)
                        {
                            setcookie("info_user", $user, time()+60*60*2);
                            setcookie("info_pass", $hash_pass , time()+60*60*2);
                            setcookie("info_remember", 1, time()+60*60*2);
                            setcookie("info_user_id", $id_user, time() + 60*60*2 );
                        }
                    }else{
                        $data['status'] = "OK";
                        $data['lock_flag'] = $lock_flag;
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

    public function logout()
    {
        if(isset($_POST['flag_logout']))
        {
            $data = [];
            $this->session->sess_destroy();
            echo json_encode(1);
            die();
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
                $email  = $this->input->post('email');
                $data['rel'] = $this->student_model->check_email_exits($email);
                $leng_rel = count($data['rel']);
               
                if($leng_rel == VALUE_NUMBER_RESULT)
                {
                    $user_name = $data['rel']['0']['email'];
                    $password_tmp = random_string('alnum', LENGTH_PASS_RAMDOM);
                    //khi regeister hoan thanh se lay thong ten khach hang de dua vao thay bang email
                    $pass_new = $this->secured_hash($password_tmp, $email);
                    $this->edit_password_db($email, $pass_new);
                    $this->send_mail_pass($email, $user_name, $password_tmp);

                    $data['pass_enter'] = $password_tmp;
                    $data['pass_new'] = $pass_new;
                    $data['status'] = "OK";
                }
                else
                {
                    $data['status'] = "FAIL";
                }
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
                    'pass_new' => $pass_new,
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