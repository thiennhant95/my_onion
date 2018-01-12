<?php
//-------------------------------------------------------
// 
// システム用モデル
// ※このモデルで直接DBを操作しないこと
// 
//-------------------------------------------------------
class System_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
    }



    /**
     * 
     * @param integer   生徒ID
     * @param integer   年
     * @param integer   月
     * @return 
     */
    public function get_closing_day($year, $month) {
        return $this->schedule_system_model->get_closing_day($year, $month);
    }


}
