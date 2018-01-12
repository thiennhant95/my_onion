<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes extends ADMIN_Controller {

    /**
     * クラスマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            admin_layout_view('classes_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * クラス登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('classes_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file class.php */
/* Location: ./application/controllers/admin/class.php */