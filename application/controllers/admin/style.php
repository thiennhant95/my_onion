<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Style extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_sw_style_model','style');
        $this->load->library('form_validation');
        $this->load->library("pagination");
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
            $pagin=$this->paginationConfig;
            $pagin["base_url"] = '/admin/style/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->style->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['style_list']=$this->style->get_list_style($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
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
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
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
            $limit=1000;
            $count_style=count($this->style->get_list());
            $count_num=ceil($count_style/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->style->export_csv($limit,$offset);
            }
            array_unshift($data[0],array("種目コード","種目名"));
            $this->load->helper('csv');
            array_to_csv($data, 'style_swimming_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
}

/* End of file style.php */
/* Location: ./application/controllers/admin/style.php */