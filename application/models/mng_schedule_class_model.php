<?php
//-------------------------------------------------------
// 
// 出席管理用モデル
// ※このモデルで直接DBを操作しないこと
// 
//-------------------------------------------------------
class Mng_schedule_class_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('db/schedule_class_model');
        $this->load->model('db/l_student_class_model');
    }
    
    /**
     * key:日付、value:曜日の配列を取得
     * @param
     * @return
     */
    public function get_ary_date_week($start_date, $days_later, $target_week = FALSE) {
        $ary_date_week = array();
        for ($i = 1; $i <= $days_later; $i++) {
            //日付取得
            $date = date("Y-m-d", strtotime("+" . $i . " day", strtotime($start_date)));
            //曜日取得
            $ary_date_week[$date] = date('w', strtotime($date));
        }
        if ($target_week !== FALSE) {
            $res = array();
            foreach ($ary_date_week as $date => $week) {
                if ($week == $target_week) {
                    $res[$date] = $week;
                }
            }
            return $res;
        }
        return $ary_date_week;
    }

    /**
     * 生徒の予約曜日を取得
     * @param
     * @return
     */
    public function get_reservation_week($student_id) {
        //生徒IDを指定して現在有効なクラス情報を取得する
        $student_class = $this->l_student_class_model->get_student_class($student_id, FALSE);
        //ユーザーの対象開催予定日を取得
        $week_num = array();
        foreach ($student_class as $row) {
            $week_num[] = $row['week_num'];
        }
        return $week_num;
    }

    /**
     * 生徒の予約日の情報を取得
     * 
     * ["2018-04-03"]=>l_student_classデータ
     */
    public function register_reservation_data($student_id, $start_date, $days_later) {
        //生徒IDを指定して現在有効なクラス情報を取得する
        $student_class = $this->l_student_class_model->get_class($student_id,TRUE);
        $reservation_data = array();
        //ユーザーの対象開催予定日を取得
        foreach ($student_class as $row) {
            //key:日付、value:曜日の配列を取得
            $ary_date_week = $this->get_ary_date_week($start_date, $days_later, $row['week_num']);
            foreach ($ary_date_week as $date => $week) {
                $reservation_data[$date] = $row;
            }
        }
        ksort($reservation_data);
        return $reservation_data;
    }
}
