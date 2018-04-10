<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reschedule extends FRONT_Controller {

    /**
     * 欠席・振替申請
     *
     * @param   
     * @return  
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('db/m_config_calendar_model', 'config_calendar_model');
        $this->load->model('student_model', 'student_model');
        //TODO 生徒IDを取得(フィルターが必要か？)
        $this->student_id = $this->session->userdata('user_account')['id'];
        //post_year,post_monthを取得
        $yyyy = $this->input->post('post_year') ? $this->input->post('post_year') : date('Y');
        $mm = $this->input->post('post_month') ? $this->input->post('post_month') : date('m');
        $last_date_of_month = mktime(0, 0, 0, $mm + 1, 0, $yyyy);
        //POSTされた月の最初の日　2018-04-01 00:00:00
        $this->last_date = date("Y-m-d H:i:s", $last_date_of_month);
        //POSTされた月の最後の日　2018-04-30 00:00:00
        $this->first_date = date("Y-m-d H:i:s", strtotime($yyyy . "-" . $mm . '-1'));
    }

    public function index($year = NULL, $month = NULL) {
        if ($this->error_flg)
            return;
        try {

            $info_user = $this->session->userdata('user_account');
            $user_id = !empty($info_user) ? $info_user['id'] : NULL;
            $data['course'] = $this->student_model->get_course_current($user_id);
            $data['student_class'] = $this->student_model->get_class_user($user_id);

            $this->viewVar = $data;
            front_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 【AJAX】テスト日一覧を取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     */
    public function load_data_test() {
        $data['list'] = $this->config_calendar_model->get_data_test($this->first_date, $this->last_date);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】休館日一覧を取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     */
    public function load_data_absent() {
        $data['list'] = $this->config_calendar_model->get_data_absent($this->first_date, $this->last_date);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】振替一覧を取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     */
    public function load_data_tranfer() {
        $data['list'] = $this->config_calendar_model->get_date_tranfer($this->first_date, $this->last_date, $this->student_id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】休み一覧取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     */
    public function load_data_rest() {
        $data['list'] = $this->config_calendar_model->get_date_rest($this->first_date, $this->last_date, $this->student_id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】無連絡欠席日取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     */
    public function load_absent_w_permission() {
        $data['list'] = $this->config_calendar_model->get_no_contact_absence($this->student_id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】通常出席予定日取得
     * 
     * 取得条件は以下を参照
     * \\192.168.0.5\web\HP販売サービス\は\花見川スイミングクラブ\仕様◆\新規作成仕様書\欠席・振替申請.xlsx
     *
     */
    public function load_data_presence_plan() {
        $data['list'] = $this->config_calendar_model->get_presence_plan(date('Y-m-d 00-00-00'), $this->last_date, $this->student_id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】
     * 
     * eventClickでコール
     *
     * 「休」アイコンがクリック時にコールされる
     */
    public function load_cancel_rest() {
        $data['data_cancel'] = $this->config_calendar_model->get_where_reserve_change($this->input->post('id_send'));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】
     * 
     * eventClickでコール
     * 
     * 「振C」アイコンがクリック時にコールされる
     */
    public function load_cancel_tranfer() {
        $data['data_cancel'] = $this->config_calendar_model->get_where_reserve_change($this->input->post('id_send'));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * 【AJAX】
     * 
     * ■select内でコール
     * 
     * 月曜日以外の日付枠がクリックされた場合にコール
     * 
     * 日付のフラグを返却する
     * 
     * レスポンス
     *    type_date 
     *      CLOSE_DATE
     *      TEST_DATE
     *      NOTRANSFER_DATE
     *      CONSTRUCTION_DATE
     *      など
     */
    public function check_type_date() {
        if (isset($_POST['start_date_selected'])) {
            $data = $this->config_calendar_model->check_date_selected();
            $type_date = FREE_DATE;
            if (!empty($data)) {
                for ($i = 0; $i < 3; $i++) {
                    if ($data[0]['closed_flg']) {
                        $type_date = CLOSE_DATE;
                        break;
                    }
                    if ($data[0]['test_flg']) {
                        $type_date = TEST_DATE;
                        break;
                    }
                    if ($data[0]['notransfer_flg']) {
                        $type_date = NOTRANSFER_DATE;
                        break;
                    }
                    if ($data[0]['construction_flg']) {
                        $type_date = CONSTRUCTION_DATE;
                        break;
                    }
                }
            }
            $data['type_date'] = $type_date;
            echo json_encode($data);
            die();
        }
    }

    /**
     * 【AJAX】
     * 
     * ■select内でコール
     * 
     * クリックされた日付のクラス情報を取得
     * 
     */
    public function get_info_class_current() {
        $db_session = $this->session->userdata('user_account');
        $db_id_student = (int) $db_session['id'];
        $db_class = $this->config_calendar_model->get_info_class($db_id_student);
        $str_info_class = '';
        $class_id = '';

        if (!empty($db_class)) {
            $name_class_sign = $db_class[0]['base_class_sign'];
            $start_time = $db_class[0]['start_time'];
            $end_time = $db_class[0]['end_time'];
            $str_info_class = '[' . $name_class_sign . ']' . $start_time . '~' . $end_time;
            $class_id = $db_class[0]['id'];
        }

        $course_id = $this->config_calendar_model->get_course_current($db_id_student);
        $calender_class = $this->config_calendar_model->get_class_of_course($course_id['course_id']);
        $db_bus = $this->config_calendar_model->get_list_bus_name($class_id);

        $data['db_class_str'] = $str_info_class;
        $data['db_class'] = $db_class;
        $data['calendar_class'] = $this->create_hmtl_list_time($calender_class);
        $data['db_bus'] = $this->create_html_list_bus($db_bus);
        $data['db_rest_reason'] = $this->create_html_list_reasons();
        $data['db_examp'] = $this->create_html_list_exam();

        echo json_encode($data);
        die();
    }

    public function create_hmtl_list_time($data) {
        $html = '';
        foreach ($data as $key => $value) {
            $html .= '<option value = "' . $value['id'] . '"> ' . '[' . $value['base_class_sign'] . '] ' . $value['start_time'] . '~' . $value['end_time'] . '</option>';
        }
        return $html;
    }

    public function create_html_list_reasons() {
        $config = $this->configVar;
        $data = $config['rest_reasons'];
        $html = '';
        foreach ($data as $key => $value) {
            $html .= '<option value = "' . $value . '"> ' . $value . '</option>';
        }
        return $html;
    }

    public function create_html_list_exam() {
        $config = $this->configVar;
        $data = $config['select_exam'];
        $html = '';
        foreach ($data as $key => $value) {
            $html .= '<option value = "' . $value . '"> ' . $value . '</option>';
        }
        return $html;
    }

    public function create_html_list_bus($db_bus) {
        $html_bus = '';
        if (!empty($db_bus)) {
            foreach ($db_bus as $key => $value) {
                $html_bus .= '<option value = "' . $value['id'] . '"> ' . $value['bus_course_name'] . '</option>';
            }
        } else {
            $html_bus .= '<option value = "">選んでください </option>';
        }
        return $html_bus;
    }

    public function get_busroute_of_class() {
        $id_class = $this->input->post('id_class_selected');
        $db_bus = $this->config_calendar_model->get_list_bus_name($id_class);
        $html = '';
        if (!empty($db_bus)) {
            foreach ($db_bus as $key => $value) {
                $html .= '<option value = "' . $value['id'] . '"> ' . $value['bus_course_name'] . '</option>';
            }
        } else {
            $html .= '<option value = "">選んでください </option>';
        }
        $data['html'] = $html;
        echo json_encode($data);
        die();
    }

    /**
     * 【AJAX】
     * 
     * 
     * 
     */
    public function register_rest_date() {
        $info_user = $this->session->userdata('user_account');
        $user_id = !empty($info_user) ? $info_user['id'] : NULL;
        $tmp_data = $this->input->post('tmp_time_reason');
        $tmp_list_examp = $this->input->post('tmp_list_examp');
        $tmp_list_bus = $this->input->post('tmp_list_bus');
        $tmp_list_rest_reason = $this->input->post('tmp_list_rest_reason');
        $tmp_text_reason = $this->input->post('text_reason');
        $tmp_courname = $this->input->post('tmp_courname');
        $tmp_class_id = $this->input->post('tmp_class_id');
        $tmp_class_name = $this->input->post('tmp_class_name');
        $tmp_dist_date = $this->input->post('tmp_dist_date');
        $tmp_type = $this->input->post('tmp_type');
        $type_submit = '';

        switch ($tmp_type) {
            case 'rest':
                $type_submit = ABSENCE;
                break;
            case 'transfer':
                $type_submit = TRANSFER;
                break;

            default:
                # code...
                break;
        }
        $tmp_title = $this->input->post('tmp_title');
        $tmp_json = '{"contents":' . '"' . $tmp_title . '"' . '}';
        $data_insert = array(
            'student_id' => $user_id,
            'schedule_class_id' => $tmp_class_id,
            'class_id' => $tmp_class_id,
            'type' => $type_submit,
            'course_name' => $tmp_courname,
            'class_name' => $tmp_class_name,
            // 'grade_name' => ,
            // 'target_date' => ,
            'dist_date' => $tmp_dist_date,
            // 'dist_class_name' => ,
            'contents' => $tmp_json,
            'reason' => $tmp_list_rest_reason,
            'reason_text' => $tmp_text_reason,
            // 'test' => ,
            'status' => 0,
        );
        $check_exits = $this->config_calendar_model->check_exits_record($user_id, $tmp_dist_date, $type_submit);
        if ($check_exits) {
            $status = $this->config_calendar_model->update_data_absent($data_insert);
        } else {
            $date_tmp = date("Y-m-d H:i:s");
            $data_insert['create_date'] = $date_tmp;
            $status = $this->config_calendar_model->register_data_absent($data_insert);
        }

        $data['status'] = $status[0];
        $data['id_reg'] = $status[1];
        $data['type'] = $type_submit;
        echo json_encode($data);
        die();
    }

    /**
     * 【AJAX】
     * 
     * クリックイベント
     * 
     * 「振替をキャンセルする」ボタン押下時
     * 「休みをキャンセルして通常通り出席する」ボタン押下時
     * 
     */
    public function remove_date_rest_tranfer() {
        $id_selected = $this->input->post('id_of_date_del');
        $type = '';
        if (isset($_POST['delete_rest'])) {
            $type = ABSENCE;
            $this->config_calendar_model->remove_date_event($id_selected, $type);
        } else if (isset($_POST['delete_tranfer'])) {
            $type = TRANSFER;
            $this->config_calendar_model->remove_date_event($id_selected, $type);
        }
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/front/reschedule.php */