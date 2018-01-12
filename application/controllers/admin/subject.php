<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends ADMIN_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_subject_model','subject');
        $this->load->library('form_validation');
    }
    /**
     * 科目マスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['subject_list']= $this->subject->get_list();
            $this->viewVar=$data;
            admin_layout_view('subject_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 科目登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_subject']=$this->subject->select_by_id($id)[0];
            if ($this->input->post()) {
                if($this->input->post('subject_code') != $data['get_subject']['subject_code'])
                {
                    $is_unique =  '|is_unique[m_subject#subject_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('subject_code', 'subject_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'subject_code' => $this->input->post('subject_code'),
                        'subject_name' => $this->input->post('subject_name')
                    );
                    $this->subject->update_by_id($dataUpdate);
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Updated !</div>");
                    redirect('admin/subject');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Update fail! Subject code already exists</div>");
                    redirect('admin/edit-subject/'.$id);
                }
            }
            $this->viewVar = $data;
            admin_layout_view('subject_edit', $this->viewVar);
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
            if ($this->input->post())
            {
                $this->form_validation->set_rules('subject_code','subject_code','required|trim|xss_clean|is_unique[m_subject#subject_code]');
                if ($this->form_validation->run() == true)
                {
                    $dataInsert = array(
                        'subject_code'=>$this->input->post('subject_code'),
                        'subject_name'=>$this->input->post('subject_name')
                    );
                    $this->subject->insert($dataInsert);
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Inserted !</div>");
                    redirect('admin/create-subject');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Insert fail! Subject code already exists</div>");
                    redirect('admin/create-subject');
                }
            }
            admin_layout_view('subject_create', $this->viewVar);
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
            $this->subject->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file subject.php */
/* Location: ./application/controllers/admin/subject.php */