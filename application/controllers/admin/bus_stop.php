<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_stop extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_bus_stop_model','bus_stop');
        $this->load->library('form_validation');
        $this->load->library("pagination");
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
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/bus_stop/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md pagination-main">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->bus_stop->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['bus_stop_list']=$this->bus_stop->get_list_bus_stop($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
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
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
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
                'delete_flg'=>DATA_ON,
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->bus_stop->update_by_id($dataUpdate);
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
            $limit=10;
            $count_bus_stop=count($this->bus_stop->get_list());
            $count_num=ceil($count_bus_stop/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->bus_stop->export_csv($limit,$offset);
            }
            array_unshift($data[0],array("乗車場所コード","乗車場所"));
            $this->load->helper('csv');
            array_to_csv($data, 'bus_stop_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file bus_stop.php */
/* Location: ./application/controllers/admin/bus_stop.php */