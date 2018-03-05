<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calender extends ADMIN_Controller {

    /**
     * カレンダー設定
     *
     * @param   
     * @return  
     *
    */
    public  function __construct() {
        parent::__construct();
        $this->load->model('db/m_config_calendar_model', 'config_calendar_model');
    }

    public function index() {
        if ($this->error_flg) return;
        try {
            $data['my_month'] = '';
            $data['rel_intransfer'] = '';
            $data['my_month'] = $this->create_selection_date();
            $data['rel_intransfer'] = $this->load_list_data();
            $this->viewVar =  $data;
            $this->view(0);

        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * カレンダー設定
     *
     * @param   
     * @return  
     *
    */
    public function view($page = 0) 
    {
        if ($this->error_flg) return;
        try 
        {
            admin_layout_view('calender_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function create_selection_date()
    {
        $join_date = [];
        $my_array_month = [];
        $my_array_week = [];
        $leng_week = NUMBER_DAY_OF_WEEK;
        $leng_month = NUMBER_DATE_OF_MONTH;
        
        for ($i= 0; $i <=  $leng_month; $i++) 
        { 
            $date_tmp = $i.'日';
            array_push($my_array_month,$date_tmp);
        }
        $my_array_week =  ['mon' => EVERY_MONDAY, 'tue' => EVERY_TUESDAY , 'wed' => EVERY_WENDAY, 'thu' =>  EVERY_THUSDAY, 'fri' =>  EVERY_FRIDAY, 'sat'  =>  EVERY_SATUDAY, 'sun' => EVERY_SUNDAY];
        $join_date = array_merge($my_array_month, $my_array_week);
        return $join_date;
    }

    public function register_date_absent()
    {
        if(isset($_POST['date_absent']))
        {   
            $data = [];
            $date_select_absent = $this->input->post('start_date_selected');
            $month_select_absent = $this->input->post('month_current_select');
            $year_data_post =  $this->input->post('year_data_post');

            $data['status'] = $this->check_is_closed_date($date_select_absent);
            if($data['status'] != OK)
            {
                $data['rel'] =  $this->config_calendar_model->check_exits_date($date_select_absent);
                $count_rel = count($data['rel']);
                if($count_rel >= HAVE_RESULT)
                {
                    //update
                    if($data['rel'][0]['closed_flg'] != 1){
                        $param = array(
                            'closed_flg' => IS_CLOSED,
                        );
                        $data['id_rel'] = $this->config_calendar_model->edit_schedule_system($data['rel'][0]['id'], $param);
                        $data['status'] = 'update';
                    }
                }
                else
                {
                    // insert
                    $my_array = array('closed_flg' => IS_CLOSED,'target_date' => $date_select_absent);
                    $this->config_calendar_model->insert($my_array, $tbl = 'schedule_system');
                    $data['id_rel'] = $this->config_calendar_model->get_last_insert_id();
                    $data['status'] = 'insert';
                }
            }
            else
            {
                $data['status'] = 'FAIL';
            }
            
            echo json_encode($data);	
            die();
        }
    }

    public function register_date_test()
    {
        if(isset($_POST['date_test']))
        {   
            $data = [];
            $date_select_absent = $this->input->post('start_date_selected');
            $month_select_absent = $this->input->post('month_current_select');
            $year_data_post =  $this->input->post('year_data_post');
            $data['status'] = $this->config_calendar_model->is_closed_date($date_select_absent);
            if($data['status'] != OK)
            {
                $data['rel'] =  $this->config_calendar_model->check_exits_date($date_select_absent);
                $count_rel = count($data['rel']);
                if($count_rel >= HAVE_RESULT)
                {
                    
                    if($data['rel'][0]['test_flg'] != 1){
                        $data['status'] = 'update';
                        $param = array(
                            'test_flg' => IS_CLOSED,
                        );
                        $data['id_rel'] = $this->config_calendar_model->edit_schedule_system($data['rel'][0]['id'], $param);
                    }
                    
                }
                else
                {
                    // insert
                    $my_array = array('test_flg' => IS_CLOSED,'target_date' => $date_select_absent);
                    $this->config_calendar_model->insert($my_array, $tbl = 'schedule_system');
                    $data['id_rel'] = $this->config_calendar_model->get_last_insert_id();
                    $data['status'] = 'insert';
                }
            }
            else
            {
                $data['status'] = 'FAIL';
            }
            
            echo json_encode($data);	
            die();
        }
    }
    

    public function register_date_intransfer()
    {
        if(isset($_POST['flag_register_transfer']))
        {
            $data = [];
            $session_content = $this->session->userdata('admin_account');
            $id_admin = (int)$session_content['id'];
            $list_date_selected = $_POST['list_date_selected'];
            $my_array = array('contents'=>$list_date_selected);

            $this->db->delete('m_config_calendar', array('create_id' => $id_admin)); 
            $this->config_calendar_model->insert($my_array, $tbl = 'm_config_calendar');
            echo json_encode($data);
            die();
        }
    }

    public function delete_date_intransfer()
    {
        if(isset($_POST['flag_delete_transfer']))
        {

            $data_json_contents = [];
            $id_edit = $this->input->post('id_edit');
            $date_delete = trim($this->input->post('date_delete'));

            $data['contents'] = $this->config_calendar_model->select_by_id($id_edit, $key = 'id', $tbl = NULL);
            $data_content_decode = json_decode($data['contents'][0]['contents']);
            $check_in_content = in_array($date_delete, $data_content_decode);
           
            if($check_in_content == ONLY_ONE_RELSULT)
            {
                foreach ($data_content_decode as $key => $value) 
                {
                    if($value == $date_delete)
                    {
                        unset($data_content_decode[$key]);  
                    }
                    else
                    {
                        array_push($data_json_contents, (string)$value);
                    }
                }
                $json_content_date = json_encode($data_json_contents);
                $data['status_edit'] = $this->config_calendar_model->edit_calender_intransfer($id_edit, $json_content_date);     
            }
            echo json_encode($data);
            die();
        }
    }

    public function load_list_data()
    {
        $list_data_intransfer = $this->config_calendar_model->get_list_intransfer();
        return $list_data_intransfer;
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
    
    public function check_is_closed_date($date_selected)
    {
        return  $this->config_calendar_model->is_test_date($date_selected);
            
    }

    public function update_closed_date()
    {
        if(isset($_POST['delete_closed']) && isset($_POST['id_of_date_del'])){
            $id_update = $this->input->post('id_of_date_del');
            $array = array('closed_flg' => UN_CLOSED);
            $data['rel'] = $this->config_calendar_model->edit_schedule_system($id_update, $array);
            echo json_encode($data);
            die();
        }
    }

    public function update_test_date()
    {
        if(isset($_POST['delete_test']) && isset($_POST['id_of_date_del'])){
            $id_update = $this->input->post('id_of_date_del');
            $array = array('test_flg' => UN_TEST);
            $data['rel'] = $this->config_calendar_model->edit_schedule_system($id_update, $array);
            echo json_encode($data);
            die();
        }
    }
    

}

/* End of file calender.php */
/* Location: ./application/controllers/admin/calender.php */