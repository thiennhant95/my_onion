<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists( 'logerr' ) ) {
    function logerr($data, $add_str='') {
        logd($data , $add_str, 'error');
    }
}

if ( ! function_exists( 'logdebug' ) ) {
    function logdebug($data, $add_str='') {
        logd($data , $add_str, 'debug');
    }
}

if ( ! function_exists( 'loginfo' ) ) {
    function loginfo($data, $add_str='') {
        logd($data , $add_str, 'info');
    }
}

if ( ! function_exists( 'logbatch' ) ) {
    function logbatch($data, $add_str='') {
        logd($data , $add_str, 'batch');
    }
}

if ( ! function_exists( 'logd' ) ) {
    // log_messageのラッパー
    // log_messageが長い上に引数の順序が非常に気に入らないので
    // 短縮形のラッパを作った（デフォルトログレベルはdebug）
    // ついでに引数に配列、オブジェクトを渡せるようにした。
    // ついでに呼出元ファイル名、行番号、メソッド名を追記を可能にした
    function logd($data , $add_str='', $level='debug' , $show_filename=true) {

        //配列、オブジェクトは自動展開する
        if (is_array($data) || is_object($data)) {
            $space = "\n";
            $message = print_r($data,true) . $space . $add_str ;
        } else {
            $space = ' ';
            $message = $data . $space . $add_str ;
        }

        if ($show_filename) {
            $dbg = debug_backtrace();

            // 呼出元ファイル名、行番号、メソッド名を追記
            $fname = ( isset($dbg[1]['file'] ) ) ? 'FILE:' . basename($dbg[1]['file']) : '';
            $line = ( isset($dbg[1]['line'] ) ) ? ' , LINE:' . $dbg[1]['line'] : '';
            $func = ( isset($dbg[2]['function'] ) ) ? ' , FUNC:' . $dbg[2]['function'] : '';
            $message = '[' . $fname . $line . $func . ']' . $space . $message ;
        }
        debug_log($level, $message, 'application-'.$level);
    }
}

if (!function_exists('debug_log'))
{
    function debug_log($level, $message, $prefix = 'debug', $php_error = FALSE)
    {
        $_log =& load_class('Log');
        $_log->write_log($level, $message, $php_error, $prefix, FALSE);
    }
}

if ( ! function_exists( 'my_trace' ) ) {
    function my_trace() {
        $dbg = debug_backtrace();

        // 呼出元ファイル名、行番号、メソッド名を追記
        $fname = ( isset($dbg[0]['file'] ) ) ? 'FILE:' . basename($dbg[0]['file']) : '';
        $line = ( isset($dbg[0]['line'] ) ) ? ' , LINE:' . $dbg[0]['line'] : '';
        $func = ( isset($dbg[1]['function'] ) ) ? ' , FUNC:' . $dbg[1]['function'] : '';
        return '[' . get_datetime() . '][' . $fname . $line . $func . ']';
    }
}