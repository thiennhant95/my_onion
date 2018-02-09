<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/l_student_request_model','request');
        $this->load->library("pagination");
    }

    /**
     * 契約変更申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            admin_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function ajax_load_list(){
        if ($this->error_flg) return;
        try {
            if (!$this->input->post('verify_submit')) {
                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/request/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $pagin['total_rows'] = count($this->request->get_list());
                $this->pagination->initialize($pagin);
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
                $data['request_list'] = $this->request->get_list_request($pagin["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
                $list_search = $this->result_html($data['request_list']);
                echo json_encode(array('list' => $list_search, 'pagination' => $data['pagination']));
                die();
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function result_html($data=NULL)
    {
        if ($this->error_flg) return;
        try {
            print_r($data);
            die();
            global $html;
            if ($data) {
                foreach ($data as $row):
                    $row_content=json_decode($row['contents'],true);
                        $html .= '
                          <tr>
                            <th>' . $row['student_id'] . '</th>
                            <td>' . $row['name']. '</td> 
                            <td>' . $row['date_change'] . '</td> 
                            <td>' . $row_content['contents'] . '</td> 
                            <td>' . $row['reason'] . '</td> 
                            <td>' . $row['dist_date'] . '</td> 
                            <td><span class="text-danger">' . $row['test'] . '</span></td> 
                            <td>' . $row['status'] . '</td>                  
                         </tr>
                    ';
                endforeach;
            }
            else {
                $html .= '
                          <tr>
                            <td colspan="8"><b>見つからない</b></td>       
                         </tr>';
            }
            return $html;
        }
        catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }


    public function view($page = 0) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 契約変更申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('request_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file request.php */
/* Location: ./application/controllers/admin/request.php */