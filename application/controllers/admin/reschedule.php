<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reschedule extends ADMIN_Controller {

    /**
     * 欠席振替申請一覧(1ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $this->view(0);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 欠席振替申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/admin/reschedule.php */