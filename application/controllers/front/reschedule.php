<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reschedule extends FRONT_Controller {

    /**
     * 欠席・振替申請
     *
     * @param   
     * @return  
     *
    */

    public  function __construct() {
        parent::__construct();
        $this->load->model('db/m_config_calendar_model', 'config_calendar_model');
        $this->load->model('student_model', 'student_model');
    }

    public function index($year = NULL, $month = NULL) {
        if ($this->error_flg) return;
        try {
            $info_user = $this->session->userdata('user_account');
            $user_id = !empty($info_user) ? $info_user['id'] : NULL;
            $data['course'] = $this->student_model->get_course_current($user_id);
            $this->viewVar = $data;
            front_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function load_data_absent()
    {
        if(isset($_POST['month_post']) && (isset($_POST['year_post'])))
        {
            $data['list_data'] = [];
            $month_selected = $this->input->post('month_post');
            $year_selected = $this->input->post('year_post');
            
            $last_date_of_month =  mktime(0, 0, 0, $month_selected + 1, 0, $year_selected);
            $last_date_formart = date("Y-m-d H:i:s", $last_date_of_month);
            $first_date_of_month = date("Y-m-d H:i:s", strtotime($year_selected."-".$month_selected.'-1'));

            $data['list_data'] = $this->config_calendar_model->get_data_absent($first_date_of_month , $last_date_formart );
            echo json_encode($data);
            die();
        }
    }

    public function load_data_test()
    {
        if(isset($_POST['month_post_test']) && (isset($_POST['year_post_test'])))
        {
            $data['list_data_test'] = [];
            $month_selected = $this->input->post('month_post_test');
            $year_selected = $this->input->post('year_post_test');
            $last_date_of_month =  mktime(0, 0, 0, $month_selected + 1, 0, $year_selected);
            $last_date_formart = date("Y-m-d H:i:s", $last_date_of_month);
            $first_date_of_month = date("Y-m-d H:i:s", strtotime($year_selected."-".$month_selected.'-1'));

            $data['list_data_test'] = $this->config_calendar_model->get_data_test($first_date_of_month , $last_date_formart );
            echo json_encode($data);
            die();
        }
    }

    public function check_type_date()
    {
        if(isset($_POST['start_date_selected'])){
            
            $data = $this->config_calendar_model->check_date_selected();
            $type_date = FREE_DATE;
            if(!empty($data)){
                for ($i=0; $i < 3; $i++) { 
                    if($data[0]['closed_flg']){
                        $type_date = CLOSE_DATE;
                        break;
                    }
                    if($data[0]['test_flg']){
                        $type_date = TEST_DATE;
                        break;
                    }
                    if($data[0]['notransfer_flg']){
                        $type_date = NOTRANSFER_DATE;
                        break;
                    }
                    if($data[0]['construction_flg']){
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
    public function get_info_class_current()
    {
        $db_session = $this->session->userdata('user_account');
        $db_id_student = (int)$db_session['id'];
        $db_class = $this->config_calendar_model->get_info_class($db_id_student);
        $str_info_class = '';
        $class_id = '';
        if(!empty($db_class)){
            $name_class_sign = $db_class[0]['base_class_sign'];
            $start_time = $db_class[0]['start_time'];
            $end_time = $db_class[0]['end_time'];
            $str_info_class = '['.$name_class_sign.']'.$start_time.'~'.$end_time;
            $class_id = $db_class[0]['id'];
        }

        $course_id = $this->config_calendar_model->get_course_current($db_id_student);
        $calender_class = $this->config_calendar_model->get_class_of_course($course_id['course_id']);
        $db_bus = $this->config_calendar_model->get_list_bus_name($class_id);

        $data['db_class_str'] = $str_info_class;
        $data['db_class'] = $db_class;
        $data['calendar_class'] = $this->create_hmtl_list_time($calender_class);
        

        $html_bus = '';
        if(!empty($db_bus)){

            foreach ($db_bus as $key => $value) {
                # code...
                $html_bus .= '<option value = "'.$value['id'].'"> ' .$value['bus_course_name'].'</option>';
            }
        }else{
            $html_bus .= '<option value = "">選んでください </option>';
        }
        $data['db_bus'] = $html_bus;

        echo json_encode($data);
        die();
        
    }
    public function create_hmtl_list_time($data)
    {
        $html = '';
        foreach ($data as $key => $value) {
            # code...
            $html .= '<option value = "'.$value['id'].'"> ' .'['.$value['base_class_sign'].'] '.$value['start_time'].'~'.$value['end_time'].'</option>';
        }
        return $html;
    }
    public function get_busroute_of_class()
    {
        $id_class = $this->input->post('id_class_selected');
        $db_bus = $this->config_calendar_model->get_list_bus_name($id_class);
        $html = '';
        if(!empty($db_bus)){

            foreach ($db_bus as $key => $value) {
                # code...
                $html .= '<option value = "'.$value['id'].'"> ' .$value['bus_course_name'].'</option>';
            }
        }else{
            $html .= '<option value = "">選んでください </option>';
        }
        $data['html'] = $html;
        echo json_encode($data);
        die();
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/front/reschedule.php */