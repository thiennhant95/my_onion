<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reschedule extends FRONT_Controller {

    /**
     * 欠席・振替申請
     *
     * @param   
     * @return  
     *
    */
    public function index($year = NULL, $month = NULL) {
        if ($this->error_flg) return;
        try {
            front_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/front/reschedule.php */