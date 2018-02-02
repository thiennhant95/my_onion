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
    public function export_to_pdf_2($htmlContent="",$newfile='export'){
        
        $html = '
            <html>
            <head>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            </head>
            <style type="text/css">
                    @font-face {
                  font-family: "Firefly Sung";
                  font-style: normal;
                  font-weight: 400;
                  src: url(http://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf) format("truetype");
                }
                body {
                  font-family: Firefly Sung, DejaVu Sans, sans-serif,Osaka ;
                }
            </style>
            <body>
            <p >献给母亲的爱</p>

            <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-help bg-violet h3">ヘルプ</h1>
      <a href="/help/export_to_pdf" target="_blank">click me to download the file</a>
      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">新規入会時ご案内の再確認</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link"  id="export_to_pdf">ご案内を見る</a>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">よくある質問</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT0">よくある質問</a>
                <div id="QT0" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>

              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT1">よくある質問</a>
                <div id="QT1" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT2">よくある質問</a>
                <div id="QT2" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT3">よくある質問</a>
                <div id="QT3" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT4">よくある質問</a>
                <div id="QT4" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT5">よくある質問</a>
                <div id="QT5" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>

    </div>
  </main>
              </body>
            </html>
';


        $filename = time()."_order.pdf";
         
        $pdfFilePath = "output_pdf_name" . time() . ".pdf";
 
        //load mPDF library
        $this->load->library('M_pdf');

       //generate the PDF from the given html
        $this->M_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->M_pdf->pdf->Output($pdfFilePath, "D");
    }

}

/* End of file help.php */
/* Location: ./application/controllers/front/help.php */