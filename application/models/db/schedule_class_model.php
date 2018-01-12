<?php
class Schedule_class_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->load->model('student_model');
        $this->load->model('system_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/schedule_bus_model');
    }

    /**
     * 生徒ID,年月日を指定して、その日のスケジュール状況を取得する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  array   スケジュール状況
     */
    public function get_student_date_propaty($student_id, $year, $month, $day) {
    }

    /**
     * 生徒ID,年月を指定して、スケジュールを削除する。ただし振替操作で作成されたレコードは削除しない。
     * @param integer   生徒ID
     * @param integer   年
     * @param integer   月
     * @return 
     */
    public function delete_schedule($student_id, $year, $month, $day = '01') {
        $last_day = date("t", strtotime($year . '-' . $month . '-' . $day));
        $params = array(
            $student_id,
            $year . '-' . $month . '-01',
            $year . '-' . $month . '-' . $last_day,
            VALUE_TRANSFER_DEFAULT,
        );

        // schedule_bus のレコードを削除するため、削除するスケジュールのidを削除する
        $query =  'SELECT id FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ? AND transfer_flg = ? ';
        $res = $this->db->query($query, $params);
        $id = array_map(create_function('$e', 'return $e["id"];'), $res->result_array());

        if (count($id)) {
            // 出席スケジュールを削除
            $query =  'DELETE FROM schedule_class ';
            $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ? AND transfer_flg = ? ';
            $this->db->query($query, $params);

            // バス乗車スケジュールを削除
            $query =  'DELETE FROM schedule_bus ';
            $query .= 'WHERE schedule_class_id IN (' . implode(',', $id) . ') ';
            $this->db->query($query, $params);
        }
    }


    /**
     * 生徒ID,年月を指定して、スケジュールを生成する。
     * @param integer   生徒ID
     * @param boolean   TRUE：削除のみ  FALSE:削除＋生成
     * @param integer   年
     * @param integer   月
     * @param integer   日
     * @return 
     */
    public function generate_schedule($student_id, $delete_only = FALSE, $year, $month, $d = NULL) {
        $d = substr('00' . (is_null($d) ? '1' : $d), -2);

        // スケジュール削除
        $this->delete_schedule($student_id, $year, $month, $d);
        if ($delete_only) return;

        // 生徒のクラス情報を取得する
        $student = $this->student_model->get_student_data($student_id);
        
        $this->_class = $student['class']['valid'];
        logdebug($this->_class);

        // クラス未登録なら戻る
        if (empty($this->_class)) return;

        

        // 休館日を取得 ※該当日は生成させないようにするため
        $closing_day = $this->system_model->get_closing_day($year, $month);
        logdebug($closing_day);

        // すべての日をループ
        for ($_day = $d; $_day <= date("t", strtotime($year . $month . '01')); $_day++) {
            $day = substr('00' . $_day, -2);

            // 休館日等の場合は生成しない
            if (in_array($year . $month . $day, $closing_day)) continue;

            // すべての登録クラス情報について日付をチェックした後、スケジュールを登録する
            foreach ($this->_class as $_class) {

                // 登録クラス情報と日付のチェック
                if (!is_valid_date($year . $month . $day, $_class['start_date'], $_class['end_date'])) continue;

                // 曜日チェック
                if (date("w", strtotime($year . $month . $day)) != $_class['week_num']) continue;

                // レコード生成
                $this->_generate_schedule_make_record($student_id, $year . '-' . $month . '-' .  $day, $_class);
            }
        }
    }

    /**
     * スケジュールを生成する。バス乗車スケジュールも生成する。
     * @param integer   生徒ID
     * @param string    年月日
     * @param array     
     * @return 
     */
    protected function _generate_schedule_make_record($student_id, $target_date, $class) {
        // 生徒情報を取得
        $student = $this->student_model->get_student_data($student_id);

        // レコード作成
        $insert_params = array(
            'target_date'       => $target_date,
            'student_id'        => $student_id,
            'student_class_id'  => $class['id'],
        );
        $this->insert($insert_params);
        $last_id = $this->get_last_insert_id();

        // l_student_class.id に対する l_student_bus_route レコードのidを取得
        $student_bus_route_id = NULL;
        foreach ($student['bus_route']['valid'] as $row) {
            if ($row['student_class_id'] == $class['id']) {
                $student_bus_route_id = $row['id'];
                break;
            }
        }
        // バス乗車レコード作成
        if (!is_null($student_bus_route_id)) {
            $insert_params = array(
                'target_date'           => $target_date,
                'student_id'            => $student_id,
                'student_bus_route_id'  => $student_bus_route_id,
                'schedule_class_id'     => $last_id,
            );
            $this->schedule_bus_model->insert($insert_params);
        }
    }


    /**
     * 生徒のクラス出欠レコードを取得する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  array   
     */
    public function get_student_class_record($student_id, $year, $month, $day) {
        $params = array(
            $student_id,
            $year . '-' . $month . '-' . $day,
        );
        $query =  'SELECT * FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date = ? ';
        $res = $this->db->query($query, $params);
        return $res->result_array();
    }

    /**
     * 生徒のクラス出欠プロパティを取得する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  array   
     */
    public function get_student_class_propaty($student_id, $year, $month, $day) {
        // レコードを取得する
        $result = $this->get_student_class_record($student_id, $year, $month, $day);

        // レコード数チェック
        if (count($result) > 1) {
            // レコードが2件以上あったら例外
            logerr($params, $query);
            throw new Exception();
        } else if (isset($result[0]['id'])) {
            // レコードがなかったらNULL
            return NULL;
        }

        $now_time = time();
        $check_time = strtotime($year . '-' . $month . '-' . $day);

        // 生徒の出欠ステータス判定
        if ($result[0]['transfer_cancel_flg'] == DATA_ON) {
            return VALUE_SCHEDULE_PROP_FUTURE_TRANSFER_CANCEL;  // 振替キャンセル
        } else if ($now_time <= $check_time) {
            // 未来
            if ($result[0]['presence_flg'] == DATA_ON) {
                return VALUE_SCHEDULE_PROP_PRESENCE;            // 出席
            } else {
                if ($result[0]['absence_flg'] == DATA_OFF && $result[0]['transfer_flg'] == DATA_OFF) {
                    return VALUE_SCHEDULE_PROP_FUTURE_PRESENCE;             // 出席予定
                }
                if ($result[0]['absence_flg'] == DATA_OFF && $result[0]['transfer_flg'] == DATA_ON && $result[0]['transfer_cancel_flg'] == DATA_OFF) {
                    return VALUE_SCHEDULE_PROP_FUTURE_TRANSFER;             // 振替出席予定
                }
                if ($result[0]['absence_flg'] == DATA_ON) {
                    return VALUE_SCHEDULE_PROP_FUTURE_ABSENCE;              // 欠席予定
                }
                return NULL;
            }
        } else {
            // 過去
            if ($result[0]['presence_flg'] == DATA_ON) {
                return VALUE_SCHEDULE_PROP_PRESENCE;            // 出席
            } else {
                if ($result[0]['absence_flg'] == DATA_ON) {
                    return VALUE_SCHEDULE_PROP_ABSENCE;         // 欠席
                } else {
                    return VALUE_SCHEDULE_PROP_ABSENCED_NO_EXPRESS;     // 無連絡欠席
                }
            }
        }
        return NULL;

    }


    /**
     * 生徒の振替操作した回数を取得する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @return  array   
     */
    public function get_transfer_count($student_id, $year, $month) {
        $last_day = date("t", strtotime($year . '-' . $month . '-01'));
        $params = array(
            $student_id,
            $year . '-' . $month . '-01',
            $year . '-' . $month . '-' . $last_day,
        );
        $query =  'SELECT COUNT(id) AS cnt FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ? AND transfer_schedule_class_id > 0 ';
        $res = $this->db->query($query, $params);
        $result =  $res->res_array();
        return $result['cnt'];
    }


    /**
     * 振替可能なレコードを取得する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @return  array   
     */
    public function get_transfer_available_date($student_id, $year, $month) {
        $last_day = date("t", strtotime($year . '-' . $month . '-01'));
        $params = array(
            $student_id,
            $year . '-' . $month . '-01',
            $year . '-' . $month . '-' . $last_day,
            DATA_ON,
        );
        $query =  'SELECT * FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ?  ';
        $query .= 'AND transfer_schedule_class_id IS NULL AND absence_flg = ? ';
        $res = $this->db->query($query, $params);
        return $res->result_array();
    }

    /**
     * 期間を指定して、生徒のの出席レコードを取得する
     * @param   integer 生徒ID
     * @param   string  開始日
     * @param   string  終了日
     * @return  array   
     */
    public function get_presence_record_period($student_id, $start_date, $end_date) {
        $params = array(
            $student_id,
            $start_date,
            $end_date,
        );
        $query =  'SELECT * FROM schedule_class ';
        $query .= 'WHERE student_id = ? AND target_date BETWEEN ? AND ?  ';
        $res = $this->db->query($query, $params);
        return $res->result_array();
    }
}
