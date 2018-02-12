<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_account_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function set_session_user()
    {
        if(isset($_POST['id_post'])){
            $id_user = $this->input->post('id_post');
            $user_account_val = array(
                'id'  => $id_user,
                'logged_in' => TRUE,
            );
            $this->session->set_userdata('user_account',$user_account_val);
            echo json_decode(1);
            die();
        }
    }
}