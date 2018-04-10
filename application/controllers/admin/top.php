<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Top extends ADMIN_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('db/m_student_model','m_student_model');
        $this->load->model('db/l_student_request_model', 'request_model');
        $this->load->model('db/m_course_model', 'm_course_model');
        $this->load->model('student_model', 'student_data');
    }

    /**
     * トップページ
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $config = $this->configVar;

            //get data course free
            $limit_record = 10;
            $data['member_course_free'] = $this->m_student_model->get_user_course_free($limit_record, 0);

            //get danh sach dang ky online moi chua xu ly
            $data['student_register'] = $this->get_limit_data_users($limit_record, 0);
            //get danh sach yeu cau thay doi hop dong
            $data['student_request']  = $this->request_model->get_list_request($limit_record, 0);
            $data['type_search'] = $config['type_search'];
            $data['db_course_short_term'] = $this->m_course_model->get_list_c_short();

            $timstamp_now = new DateTime();
            $timstamp_now = $timstamp_now->format('Y-m-d');
            $data['list_member_today'] = $this->student_data->get_member_today($timstamp_now);

            $this->viewVar = $data;
            admin_layout_view('top_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function get_limit_data_users($limit, $started)
    {
        $data_users_inactive =  $this->get_list_users_inactive($limit, $started);
        $data_user_detail = [];

        foreach ($data_users_inactive as $key => $value) {

            $array_item = [];
            $tmp_data_user = $this->student_data->get_student_data($value['id']);
            $info_id_user = isset($tmp_data_user['info']['id']) ? $tmp_data_user['info']['id'] : '';
            $info_date_register = isset($tmp_data_user['info']['create_date']) ? $tmp_data_user['info']['create_date'] : '';
            $tag_name = isset($tmp_data_user['meta']['name']) ? $tmp_data_user['meta']['name']  : '';
            
            $tag_type_course = isset($tmp_data_user['meta']['course_type']) ? $tmp_data_user['meta']['course_type']  : '';
            $type_name_course = $this->get_name_type_course($tag_type_course);
            
            $courser_id = isset($tmp_data_user['course']['valid']['1']) ? $tmp_data_user['course']['valid']['1']['course_id'] : '';          
            $data_coure = $this->m_course_model->get_info_course($courser_id);
            $course_name = isset($data_coure[0]['course_name'] ) ? $data_coure[0]['course_name'] : '';
            
            $array_item = array(
                'id' =>  $info_id_user,
                'date_register' => $info_date_register,
                'tag_name' => $tag_name,
                'tag_type_course' => $type_name_course,
                'course_name' => $course_name
            );
            array_push($data_user_detail, $array_item);
        }
        return $data_user_detail;
    }
    public function get_list_users_inactive($limit,  $stated){
        $data = $this->student_data->get_limit_list_user($limit, $stated);
        return $data;
    }
    public function get_name_type_course($valid)
    {
        $name_course = '';
        $course_name = $this->configVar['course_type'];
        
        switch ($valid) {
            case '0':
                $name_course = $course_name[VALUE_COURSE_TYPE_NORMAL];
                break;
            case '1':
                $name_course = $course_name[VALUE_COURSE_TYPE_LIMITED];
                break;
            case '2':
                $name_course = $course_name[VALUE_COURSE_TYPE_FREE];
                break;
            default:
                # code...
                break;
        }
        return $name_course;
    }
}

/* End of file top.php */
/* Location: ./application/controllers/admin/top.php */
