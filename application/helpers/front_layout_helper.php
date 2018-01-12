<?php

function front_layout_view($body, $data = array()) {

    // モバイル判定する文字列
    $mobile = array(
        'iPad',
        'iPhone',
        'Android',
    );
    
    // デバイス判定
    $device = 'pc';
//    if (preg_match('/'. implode("|", $mobile) . '/', $_SERVER['HTTP_USER_AGENT'])) {
//        $device = 'sp';
//    };

    // 多言語処理
    $lang = 'ja';

    $directory = sprintf("front/%s/%s",
                        $device,
                        $lang
                 );
    $data['js_view']=$body;
	$CI = get_instance();

	$layout_data['header_meta'] = $CI->load->view( $directory . '/layout/header_meta', $data, TRUE);
	$layout_data['header_ogp'] = $CI->load->view( $directory . '/layout/header_ogp', $data, TRUE);
	$layout_data['content_header'] = $CI->load->view( $directory . '/layout/header_view', $data, true);
	$layout_data['content_body']   = $CI->load->view( $directory . '/' .  $body, $data, true);
	$layout_data['content_footer'] = $CI->load->view( $directory . '/layout/footer_view', $data, true);
	if (isset($data['sidebar'])) {
    	$layout_data['content_sidebar']   = $CI->load->view( $directory . '/' .  $data['sidebar'], $data, TRUE);
    } else {
        $layout_data['content_sidebar'] = '';
    }

	$CI->load->view( $directory . '/layout/layout_view', $layout_data);
}
