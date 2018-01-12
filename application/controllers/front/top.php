<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top extends FRONT_Controller {

    /**
     * トップページ
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            front_layout_view('top_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/front/top.php */