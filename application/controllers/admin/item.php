<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_item_model','item');
        $this->load->library('form_validation');
    }

    /**
     * 品目マスター
     *
     * @param
     * @return
     *
     */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['item_list']= $this->item->get_list();
            $this->viewVar=$data;
            admin_layout_view('item_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }


    /**
     * 品目登録編集
     *
     * @param
     * @return
     *
     */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_item']=$this->item->select_by_id($id)[0];
            $this->load->model('db/m_subject_model','subject');
            $data['subject_list']=$this->subject->get_list();
            if ($this->input->post()) {
                if($this->input->post('item_code') != $data['get_item']['item_code'])
                {
                    $is_unique =  '|is_unique[m_item#item_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('item_code', 'item_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    $dataUpdate = array(
                        'id' => $id,
                        'item_code' => $this->input->post('item_code'),
                        'item_name' => $this->input->post('item_name'),
                        'subject_id'=>$this->input->post('subject_id'),
                        'sell_price'=>$this->input->post('sell_price'),
                        'buy_price'=>$this->input->post('buy_price'),
                        'tax_flg'=>$this->input->post('tax'),
                        'manage_flg'=>$this->input->post('stock'),
                        'left_num'=>$this->input->post('left_num'),
                        'type'=>$this->input->post('type'),
                        'disp_flg'=>$this->input->post('display'),
                    );
                    $this->item->update_by_id($dataUpdate);
                    echo "1";
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo "0";
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('item_edit', $this->viewVar);
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
            $this->load->model('db/m_subject_model','subject');
            $data['subject_list']=$this->subject->get_list();
            if ($this->input->post())
            {
                $this->form_validation->set_rules('item_code','item_code','required|trim|xss_clean|is_unique[m_item#item_code]');
                if ($this->form_validation->run() == true) {
                    $dataInsert = array(
                        'item_code' => $this->input->post('item_code'),
                        'item_name' => $this->input->post('item_name'),
                        'subject_id'=>$this->input->post('subject_id'),
                        'sell_price'=>$this->input->post('sell_price'),
                        'buy_price'=>$this->input->post('buy_price'),
                        'tax_flg'=>$this->input->post('tax'),
                        'manage_flg'=>$this->input->post('stock'),
                        'left_num'=>$this->input->post('left_num'),
                        'type'=>$this->input->post('type'),
                        'disp_flg'=>$this->input->post('display'),
                    );
                    $this->item->insert($dataInsert);
                    echo "1";
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo "0";
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('item_create', $this->viewVar);
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
            $this->item->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file item.php */
/* Location: ./application/controllers/admin/item.php */
