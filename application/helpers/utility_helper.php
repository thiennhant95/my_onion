<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 表示用フィルタ
 *
 * @param    string     表示文字列
 * @param    string     表示種別
 * @return   string     表示内容
 */
if ( ! function_exists('pr')) {
    function pr($str = NULL, $type = NULL, $params = array()) {
        $CI =& get_instance(); 
        $CI->config->load('config', TRUE);
        $_config = $CI->config->item('config');
        $CI->config->load('my_config', TRUE);
        $_config2 = $CI->config->item('my_config');
        $config = array_merge($_config, $_config2);

        // なかったら空を返す
        if ($type == 'NUMBER') {
            ;
        } else if (!isset($str) || !strlen($str)) return "";
        
        if (in_array($type, array('HTML'))) {
            $str = nl2br($str);
        } else {
            $str = htmlspecialchars($str);
        }
        switch ($type) {
            case 'ID':
                $str = substr(str_repeat('0', 8) . $str, -8);
                break;
            case 'NUMBER':
                if (!strlen($str)) return 0;
                break;
            case 'date_format_std':
                $weeks = array("日", "月", "火", "水", "木", "金", "土");
                $date = explode('-', $str);
                $str = $date[0] . '年' . (integer)$date[1] . '月'. (integer)$date[2] . '日' . ' ' . $weeks[date("w", strtotime($str))]. '曜日';
                break;
            case 'datetime_format_std':
                $str = date('Y年n月j日 H時i分',strtotime($str));
                break;
            case 'date_limited':
                $str = substr($str, 0, 16);
                break;
            case 'date_only':
                $str = str_replace("-", "/", substr($str, 0, 10));
                break;
            case 'time_only':
                $str = substr($str, -8);
                break;
            case 'int2week':
                $week = array(
                    '日','月','火','水','木','金','土',
                );
                $str = $week[(integer)$str] . '曜日';
                break;
        }
        return $str;
    }
}




/**
 * ファイルアップロード時にMD5変換されたファイル名を取得する
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('get_md5_filename'))
{
    function get_md5_filename($filename = NULL) {
        // ファイル名が NULL なら FALSEを返却
        if (is_null($filename)) return FALSE;

        return md5($filename) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
    }
}


/**
 * ファイルを削除する
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('delete_file'))
{
    function delete_file($path) {
        if (file_exists($path) && !is_dir($path)) {
            unlink($path);
        }
    }
}

if ( ! function_exists('csv_format_item'))
{
    function csv_format_item($data = array()) {
        // 要素に含まれるダウぶるクォーテーションは \" に変換
        $repl = str_replace(array('"', "\n"), array('\"', '\n'), $data);

        // ダブルクォーテーションで囲み、カンマ区切りで結合
        $string = '"' . implode('","', $repl) . '"' . "\r\n";
        return mb_convert_encoding($string, "SJIS-win", "UTF-8");
    }
}

/**
 * 現在の日時を YYYY-MM-DD HH:ii:ss 形式で返却する
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('get_datetime'))
{
    function get_datetime($t = NULL) {
        if (empty($t)) {
            $time = time();
        } else {
            $time = strtotime($t);
        }
        return date("Y-m-d H:i:s", $time);
    }
}

/**
 * 現在の日を YYYY-MM-DD 形式で返却する
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('get_date'))
{
    function get_date($t = NULL) {
        return substr(get_datetime($t), 0, 10);
    }
}

/**
 * 現在のタイムスタンプを返す
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('get_time'))
{
    function get_time($t = NULL) {
        if (empty($t)) {
            $time = time();
        } else {
            $time = strtotime($t);
        }
        return $time;
    }
}

/**
 * 会員IDをUCD形式で返す
 *
 * @param    string 
 * @return    string 
 */
if ( ! function_exists('get_ucd'))
{
    function get_ucd($id = NULL) {
        $ucd = substr(str_repeat('0', 9) . $id, -9);;
        return $ucd;
    }
}

/**
 * 連想配列から値を取得する
 *
 * @param       array   連想配列変数
 * @param       string  キー
  * @return     string  値
 */
if ( ! function_exists('get_array_values'))
{
    function get_array_values($array, $key) {
        if (isset($array[ $key ])) {
            return $array[ $key ];
        } else {
            return "";
        }
    }
}


/**
 * iPhone/iPadかどうか
 *
 * @param       
 * @return      boolean TRUE:iPhone/iPad  FALSE:iPhone/iPadではない
 */
if ( ! function_exists('is_iphone'))
{
    function is_iphone($ua = '') {
        if (!strlen($ua)) {
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }

        // 判定する文字列
        $mobile = array(
            'iPad',
            'iPhone',
        );

        if (preg_match('/'. implode("|", $mobile) . '/', $ua)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * androidかどうか
 *
 * @param       
 * @return      boolean TRUE:android  FALSE:androidではない
 */
if ( ! function_exists('is_android'))
{
    function is_android($ua = '') {
        if (!strlen($ua)) {
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }

        // 判定する文字列
        $mobile = array(
            'Android',
        );

        if (preg_match('/'. implode("|", $mobile) . '/', $ua)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * IEのバージョンを返却
 *
 * @param       
 * @return      integer IEのバージョン
 */
if ( ! function_exists('getIEVersion'))
{
    function getIEVersion() {
        if (!stristr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
            $ver = 0;
        } else {
            preg_match('/MSIE\s([\d.]+)/i', $_SERVER['HTTP_USER_AGENT'], $ver);
            $ver = floor($ver[1]);
        }
        return (int) $ver;
    }
}

/**
 * メール本文の動的置換処理
 *
 * @param       string  本文
 * @param       array   予約情報
  * @return     string  値
 */
if ( ! function_exists('replace_mailbody'))
{
    function replace_mailbody($body, $params = array()) {
        $replace = array();
        foreach ($params as $key => $val) {
            $replace[ '#' . strtoupper($key) . '#' ] = $val;
        }
        return str_replace(array_keys($replace), array_values($replace), $body);
    }
}

/**
 * Google API 祝日取得
 *
 * @param    
 * @return   
 */
if ( ! function_exists('getHoliday_by_Google'))
{
    function getHoliday_by_Google($year) {
         $type = urlencode('ja.japanese#holiday@group.v.calendar.google.com');
         $google_api_key = 'AIzaSyBvW-Atw3MGv4Gs-vypXXFMtjIRxAZg_9E';

         $start  = $year . "-01-01T00:00:00Z";
         $finish = $year . "-12-31T23:59:59Z";

         $url = "https://www.googleapis.com/calendar/v3/calendars/{$type}/events?key={$google_api_key}&timeMin={$start}&timeMax={$finish}&maxResults=50&orderBy=startTime&singleEvents=true";
         $cnt = 0;
         $result = file_get_contents($url);
         $result = json_decode($result);
         $holidays = array();
         if (!empty($result->items)) {
             foreach ($result->items as $value) {
                 $title = (string) $value->summary;
                 $date = (string) $value->start->date;
                 $holidays[$date] = $title;
                 $cnt++;
             }
         }
         return $holidays;
    }
}


/**
 * 暗号化（可逆）
 *
 * @param      string  文字列
 * @return     string  暗号化文字列
 */
if ( ! function_exists('rot13encrypt'))
{
    function rot13encrypt($str) {
        return str_rot13(base64_encode($str));
    }
}

/**
 * 復号化（可逆）
 *
 * @param      string  文字列
 * @return     string  暗号化文字列
 */
if ( ! function_exists('rot13decrypt'))
{
    function rot13decrypt($str) {
        return base64_decode(str_rot13($str));
    }
}



/**
 * URLのパラメータを配列に格納する ※ parse_str だと記号が勝手に変換されるため
 *
 * @param      string   文字列
 * @return     array    返却値
 */
if ( ! function_exists('my_parse_str'))
{
    function my_parse_str($str) {
        $result = array();

        $tmp = explode("&", $str);
        foreach ($tmp as $row) {
            list($key, $value) = explode("=", $row);
            $result[ $key ] = $value;
        }
        return $result;
    }
}


if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}


if ( ! function_exists('object2array')) {
    function object2array($obj) {
        return json_decode(json_encode($obj), 1);
    }
}

if ( ! function_exists('is_valid_date')) {
    function is_valid_date($target, $start, $end) {
        // 32bit環境だとstrtotimeは2038-01-19までしか扱えないため念の為
        if (strtotime('2038-01-20') == FALSE && str_replace("-", "", substr($end, 0, 10)) >= 20380119) {
            $end = '2038-01-19';
        }
        $t = strtotime($target);
        $s = strtotime($start);
        $e = strtotime($end);

        if ($s <= $t && $t <= $e) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
