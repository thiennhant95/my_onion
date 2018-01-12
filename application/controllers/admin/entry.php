<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends ADMIN_Controller {

    /**
     * 新規ネット申込一覧(１ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        /*
       【備考】
            ・index()メソッドは一覧表示画面にて、１ページめを表示するときに呼んでください。
              検索フォームのセッション保持（クリア）をおこない、ページ表示（view()メソッド）を呼び出します。

              $search_session には、セッション保持したいフォームのname属性をセットしてください。
              例）<input type="text" name="search_name"> の場合
                  $search_session = array(
                      'search_name',
                  );

            ・ページネーションにて画面遷移するときはindex()ではなく、view()を呼んでください（引数はページ数）。

            ・view()メソッドにてページ数に応じた一覧をDBより取得し、ページネーションの設定をおこなったあとビューを表示します。
        */

        if ($this->error_flg) return;
        try {
            // 検索フォーム保持用セッション
            $search_session = array();

            // 検索フォーム用セッション設定
            $this->_initialize_session($search_session);

            // 表示
            $this->view(0);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 新規ネット申込一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('entry_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * お申込書
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('entry_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file entry.php */
/* Location: ./application/controllers/admin/entry.php */