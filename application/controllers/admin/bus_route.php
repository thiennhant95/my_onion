<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_route extends ADMIN_Controller {

    /**
     * バスコースマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            admin_layout_view('bus_route_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バスコース登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('bus_route_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file bus_route.php */
/* Location: ./application/controllers/admin/bus_route.php */