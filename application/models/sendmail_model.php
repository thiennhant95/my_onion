<?php
//-------------------------------------------------------
// 
// メール送信用モデル
// 
//-------------------------------------------------------
class Sendmail_model extends MY_Model {

    // 定数
    const CODE = 'iso-2022-jp';
    const SENDMAIL_ALIAS = '';     // 設定した場合、すべての送信先はこれに置き換えられる（テスト環境用）

    // プロパティ
    protected $from     = NULL;
    protected $to       = NULL;
    protected $subject  = NULL;
    protected $body     = NULL;

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();

        // メールクラス
        $this->load->library('email');

        $config = array(
            "protocol"  => "smtp",
            "smtp_host" => "onionworld.sakura.ne.jp",
            "smtp_port" => 25,
            "smtp_user" => "hanamigawasw@onionworld.sakura.ne.jp",
            "smtp_pass" => "6yAsWogWAaBqDO3aKkunNWDp",
            "smtp_crypto" => "",
            "wrapchars"  => "999",  // ワードラップがマルチバイトに対応していないため、ワードラップ時に文字化けが発生する。ワードラップしないような文字数を設定
        );

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $this->email->initialize($config);
    }

    /**
     * 送信元アドレス
     * 
     * @param   string  送信元
     * @param   string  送信表示名
     * @return  
     */
    public function set_from($from = '', $disp = '') {
        if (!empty($from)) {
            if (!empty($disp)) {
                $this->email->from($from, mb_encode_mimeheader($disp, self::CODE));
            } else {
                $this->email->from($from);
            }
        }
        $this->from = $from;
        logdebug($from);
    }

    /**
     * 送信先設定
     * 
     * @param   string  送信先
     * @return  
     */
    public function set_to($to = NULL, $type = 'to') {
        switch ($type) {
            case 'bcc':
                $this->email->bcc($to);
                break;
            case 'cc':
                $this->email->cc($to);
                break;
            default:
                if (strlen(self::SENDMAIL_ALIAS)) {
                    $to = self::SENDMAIL_ALIAS;
                }
                $this->email->to($to);
                $this->to = $to;
                break;
        }
        if (is_array($to)) {
            logdebug(implode(",", $to));
        } else {
            logdebug($to);
        }
    }

    /**
     * BCC送信先設定
     * 
     * @param   string  BCC送信先
     * @return  
     */
    public function set_bcc($bcc = NULL) {
        $this->email->bcc($bcc, 100);
        logdebug($bcc);
    }

    /**
     * タイトル設定
     * 
     * @param   string  タイトル
     * @return  
     */
    public function set_subject($subject = NULL) {
        $subject = mb_encode_mimeheader($subject);
        $this->email->subject($subject);
        $this->subject = $subject;
        logdebug($subject);
    }

    /**
     * 本文設定
     * 
     * @param   string  本文送信先
     * @return  
     */
    public function set_message($message = NULL) {
        $this->email->message($message);
        $this->body = $message;
        logdebug($message);
    }

    /**
     * メール送信
     * 
     * @param   
     * @return  
     */
    public function send() {
        if (empty($this->to) || empty($this->from)) {
            logerr("no to or no from");
            throw new Exception();
        }

        if (ENVIRONMENT != 'local') {
            $result = $this->email->send();
            loginfo($this->email->print_debugger());
            if($result === FALSE){
                throw new Exception();
            }
        }
    }


    /**
     * 添付ファイル
     * 
     * @param   string  添付ファイルのパス
     * @return  
     */
    public function set_attach($path) {
        if (file_exists($path)) {
            $this->email->attach($path);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
