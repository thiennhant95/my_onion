<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends ADMIN_Controller {
     function __construct()
     {
         parent::__construct();
//         $this->load->model('db/notice');
     }

    /**
     * お知らせ設定
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {

            admin_layout_view('notice_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file notice.php */
/* Location: ./application/controllers/admin/notice.php */