<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends FRONT_Controller {

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
            front_layout_view('entry_questionnaire', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file entry.php */
/* Location: ./application/controllers/front/entry.php */