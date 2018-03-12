<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends FRONT_Controller {

    /**
     * トップページ
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            front_layout_view('help_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function export_to_pdf() {

        $body = isset( $_POST['html'] ) ? $_POST['html'] : ' Something wrong ! '; 
        $filename = "FAQ_".time().".pdf";
        $html = '<!DOCTYPE html>
                <html><head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                </head><body>'.$body.'</body></html>';
        require_once APPPATH . '/third_party/MPDF/vendor/autoload.php'; 
        $mpdf = new  Mpdf\Mpdf(['default_font' => 'Sun-ExtA']);
        $mpdf->WriteHTML($html);
        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
        exit(0);
    }

}

/* End of file help.php */
/* Location: ./application/controllers/front/help.php */