<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends FRONT_Controller {

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
            front_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 基本情報変更
     *
     * @param   
     * @return  
     *
    */
    public function change_base_info() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_base_info', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バスコース変更
     *
     * @param   
     * @return  
     *
    */
    public function change_bus() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_bus', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース変更
     *
     * @param   
     * @return  
     *
    */
    public function change_course() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_course', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース変更申請完了
     *
     * @param   
     * @return  
     *
    */
    public function change_course_complete() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_change_course_complete', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 休会届
     *
     * @param   
     * @return  
     *
    */
    public function leave() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_leave', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 退会届
     *
     * @param   
     * @return  
     *
    */
    public function withdrawal() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_withdrawal', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * イベント・短期教室参加申請
     *
     * @param   
     * @return  
     *
    */
    public function event() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_event', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 申請完了
     *
     * @param   
     * @return  
     *
    */
    public function complete() {
        if ($this->error_flg) return;
        try {
            front_layout_view('request_complete', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file request.php */
/* Location: ./application/controllers/front/request.php */