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
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md">';
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

}

/* End of file class.php */
/* Location: ./application/controllers/admin/class.php */