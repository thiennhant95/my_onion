<?php
//-------------------------------------------------------
// 
// バス乗車管理用モデル
// ※このモデルで直接DBを操作しないこと
// 
//-------------------------------------------------------
class Mng_schedule_bus_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('db/schedule_bus_model');
    }
}
