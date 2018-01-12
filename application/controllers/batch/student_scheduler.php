<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/************************************************************
 * 
 * 生徒・出席データ生成/削除バッチ(バススケジュール生成も同時に行う)
 * 
 * [使い方]
 * > php index.php batch/student_scheduler
 * 
 * [オプション]
 * -a : 動作モード ※generate|delete (例)-a:generate
 * -s : 対象生徒 ※生徒IDを指定。生徒指定無し時は、全生徒対象（ただし退会していない生徒）。(例)-s:1100001
 * -d : 対象年月 ※バッチ起動時を起点として、当月は0、次月は1、・・・を指定する。対象年月指定無し時は0、また0のときはバッチ起動日以降に日を対象とする。(例)-d:6
 * -p : 期間 ※対象の期間を月数で指定する（1以上）。期間の指定無し時は1。(例)-d:3
 *
 * [例]
 * > php index.php batch/student_scheduler index -a:generate -p:2 -d:6
 * 
 ************************************************************/
class Student_scheduler extends BATCH_Controller {

    // 更新する生徒ID
    protected $_students = array();

    // 受講クラス
    protected $_class = array();

    protected $_year  = NULL;
    protected $_month = NULL;
    protected $_day   = NULL;


    function __construct() {
        parent::__construct();
        $this->load->model('db/schedule_class_model');
        $this->load->model('db/l_student_class_model');
    }

    public function _main() {
        try {
            // オプションチェック
            $this->_check_options();

            // 対象生徒取得
            $this->_get_student();

            // 出席情報生成処理
            $this->_db_execute();

        } catch (Exception $e) {
            $this->load->model('slack_model');
            $this->slack_model->post_slack($e->getMessage(), '花見川システムアラート');
            $this->slack_model->post_slack(' ```' . $e->getTraceAsString() . '``` ', '花見川システムアラート');

            logbatch($e->getMessage());
            logbatch($e->getTraceAsString());
        }
    }

    /**
     * オプションチェック
     */
    protected function _check_options() {
        // 動作モードチェック
        $this->_check_mode();

        // 対象年月チェック
        $this->_check_target_ymd();

        // 期間チェック
        $this->_check_period();
    }

    /**
     * 動作モードチェック
     */
    protected function _check_mode() {
        if (!isset($this->options['-a']) || !in_array($this->options['-a'], array('generate','delete'))) {
            throw new Exception('引数エラー[-a]');
        }
        logbatch("動作モード:" . $this->options['-a']);
    }

    /**
     *  対象年月チェック
     */
    protected function _check_target_ymd() {
        if (!isset($this->options['-d'])) {
            // オプション指定がない場合
            $this->_year = date("Y");
            $this->_month = date("m");
            $this->_day = date("d");
        } else if (isset($this->options['-d']) && ($this->options['-d'] <= 0 || !is_numeric($this->options['-d']))) {
            throw new Exception('引数エラー[-d]');
        } else {
            $this_month = date("Y-m-01");
            $this->_year = date("Y", strtotime($this_month . "+" . $this->options['-d'] . " month"));
            $this->_month = date("m", strtotime($this_month . "+" . $this->options['-d'] . " month"));
            $this->_day = '01';
        }
        logbatch("対象年月日:" . $this->_year . $this->_month . $this->_day);
    }

    /**
     *  期間チェック
     */
    protected function _check_period() {
        if (!isset($this->options['-p'])) {
            $this->options['-p'] = 1;
        } else if (isset($this->options['-p']) && ($this->options['-p'] <= 0 || !is_numeric($this->options['-p']))) {
            throw new Exception('引数エラー[-p]');
        }
        logbatch("期間:" . $this->options['-p']);
    }

    /**
     * 対象生徒取得
     */
    protected function _get_student() {
        if (isset($this->options['-s'])) {
            $student = $this->options['-s'];
        } else {
            $student = '';
        }

        $this->load->model('db/m_student_model');
        $this->_students = $this->m_student_model->get_no_quit_student($student);
        $this->_students = array(
            1
        );
    }

    /**
     * 出席情報生成処理 全員分
     */
    protected function _db_execute() {
        foreach ($this->_students as $student) {
            $this->_do_execute_one($student);
        }
    }

    /**
     * 出席情報生成処理 1人分
     */
    protected function _do_execute_one($student_id) {
        // 期間の数だけループする
        for ($period = 1; $period <= $this->options['-p']; $period++) {

            // 出席スケジュールを生成
            $this->schedule_class_model->generate_schedule($student_id, ($this->options['-a'] == 'generate' ? FALSE : TRUE), $this->_year, $this->_month, $this->_day);

            // 対象年月を更新
            $m = date("Y-m-01", strtotime($this->_year . $this->_month . '01'));
            $this->_year = date("Y", strtotime($m . "+1 month"));
            $this->_month = date("m", strtotime($m . "+1 month"));
            $this->_day = '01';
        }
    }

}
