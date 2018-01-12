-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2018 at 05:35 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hanamigawa_sw_vietvang`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6c9b0ffd1641b9cf70e1a9cfffcd8589', '0.0.0.0', 'avast! Antivirus', 1515485286, ''),
('b04923a87bc13779f94247012121e53e', '0.0.0.0', 'avast! Antivirus', 1515485286, ''),
('bbed2deb87ae4abf8c02504fa88a3619', '0.0.0.0', 'avast! Antivirus', 1515500999, '');

-- --------------------------------------------------------

--
-- Table structure for table `l_student_bus_route`
--

CREATE TABLE `l_student_bus_route` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `student_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒-クラス設定リンクID',
  `bus_route_go_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'バスルートID（行き）',
  `bus_route_ret_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'バスルートID（帰り）',
  `start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '開始日',
  `end_date` date NOT NULL DEFAULT '2199-12-31' COMMENT '終了日',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_class`
--

CREATE TABLE `l_student_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_course_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒-コース設定リンクID',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `class_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'クラスID',
  `week_num` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '出席曜日',
  `start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '開始日',
  `end_date` date NOT NULL DEFAULT '2199-12-31' COMMENT '終了日',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_course`
--

CREATE TABLE `l_student_course` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `course_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'コースID',
  `start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '開始日',
  `end_date` date NOT NULL DEFAULT '2199-12-31' COMMENT '終了日',
  `join_date` date DEFAULT NULL COMMENT '無料体験実施日',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_event`
--

CREATE TABLE `l_student_event` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `course_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'コースID',
  `contents` text COMMENT '備考',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_meta`
--

CREATE TABLE `l_student_meta` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `tag` text COMMENT 'タグ',
  `value` text COMMENT '値',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_payment`
--

CREATE TABLE `l_student_payment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `item_id` int(10) UNSIGNED DEFAULT NULL COMMENT '品目ID',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_request`
--

CREATE TABLE `l_student_request` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `type` varchar(255) DEFAULT NULL COMMENT '申請タイプ',
  `contents` text COMMENT '内容',
  `message` text COMMENT '返信メッセージ',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '処理状況',
  `process_date` timestamp NULL DEFAULT NULL COMMENT '処理日',
  `comission_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '手数料フラグ',
  `comission` int(10) UNSIGNED DEFAULT NULL COMMENT '手数料',
  `melody_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'MELODY状況',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `l_student_reserve_change`
--

CREATE TABLE `l_student_reserve_change` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `schedule_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '対象スケジュールID',
  `type` text COMMENT '申請タイプ',
  `course_name` text COMMENT 'コース名',
  `class_name` text COMMENT 'クラス名',
  `grade_name` text COMMENT '級名',
  `target_date` text COMMENT '対象日',
  `dist_date` text COMMENT '振替日',
  `dist_class_name` text COMMENT '振替先クラス名',
  `contents` text COMMENT '申請内容',
  `reason` text COMMENT '理由',
  `reason_text` text COMMENT '理由その他',
  `test` text COMMENT 'テスト',
  `status` text COMMENT 'ステータス',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_bus_course`
--

CREATE TABLE `m_bus_course` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `bus_course_code` varchar(255) DEFAULT NULL COMMENT 'バスコースコード',
  `class_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'クラスID',
  `bus_course_name` varchar(255) DEFAULT NULL COMMENT 'バスコース名',
  `max` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '定員',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_bus_route`
--

CREATE TABLE `m_bus_route` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `bus_course_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'バスコースID',
  `bus_stop_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'バス停ID',
  `route_order` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '巡回順',
  `go_time` varchar(4) DEFAULT NULL COMMENT '時刻（行き）',
  `ret_time` varchar(4) DEFAULT NULL COMMENT '時刻（帰り）',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_bus_stop`
--

CREATE TABLE `m_bus_stop` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `bus_stop_code` varchar(255) DEFAULT NULL COMMENT '乗車場所コード',
  `bus_stop_name` varchar(255) DEFAULT NULL COMMENT '乗車場所名',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_class`
--

CREATE TABLE `m_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `course_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'コースID',
  `base_class_sign` varchar(1) DEFAULT NULL COMMENT 'クラス記号',
  `class_code` varchar(255) DEFAULT NULL COMMENT 'クラスコード',
  `class_name` varchar(255) DEFAULT NULL COMMENT 'クラス名',
  `grade_manage_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '級管理フラグ',
  `use_bus_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'バス利用フラグ',
  `week` varchar(255) DEFAULT NULL COMMENT '授業曜日',
  `start_time` varchar(4) DEFAULT NULL COMMENT '開始時刻',
  `end_time` varchar(4) DEFAULT NULL COMMENT '終了時刻',
  `invalid_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '有効/無効フラグ',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_config_calendar`
--

CREATE TABLE `m_config_calendar` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `contents` varchar(255) DEFAULT NULL COMMENT '振替不可条件',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_course`
--

CREATE TABLE `m_course` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `course_code` varchar(255) DEFAULT NULL COMMENT 'コースコード',
  `course_name` varchar(255) DEFAULT NULL COMMENT 'コース名',
  `short_course_name` varchar(255) DEFAULT NULL COMMENT '記号',
  `grade_manage_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '級管理フラグ',
  `cost_item_id` int(10) UNSIGNED DEFAULT NULL COMMENT '品目ID：会費',
  `rest_item_id` int(10) UNSIGNED DEFAULT NULL COMMENT '品目ID：休会費',
  `bus_item_id` int(10) UNSIGNED DEFAULT NULL COMMENT '品目ID：バス代',
  `change_flg` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '振替フラグ',
  `practice_max` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '練習回数',
  `practice_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '練習回数 週あたり/月あたり',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'コース種別',
  `invalid_flg` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '有効/無効フラグ',
  `start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '開催開始',
  `end_date` date NOT NULL DEFAULT '2199-12-31' COMMENT '開催終了',
  `regist_start_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '申込開始',
  `regist_end_date` date NOT NULL DEFAULT '2199-12-31' COMMENT '申込終了',
  `join_condition` text COMMENT '泳力アンケート/参加条件',
  `max_count` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '定員',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_distance`
--

CREATE TABLE `m_distance` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `distance_code` varchar(255) DEFAULT NULL COMMENT '距離コード',
  `distance_name` varchar(255) DEFAULT NULL COMMENT '距離名',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_grade`
--

CREATE TABLE `m_grade` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `grade_code` varchar(255) DEFAULT NULL COMMENT '級コード',
  `grade_name` varchar(255) DEFAULT NULL COMMENT '級名',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `item_code` varchar(255) DEFAULT NULL COMMENT '品目コード',
  `item_name` varchar(255) DEFAULT NULL COMMENT '品目名',
  `subject_id` int(10) UNSIGNED DEFAULT NULL COMMENT '科目ID',
  `sell_price` int(10) UNSIGNED DEFAULT '0' COMMENT '売単価',
  `buy_price` int(10) UNSIGNED DEFAULT '0' COMMENT '仕入れ単価',
  `tax_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '税計算',
  `manage_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '在庫管理',
  `left_num` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '在庫数',
  `type` varchar(255) DEFAULT NULL COMMENT '分類',
  `disp_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '画面表示',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_request_message`
--

CREATE TABLE `m_request_message` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `type` text COMMENT 'メッセージ種別',
  `body` text COMMENT '表示文言',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_student`
--

CREATE TABLE `m_student` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `email` varchar(255) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(255) DEFAULT NULL COMMENT 'パスワード',
  `tel_normalize` varchar(255) DEFAULT NULL COMMENT '正規化電話番号',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会員状態',
  `rest_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '休会フラグ',
  `lock_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会員ロックフラグ',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_student`
--

INSERT INTO `m_student` (`id`, `email`, `password`, `tel_normalize`, `status`, `rest_flg`, `lock_flg`, `orderby`, `create_id`, `create_date`, `update_id`, `update_date`, `delete_date`, `delete_flg`) VALUES
(1, 'eps@gmail.com', '$2y$10$YXNkZnF3ZXp4Y3ZydHl1ZecLU97AHdByqAcqmim/ZWn4ZQW2XaMTq', '01663247266', 0, 0, 0, 0, NULL, '0000-00-00 00:00:00', NULL, '2018-01-04 07:30:51', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_subject`
--

CREATE TABLE `m_subject` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `subject_code` varchar(255) DEFAULT NULL COMMENT '科目コード',
  `subject_name` varchar(255) DEFAULT NULL COMMENT '科目名',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m_sw_style`
--

CREATE TABLE `m_sw_style` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `style_code` varchar(255) DEFAULT NULL COMMENT '種目コード',
  `style_name` varchar(255) DEFAULT NULL COMMENT '種目名',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_bus`
--

CREATE TABLE `schedule_bus` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `target_date` date DEFAULT NULL COMMENT '日付',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `student_bus_route_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒バスルート設定リンクID',
  `ride_time` datetime DEFAULT NULL COMMENT '乗車時刻',
  `check_time` datetime DEFAULT NULL COMMENT '乗車チェック時刻',
  `extend_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '予定外フラグ',
  `bus_route_go_id` int(10) UNSIGNED DEFAULT NULL COMMENT '予定外時 バスルートID（行き）',
  `bus_route_ret_id` int(10) UNSIGNED DEFAULT NULL COMMENT '予定外時 バスルートID（帰り）',
  `schedule_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒予約スケジュールID',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_class`
--

CREATE TABLE `schedule_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `target_date` date DEFAULT NULL COMMENT '日付',
  `student_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒ID',
  `student_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '生徒クラスID',
  `presence_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '出席フラグ',
  `presence_datetime` datetime DEFAULT NULL COMMENT '出席日時',
  `transfer_schedule_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '振替先ID',
  `source_schedule_class_id` int(10) UNSIGNED DEFAULT NULL COMMENT '振替元ID',
  `transfer_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '振替フラグ',
  `transfer_cancel_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '振替キャンセルフラグ',
  `absence_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '欠席フラグ',
  `test_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'テストフラグ',
  `schedule_bus_id` int(10) UNSIGNED DEFAULT NULL COMMENT '予定外バスID',
  `reason` text COMMENT '申請理由',
  `reason_text` text COMMENT '申請理由その他',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_system`
--

CREATE TABLE `schedule_system` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `target_date` date DEFAULT NULL COMMENT '日付',
  `closed_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '休館日フラフ',
  `test_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'テスト日フラグ',
  `notransfer_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '振替不可日フラグ',
  `construction_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '設備工事フラグ',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `_base_`
--

CREATE TABLE `_base_` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `orderby` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '表示順',
  `create_id` int(10) UNSIGNED DEFAULT NULL COMMENT '登録者',
  `create_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登録日',
  `update_id` int(10) UNSIGNED DEFAULT NULL COMMENT '更新者',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新日',
  `delete_date` datetime DEFAULT NULL COMMENT '削除日',
  `delete_flg` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `l_student_bus_route`
--
ALTER TABLE `l_student_bus_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_class`
--
ALTER TABLE `l_student_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_course`
--
ALTER TABLE `l_student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_event`
--
ALTER TABLE `l_student_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_meta`
--
ALTER TABLE `l_student_meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique1` (`student_id`,`tag`(10));

--
-- Indexes for table `l_student_payment`
--
ALTER TABLE `l_student_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_request`
--
ALTER TABLE `l_student_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_student_reserve_change`
--
ALTER TABLE `l_student_reserve_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bus_course`
--
ALTER TABLE `m_bus_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bus_route`
--
ALTER TABLE `m_bus_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bus_stop`
--
ALTER TABLE `m_bus_stop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_class`
--
ALTER TABLE `m_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_config_calendar`
--
ALTER TABLE `m_config_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_course`
--
ALTER TABLE `m_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_distance`
--
ALTER TABLE `m_distance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_grade`
--
ALTER TABLE `m_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_request_message`
--
ALTER TABLE `m_request_message`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`(20));

--
-- Indexes for table `m_student`
--
ALTER TABLE `m_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_subject`
--
ALTER TABLE `m_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_sw_style`
--
ALTER TABLE `m_sw_style`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_bus`
--
ALTER TABLE `schedule_bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_class`
--
ALTER TABLE `schedule_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_system`
--
ALTER TABLE `schedule_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_base_`
--
ALTER TABLE `_base_`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l_student_bus_route`
--
ALTER TABLE `l_student_bus_route`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_class`
--
ALTER TABLE `l_student_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_course`
--
ALTER TABLE `l_student_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_event`
--
ALTER TABLE `l_student_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_meta`
--
ALTER TABLE `l_student_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_payment`
--
ALTER TABLE `l_student_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_request`
--
ALTER TABLE `l_student_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `l_student_reserve_change`
--
ALTER TABLE `l_student_reserve_change`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_bus_course`
--
ALTER TABLE `m_bus_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_bus_route`
--
ALTER TABLE `m_bus_route`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_bus_stop`
--
ALTER TABLE `m_bus_stop`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_class`
--
ALTER TABLE `m_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_config_calendar`
--
ALTER TABLE `m_config_calendar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_course`
--
ALTER TABLE `m_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_distance`
--
ALTER TABLE `m_distance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_grade`
--
ALTER TABLE `m_grade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_item`
--
ALTER TABLE `m_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_request_message`
--
ALTER TABLE `m_request_message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_student`
--
ALTER TABLE `m_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_subject`
--
ALTER TABLE `m_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `m_sw_style`
--
ALTER TABLE `m_sw_style`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `schedule_bus`
--
ALTER TABLE `schedule_bus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `schedule_class`
--
ALTER TABLE `schedule_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `schedule_system`
--
ALTER TABLE `schedule_system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
--
-- AUTO_INCREMENT for table `_base_`
--
ALTER TABLE `_base_`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
