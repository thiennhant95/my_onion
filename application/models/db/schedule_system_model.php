<?php
class Schedule_system_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 期間を指定して振替できない日を取得
     * @param   string  開始日
     * @param   string  終了日
     * @return 
     */
    public function no_transfer_date($start_date, $end_date) {
        $params = array(
            $start_date,
            $end_date,
            DATA_ON,
            DATA_ON,
            DATA_ON,
        );
        $query =  'SELECT * FROM schedule_system ';
        $query .= 'WHERE target_date BETWEEN ? AND ? ';
        $query .= 'AND (closed_flg = ? OR notransfer_flg = ? OR construction_flg = ?) ';
        $res = $this->db->query($query, $params);
        return $res->result_array();
    }

    /**
     * 年月を指定して休館日（YYYYMMDD形式）を取得する。
     * @param integer   生徒ID
     * @param integer   年
     * @param integer   月
     * @return 
     */
    public function get_closing_day($year, $month) {
        $last_day = date("t", strtotime($year . '-' . $month . '-01'));

        $params = array(
            $year . '-' . $month . '-01',
            $year . '-' . $month . '-' . $last_day,
            DATA_ON,
            DATA_ON,
        );

        // 期間内の休館日または設備工事日を取得する
        $query =  'SELECT REPLACE(target_date, "-", "") AS target_date FROM schedule_system ';
        $query .= 'WHERE target_date BETWEEN ? AND ? AND (closed_flg = ? OR construction_flg = ?) ';
        $res = $this->db->query($query, $params);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }
        $tmp = $res->result_array();
        return array_map(create_function('$e', 'return $e["target_date"];'), $tmp);
    }


    /**
     * 年月を指定して休館日かどうかチェックする
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  boolean TRUE:休館日  FALSE:休館日でない
     */
    public function is_closed_day($year, $month, $day) {
        $params = array(
            $year . '-' . $month . '-' . $day,
            DATA_ON,
        );
        $query =  'SELECT 1 AS result FROM schedule_system ';
        $query .= 'WHERE target_date = ? AND closed_flg = ?  ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 年月を指定して設備工事日かどうかチェックする
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  boolean TRUE:休館日  FALSE:休館日でない
     */
    public function is_construction_day($year, $month, $day) {
        $params = array(
            $year . '-' . $month . '-' . $day,
            DATA_ON,
        );
        $query =  'SELECT 1 AS result FROM schedule_system ';
        $query .= 'WHERE target_date = ? AND construction_flg = ?  ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 年月を指定してテスト日かどうかチェックする
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  boolean TRUE:休館日  FALSE:休館日でない
     */
    public function is_test_day($year, $month, $day) {
        $params = array(
            $year . '-' . $month . '-' . $day,
            DATA_ON,
        );
        $query =  'SELECT 1 AS result FROM schedule_system ';
        $query .= 'WHERE target_date = ? AND test_flg = ?  ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 振替可能な期間の開始日と終了日を返却する
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  array
     */
    public function get_transfer_period($date) {
        list($year, $month, $day) = explode('-', $date);
        $start = $this->get_transfer_period_start_day($date);
        $end   = $this->get_transfer_period_end_day($date);
        return list($start, $end);
    }


    /**
     * 振替可能な期間の開始日を返却する
     * @param   string  年月日
     * @return  string
     */
    public function get_transfer_period_start_day($date) {
        list($year, $month, $day) = explode('-', $date);
        if ($this->is_construction_day($year, $month, $day)) {

            // 設備工事日：翌日以降の休館日・振替不可日でない日
            return $this->_get_transfer_period_start_day_next($date);

        } else if ($this->is_test_day($year, $month, $day)) {

            // テスト日：テスト期間の最初の日
            return $this->_get_transfer_period_start_day_test($date);

        } else {

            // その他：翌日以降の休館日・振替不可日でない日
            return $this->_get_transfer_period_start_day_next($date);

        }
    }

    /**
     * 振替可能な期間の開始日を返却する（翌日以降）
     * @param   string  年月日
     * @return  string
     */
    public function _get_transfer_period_start_day_next($date) {
        $time = strtotime($date);
        $i = 0;
        while (1) {
            $date = date("Y-m-d", strtotime($i . ' day', $time);
            $params = array(
                $date
            );
            $query =  'SELECT * FROM schedule_system ';
            $query .= 'WHERE target_date = ? ';
            $res = $this->db->query($query, $params);
            $result = $res->row_array();
            if (empty($result) || $result['closed_flg'] == DATA_OFF && $result['notransfer_flg'] == DATA_OFF && $result['construction_flg'] == DATA_OFF) {
                return $date;
            }
            $i++;
        }
    }


    /**
     * 振替可能な期間の開始日を返却する（テスト開始日）
     * @param   string  年月日
     * @return  string
     */
    public function _get_transfer_period_start_day_test($date) {
        $time = strtotime($date);
        $i = -1;
        while (1) {
            $date = date("Y-m-d", strtotime($i . ' day', $time);
            $params = array(
                $date
            );
            $query =  'SELECT * FROM schedule_system ';
            $query .= 'WHERE target_date = ? ';
            $res = $this->db->query($query, $params);
            $result = $res->row_array();
            if (isset($result['id']) && $result['test_flg'] == DATA_ON) {
                return $date;
            }
            $i--;
        }
    }

    /**
     * 振替可能な期間の終了日を返却する
     * @param   string  年月日
     * @return  string
     */
    public function get_transfer_period_end_day($date) {
        list($year, $month, $day) = explode('-', $date);

        $time = strtotime($year . '-' . $month . '-01');
        $last = date("Y-m-t", strtotime('1 month', $time));

        if ($this->is_construction_day($year, $month, $day)) {

            // 設備工事日：10月末まで
            return $year . '-10-31';

        } else if ($this->is_test_day($year, $month, $day)) {

            // テスト日：翌月末まで
            return $last;

        } else {

            // その他：翌月末まで
            return $last;

        }
    }


    /**
     * 指定期間の中で、振替可能な日を取得する
     * @param   integer l_schedule_class.id
     * @param   string  年月日
     * @param   array   生徒クラス設定リンク情報
     * @return  array   
     */
    public function get_transfer_date_list($schedule_class_id, $start_day, $end_day, $schedule_class = array()) {
        $this->load->model('db/m_class_model');
        $this->load->model('db/schedule_class_model');

        if (empty($schedule_class)) {
            // 生徒のスケジュールを取得
            $this->load->model('db/schedule_class_model');
            $schedule_class = $this->schedule_class_model->select_by_id($schedule_class_id);
        }
        if (!isset($schedule_class[0]) || !$schedule_class[0]['student_class_id']) {
            throw new Exception();
        }

        // この生徒が登録しているクラス情報を取得
        $class = $this->m_class_model->get_classes_by_student_class_id($schedule_class[0]['student_class_id']);
        if (empty($class)) {
            throw new Exception();
        }
        // 振替可能な曜日
        $week = explode(',', $class['week']);

        // 期間中、振替できない日を取得
        $no_transfer_date = array_map(create_function('$e', 'return $e["target_date"];'), $this->no_transfer_date());

        // 期間中、すでに予約済みの日を取得
        $no_transfer_date = array_merge($no_transfer_date, array_map(create_function('$e', 'return $e["target_date"];'), $this->get_presence_record_period());

        $time = strtotime($start_day);
        $idx = 0;
        $result = array();
        while (1) {
            $date = date("Y-m-d", strtotime($idx . ' day', $time));
            $w    = date("w", strtotime($idx . ' day', $time));
            if (!in_array($date, $no_transfer_date) && in_array($w, $week)) {
                $result[ $date ] = pr($date, 'date_format_std');
            }
            if ($date == $end_day) break;
            $idx++;
        }
        return $result;
    }

}
