<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_stop extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_bus_stop_model','bus_stop');
        $this->load->library('form_validation');
    }
    /**
     * バス停マスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['bus_stop_list']= $this->bus_stop->get_list();
            $this->viewVar=$data;
            admin_layout_view('bus_stop_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バス停登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_bus_stop']=$this->bus_stop->select_by_id($id)[0];
            if ($this->input->post()) {
                if($this->input->post('bus_stop_code') != $data['get_bus_stop']['bus_stop_code'])
                {
                    $is_unique =  '|is_unique[m_bus_stop#bus_stop_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('bus_stop_code', 'bus_stop_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'bus_stop_code' => $this->input->post('bus_stop_code'),
                        'bus_stop_name' => $this->input->post('bus_stop_name')
                    );
                    $this->bus_stop->update_by_id($dataUpdate);
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Updated !</div>");
                    redirect('admin/bus_stop');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Update fail! Bus stop code already exists</div>");
                    redirect('admin/edit-bus-stop/'.$id);
                }
            }
            $this->viewVar = $data;
            admin_layout_view('bus_stop_edit', $this->viewVar);
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
                $this->form_validation->set_rules('bus_stop_code','bus_stop_code','required|trim|xss_clean|is_unique[m_bus_stop#bus_stop_code]');
                if ($this->form_validation->run() == true)
                {
                    $dataInsert = array(
                        'bus_stop_code'=>$this->input->post('bus_stop_code'),
                        'bus_stop_name'=>$this->input->post('bus_stop_name')
                    );
                    $this->bus_stop->insert($dataInsert);
                    $this->session->set_flashdata('message', "<div class='alert alert-success'>Inserted !</div>");
                    redirect('admin/create-bus-stop');
                }
                else if ($this->form_validation->run() == false)
                {
                    $this->session->set_flashdata('message', "<div class='alert alert-danger'>Insert fail! Bus stop code already exists</div>");
                    redirect('admin/create-bus-stop');
                }
            }
            admin_layout_view('bus_stop_create', $this->viewVar);
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
            $this->bus_stop->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file bus_stop.php */
/* Location: ./application/controllers/admin/bus_stop.php */