<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tool extends ADMIN_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db/l_student_reserve_change_model', 'student_reserve');
        $this->load->model('db/m_course_model', 'course');
        $this->load->model('db/m_class_model', 'class');
        $this->load->model('db/m_grade_model', 'grade');
        $this->load->model('db/schedule_class_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/schedule_class_model');
        $this->load->model('Mng_schedule_class_model');
    }

    /**
     * デバッグ用ツール
     *
     * @param   
     * @return  
     *
     */
    public function index() {
        //flash
        $this->data['flash_msg'] = $this->session->flashdata('flash_msg');
        admin_layout_view('tool_index', $this->data);
    }

    /**
     * schedule_classへ登録 デバッグ用
     */
    public function register_schedule_save() {
        //仕様不明の為、とりあえず本日
        $start_date = date('Y-m-d');
        $days_later = 30;
        //セッション取得
        $user = $this->session->userdata('user_account');
        /*
          //生徒IDを指定して現在有効なクラス情報を取得する
          $student_class = $this->l_student_class_model->get_student_class($user['id'], FALSE);

          //k:日付、v:曜日の配列を取得
          $ary_date_week = $this->Mng_schedule_class_model->get_ary_date_week($start_date, $days_later);

          //生徒の予約曜日を取得
          $reservation_week = $this->Mng_schedule_class_model->get_reservation_week($user['id']);
         */
        $reservation_data = $this->Mng_schedule_class_model->register_reservation_data($user['id'], $start_date, $days_later);
        //デバッグ用メッセージ
        if (!$reservation_data) {
            echo "l_student_classテーブルにデータが存在しません。";
            exit();
        }
        foreach ($reservation_data as $date => $l_student_class) {
            $result_insert = $this->schedule_class_model->insert(array(
                'target_date' => $date,
                'student_id' => $l_student_class['student_id'],
                'student_class_id' => $l_student_class['class_id'],
                'absence_flg' => 0,
                'transfer_flg' => 0,
            ));
        }
        $this->session->set_flashdata('flash_msg', 'l_student_classに開発用データを登録しました。');
        redirect('/admin/tool');
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/admin/reschedule.php */