<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends ADMIN_Controller {
    /*
        ログイン成功しましたら、
        $this->session->set_userdata('admin_account', ･･･);
        でadmin_accountセッションにDBから読み出したアカウント情報を設定してください。
        /admin/auth 以外にアクセス可能となります
    */

    /**
     * ログイン
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try 
        {
            $this->login();
            admin_layout_view('auth_index', $this->viewVar);
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
            $data = [];
            $user_name = trim($this->input->post('user'));
            $pass = trim($this->input->post('pass'));
            if(isset($_SESSION['admin_account']))
            {
                $this->session->sess_destroy();
            }
            //hash pass
            $options = [ 'cost' => 10, 'salt' => 'asdfqwezxcvrtyufghjvbnmuiop123456789'.$user_name ];
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT, $options);

            $data['pass'] = $pass_hash;

            $this->load->model('db/m_staff_model','staff_model');
            $data['rel'] = $this->staff_model->check_account($user_name, $pass_hash);
            $leng_rel = count($data['rel']);
            if($leng_rel === 1)
            {
                $admin_account_val = array(
                    'email'     => $user_name,
                    'logged_in' => TRUE,
                );
                $this->session->set_userdata('admin_account',$admin_account_val);
                
                $data['status'] = "OK";
            }
            else
            {
                $data['status'] = "FAIL";
            }
            echo json_encode($data);	
            die();
        }
        
    }
    public function logout(){
        
        $this->session->sess_destroy('admin_account');
        echo json_decode(1);
        die();
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/admin/auth.php */