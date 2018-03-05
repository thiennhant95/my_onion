<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//===========================================================
// バッチ用規定コントローラー
//===========================================================
class BATCH_Controller extends CI_Controller {

    // 設定情報
    public $configVar = array();

    protected $script_info = "";
    protected $options = array();

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('pagination');
        // エラーレベルセット
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

        ini_set('display_errors', 1);

        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = $this->viewVar['config'] = array_merge($_config, $_config2);
    
        if (isset($_SERVER['argv'])) {
            $argv = $_SERVER['argv'];
            array_shift($argv);

            $this->script_info = ' ' . implode("/", $argv);

            if (count($argv) >= 3) {
                array_shift($argv);
                array_shift($argv);
                foreach ($argv as $row) {
                    list($key, $value) = explode(":", $row);
                    $this->options[ $key ] = $value;
                }
            }
        } else {
            $this->script_info = '';
        }
        $this->load->model("sendmail_model");

        // 環境ごとの設定
        $this->_setenv();

    }

    public function index() {
        $this->execute();
    }

    /**
     * メイン処理等を呼び出す（テンプレートメソッド）
     *
     */
    public function execute()
    {
        // 開始ログ出力
        $this->_startLog();

        //バッファを制御開始
        ob_start();

        // メイン処理を実行
        $this->_main();

        // 終了ログ出力
        $this->_endLog();
    }

    /**
     * バッチ開始ログを出力します。
     */
    protected function _startLog()
    {
        logbatch("[BATCH START]" . $this->script_info);
    }

    /**
     * バッチ終了ログを出力します。
     */
    protected function _endLog()
    {
        logbatch("[BATCH END]" . $this->script_info);
    }

    /**
     * ログ出力
     * @param unknown $message
     */
    public function writeLog($message)
    {
        logbatch("[BATCH INFO]" . $message);
    }

    /**
     * 報告メールを送信先設定
     * @param string $addr
     */
    public function setMailTo($addr)
    {
        $this->sendmail_model->set_to($addr);
    }

    /**
     * 報告メールを送信元設定
     * @param string $addr
     */
    public function setMailFrom($addr)
    {
        $this->sendmail_model->set_from($addr);
    }

    /**
     * 添付メール
     * @param string 
     */
    public function setAttach($path)
    {
        return $this->sendmail_model->set_attach($path);
    }

    /**
     * 報告メールを送信する
     * @param string $message メール本文
     * @param string $subject メール件名
     */
    public function reportMail($message, $subject)
    {
        $message = $this->createMailMessage($message);
        $hostname = $this->getHostname();
        $this->sendmail_model->set_subject('[INFO]' . $subject . " - " . $hostname);
        $this->sendmail_model->set_message($message);
        $this->sendmail_model->send();
    }

    /**
     * 警告メールを送信する
     * @param string $message メール本文
     * @param string $subject メール件名
     */
    public function alertMail($message, $subject)
    {
        $message = $this->createMailMessage($message);
        $hostname = $this->getHostname();
        $this->sendmail_model->set_subject('[ALERT]' . $subject . " - " . $hostname);
        $this->sendmail_model->set_message($message);
        $this->sendmail_model->send();
    }

    /**
     * ホスト名を取得する
     *
     * @return string $hostname ホスト名
     */
    protected function getHostname()
    {
        $hostname = exec("/bin/hostname");
        return $hostname;
    }

    /**
     * メール本文を作成する
     *
     * @param string $message メールの本文
     */
    protected function createMailMessage($message)
    {
        // 時間
        $start_time = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $end_timestamp = time();
        $end_time = date('Y-m-d H:i:s', $end_timestamp);
        $took_time = date('H:i:s', strtotime(date('Y-m-d')) + $end_timestamp - $_SERVER['REQUEST_TIME']);

        // 実行ファイル
//        $script_name = realpath($_SERVER['argv'][0]);
        $script_name = $this->script_info;

        // ホスト名
        $hostname = $this->getHostname();

        $macro =
                array(
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'took_time' => $took_time,
                    'hostname' => $hostname,
                    'script_name' => $script_name,
                    'message' => $message,
        );
        $message = $this->getMailTemplate();
        foreach ($macro as $key => $val) {
            $message = str_replace("%{$key}%", $val, $message);
        }
        return $message;
    }

    /**
     * メールのテンプレートを取得する
     *
     * @return string $template メールのテンプレート
     */
    protected function getMailTemplate()
    {
        $template = <<<EOF
%message%

■ 実行時間
------------------------------------------
実行開始：%start_time%
実行終了：%end_time%
実行時間：%took_time%
------------------------------------------

■ 実行プログラム
------------------------------------------
実行ホスト：%hostname%
実行プログラム：%script_name%
------------------------------------------
EOF;
        return $template;
    }

    /**
     * 環境ごとの設定
     * @param
     * @return 
     */
    protected function _setenv() {
        $this->output->enable_profiler(FALSE);
        require_once( realpath( dirname(__FILE__) . "/../libraries/dBug.php"));
    }
}



//===========================================================
// API用規定コントローラー
//===========================================================
class API_Controller extends CI_Controller {

    // エラー定義
    const API_ERROR_OK = "000";
    const API_ERROR_UNKNOWN = "999";

    // API呼び出された時の入力パラメータ
    public $input_parameters = array();

    // 返却件数
    public $rows = 0;

    // 条件に合致する全件数
    public $found_rows = 0;

    // 設定情報
    public $configVar = array();

    // レスポンス用変数
    protected $_response = array();

    // エラーフラグ
    protected $error_flg = FALSE;

    // アカウント情報
    public $accountVar = array();

    public function __construct() {
        parent::__construct();

        // 設定値読み込み
        $this->_startup();

        // 環境ごとの設定
        $this->_setenv();

        // 入力パラメータ読み込み
        $this->_get_input();
    }


    /**
     * 処理開始時のもろものの処理
     * @param
     * @return 
     */
    protected function _startup() {
        // 許可するAPIのみ受付
    
        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = $this->viewVar['config'] = array_merge($_config, $_config2);
    }

    /**
     * 環境ごとの設定
     * @param
     * @return 
     */
    protected function _setenv() {
        $this->output->enable_profiler(FALSE);

        require_once( realpath( dirname(__FILE__) . "/../libraries/dBug.php"));
    }


    /**
     * 入力パラメータ読み込み
     * @param
     * @return 
     */
    protected function _get_input() {
        $json_string = file_get_contents('php://input');
        
        if (!empty($json_string)) {
            $this->input_parameters = json_decode($json_string, TRUE);
        }
    }

    protected function _success($msg = '成功', $item = array()) {
        $this->_response = array(
            'status' => array(
                'result_code'   => "000",
                'description'   => $msg,
                'date'          => date("Y/m/d H:i:s"),
                'rows'          => $this->rows,
                'found_rows'    => $this->found_rows,
            ),
            'item' => $item,
        );
        $this->_json_output();
    }

    protected function _error($msg = 'エラー', $code = API_ERRMSG_999) {
        $this->_response = array(
            'status' => array(
                'result_code'   => "999",
                'description'   => $msg,
                'date'          => date("Y/m/d H:i:s"),
                'rows'          => $this->rows,
                'found_rows'    => $this->found_rows,
            ),
        );
        $this->_json_output();
    }

    protected function _json_output() {
        if (ob_get_contents()) ob_end_clean();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->_response));
    }

    protected function _exit_ok() {
        echo "OK";
        exit;
    }

    protected function _exit_ng() {
        header('HTTP/1.1 500 Internal Server Error');
        echo "NG";
        exit;
    }

    protected function _sanitaize_post($post = array()) {
        $result = array();
        foreach ($post as $key => $value) {
            if (strpos($key, '---') === FALSE) {    // IEでmultipleでPOSTしたとき、バウンダリがPOSTに入ってきてしまうので、その対応
                $result[ $key ] = $value;
            }
        }
        logerr($result);
        return $result;
    }
}



//===========================================================
// フロント用規定コントローラー
//===========================================================
class FRONT_Controller extends CI_Controller {

    // ページネーション設定
    const VALUE_PAGINATION_LIMIT = 5;    // 5件/1ページ
    const VALUE_PAGINATION_LINKS = 7;    // ページリンク数
    const VALUE_PAGINATION_URISEGMENT_FRONT = 3; // ページのパラメータのセグメント位置（フロント用）
    const VALUE_PAGINATION_URISEGMENT = 3; // ページのパラメータのセグメント位置（管理ツール用）

    // viewとのI/F用変数
    public $viewVar = array();

    // アカウント情報
    public $accountVar = array();

    // 設定情報
    public $configVar = array();

    // パラメータ設定用
    public $parameters = array();

    // 一覧表示用ソートパラメータ
    public $filters = array();

    // エラーフラグ
    protected $error_flg = FALSE;

    // facebookユーザーパラメータ
	public $FB_user = array();

    // class
	public $_class = '';

    // method
	public $_method = '';


    // ページネーション設定
    public $paginationConfig = array(
        'per_page'     => self::VALUE_PAGINATION_LIMIT,
        'num_links'    => self::VALUE_PAGINATION_LINKS,
        'uri_segment'  => self::VALUE_PAGINATION_URISEGMENT_FRONT,
        'cur_tag_open'     => '<span class="current">',
        'cur_tag_close'    => '</span>',
        'first_tag_open'   => '',
        'first_tag_close'  => '',
        'last_tag_open'    => '',
        'last_tag_close'   => '',
        'next_tag_open'    => '',
        'next_tag_close'   => '',
        'prev_tag_open'    => '',
        'prev_tag_close'   => '',
        'num_tag_open'     => '',
        'num_tag_close'    => '',
        'first_link'   => '&laquo;',
        'last_link'    => '&raquo;',
        'prev_link'    => '&lt;',
        'next_link'    => '&gt',
    );


    /**
     * コンストラクタ
     * @param
     * @return 
     */
    public function __construct() {

        parent::__construct();

        // helper/liblary 読み込み
        $this->load->helper('front_layout');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->library('session');

        // 環境ごとの設定
        $this->_setenv();

        // 設定値読み込み
        $this->_startup();

        // 共通認証処理
        $this->_doAuthUser();
    }

    
    /**
     * 処理開始時のもろものの処理
     * @param
     * @return 
     */
    protected function _startup() {
        $this->_class = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();

        $this->viewVar['meta_css'] = array();

        // パンクズリスト
        $this->viewVar['meta_breadcrumbs'] = array();

        // デフォルトのOGP設定
        $this->_set_ogp();

        // タイトル設定
        $this->_set_meta_title();
        
        // その他メタ設定
        $this->_set_meta();

        // CSS設定
        $this->_set_css();

    }

    /**
     * 環境ごとの設定
     * @param
     * @return 
     */
    protected function _setenv() {
        if (ENVIRONMENT == 'local') {
            $this->output->enable_profiler(true);
        }
        require_once( realpath( dirname(__FILE__) . "/../libraries/dBug.php"));

        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = $this->viewVar['config'] = array_merge($_config, $_config2);


    }

    /**
     * 共通認証処理
     * @param
     * @return 
     */
    protected function _doAuthUser() {
// return;
        try {
            // 非ログインでもログインページにリダイレクトしないクラス
            $auth_exclude_class = array(
                "auth",
                "entry",
                "test",
            );

            $account = $this->session->userdata('user_account');
            if (in_array($this->router->fetch_class(), $auth_exclude_class)) {
                ;
            } else {
                if (empty($account)) {
                    // 非ログインならログインページにリダイレクト
                    redirect('/auth/');
                }
            } 
            // ログイン済みならアカウント情報を取得
            if (!empty($account)) {
                $this->viewVar['user_account'] = $this->accountVar = $account;
                if (empty($this->accountVar)) {
                    $this->session->sess_destroy();
                    redirect('/auth/');
                }
            }

        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * エラー画面表示
     * @param
     * @return 
     */
    protected function _show_error($message = NULL, $trace = NULL) {
        $this->viewVar['message'] = $message;
        if (ENVIRONMENT != 'production') {
            $this->viewVar['trace']   = $trace;
        }

        logerr($message, $trace);
        front_layout_view('error', $this->viewVar);
    }

    /**
     * 編集/登録用パラメータ設定
     * @param   string  設定タイプ（'new','post','flashdata'）
     * @return 
     */
    protected function _get_parameters($type) {
        if ($type == 'new' && $this->input->post('id') !== FALSE) $type = 'post';
    
        $result = array();
        foreach ($this->parameters as $row) {
            switch ($type) {
                case 'new':
                    $result[ $row ] = NULL;
                    break;
                case 'post':
                    // パラメータが無ければ配列に入れない
                    if ($this->input->post($row) === FALSE) continue;
                    $result[ $row ] = $this->input->post($row);
                    $this->session->set_flashdata($row, $this->input->post($row));
                    break;
                case 'validate':
                    $result[ $row ] = set_value($row);
                    $this->session->set_flashdata($row, set_value($row));
                    break;
                case 'flashdata':
                    // パラメータが無ければ配列に入れない
                    $result[ $row ] = $this->session->flashdata($row);
                    break;
            }
        }
        return $result;
    }

    /**
     * ヘッダ設定共通メソッド
     * @param   array           キー header_title:タイトル header_meta:メタ header_ogp:OGP
     * @param   array/string    パラメタ
     * @return 
     */
    protected function _set_header_common($key, $params = NULL) {
        $this->viewVar[ $key ] = $params;
    }

    /**
     * ページタイトル設定
     * @param   string  タイトル
     * @return 
     */
    protected function _set_meta_title($params = NULL) {
        $p = '';
        $p = $params;
        $this->_set_header_common('header_title', $p);
    }

    /**
     * その他メタ設定
     * @param   array   メタ
     * @return 
     */
    protected function _set_meta($params = array()) {
        $p = array();
        $p = $params;
        $this->_set_header_common('header_meta', $p);
    }

    /**
     * ドメインごとのCSS読み込み
     * @param  
     * @return 
     */
    protected function _set_css($params = array()) {
        $this->viewVar['meta_css'] = $params;
    }

    /**
     * OGP設定
     * @param   array   OGP
     * @return 
     */
    protected function _set_ogp($params = array()) {
        $ogp = $params;
        $this->viewVar['ogp'] = $ogp;
        $this->_set_header_common('header_ogp', $ogp);
    }


    /**
     * サイドバー設定
     * @param   サイドバーファイル名 ※指定しない場合は 「"sidebar_" + クラス名」となる
     * @return 
     */
    protected function _set_sidebar($fn = NULL) {
        if (is_null($fn)) { 
            $this->viewVar['sidebar'] = "sidebar_" . $this->router->fetch_class();
        } else {
            $this->viewVar['sidebar'] = $fn;
        }
    }

    /**
     * 検索用セッション初期化
     * @param   array   セッション文字列
     * @param   boolean POSTがない場合の処理 TRUE:セッションクリア FALSE:何もしない
     * @return  
     */
    protected function _initialize_session($session = array(), $clear = TRUE) {
        foreach ($session as $row) {
            if (strlen($this->input->post($row, TRUE))) {
                $this->session->set_userdata($row, $this->input->post($row, TRUE));
            } else {
                if ($clear == TRUE) $this->session->unset_userdata($row);
            }
        }
    }

    public function view($view = '') {
        $tmp = $this->viewVar;
        front_layout_view(str_replace(".php", '', $view), $this->viewVar);
    }

}


//===========================================================
//管理画面用規定コントローラー
//===========================================================
class ADMIN_Controller extends CI_Controller {

    // ページネーション設定
    const VALUE_PAGINATION_LIMIT = 10;    // 5件/1ページ
    const VALUE_PAGINATION_LINKS = 7;    // ページリンク数
    const VALUE_PAGINATION_URISEGMENT = 4; // ページのパラメータのセグメント位置（管理ツール用）

    // 権限レベル設定
    const VALUE_LEVEL_ADMIN = 4;
    const VALUE_LEVEL_OPERATOR = 2;
    const VALUE_LEVEL_CONTENTS =  1;

    // viewとのI/F用変数
    public $viewVar = array();

    // アカウント情報
    public $accountVar = array();

    // 設定情報
    public $configVar = array();

    // パラメータ設定用
    public $parameters = array();

    // 一覧表示用ソートパラメータ
    public $filters = array();

    // 権限による許可
    public $privilageMethod = array();

    // ページネーション設定
    public $paginationConfig = array(
        'per_page'     => self::VALUE_PAGINATION_LIMIT,
        'num_links'    => self::VALUE_PAGINATION_LINKS,
        'uri_segment'  => self::VALUE_PAGINATION_URISEGMENT,
        'cur_tag_open'     => '<li class="active"><span>',
        'cur_tag_close'    => '</span></li>',
        'first_tag_open'   => '<li>',
        'first_tag_close'  => '</li>',
        'last_tag_open'    => '<li>',
        'last_tag_close'   => '</li>',
        'next_tag_open'    => '<li>',
        'next_tag_close'   => '</li>',
        'prev_tag_open'    => '<li>',
        'prev_tag_close'   => '</li>',
        'num_tag_open'     => '<li>',
        'num_tag_close'    => '</li>',
        'first_link'   => '&laquo;',
        'last_link'    => '&raquo;',
        'prev_link'    => '&lt;',
        'next_link'    => '&gt',
    );

    // エラーフラグ
    protected $error_flg = FALSE;

    /**
     * コンストラクタ
     * @param
     * @return 
     */
    public function __construct() {
        parent::__construct();

        // helper/liblary 読み込み
        $this->load->helper('admin_layout');
        $this->load->library('form_validation');
        $this->load->library('session');

        // 設定値読み込み
        $this->_startup();

        // 環境ごとの設定
        $this->_setenv();

        // 共通認証処理
        $this->_doAuthUser();

        // 権限チェック
        $this->_check_privilage();
    }

    
    /**
     * 処理開始時のもろものの処理
     * @param
     * @return 
     */
    protected function _startup() {
        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = $this->viewVar['config'] = array_merge($_config, $_config2);
    }

    /**
     * 環境ごとの設定
     * @param
     * @return 
     */
    protected function _setenv() {
        if (ENVIRONMENT == 'local') {
            $this->output->enable_profiler(false);
        }
        require_once( realpath( dirname(__FILE__) . "/../libraries/dBug.php"));
    }

    /**
     * 共通認証処理
     * @param
     * @return 
     */
    protected function _doAuthUser() {
 return;
        try {
            // 非ログインでもログインページにリダイレクトしないクラス
            $auth_exclude_class = array(
                "auth",
            );
            
            $account = $this->session->userdata('admin_account');
            if (in_array($this->router->fetch_class(), $auth_exclude_class)) {
                ;
            } else {
                if (empty($account)) {
                    // 非ログインならログインページにリダイレクト
                    redirect('/admin/auth/');
                }
            } 
            // ログイン済みならアカウント情報を取得
            if (!empty($account)) {
                $this->viewVar['admin_account'] = $this->accountVar = $account;
                if (empty($this->accountVar)) {
                    $this->session->sess_destroy();
                    redirect('/admin/auth/');
                }
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 権限チェック
     * @param   
     * @return  
     */
    protected function _check_privilage() {
        try {
        
            ;
        
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 登録完了
     *
     * @param   
     * @return  
     *
    */
    public function complete() {
        admin_layout_view('complete', $this->viewVar);
    }

    /**
     * エラー画面表示
     * @param
     * @return 
     */
    protected function _show_error($message = NULL, $trace = NULL) {
        $this->viewVar['message'] = $message;
        if (ENVIRONMENT != 'production') {
            $this->viewVar['trace']   = $trace;
        }
        logerr($message, $trace);
        admin_layout_view('error', $this->viewVar);
        $this->error_flg = TRUE;
    }

    /**
     * 編集/登録用パラメータ設定
     * @param   string  設定タイプ（'new','post','flashdata'）
     * @return 
     */
    protected function _get_parameters($type) {
        if ($type == 'new' && $this->input->post('id') !== FALSE) $type = 'post';
    
        $result = array();
        foreach ($this->parameters as $row) {
            switch ($type) {
                case 'new':
                    $result[ $row ] = NULL;
                    break;
                case 'post':
                    // パラメータが無ければ配列に入れない
                    if ($this->input->post($row) === FALSE) continue;
                    $result[ $row ] = $this->input->post($row);
                    break;
                case 'validate':
                    $result[ $row ] = set_value($row);
                    break;
                case 'flashdata':
                    // パラメータが無ければ配列に入れない
                    if ($this->input->post($row) === FALSE) continue;
                    $result[ $row ] = $this->session->flashdata($row);
                    break;
            }
        }
        return $result;
    }

    /**
     * 検索用セッション初期化
     * @param   array   セッション文字列
     * @param   boolean POSTがない場合の処理 TRUE:セッションクリア FALSE:何もしない
     * @return  
     */
    protected function _initialize_session($session = array(), $clear = TRUE) {
        foreach ($session as $row) {
            // 配列の場合
            if(is_array($this->input->post($row, TRUE))) {
                if(count($this->input->post($row, TRUE)) > 0) {
                    $this->session->set_userdata($row, $this->input->post($row, TRUE));
                } else {
                    if ($clear == TRUE) $this->session->unset_userdata($row);
                }                
            }
            // 文字列の場合
            else {
                if (strlen($this->input->post($row, TRUE))) {
                    $this->session->set_userdata($row, $this->input->post($row, TRUE));
                } else {
                    if ($clear == TRUE) $this->session->unset_userdata($row);
                }
            }
        }
    }

}

class MY_Controller extends CI_Controller {
}
