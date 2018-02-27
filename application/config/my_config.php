<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['dummy'] = 'dummy';
//====================================================
//
// 環境に依らない共通設定
//
//====================================================


/************* システム関連 *****************/
//--------------------------------
// データ
//--------------------------------
define('DATA_UNSET',   0);  // 未設定状態
define('DATA_ON',      1);  // データON
define('DATA_OFF',     0);  // データOFF

//--------------------------------
// 削除フラグ
//--------------------------------
define('DATA_NOT_DELETED',  0);  // 削除されていないレコード
define('DATA_DELETED',      1);  // 削除されたレコード

//--------------------------------
// 有効/無効フラグ
//--------------------------------
define('DATA_INVALID_NO',       0);  // 有効レコード
define('DATA_INVALID_YES',      1);  // 無効レコード
$config['family_relationships'] = array(
    DATA_INVALID_NO         => '有効',
    DATA_INVALID_YES        => '無効',
);

//--------------------------------
// 学年一覧
//--------------------------------
define('VALUE_GRADE_KINDERGARTEN_LOW',      1); // 幼稚園年少
define('VALUE_GRADE_KINDERGARTEN_MIDDLE',   2); // 幼稚園年中
define('VALUE_GRADE_KINDERGARTEN_HIGH',     3); // 幼稚園年長
define('VALUE_GRADE_ELEMENTARY_SCHOOL_1',   4); // 小学1年
define('VALUE_GRADE_ELEMENTARY_SCHOOL_2',   5); // 小学2年
define('VALUE_GRADE_ELEMENTARY_SCHOOL_3',   6); // 小学3年
define('VALUE_GRADE_ELEMENTARY_SCHOOL_4',   7); // 小学4年
define('VALUE_GRADE_ELEMENTARY_SCHOOL_5',   8); // 小学5年
define('VALUE_GRADE_ELEMENTARY_SCHOOL_6',   9); // 小学6年
define('VALUE_GRADE_JUNIOR_HIGH_SCHOOL_1', 10); // 中学1年
define('VALUE_GRADE_JUNIOR_HIGH_SCHOOL_2', 11); // 中学2年
define('VALUE_GRADE_JUNIOR_HIGH_SCHOOL_3', 13); // 中学3年
define('VALUE_GRADE_HIGH_SCHOOL_1',        14); // 高校1年
define('VALUE_GRADE_HIGH_SCHOOL_2',        15); // 高校2年
define('VALUE_GRADE_HIGH_SCHOOL_3',        16); // 高校3年
define('VALUE_GRADE_COLLEGE_1',            17); // 大学1年
define('VALUE_GRADE_COLLEGE_2',            18); // 大学2年
define('VALUE_GRADE_COLLEGE_3',            19); // 大学3年
define('VALUE_GRADE_COLLEGE_4',            20); // 大学4年
define('VALUE_GRADE_OTHER',                99); // その他
$config['school_grades'] = array(
    VALUE_GRADE_KINDERGARTEN_LOW      => '年少',
    VALUE_GRADE_KINDERGARTEN_MIDDLE   => '年中',
    VALUE_GRADE_KINDERGARTEN_HIGH     => '年長',
    VALUE_GRADE_ELEMENTARY_SCHOOL_1   => '小１',
    VALUE_GRADE_ELEMENTARY_SCHOOL_2   => '小２',
    VALUE_GRADE_ELEMENTARY_SCHOOL_3   => '小３',
    VALUE_GRADE_ELEMENTARY_SCHOOL_4   => '小４',
    VALUE_GRADE_ELEMENTARY_SCHOOL_5   => '小５',
    VALUE_GRADE_ELEMENTARY_SCHOOL_6   => '小６',
    VALUE_GRADE_JUNIOR_HIGH_SCHOOL_1  => '中１',
    VALUE_GRADE_JUNIOR_HIGH_SCHOOL_2  => '中２',
    VALUE_GRADE_JUNIOR_HIGH_SCHOOL_3  => '中３',
    VALUE_GRADE_HIGH_SCHOOL_1         => '高１',
    VALUE_GRADE_HIGH_SCHOOL_2         => '高２',
    VALUE_GRADE_HIGH_SCHOOL_3         => '高３',
    VALUE_GRADE_COLLEGE_1             => '大１',
    VALUE_GRADE_COLLEGE_2             => '大２',
    VALUE_GRADE_COLLEGE_3             => '大３',
    VALUE_GRADE_COLLEGE_4             => '大４',
    VALUE_GRADE_OTHER                 => 'その他',
);

//--------------------------------
// 続柄
//--------------------------------
define('VALUE_RELATIONSHIP_FATHER',     1); // 父
define('VALUE_RELATIONSHIP_MOTHER',     2); // 母
define('VALUE_RELATIONSHIP_MARRIAGE',   3); // 夫・妻
define('VALUE_RELATIONSHIP_BROTHER',    4); // 兄弟、姉妹
define('VALUE_RELATIONSHIP_CHILD',      5); // 子
define('VALUE_RELATIONSHIP_GRANDPARENT',7); // 祖父母
define('VALUE_RELATIONSHIP_OTHER',     99); // その他
$config['family_relationships'] = array(
    VALUE_RELATIONSHIP_FATHER       => '父',
    VALUE_RELATIONSHIP_MOTHER       => '母',
    VALUE_RELATIONSHIP_MARRIAGE     => '夫・妻',
    VALUE_RELATIONSHIP_BROTHER      => '兄弟・姉妹',
    VALUE_RELATIONSHIP_CHILD        => '子',
    VALUE_RELATIONSHIP_GRANDPARENT  => '祖父母',
    VALUE_RELATIONSHIP_OTHER        => 'その他',
);

//--------------------------------
// 理由
//--------------------------------
define('VALUE_REASON_SICK',         1); // 病気
define('VALUE_REASON_INJURY',       2); // 怪我
define('VALUE_REASON_MATTER',       3); // 用事
define('VALUE_REASON_OTHER',       99); // その他
$config['rest_reasons'] = array(
    VALUE_REASON_SICK       => '病気',
    VALUE_REASON_INJURY     => '怪我',
    VALUE_REASON_MATTER     => '用事',
    VALUE_REASON_OTHER      => 'その他',
);

//--------------------------------
// テストフォーム
//--------------------------------
define('VALUE_TEST_EXAM',       1); // テストを受ける
define('VALUE_TEST_NOT_EXAM',   2); // テストを受けない
$config['select_exam'] = array(
    VALUE_TEST_EXAM       => '受ける',
    VALUE_TEST_NOT_EXAM   => '受けない',
);

//--------------------------------
// 送迎バスフォーム
//--------------------------------
define('VALUE_BUS_RIDE_TRANSFER_BUS',       1); // 振替先のバスに乗る
define('VALUE_BUS_CONTACT_RIDE_OR_NOT',   2); // 振替先のバスに乗らない
$config['select_transfer_bus'] = array(
    VALUE_BUS_RIDE_TRANSFER_BUS     => '振替先のバスに乗る',
    VALUE_BUS_CONTACT_RIDE_OR_NOT   => '乗る/乗らないを連絡する',
);

//--------------------------------
// スケジュール属性
//--------------------------------
define('VALUE_SCHEDULE_PROP_CLOSED',                1); // 休館日
define('VALUE_SCHEDULE_PROP_CONSTRUCTION',          2); // 設備工事日
define('VALUE_SCHEDULE_PROP_TEST',                  3); // テスト日
define('VALUE_SCHEDULE_PROP_ABSENCED_NO_EXPRESS',   4); // 無連絡欠席
define('VALUE_SCHEDULE_PROP_PRESENCE',              5); // 出席
define('VALUE_SCHEDULE_PROP_ABSENCE',               6); // 欠席
define('VALUE_SCHEDULE_PROP_FUTURE_PRESENCE',       7); // 出席予定
define('VALUE_SCHEDULE_PROP_FUTURE_ABSENCE',        8); // 欠席予定
define('VALUE_SCHEDULE_PROP_FUTURE_TRANSFER',       9); // 振替予定
define('VALUE_SCHEDULE_PROP_FUTURE_TRANSFER_CANCEL',10); // 振替キャンセル
define('VALUE_SCHEDULE_PROP_TRANSFER_POSSIBLE',     11); // 振替可能日
$config['schedule_prop'] = array(
    VALUE_SCHEDULE_PROP_CLOSED                  => '休館日',
    VALUE_SCHEDULE_PROP_CONSTRUCTION            => '設備工事日',
    VALUE_SCHEDULE_PROP_TEST                    => 'テスト日',
    VALUE_SCHEDULE_PROP_ABSENCED_NO_EXPRESS     => '無連絡欠席',
    VALUE_SCHEDULE_PROP_PRESENCE                => '出席',
    VALUE_SCHEDULE_PROP_ABSENCE                 => '欠席',
    VALUE_SCHEDULE_PROP_FUTURE_PRESENCE         => '出席予定',
    VALUE_SCHEDULE_PROP_FUTURE_ABSENCE          => '欠席予定',
    VALUE_SCHEDULE_PROP_FUTURE_TRANSFER         => '振替予定',
    VALUE_SCHEDULE_PROP_FUTURE_TRANSFER_CANCEL  => '振替キャンセル',
    VALUE_SCHEDULE_PROP_TRANSFER_POSSIBLE       => '振替可能日',
);


/************* 生徒関連 *****************/
//--------------------------------
// 生徒メタタグ一覧
//--------------------------------
$config['student_meta'] = array(
    'name'              => '氏名',
    'name_kana'         => '氏名フリガナ',
    'birthday'          => '生年月日',
    'sex'               => '性別',
    'zip'               => '郵便番号',
    'address'           => '住所',
    'tel'               => '電話番号',
    'iccard'            => 'ICカード番号',
    'email_flg'         => 'メールアドレス無しフラグ',
    'course_type'       => '申し込み時区分',
    'emergency_tel'     => '緊急連絡先',
    'parent_name'       => '保護者氏名',
    'school_name'       => '学校名',
    'school_grade'      => '学年',
    'family'            => '家族名',
    'relationship'      => '続柄',
    'bus_use_flg'       => 'バスの利用フラグ',
    'life_check_flg'    => 'ライフチェックフラグ',
    'life_check_date'   => 'ライフチェック日時',
    'enquete'           => '泳力アンケート/参加条件',
    'memo_to_coach'     => 'コーチへの伝達事項',
    'memo_health'       => '健康管理連絡事項',
    'memo_special'      => 'メモ・特記事項',
    'first_lesson_date' => '初回レッスン日',
    'first_lesson_date_initial' => '初回レッスン日（申込時）',
    'quit_date'         => '退会日',
    'quit_reason'       => '退会理由',
    'quit_memo'         => '退会その他',
    'rest_start_date'   => '休会開始日',
    'rest_end_date'     => '休会終了日',
    'token'             => 'メール認証トークン',
);


//--------------------------------
// 会員ステータス
//--------------------------------
define('VALUE_STUDENT_STATUS_WATING',      0); // 申込中（未処理）
define('VALUE_STUDENT_STATUS_MEMBER',      1); // 入会中
define('VALUE_STUDENT_STATUS_QUIT_WAIT',   2); // 退会保留中
define('VALUE_STUDENT_STATUS_QUIT',        3); // 退会済み
$config['student_status'] = array(
    VALUE_STUDENT_STATUS_WATING     => '申込中(未処理)',
    VALUE_STUDENT_STATUS_MEMBER     => '入会中',
    VALUE_STUDENT_STATUS_QUIT_WAIT  => '退会保留中',
    VALUE_STUDENT_STATUS_QUIT       => '退会済',
);

//--------------------------------
// 休会ステータス
//--------------------------------
define('VALUE_STUDENT_REST_NO',         0); // 休会中ではない
define('VALUE_STUDENT_REST_WATING',     1); // 休会保留中
define('VALUE_STUDENT_REST_DONE',       2); // 休会中
$config['student_rest_status'] = array(
    VALUE_STUDENT_REST_NO       => '---',
    VALUE_STUDENT_REST_WATING   => '休会保留中',
    VALUE_STUDENT_REST_DONE     => '休会中',
);

//--------------------------------
// 会員ロック状態
//--------------------------------
define('VALUE_STUDENT_LOCK_OFF',        0); // ロック中でない
define('VALUE_STUDENT_LOCK_ON',         1); // ロック中
$config['student_lock_status'] = array(
    VALUE_STUDENT_LOCK_OFF      => '---',
    VALUE_STUDENT_LOCK_ON       => 'ロック中',
);

//--------------------------------
// 振替フラグ
//--------------------------------
define('VALUE_TRANSFER_DEFAULT',        0); // バッチスケジュールで作成
define('VALUE_TRANSFER_OPERATION',      1); // 振替操作で作成
$config['student_transfer_status'] = array(
    VALUE_TRANSFER_DEFAULT      => 'バッチ生成',
    VALUE_TRANSFER_OPERATION    => '振替操作生成',
);

//--------------------------------
// 出席フラグ
//--------------------------------
define('VALUE_PRESENCE_NONE',           0); // 出席予定（未出席）
define('VALUE_PRESENCE_DONE',           1); // 出席済み
define('VALUE_PRESENCE_TRANSFER',       9); // 振替
$config['student_presence_status'] = array(
    VALUE_PRESENCE_NONE         => '出席予定/未出席',
    VALUE_PRESENCE_DONE         => '出席済み',
    VALUE_PRESENCE_TRANSFER     => '振替',
);





/************* コース・クラス・バス関連 *****************/
//--------------------------------
// コースタイプ
//--------------------------------
define('VALUE_COURSE_TYPE_NORMAL',      0); // 通常コース
define('VALUE_COURSE_TYPE_LIMITED',     1); // 期間限定（短期）
define('VALUE_COURSE_TYPE_FREE',        2); // 無料体験
$config['course_type'] = array(
    VALUE_COURSE_TYPE_NORMAL        => '通常コース',
    VALUE_COURSE_TYPE_LIMITED       => '期間限定(短期)コース',
    VALUE_COURSE_TYPE_FREE          => '無料体験コース',
);

/* Define Constant */
define('REGISTER_TOKEN_LENGTH', 32); // register token length
define('RANDOM_STRING_LENGTH', 16); // random string length


// 授業曜日
define('SUNDAY',        0);
define('MONDAY',        1);
define('TUESDAY',       2);
define('WEDNESDAY',     3);
define('THURSDAY',      4);
define('FRIDAY',        5);
define('SATURDAY',      6);

//回数
define('ZERO',       0);
define('ONE',        1);
define('TWO',        2);
define('THREE',      3);
define('FOUR',       4);
define('FIVE',       5);
define('SIX',        6);
define('SEVEN',      7);
define('EIGHT',      8);

//month
define('JANUARY',           1);
define('FEBRUARY',          2);
define('MARCH',             3);
define('APRIL',             4);
define('MAY',               5);
define('JUNE',              6);
define('JULY',              7);
define('AUGUST',            8);
define('SEPTEMBER',         9);
define('OCTOBER',           10);
define('NOVEMBER',          11);
define('DECEMBER',          12);
$config['month']=array(
    JANUARY   =>'1',
    FEBRUARY  =>'2',
    MARCH     =>'3',
    APRIL     =>'4',
    MAY       =>'5',
    JUNE      =>'6',
    JULY      =>'7',
    AUGUST    =>'8',
    SEPTEMBER =>'9',
    OCTOBER   =>'10',
    NOVEMBER  =>'11',
    DECEMBER  =>'12'
);

//day
define('DAY1'      ,1);
define('DAY2'      ,2);
define('DAY3'      ,3);
define('DAY4'      ,4);
define('DAY5'      ,5);
define('DAY6'      ,6);
define('DAY7'      ,7);
define('DAY8'      ,8);
define('DAY9'      ,9);
define('DAY10'     ,10);
define('DAY11'     ,11);
define('DAY12'     ,12);
define('DAY13'     ,13);
define('DAY14'     ,14);
define('DAY15'     ,15);
define('DAY16'     ,16);
define('DAY17'     ,17);
define('DAY18'     ,18);
define('DAY19'     ,19);
define('DAY20'     ,20);
define('DAY21'     ,21);
define('DAY22'     ,22);
define('DAY23'     ,23);
define('DAY24'     ,24);
define('DAY25'     ,25);
define('DAY26'     ,26);
define('DAY27'     ,27);
define('DAY28'     ,28);
define('DAY29'     ,29);
define('DAY30'     ,30);
define('DAY31'     ,31);
$config['day']=array(
    DAY1      =>'1',
    DAY2      =>'2',
    DAY3      =>'3',
    DAY4      =>'4',
    DAY5      =>'5',
    DAY6      =>'6',
    DAY7      =>'7',
    DAY8      =>'8',
    DAY9      =>'9',
    DAY10     =>'10',
    DAY11     =>'11',
    DAY12     =>'12',
    DAY13     =>'13',
    DAY14     =>'14',
    DAY15     =>'15',
    DAY16     =>'16',
    DAY17     =>'17',
    DAY18     =>'18',
    DAY19     =>'19',
    DAY20     =>'20',
    DAY21     =>'21',
    DAY22     =>'22',
    DAY23     =>'23',
    DAY24     =>'24',
    DAY25     =>'25',
    DAY26     =>'26',
    DAY27     =>'27',
    DAY28     =>'28',
    DAY29     =>'29',
    DAY30     =>'30',
    DAY31     =>'31',
);

define('VALUE_NUMBER_RESULT', 1);
define('LENGTH_PASS_RAMDOM', 8);
define('HAVE_RESULT', 1);
define('NONE_RESULT', 0);
define('ONLY_ONE_RELSULT', 1);
define('OK', 1);
define('NOT_OK', 0);

//define day of week
define('NUMBER_DAY_OF_WEEK', 7);
define('NUMBER_DATE_OF_MONTH', 31);
define('EVERY_MONDAY', '毎週月曜日'); // mon 
define('EVERY_TUESDAY', '毎週火曜日');
define('EVERY_WENDAY', '毎週水曜日');
define('EVERY_THUSDAY', '毎週木曜日');
define('EVERY_FRIDAY', '毎週金曜日');
define('EVERY_SATUDAY', '毎週土曜日');
define('EVERY_SUNDAY', '毎週日曜日');// sun

define('IS_CLOSED', 1);
define('UN_CLOSED', 0);

define('IS_TEST', 1);
define('UN_TEST', 0);

define('DATE_CLOSED','休館');
define('DATE_TEST', 'テスト');

define('ID_FROM_AND_TO_NULL', 0);
define('ID_FROM_AND_TO_NOT_NULL', 1);
define('ID_FROM_NOT_NULL_AND_TO_NULL', 2);
define('ID_FROM_NULL_AND_TO_NOT_NULL', 3);

$config['week_num'] = array(
    SUNDAY        => '日',
    MONDAY        => '月',
    TUESDAY        => '火',
    WEDNESDAY        => '水',
    THURSDAY        => '木',
    FRIDAY        => '金',
    SATURDAY        => '土',

);
//type of request
define('BUS_CHANGE_ONCE','bus_change_once');
define('BUS_CHANGE_ETERNAL','bus_change_eternal');
define('COURSE_CHANGE','course_change');
define('RECESS','recess');
define('QUIT','quit');
define('EVENT_TRY','event_entry');
define('ADDRESS_CHANGE','address_change');

define("END_DATE_DEFAULT", '2199-12-31');
define("START_DATE_DEFAULT",'1970-01-01');

// type student reserve change
define('ABSENCE','欠席');
define('TRANSFER','振替');
define('ABSENCE_TRANSFER','欠席＆振替');
define('ABSENCE_CANCELED','欠席キャンセル');
define('TRANSFER_CANCELLATION','振替キャンセル');
define('ABSENCE_TRANSFER_CANCELLATION','欠席＆振替');

//type search student request
define('PRACTICE_COURSE','練習コース');
define('BUS_COURSE','バスコース');
define('NOTICE_OF_ABSENCE','休会届');
define('NOTICE_OF_WITHDRAWAL','退会届');
define('CHANGE_BASIC_INFORMATION','基本情報変更');
define('EVENT_ENTRY','イベント・短期教');

//config limit csv
define('LIMIT_CSV',1000);

//start time and time class
define('START_TIME_M',1100);
define('START_TIME_A',1330);
define('START_TIME_B',1440);
define('START_TIME_C',1555);
define('START_TIME_D',1705);
define('START_TIME_E',1805);
define('START_TIME_F',1920);
define('END_TIME_M',1330);
define('END_TIME_A',1440);
define('END_TIME_B',1555);
define('END_TIME_C',1705);
define('END_TIME_D',1805);
define('END_TIME_E',1920);
define('END_TIME_F',2100);
