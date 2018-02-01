<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distance extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_distance_model','distance');
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
            $pagin["base_url"] = '/admin/distance/index';
            $pagin['full_tag_open']   = '<ul class="pagination pagination-md">';
            $pagin['full_tag_close']  = '</ul>';
            $pagin['total_rows'] = count($this->distance->get_list());
            $this->pagination->initialize($pagin);
            $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
            $data['distance_list']=$this->distance->get_list_distance($pagin["per_page"], $data['page']);
            $data['pagination'] = $this->pagination->create_links();
            $this->viewVar=$data;
            admin_layout_view('distance_index', $this->viewVar);
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
            $data['get_distance']=$this->distance->select_by_id($id)[0];
            if ($this->input->post()) {
                if($this->input->post('distance_code') != $data['get_distance']['distance_code'])
                {
                    $is_unique =  '|is_unique[m_distance#distance_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('distance_code', 'distance_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'distance_code' => $this->input->post('distance_code'),
                        'distance_name' => $this->input->post('distance_name')
                    );
                    $this->distance->update_by_id($dataUpdate);
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
            admin_layout_view('distance_edit', $this->viewVar);
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
                $this->form_validation->set_rules('distance_code','distance_code','required|trim|xss_clean|is_unique[m_distance#distance_code]');
                if ($this->form_validation->run() == true)
                {
                    $dataInsert = array(
                        'distance_code'=>$this->input->post('distance_code'),
                        'distance_name'=>$this->input->post('distance_name')
                    );
                    $this->distance->insert($dataInsert);
                    echo json_encode(array('status'=>DATA_ON));
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
            }
            admin_layout_view('distance_create', $this->viewVar);
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
            $this->distance->update_by_id($dataUpdate);
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
            $count_distance=count($this->distance->get_list());
            $count_num=ceil($count_distance/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->distance->get_list_distance($limit,$offset);
            }
            array_unshift($data[0],array("id","距離コード","距離コード"));
            $this->load->helper('csv');
            array_to_csv($data, 'distance_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
}

/* End of file distance.php */
/* Location: ./application/controllers/admin/distance.php */