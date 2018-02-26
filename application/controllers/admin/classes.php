<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classes extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_course_model','course');
        $this->load->library('form_validation');
        $this->load->library("pagination");
    }

    /**
     * クラスマスター
     *
     * @param
     * @return
     *
     */
    public function index() {
        if ($this->error_flg) return;
        try {
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/classes/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md pagination-main">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->class->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['class_list']=$this->class->get_list_class($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $this->viewVar=$data;
            admin_layout_view('classes_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * クラス登録編集
     *
     * @param
     * @return
     *
     */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_class']=$this->class->select_by_id($id)[0];
            $data['course_list']=$this->course->get_list();
            $data['get_course']=$this->course->select_by_id($data['get_class']['course_id'])[0];
            if ($this->input->post()) {
                $this->form_validation->set_rules('class_code', 'class_code', 'required|trim|xss_clean');
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id'=>$id,
                        'course_id'=>$this->input->post('short_course_name'),
                        'base_class_sign'=>$this->input->post('base_class_sign'),
                        'class_code' => $this->input->post('class_code'),
                        'class_name' => $this->input->post('class_name'),
                        'grade_manage_flg'=>$this->input->post('level-manage'),
                        'use_bus_flg'=>$this->input->post('use-bus'),
                        'week'=>implode(',',$this->input->post('week')),
                        'max_count'=>$this->input->post('max_count'),
                        'invalid_flg'=>$this->input->post('enable'),
                    );
                    $this->class->update_by_id($dataUpdate);
                    echo json_encode(array('success'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('fail'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('classes_edit', $this->viewVar);
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
            $data['course_list']=$this->course->get_list();
            if ($this->input->post()) {
                $this->form_validation->set_rules('class_code', 'class_code', 'required|trim|xss_clean');
                if ($this->form_validation->run() == true) {
                    $dataInsert = array(
                        'course_id'=>$this->input->post('short_course_name'),
                        'base_class_sign'=>$this->input->post('base_class_sign'),
                        'class_code' => $this->input->post('class_code'),
                        'class_name' => $this->input->post('class_name'),
                        'grade_manage_flg'=>$this->input->post('level-manage'),
                        'use_bus_flg'=>$this->input->post('use-bus'),
                        'week'=>implode(',',$this->input->post('week')),
                        'max_count'=>$this->input->post('max_count'),
                        'invalid_flg'=>$this->input->post('enable'),
                    );
                    switch ($this->input->post('base_class_sign'))
                    {
                        case 'M':
                            $dataInsert['start_time']=START_TIME_M;
                            $dataInsert['end_time']=END_TIME_M;
                            break;
                        case 'A':
                            $dataInsert['start_time']=START_TIME_A;
                            $dataInsert['end_time']=END_TIME_A;
                            break;
                        case 'B':
                            $dataInsert['start_time']=START_TIME_B;
                            $dataInsert['end_time']=END_TIME_B;
                            break;
                        case 'C':
                            $dataInsert['start_time']=START_TIME_C;
                            $dataInsert['end_time']=END_TIME_C;
                            break;
                        case 'D':
                            $dataInsert['start_time']=START_TIME_D;
                            $dataInsert['end_time']=END_TIME_D;
                            break;
                        case 'E':
                            $dataInsert['start_time']=START_TIME_E;
                            $dataInsert['end_time']=END_TIME_E;
                            break;
                        case 'F':
                            $dataInsert['start_time']=START_TIME_F;
                            $dataInsert['end_time']=END_TIME_F;
                            break;
                    }
                    $this->class->insert($dataInsert);
                    echo json_encode(array('success'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('fail'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('classes_create', $this->viewVar);
        } catch (Exception $e) {
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
            $limit=10;
            $count_class=count($this->class->get_list());
            $count_num=ceil($count_class/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->class->export_csv($limit,$offset);
            }
            array_unshift($data[0],array("コース記号","クラス記号","クラスコード","クラス名","	授業曜日","開始時刻","バス利用フラグ","終了時刻","	定員"));
            $this->load->helper('csv');
            array_to_csv($data, 'class_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function get_short_course_name($id)
    {
        if ($this->error_flg) return;
        try {
            $data=$this->course->select_by_id($id)[0];
            echo json_encode($data);
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function check_week($id_course,$class_sign,$week,$id_class=NULL)
    {
        if ($this->error_flg) return;
        try {
            $list_class=$this->class->get_list(array('course_id'=>'='.$id_course,'base_class_sign'=>'="'.$class_sign.'"'));
            if ($list_class!=null) {
                if (array_key_exists($id_class,$list_class))
                {
                    unset($list_class[$id_class]);
                }
                foreach ($list_class as $row_class):
                    $row_class['week'] = explode(',', $row_class['week']);
                    if (in_array($week, $row_class['week'])) {
                        echo json_encode(array('status' => DATA_ON));
                         die();
                    }
                endforeach;
            }
            else
            {
                echo json_encode(array('status' => DATA_OFF));
                die();
            }
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function check_max_count($course_id)
    {

        if ($this->error_flg) return;
        try {
            $this->input->post('max_count');
            $max_count_db=$this->class->number_of_pupils($course_id)[0]['count_total'];
            $max_course=$this->course->select_by_id($course_id)[0];
            $max_count=$this->input->post('max_count')+$max_count_db;
            if ($max_count < $max_course['max_count'])
            {
                $total=$max_course['max_count']-$max_count_db;
                echo json_encode(array('status'=>'0','total'=>$total));
                die();
            }
            else
            {
                $total=$max_course['max_count']-$max_count_db;
                echo json_encode(array('status'=>'1','total'=>$total));
                die();
            }
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file class.php */
/* Location: ./application/controllers/admin/class.php */