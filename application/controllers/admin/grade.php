<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grade extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_grade_model','grade');
        $this->load->library('form_validation');
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
            $data['grade_list']= $this->grade->get_list();
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
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Updated !</div>");
                    redirect('admin/grade');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Update fail! Grade code already exists</div>");
                    redirect('admin/edit-grade/'.$id);
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
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Inserted !</div>");
                    redirect('admin/create-grade');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Insert fail! Grade code already exists</div>");
                    redirect('admin/create-grade');
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
                'delete_flg'=>'1',
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->grade->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file grade.php */
/* Location: ./application/controllers/admin/grade.php */