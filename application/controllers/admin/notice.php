<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends ADMIN_Controller {
     function __construct()
     {
         parent::__construct();
     }

    /**
     * お知らせ設定
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            if ($this->input->post())
            {
                if (strlen($_POST['contents'])<100)
                {
                    echo json_encode(array('status'=>DATA_OFF));
                    die();
                }
                else {
                    $filename = FCPATH . "files/notice.txt";
                    file_put_contents($filename, $_POST['contents']);
                    echo json_encode(array('status' => DATA_ON));
                    die();
                }
            }
            admin_layout_view('notice_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file notice.php */
/* Location: ./application/controllers/admin/notice.php */