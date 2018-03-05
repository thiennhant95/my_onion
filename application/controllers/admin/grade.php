<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grade extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_grade_model','grade');
        $this->load->library('form_validation');
        $this->load->library("pagination");
    }
    /**
     * 級マスター
     *
     * @param
     * @return
     *
     */
    public function index() {
        if ($this->error_flg) return;
        try {
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/grade/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md pagination-main">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->grade->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['grade_list']=$this->grade->get_list_grade($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $this->viewVar=$data;
            admin_layout_view('grade_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 級登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_grade']=$this->grade->select_by_id($id)[0];
            if ($this->input->post()) {
                if($this->input->post('grade_code') != $data['get_grade']['grade_code'])
                {
                    $is_unique =  '|is_unique[m_grade#grade_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('grade_code', 'grade_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'grade_code' => $this->input->post('grade_code'),
                        'grade_name' => $this->input->post('grade_name')
                    );
                    $this->grade->update_by_id($dataUpdate);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('grade_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 級登録編集
     *
     * @param   
     * @return  
     *
    */
    public function create() {
        if ($this->error_flg) return;
        try {
            if ($this->input->post())
            {
                $this->form_validation->set_rules('grade_code','grade_code','required|trim|xss_clean|is_unique[m_grade#grade_code]');
                if ($this->form_validation->run() == true)
                {
                    $dataInsert = array(
                        'grade_code'=>$this->input->post('grade_code'),
                        'grade_name'=>$this->input->post('grade_name')
                    );
                    $this->grade->insert($dataInsert);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            admin_layout_view('grade_create', $this->viewVar);
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
    public function delete($id = NULL) {
        if ($this->error_flg) return;
        try {
            $dataUpdate = array(
                'id'=>$id,
                'delete_flg'=>DATA_ON,
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->grade->update_by_id($dataUpdate);
            echo json_encode(array('status'=>DATA_ON));
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
            $limit=LIMIT_CSV;
            $count_grade=count($this->grade->get_list());
            $count_num=ceil($count_grade/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->grade->export_csv($limit,$offset);
            }
            array_unshift($data[0],array("級コード","級名"));
            $this->load->helper('csv');
            array_to_csv($data, 'grade_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file grade.php */
/* Location: ./application/controllers/admin/grade.php */