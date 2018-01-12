<?php
$config = array(
		'registration' => array(
				array(
						'field' => 'passwd',
						'label' => 'パスワード',
						'rules' => 'required|matches[passwd_conf]'
				),
				array(
						'field' => 'passwd_conf',
						'label' => 'パスワード(確認)',
						'rules' => 'required'
				),
				array(
						'field' => 'last_name',
						'label' => '保護者 姓',
						'rules' => 'required'
				),
				array(
						'field' => 'first_name',
						'label' => '保護者 名',
						'rules' => 'required'
				),
				array(
						'field' => 'last_kana',
						'label' => '保護者 姓（カナ）',
						'rules' => 'required'
				),
				array(
						'field' => 'first_kana',
						'label' => '保護者 名（カナ)',
						'rules' => 'required'
				),
				array(
						'field' => 'emergency_tel',
						'label' => '緊急電話番号',
						'rules' => 'required'
				),
				array(
						'field' => 'zip',
						'label' => '郵便番号',
						'rules' => 'required'
				),
				array(
						'field' => 'address',
						'label' => '住所',
						'rules' => 'required'
				),
				array(
						'field' => 'email',
						'label' => 'メールアドレス',
						'rules' => 'required'
				),
		),
		'enter_search' => array(
				array(
						'field' => 'date',
						'label' => '日付',
						'rules' => 'required|regex_match[/^(19|20)[0-9]{2}-[0-9]{1,2}-[0-9]{1,2}$/]'
				),
		),
		'enter_update' => array(
				array(
						'field' => 'enter',
						'label' => '時間',
						'rules' => 'required|regex_match[/^([0-1][0-9]|[2][0-3]):[0-5][0-9]$/]'
				),
				array(
						'field' => 'exit',
						'label' => '時間',
						'rules' => 'required|regex_match[/^([0-1][0-9]|[2][0-3]):[0-5][0-9]$/]'
				),
		),
);