<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calender extends ADMIN_Controller {

    /**
     * カレンダー設定
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
     * カレンダー設定
     *
     * @param   
     * @return  
     *
    */
    public function view($page = 0) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('calender_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file calender.php */
/* Location: ./application/controllers/admin/calender.php */