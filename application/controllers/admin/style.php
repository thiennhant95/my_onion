<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Style extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_sw_style_model','style');
        $this->load->library('form_validation');
    }

    /**
     * 距離マスター
     *
     * @param
     * @return
     *
     */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['style_list']= $this->style->get_list();
            $this->viewVar=$data;
            admin_layout_view('style_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 距離登録編集
     *
     * @param
     * @return
     *
     */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_style']=$this->style->select_by_id($id)[0];
            if ($this->input->post()) {
                if($this->input->post('style_code') != $data['get_style']['style_code'])
                {
                    $is_unique =  '|is_unique[m_sw_style#style_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('style_code', 'style_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'style_code' => $this->input->post('style_code'),
                        'style_name' => $this->input->post('style_name')
                    );
                    $this->style->update_by_id($dataUpdate);
                    echo DATA_ON;
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                  echo DATA_OFF;
                  die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('style_edit', $this->viewVar);
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
                $this->form_validation->set_rules('style_code','style_code','required|trim|xss_clean|is_unique[m_sw_style#style_code]');
                if ($this->form_validation->run() == true)
                {
                    $dataInsert = array(
                        'style_code'=>$this->input->post('style_code'),
                        'style_name'=>$this->input->post('style_name')
                    );
                    $this->style->insert($dataInsert);
                    echo  DATA_ON;
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo DATA_OFF;
                    die();
                }
            }
            admin_layout_view('style_create', $this->viewVar);
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
            $this->style->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
}

/* End of file style.php */
/* Location: ./application/controllers/admin/style.php */