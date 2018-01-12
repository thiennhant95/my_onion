<?php
//-------------------------------------------------------
// 
// 外部サーバーアクセス用curlモデル
// 
//-------------------------------------------------------
class Curl_model extends MY_Model {

    // 定数

    // プロパティ
    private $ch;
    private $fp;
    private $userAgent;
    private $cookie;

    /**
     * construct
     *
     * @param   
     * @return  
     */
    public function __construct() {
        parent::__construct();
        $userAgent = $this->getUserAgents();
        $this->userAgent = $userAgent['Chrome'];
        $this->init();
    }

    /**
     * For GET requests.
     * 
     * @access public
     * @param string $url
     * @param mixed [&$info = null] Set result of curl_getinfo().
     * @return string Response body.
     */
    public function get($url, &$info = null) {
        logdebug("cURL URL:".$url);

        if (!is_string($url)) {
            throw new InvalidArgumentException('URL value type must be string.');
        }
        if (!is_resource($this->ch)) {
            throw new BadMethodCallException('cURL resource is not initialized');
        }
        curl_setopt_array($this->ch, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPGET => true,
        ));
        return $this->exec($info);
    }

    /**
     * For POST requests.
     * 
     * @access public
     * @param string $url
     * @param mixed $params Query string or associative array.
     * @param mixed [&$info = null] Set result of curl_getinfo().
     * @return string Response body.
     */
    public function post($url, $params, &$info = null) {
        if (!is_string($url)) {
            throw new InvalidArgumentException('URL value type must be string.');
        }
        if (!is_resource($this->ch)) {
            throw new BadMethodCallException('cURL resource is not initialized');
        }
        curl_setopt_array($this->ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
        ));

        logdebug("cURL URL:".$url);
        logdebug("cURL POST:".json_encode(empty($params) ? (object)NULL : $params));

        return $this->exec($info);
    }

    /**
     * For POST requests.
     * 
     * @access public
     * @param string $url
     * @param mixed $params Query string or associative array.
     * @param mixed [&$info = null] Set result of curl_getinfo().
     * @return string Response body.
     */
    public function apipost($url, $params, &$info = null) {
        if (!is_string($url)) {
            throw new InvalidArgumentException('URL value type must be string.');
        }
        if (!is_resource($this->ch)) {
            throw new BadMethodCallException('cURL resource is not initialized');
        }
        curl_setopt_array($this->ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(empty($params) ? (object)NULL : $params),         // JSONでエンコード
        ));

        logdebug("cURL URL:".$url);
        logdebug("cURL POST:".json_encode(empty($params) ? (object)NULL : $params));

        return $this->exec($info);
    }

    /**
     * Clear cookies.
     * 
     * @access public
     */
    public function clearCookies() {
        if (!is_resource($this->ch)) {
            throw new BadMethodCallException('cURL resource is not initialized');
        }
        ftruncate($this->fp, 0);
    }

    /**
     * Return the list of User-Agents.
     * You can extend this method.
     * 
     * @static
     * @access protected
     * @return array Associative array.
     */
    protected static function getUserAgents() {
        return array(
            'Chrome' =>
                'Mozilla/5.0 (Windows NT 6.1) ' .
                'AppleWebKit/537.36 (KHTML, like Gecko) ' .
                'Chrome/28.0.1500.63 Safari/537.36'
            ,
            'Firefox' =>
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) ' .
                'Gecko/20100101 Firefox/9.0.1'
            ,
            'Android' =>
                'Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03S) ' .
                'AppleWebKit/535.19 (KHTML, like Gecko) ' .
                'Chrome/18.0.1025.166 Safari/535.19'
            ,
            'iOS' =>
                'Mozilla/5.0 (iPhone; CPU iPhone OS 6_0 like Mac OS X) ' .
                'AppleWebKit/536.26 (KHTML, like Gecko) ' .
                'Version/6.0 Mobile/10A403 Safari/8536.25'
            ,
            'Windows Phone' =>
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; ' .
                'Trident/5.0; IEMobile/9.0; ' .
                'FujitsuToshibaMobileCommun; IS12T; KDDI)'
            ,
            'Internet Explorer' =>
                'Mozilla/5.0 (Windows NT 6.3; WOW64; ' . 
                'Trident/7.0; Touch; rv:11.0) like Gecko'
            ,
        );
    }

    /**
     * Serialize your own properties.
     * You can extend this method.
     * 
     * @access protected
     * @return mixed
     */
    protected function userSerialize() { return null; }

    /**
     * Unserialize your own properties.
     * You can extend this method.
     * 
     * @param anything $data
     * @access protected
     * @return mixed
     */
    protected function userUnserialize($data) { }

    /**
     * You have to call parent::__destruct() on your extended method.
     * 
     * @magic
     * @access public
     */
    public function __destruct() {
        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }
        if (is_resource($this->fp)) {
            $this->cookie = stream_get_contents($this->fp);
            fclose($this->fp);
        }
    }

    final public function serialize() {
        $this->__destruct();
        $this->init($this->cookie);
        return serialize(array(
            $this->userAgent,
            $this->cookie,
            $this->userSerialize(),
        ));
    }

    final public function unserialize($data) {
        if (
            !$data = @unserialize($data) or
            !array_key_exists(0, $data) or
            !array_key_exists(1, $data) or
            !array_key_exists(2, $data) or
            !in_array($data[0], static::getUserAgents(), true) or
            !is_string($data[1])
        ) {
            throw new UnexpectedValueException('Invalid serial');
        }
        $this->userAgent = $data[0];
        $this->init($data[1]);
        $this->userUnserialize($data[2]);
    }

    private function exec(&$info) {
        $ret = curl_exec($this->ch);
        $info = curl_getinfo($this->ch);

        logdebug("cURL StatusCode:" . $info['http_code']);
        logdebug($ret, "cURL result");

        return $ret;
    }

    private function init($data = '') {

        $this->fp = tmpfile();
        if ($data !== '') {
            fwrite($this->fp, $data);
            rewind($this->fp);
        }
        $info = stream_get_meta_data($this->fp);
        $cookie_uri = $info['uri'];
        $this->ch = curl_init();
        curl_setopt_array($this->ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FAILONERROR => TRUE,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSLVERSION => 6,
            CURLOPT_SSL_CIPHER_LIST =>  'rsa_aes_128_sha',
        ));
    }
    
}
