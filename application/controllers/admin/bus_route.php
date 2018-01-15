<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_route extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_bus_route_model','bus_route');
        $this->load->model('db/m_bus_course_model','bus_course');
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_bus_stop_model','bus_stop');
    }
    /**
     * バスコースマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['bus_course_list']=$this->bus_course->get_list();
            $data['bus_route_list']=$this->bus_route->get_list();
            $data['class_list']=$this->class->get_list();
            $this->viewVar=$data;
            admin_layout_view('bus_route_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バスコース登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_bus_course']=$this->bus_course->select_by_id($id)[0];
            $data['class_list']=$this->class->get_list();
            $data['bus_route_list']=$this->bus_route->get_list(array('bus_course_id'=> "=".$id));
            $data['bus_stop_list']=$this->bus_stop->get_list();
            $data['title'] =" バスコース登録／ルート設定";
            if ($this->input->post())
            {
                if($this->input->post('bus_course_code') != $data['get_bus_course']['bus_course_code'])
                {
                    $is_unique =  '|is_unique[m_bus_course#bus_course_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('bus_course_code', 'bus_course_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {


                }
                else if ($this->form_validation->run() == false)
                {
                    echo "0";
                    die();
//                    $this->session->set_flashdata('message', "<div class='alert-danger'>Update fail! Grade code already exists</div>");
//                    redirect('admin/edit-level/'.$id);
                }
            }
            $this->viewVar = $data;
            admin_layout_view('bus_route_edit', $this->viewVar);
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
            $this->bus_course->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }



    public function delete_bus_route($id = NULL) {
        if ($this->error_flg) return;
        try {
            $dataUpdate = array(
                'id'=>$id,
                'delete_flg'=>'1',
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->bus_route->update_by_id($dataUpdate);
            echo json_encode(array("success" => true));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file bus_route.php */
/* Location: ./application/controllers/admin/bus_route.php */