<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_item_model','item');
        $this->load->model('db/m_grade_model','grade');
        $this->load->model('db/m_distance_model','distance');
        $this->load->library('form_validation');
        $this->load->library("pagination");
    }

    /**
     * 練習コースマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/course/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->course->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['course_list']=$this->course->get_list_course($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $data['item_list']=$this->item->get_list();
            $this->viewVar=$data;
            admin_layout_view('course_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 練習コース登録編集
     *
     * @param
     * @return
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_course']=$this->course->select_by_id($id)[0];
            $data['item_list']=$this->item->get_list();
            $data['grade_list']=$this->grade->get_list();
            $data['distance_list']=$this->distance->get_list();
            if ($this->input->post())
            {
                if($this->input->post('course_code') != $data['get_course']['course_code'])
                {
                    $is_unique_code =  '|is_unique[m_course#course_code]';
                }
                else {
                    $is_unique_code =  '';
                }
                if($this->input->post('short_course_name') != $data['get_course']['short_course_name'])
                {
                    $is_unique_short =  '|is_unique[m_course#short_course_name]';
                }
                else {
                    $is_unique_short =  '';
                }
                $this->form_validation->set_rules('course_code', 'course_code', 'required|trim|xss_clean'.$is_unique_code);
                if ($this->form_validation->run() == true) {
                    if ($this->input->post('free_practice_radio')==DATA_OFF) {
                        $practice_max = $this->input->post('free_practice_radio');
                    }
                    if (!isset($_POST['free_practice_radio']))
                    {
                        $practice_max=$this->input->post('number_practice_select');
                    }

                    $start_date=implode('-',$this->input->post('start'));
                    $end_date=implode('-',$this->input->post('end'));
                    $start_regist=implode('-',$this->input->post('start_regist'));
                    $end_regist=implode('-',$this->input->post('end_regist'));
                    $condition_age=implode('~',$this->input->post('condition_age'));
                    $condition_grade=implode('~',$this->input->post('condition_grade'));
                    $join_condition_array['age']=$condition_age;
                    $join_condition_array['grade']=$condition_grade;
                    $join_condition_array['swimming_ability']=$this->input->post('swimming_ability');

                    if (!array_key_exists('face_into_water',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['face_into_water']=0;
                    if (!array_key_exists('not_face_into_water',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['not_face_into_water']=0;
                    if (!array_key_exists('dive',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['dive']=0;
                    if (!array_key_exists('float',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['float']=0;
                    if (!array_key_exists('free_lesson',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['free_lesson']=0;
                    if (!array_key_exists('short_lesson',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['short_lesson']=0;
                    if (!array_key_exists('experience',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['experience']['status']=0;

                    $join_condition_json=json_encode($join_condition_array,JSON_UNESCAPED_UNICODE);
                    $dataUpdate = array(
                        'id' => $id,
                        'course_code' => $this->input->post('course_code'),
                        'course_name' => $this->input->post('course_name'),
                        'cost_item_id'=>$this->input->post('cost_item_id'),
                        'rest_item_id'=>$this->input->post('rest_item_id'),
                        'bus_item_id'=>$this->input->post('bus_item_id'),
                        'short_course_name'=>$this->input->post('short_course_name'),
                        'practice_type'=>$this->input->post('number'),
                        'practice_max'=>$practice_max,
                        'change_flg'=>$this->input->post('transfer'),
                        'type'=>$this->input->post('course-type'),
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'max_count'=>$this->input->post('max_count'),
                        'regist_start_date'=>$start_regist,
                        'regist_end_date'=>$end_regist,
                        'join_condition'=>$join_condition_json,
                        'invalid_flg'=>$this->input->post('enable'),
                    );
                    $this->course->update_by_id($dataUpdate);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar=$data;
            admin_layout_view('course_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     *
     *
     * @param
     * @return
     *
     */
    public function create() {
        if ($this->error_flg) return;
        try {
            $data['item_list']=$this->item->get_list();
            $data['grade_list']=$this->grade->get_list();
            $data['distance_list']=$this->distance->get_list();
            if ($this->input->post())
            {
                $this->form_validation->set_rules('course_code', 'course_code', 'required|trim|xss_cleanis_unique[m_course#course_code]');
                if ($this->form_validation->run() == true) {
                    if ($this->input->post('free_practice_radio')==DATA_OFF) {
                        $practice_max = $this->input->post('free_practice_radio');
                    }
                    if (!isset($_POST['free_practice_radio']))
                    {
                        $practice_max=$this->input->post('number_practice_select');
                    }

                    $start_date=implode('-',$this->input->post('start'));
                    $end_date=implode('-',$this->input->post('end'));
                    $start_regist=implode('-',$this->input->post('start_regist'));
                    $end_regist=implode('-',$this->input->post('end_regist'));
                    $condition_age=implode('~',$this->input->post('condition_age'));
                    $condition_grade=implode('~',$this->input->post('condition_grade'));
                    $join_condition_array['swimming_ability']=$this->input->post('swimming_ability');
                    $join_condition_array['age']=$condition_age;
                    $join_condition_array['grade']=$condition_grade;

                    if (!array_key_exists('face_into_water',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['face_into_water']=0;
                    if (!array_key_exists('not_face_into_water',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['not_face_into_water']=0;
                    if (!array_key_exists('dive',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['dive']=0;
                    if (!array_key_exists('float',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['float']=0;
                    if (!array_key_exists('free_lesson',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['free_lesson']=0;
                    if (!array_key_exists('short_lesson',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['short_lesson']=0;
                    if (!array_key_exists('experience',$join_condition_array['swimming_ability']))
                        $join_condition_array['swimming_ability']['experience']['status']=0;

                    $join_condition_json=json_encode($join_condition_array,JSON_UNESCAPED_UNICODE);
                    $dataUpdate = array(
                        'course_code' => $this->input->post('course_code'),
                        'course_name' => $this->input->post('course_name'),
                        'cost_item_id'=>$this->input->post('cost_item_id'),
                        'rest_item_id'=>$this->input->post('rest_item_id'),
                        'bus_item_id'=>$this->input->post('bus_item_id'),
                        'short_course_name'=>$this->input->post('short_course_name'),
                        'practice_type'=>$this->input->post('number'),
                        'practice_max'=>$practice_max,
                        'change_flg'=>$this->input->post('transfer'),
                        'type'=>$this->input->post('course-type'),
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'max_count'=>$this->input->post('max_count'),
                        'regist_start_date'=>$start_regist,
                        'regist_end_date'=>$end_regist,
                        'join_condition'=>$join_condition_json,
                        'invalid_flg'=>$this->input->post('enable'),

                    );
                    $this->course->insert($dataUpdate);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar=$data;
            admin_layout_view('course_create', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_item($id = NULL)
    {
        if ($this->error_flg) return;
        try {
            $data_item= $this->item->select_by_id($id)[0];
            echo json_encode($data_item);
            die();
        }catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     *
     * export Csv
     * @param
     * @return
     *
     */
    public function export() {
        if ($this->error_flg) return;
        try {
            $limit=1000;
            $count_course=count($this->course->get_list());
            $count_num=ceil($count_course/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->course->export_csv($limit,$offset);
            }
            array_unshift($data[0],array("コースコード","コース名","記号","会費","休会費","バス管理費","回数",""));
            $this->load->helper('csv');
            array_to_csv($data, 'course_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }


}

/* End of file course.php */
/* Location: ./application/controllers/admin/course.php */