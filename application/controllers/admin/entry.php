<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends ADMIN_Controller {

    public  function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('student_model', 'student_data');
        $this->load->model('db/m_course_model', 'm_course_model');
        $this->load->model('db/m_student_model','student_model');
        $this->load->model('db/m_class_model','m_class_model');
        $this->load->model('db/l_student_meta_model', 'student_meta_model');
        $this->load->model('db/l_student_course_model', 'l_student_course_model');
        $this->load->model('sendmail_model','send_mail');
        $this->load->library('pagination');
        
    }
    
    public function index() {
        if ($this->error_flg) return;
        try {            
            $condition = array('status' => 0, 'delete_flg' => 0);
            $total_list_user_inactive =  $this->student_data->get_total_user_inactive($condition);
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

            $pagination = $this->paginationConfig;
            $pagination['base_url'] = '/admin/entry/index';
            $pagination['total_rows'] = $total_list_user_inactive;
            $this->pagination->initialize($pagination);

            $params['result'] = $this->get_limit_data_users($pagination['per_page'], $page);
            $params["links"] = $this->pagination->create_links();
            $this->viewVar =  $params;
            admin_layout_view('entry_index', $this->viewVar);
            // // 検索フォーム保持用セッション
            // $search_session = array();
            // // 検索フォーム用セッション設定
            // $this->_initialize_session($search_session);
            // // 表示
            // $this->view(0);

        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 新規ネット申込一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('entry_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * お申込書
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $metas = $this->student_meta_model->select_student_metas( $id );
            $data = array();
            foreach ( $metas as $key => $value ) {
                $data[$value['tag']] = $value['value'];
            }
            $email_address = $this->student_model->select_student_field( $id, 'email' );
            $course = $this->l_student_course_model->select_by_id( $id, 'student_id', 'l_student_course' );
            $course_id = $course[0]['course_id'];
            $classes = $this->m_class_model->select_by_id($course_id, 'course_id', 'm_class');
            $classes_week = array();
            foreach ( $classes as $key => $value ) {
                for ( $i = 0; $i < 7; $i++ ) {
                    if ( strpos( $value['week'], $i . '' ) !== false ) $classes_week[$i][]['info'] = $value['id'] . '-' . $value['base_class_sign'] . '-' . $value['class_code'];
                }
            }
            $all_course = $this->m_course_model->select_all('m_course');
            $data['email_address'] = $email_address[0]['email'];
            $data['school_grades'] = $this->configVar['school_grades'];
            $class_week_sort = array();
            $class_week_sort[2] = $classes_week[2];
            $class_week_sort[3] = $classes_week[3];
            $class_week_sort[4] = $classes_week[4];
            $class_week_sort[5] = $classes_week[5];
            $class_week_sort[6] = $classes_week[6];
            $class_week_sort[0] = $classes_week[0];
            $class_week_sort[1] = $classes_week[1];
            $data['classes_week'] = $class_week_sort;
            $data['course_id'] = $course_id;
            $data['courses'] = $all_course;
            $this->viewVar = $data;
            admin_layout_view('entry_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_list_users_inactive($limit,  $stated){
       
        $data = $this->student_data->get_limit_list_user($limit, $stated);
        return $data;
    }

    // public function get_info_users_inactive()
    // {
    //     $data = $this->master_student->get_records_user_inactive();
    //     return $data;
    // }

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

/* End of file entry.php */
/* Location: ./application/controllers/admin/entry.php */