<?php
//-------------------------------------------------------
// 
// slack投稿モデル
// 
//-------------------------------------------------------
class Slack_model extends MY_Model {

    // 定数
    const POST_URL = 'https://hooks.slack.com/services/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';

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * slackにポスト
     * 
     * @param   string  投稿者名
     * @param   string  
     * @return  
     */
    public function post_slack($text = '', $username = 'システムアラート', $channel = '#開発システムアラート') {
        $payload = array();

        if (ENVIRONMENT != 'production') {
            // テスト環境の場合
            $text = "【テスト環境】{$text}";
        } else {
            $text = "<!channel> {$text}";
        }

        $payload['icon_emoji'] = ':warning:';
        $payload['mrkdwn'] = true;
        $payload['username'] = $username;
        $payload['channel'] = $channel;
        $payload['text'] = $text;

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => self::POST_URL,
            CURLOPT_POST            => TRUE,
            CURLOPT_POSTFIELDS      => 'payload=' . urlencode(json_encode($payload)),
            CURLOPT_RETURNTRANSFER  => TRUE,
            CURLOPT_SSL_VERIFYPEER  => FALSE,
            CURLOPT_TIMEOUT         => 10,
        ));
        $result = curl_exec( $ch );
        curl_close( $ch );
        return false !== $result;
    }

}
