<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function logout_user(){
        if(isset($_POST['flag_logout']))
        {
            $this->session->sess_destroy('user_account');
            $this->session->sess_destroy('list_family');
            echo json_decode(1);
            die();
        }
    }
    public function logout_admin(){
        if(isset($_POST['flag_logout']))
        {
            $this->session->sess_destroy('admin_account');
            echo json_decode(1);
            die();
        }

    }
}