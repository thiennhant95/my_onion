<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends ADMIN_Controller {

    public  function __construct() {
        parent::__construct();
        $this->load->helper('file');
        $this->load->model('student_model', 'student_data');
        $this->load->model('db/m_course_model', 'm_course_model');
        $this->load->model('db/m_student_model','m_student_model');
        $this->load->model('db/m_class_model','m_class_model');
        $this->load->model('db/m_bus_course_model','m_bus_course_model');
        $this->load->model('db/m_bus_route_model','m_bus_route_model');
        $this->load->model('db/m_bus_stop_model','m_bus_stop_model');
	$this->load->model('db/m_item_model','m_item_model');
        $this->load->model('db/l_student_meta_model', 'l_student_meta_model');
        $this->load->model('db/l_student_course_model', 'l_student_course_model');
        $this->load->model('db/l_student_class_model', 'l_student_class');
        $this->load->model('db/l_student_bus_route_model', 'l_student_bus_route_model');
        $this->load->model('sendmail_model','send_mail');
        $this->load->library('pagination');
        
    }
    
    public function index() {
        if ($this->error_flg) return;
        try {            
            $condition = array('status' => 0, 'delete_flg' => 0);
            $total_list_user_inactive =  $this->student_data->get_total_user_inactive($condition);
            $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

            $pagination = $this->paginationConfig;
            $pagination['base_url'] = '/admin/entry/index';
            $pagination['total_rows'] = $total_list_user_inactive;
            $this->pagination->initialize($pagination);

            $params['result'] = $this->get_limit_data_users($pagination['per_page'], $page);
            $params["links"] = $this->pagination->create_links();
            $this->viewVar =  $params;
            admin_layout_view('entry_index', $this->viewVar);
            // // 検索フォーム保持用セッション
            // $search_session = array();
            // // 検索フォーム用セッション設定
            // $this->_initialize_session($search_session);
            // // 表示
            // $this->view(0);

        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 新規ネット申込一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('entry_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

   /**
     * お申込書
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $admin_account = ( $this->session->userdata( 'admin_account' ) ) ? ( $this->session->userdata( 'admin_account' ) ) : '';
            $check_student = $this->m_student_model->select_by_id( $id, 'id', 'm_student' );
            if ( $admin_account == '' ) {
                redirect('/admin/auth');
            } else if ( count( $check_student ) == 0 ) {
                redirect('/admin/entry');
            } else {
                $s_info = $this->student_data->get_student_data_detail( $id );
                if ( $s_info['info']['status'] == 1 ) redirect('/admin/entry');
                $course_valid = $this->m_course_model->getData_Course_valid( $id );
                $all_distance = $this->m_distance_model->select_all( 'm_distance' );
                $all_items = $this->m_course_model->select_all( 'm_item' );
                $distance = array();
                foreach ( $all_distance as $k => $v ) {
                    if ( $v['delete_flg'] == 0 ) $distance[] = $v['distance_name'];
                }
                $data = array();
                $data['all_items'] = $all_items;
                $data['distance'] = $distance;
                $data['course_valid'] = $course_valid;
                $data['html'] = $this->create_html( $s_info['course']['valid'][0]['course_id'] );
                $data['school_grades'] = $this->configVar['school_grades'];
                $data['s_info'] = $s_info;
                if ( isset( $_POST['change_course'] ) && isset( $_POST['course_id'] ) ) {
                    $html['html'] = $this->create_html( $_POST['course_id'] );
                    $course_change = $this->student_data->select_by_id( $_POST['course_id'], 'id', 'm_course' );
                    $html['practice_max'] = $course_change[0]['practice_max'];
                    die( json_encode( $html ) );
                }
                if ( isset( $_POST['data_class'] ) && isset( $_POST['class_id'] ) && isset( $_POST['course_id'] ) && isset( $_POST['bus_use_flg'] ) ) {
                    $html_bus_default = $this->create_html_bus_default( $_POST['data_class'], $_POST['class_id'], $s_info, $_POST['course_id'] , $_POST['bus_use_flg'] );
                    die( json_encode( $html_bus_default ) );
                }
                if ( isset( $_POST['bus_course_id'] ) ) {
                    $html_change_bus_course = $this->create_html_change_bus_course( $_POST['bus_course_id'] );
                    die( json_encode( $html_change_bus_course ) );
                }
                if ( isset( $_POST['user_name'] ) && isset( $_POST['name_kana'] ) && isset( $_POST['birthday'] ) && isset( $_POST['sex'] ) && isset( $_POST['address'] ) && isset( $_POST['email_address'] ) && isset( $_POST['phone_number'] ) && isset( $_POST['postal_code']) ) {
                    $password = strtolower( random_string('alnum', LENGTH_PASS_RAMDOM_CREATE) );
                    $arr_update = array(
                        'email' => $_POST['email_address'],
                        'password' => password_hash( $password, PASSWORD_DEFAULT ),
                        'tel_normalize' => $_POST['phone_number'],
                        'status' => '1'
                    );
                    // update m_student
                    foreach ( $arr_update as $k => $v ) {
                        if ( $v != '' ) $this->m_student_model->update_student_info( $_POST['student_id'], $k, $v );
                    }
                    $arr_update_meta = array(
                        'name' => $_POST['user_name'],
                        'name_kana' => $_POST['name_kana'],
                        'birthday' => $_POST['birthday'],
                        'sex' => $_POST['sex'],
                        'address' => $_POST['address'],
                        'email' => $_POST['email_address'],
                        'tel' => $_POST['phone_number'],
                        'zip' => $_POST['postal_code'],
                        'email_flg' => $_POST['email_flg'],
                        'emergency_tel' => isset( $_POST['emergency_tel'] ) ? $_POST['emergency_tel'] : '', 
                        'school_name' => isset( $_POST['school_name'] ) ? $_POST['school_name'] : '', 
                        'parent_name' => isset( $_POST['parent_name'] ) ? $_POST['parent_name'] : '', 
                        'school_grade' => isset( $_POST['school_grade'] ) ? $_POST['school_grade'] : '', 
                        'bus_use_flg' => isset( $_POST['bus_use_flg'] ) ? $_POST['bus_use_flg'] : '',
                        'life_check_flg' => isset( $_POST['life_check_flg'] ) ? $_POST['life_check_flg'] : '',
                        'enquete' => isset( $_POST['enquete'] ) ? json_encode( $_POST['enquete'] ) : '',
                        'memo_to_coach' => isset( $_POST['memo_to_coach'] ) ? $_POST['memo_to_coach'] : '',
                        'first_lesson_date' => isset( $_POST['first_lesson_date'] ) ? $_POST['first_lesson_date'] : '',
                        'memo_special' => isset( $_POST['memo_special'] ) ? $_POST['memo_special'] : '',
                        'family' => isset( $_POST['family'] ) ? $_POST['family'] : '',
                        'relationship' => isset( $_POST['relationship'] ) ? $_POST['relationship'] : '',
                        'enter_date' => date('Y-m-d'),
                        'item' => isset( $_POST['item'] ) ? $_POST['item'] : '',
                        'iccard' => isset( $_POST['iccard'] ) ? $_POST['iccard'] : ''
                    );
                    // update l_student_meta
                    foreach ( $arr_update_meta as $k => $v ) {
                        if ( count( $this->l_student_meta_model->select_student_meta( $_POST['student_id'], $k ) ) == 1 ) {
                            if ( $v != '' ) $this->l_student_meta_model->update_student_meta( $_POST['student_id'], $k, $v );
                        } else {
                            if ( $v != '' ) $this->l_student_meta_model->insert( array( 'student_id' => $_POST['student_id'], 'tag' => $k, 'value' => $v ) );
                        }
                    }

                    // update l_student_course
                    $id_course = '';
                    if ( isset( $_POST['course_id'] ) && !empty( $_POST['course_id'] ) ) {
                        $s_course = $this->l_student_course_model->select_by_id( $_POST['course_id'], 'id', 'm_course' );
                        $cost_item = $this->m_item_model->get_item( $s_course[0]['cost_item_id'] );
                        $rest_item = $this->m_item_model->get_item( $s_course[0]['rest_item_id'] );
                        $bus_item = $this->m_item_model->get_item( $s_course[0]['bus_item_id'] );
                        $price = $cost_item[0]['sell_price'] + $rest_item[0]['sell_price'] + $bus_item[0]['sell_price'];
                        $data['price'] = number_format( $price ) . ' 円';
                        $check_change_course = $this->l_student_course_model->check_change_course( $id, $_POST['course_id'] );
                        if ( count( $check_change_course ) < 1 ) {
                            $course = $this->m_course_model->select_by_id( $_POST['course_id'], 'id', 'm_course' );
                            $start_date = $course[0]['start_date'];
                            if ( $start_date == INVALID_DATE ) $start_date = date( 'Y-m-d' );
                            $this->l_student_course_model->update_course_change( $id, date( 'Y-m-d' ) );
                            $this->l_student_course_model->insert( array( 'student_id' => $id, 'course_id' => $_POST['course_id'], 'start_date' => $start_date ) );
                            $id_course = $this->l_student_course_model->get_last_insert_id();
                        } else $id_course = $check_change_course[0]['id'];
                    }

                    // update l_student_class
                    $class_choose = ( isset( $_POST['class_choose'] ) && count( $_POST['class_choose'] ) > 0 ) ? $_POST['class_choose'] : '';
                    $arr_insert_class = array();
                    if ( $class_choose != '' ) { 
                        foreach ( $class_choose as $k => $v ) {
                            $current_class = explode( 'space_', $v );
                            $start_date = '';
                            foreach ( $s_info['course']['all'] as $k1 => $v1 ) {
                                if ( $v1['course_id'] == $_POST['course_id'] ) $start_date = $v1['start_date'];
                            }
                            if ( $start_date == INVALID_DATE ) $start_date = date( 'Y-m-d' );
                            $result_insert = $this->l_student_class_model->insert( 
                                array( 
                                    'student_course_id' => $id_course, 
                                    'student_id' => $_POST['student_id'], 
                                    'class_id' => $current_class[0], 
                                    'week_num' => $current_class[3],
                                    'start_date' => $start_date
                                ) 
                            );
                            $arr_insert_class[$current_class[0] . '_' . $current_class[3]] = $this->l_student_class_model->get_last_insert_id();
                        }
                    }
                    
                    // update l_student_bus_route
                    $class_route = ( isset( $_POST['class_route'] ) && count( $_POST['class_route'] ) > 0 ) ? $_POST['class_route'] : '';
                    if ( $class_route != '' && $_POST['bus_use_flg'] == 1 ) {
                        foreach ( $class_route as $k => $v ) {
                            $current_route = explode( '_', $v );
                            $this->l_student_bus_route_model->insert(
                                array(
                                    'student_id' => $current_route[0],
                                    'student_class_id' => $arr_insert_class[$current_route[1] . '_' . $current_route[2]],
                                    'bus_route_go_id' => $current_route[4],
                                    'bus_route_ret_id' => $current_route[5],
                                    'start_date' => $current_route[3]
                                )
                            );
                        }
                    }
                    
                    $this->send_mail_entry_admin( $s_info['info']['email'], $password, $price );
                    $data['update'] = 'success';
                    $data['temporary_pw'] = $password;
                    die( json_encode( $data ) );
                }
                $this->viewVar = $data;
                admin_layout_view('entry_edit', $this->viewVar);
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function send_mail_entry_admin( $email_address, $password, $price )
    {
        $string = $this->get_template_send_mail( 'register_admin' );
        $macro = array( 'password' => $password, 'price' => $price );
        foreach ($macro as $key => $value) {
            $string = str_replace("%{$key}%", $value, $string);
        }
        // send mail
        $this->send_mail->set_from('hanamigawasw@onionworld.sakura.ne.jp', 'Onion World');
        $this->send_mail->set_to($email_address);
        $this->send_mail->set_bcc('tonnguyenhoangan@gmail.com');
        $this->send_mail->set_subject('【花見川スイミングクラブ】お申込みページのご案内');
        $this->send_mail->set_message($string);
        $this->send_mail->send();
    }

    public function get_template_send_mail($template_mail)
    {
        $url_path = './mailbody/' . $template_mail . '.txt';
        $content = read_file($url_path);
        return $content;
    }

    public function create_html( $course_id ) {
        $html = '';
        $classes = $this->m_class_model->select_by_id( $course_id, 'course_id', 'm_class');
        foreach ( $classes as $k => $v ) {
            $current_student = $this->l_student_class_model->select_by_id( $v['id'], 'class_id', 'l_student_class');
            $classes[$k]['current_student'] = count($current_student);
        }
        $classes_week = array();
        foreach ( $classes as $k => $v ) {
            for ( $i = 0; $i < 7; $i++ ) {
                if ( strpos( $v['week'], $i . '' ) !== false ) {
                    $current_s = $this->l_student_class_model->get_current_student_by_class_id( $v['id'], $i );
                    $classes_week[$i][]['info'] = $v['id'] . '-' . $v['base_class_sign'] . '-' . $v['class_code'] . '-' . $current_s[0]['current_student'] . '-' . $v['max_count'];
                }
            }
        }
        $class_week_sort = array();
        $arr_sort = array('2', '3', '4', '5', '6', '0', '1');
        foreach ( $arr_sort as $k => $v ) {
            $class_week_sort[$v] = isset( $classes_week[$v] ) ? $classes_week[$v] : array();
        }
        $arr_loop = array('2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土', '0' => '日', '1' => '月');
        $arr_class = array('M', 'A', 'B', 'C', 'D', 'E', 'F');
        foreach ( $arr_loop as $k => $v ) {
            $check_M = 0; $check_A = 0; $check_B = 0; $check_C = 0; $check_D = 0; $check_E = 0; $check_F = 0;
            foreach ( $class_week_sort[$k] as $k1 => $v1 ) {
                foreach ( $arr_class as $k2 => $v2 ) {
                    if ( strpos( $v1['info'], '-' . $v2 . '-' ) !== false ) { ${'check_' . $v2}++; ${'arr_value_' . $v2} = explode( '-', $v1['info'] ); }
                }
            }
            $html .= '<tr>';
            $html .= '<td >' . $v . '</td>';
            foreach ( $arr_class as $k3 => $v3 ) {
                if ( ${'check_'. $v3} == 0 ) $html .= '<td  class="bg-gainsboro">　</td>'; 
                else if ( ${'arr_value_' . $v3}[3] >= ${'arr_value_' . $v3}[4] ) $html .= '<td  class="bg-lightpink">' . '【' . ${'arr_value_' . $v3}[3] . '/' . ${'arr_value_' . $v3}[4] . '】</td>'; 
                else $html .= '<td  class="bg-plae-lemmon" data-id="' . ${'arr_value_' . $v3}[0] . '" data-class="' . ${'arr_value_' . $v3}[2] . 'space_weekspace_' . $k . 'space_' . ${'arr_value_' . $v3}[3] . 'space_' . ${'arr_value_' . $v3}[4] . '">' . '【' . ${'arr_value_' . $v3}[3] . '/' . ${'arr_value_' . $v3}[4] . '】</td>';
            }
            $html .= '</tr>';
        }
        return $html;
    }

    public function create_html_bus_default( $data_class, $class_id, $student_info, $course_id, $bus_use ) {
        $html_bus = ''; $class_course_go = ''; $class_course_ret = ''; $class_route_go = ''; $class_route_ret = '';
        $class_use_bus = $this->m_class_model->select_by_id( $class_id, 'id', 'm_class');
        $bus_course = $this->m_bus_course_model->get_bus_course_by_class_id( $class_id );
        if ( $class_use_bus[0]['use_bus_flg'] == 0 ) {
            $start_date = '';
            foreach ( $student_info['course']['all'] as $k => $v ) {
                if ( $v['course_id'] == $course_id ) $start_date = $v['start_date'];
            }
            $bus_use_flg = ( isset( $student_info['meta']['bus_use_flg'] ) ) ? $student_info['meta']['bus_use_flg'] : '';
            if ( $bus_use_flg == 1 ) $disabled = ''; else $disabled = 'disabled';
            if ( $bus_use == 1 ) $disabled = ''; else $disabled = 'disabled';
            $split = explode( 'space_', $data_class );
            if ( count( $bus_course ) > 0 ) {
                $bus_route_default = $this->m_bus_route_model->select_by_id( $bus_course[0]['id'], 'bus_course_id', 'm_bus_route' );
                $data_route = $student_info['info']['id'] . '_' . $class_id . '_' . $split[2] . '_' . $start_date;
            } else $data_route = $student_info['info']['id'] . '_' . $class_id . '_' . $split[2] . '_' . $start_date;
            $bus_stop_default = $this->m_bus_stop_model->select_all( 'm_bus_stop' );
            $arr_date = array('2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土', '0' => '日', '1' => '月');
            $id_bus_route_1 = random_string( 'alnum', RANDOM_STRING_LENGTH );
            $id_bus_route_2 = random_string ( 'alnum', RANDOM_STRING_LENGTH );
            $class_course_go = random_string( 'alpha', RANDOM_STRING_LENGTH );
            $class_course_ret = random_string( 'alpha', RANDOM_STRING_LENGTH );
            $class_route_go = random_string( 'alpha', RANDOM_STRING_LENGTH );
            $class_route_ret = random_string( 'alpha', RANDOM_STRING_LENGTH );
            if ( count( $bus_course ) > 0 ) {
                $html_bus .= '<div class="main_bus_route" style="display:flex;" id="' . $data_class . '">';
                    $html_bus .= '<div style="height:100px;padding-top:40px;">';
                        $html_bus .= $arr_date[$split[2]] . '曜日（' . $split[0] . '）';
                    $html_bus .= '</div>';
                    $html_bus .= '<div>';
                        $html_bus .= '<table>';
                            $html_bus .= '<tbody>';
                                $html_bus .= '<tr>';
                                $html_bus .= '<td>行き（乗車）</td>';
                                $html_bus .= '<td>';
                                    $html_bus .= '<input type="hidden" class="data_route" data-course="yes" data-route="' . $data_route . '" />';
                                    $html_bus .= '<select class="' . $class_course_go . ' form-control w-xs-100per change_bus_course disabled_bus '. $id_bus_route_1 . '" ' . $disabled . ' onchange="change_bus_course(this.value, ' . "'" . $id_bus_route_1 . "'" . ')"  ' . $disabled . '>';
                                        foreach ( $bus_course as $k => $v ) {
                                            $html_bus .= '<option value="' . $v['id'] . '">' . $v['bus_course_name'] . '</option>';
                                        }
                                    $html_bus .= '</select>';
                                $html_bus .= '</td>';
                                $html_bus .= '<td>';
                                    $html_bus .= '<select data-check="yes" data-go-ret="go" data-class-id="' . $class_id . '" class="' . $class_route_go . ' change_bus_route form-control w-xs-100per each_route disabled_bus" ' . $disabled . ' data-route="' . $data_route . '" id="' . $id_bus_route_1 . '" ' . $disabled . '>';
                                        foreach ( $bus_route_default as $k => $v ) {
                                            $html_bus .= '<option value="' . $v['id'] . '">';
                                                foreach ( $bus_stop_default as $k1 => $v1 ) {
                                                    if ( $v1['id'] == $v['bus_stop_id'] ) $html_bus .= '【' . $v1['bus_stop_code'] . '】 ' . $v1['bus_stop_name'];
                                                }
                                            $html_bus .= '</option>';
                                        }
                                    $html_bus .= '</select>';
                                $html_bus .= '</td>';
                            $html_bus .= '</tr>';
                                $html_bus .= '<tr>';
                                    $html_bus .= '<td>帰り（降車）</td>';
                                    $html_bus .= '<td>';
                                        $html_bus .= '<select class="' . $class_course_ret . ' form-control w-xs-100per change_bus_course disabled_bus '. $id_bus_route_2 . '" ' . $disabled . ' onchange="change_bus_course(this.value, ' . "'" . $id_bus_route_2 . "'" . ')" ' . $disabled . '>';
                                            foreach ( $bus_course as $k => $v ) {
                                                $html_bus .= '<option value="' . $v['id'] . '">' . $v['bus_course_name'] . '</option>';
                                            }
                                        $html_bus .= '</select>';
                                    $html_bus .= '</td>';
                                    $html_bus .= '<td>';
                                        $html_bus .= '<select data-check="yes" data-go-ret="ret" data-class-id="' . $class_id . '" class="' . $class_route_ret . ' form-control w-xs-100per each_route disabled_bus change_bus_route" ' . $disabled . ' data-route="' . $data_route . '" id="' . $id_bus_route_2 . '" ' . $disabled . '>';
                                            foreach ( $bus_route_default as $k => $v ) {
                                                $html_bus .= '<option value="' . $v['id'] . '">';
                                                    foreach ( $bus_stop_default as $k1 => $v1 ) {
                                                        if ( $v1['id'] == $v['bus_stop_id'] ) $html_bus .= '【' . $v1['bus_stop_code'] . '】 ' . $v1['bus_stop_name'];
                                                    }
                                                $html_bus .= '</option>';
                                            }
                                        $html_bus .= '</select>';
                                    $html_bus .= '</td>';
                                $html_bus .= '</tr>';
                            $html_bus .= '</tbody>';
                        $html_bus .= '</table>';
                        $html_bus .= '<div class="form-group">';
                            $html_bus .= '<div class="col-sm-12 checkbox_bus"></div>';
                        $html_bus .= '</div>';
                    $html_bus .= '</div>';
                $html_bus .= '</div>';
            }
        }
        $data['html'] = $html_bus;
        return $data;
    }

    public function create_html_change_bus_course( $bus_course_id) {
        $bus_route = $this->m_bus_route_model->select_by_id( $bus_course_id, 'bus_course_id', 'm_bus_route' );
        $bus_stop = $this->m_bus_stop_model->select_all( 'm_bus_stop' );
        $html_change_bus_course = '';
        if ( count( $bus_route ) > 0 ) {
            foreach ( $bus_route as $k => $v ) {
                $html_change_bus_course .= '<option value="' . $v['id'] . '">';
                    foreach ( $bus_stop as $k1 => $v1 ) {
                        if ( $v1['id'] == $v['bus_stop_id'] ) $html_change_bus_course .= '【' . $v1['bus_stop_code'] . '】 ' . $v1['bus_stop_name'];
                    }
                $html_change_bus_course .= '</option>';
            }
        } else $html_change_bus_course .= '<option>データがありません</option>';
        return $html_change_bus_course;
    }

    // public function get_info_users_inactive()
    // {
    //     $data = $this->master_student->get_records_user_inactive();
    //     return $data;
    // }

    public function get_limit_data_users($limit, $started)
    {
        $data_users_inactive =  $this->get_list_users_inactive($limit, $started);
        $data_user_detail = [];

        foreach ($data_users_inactive as $key => $value) {

            $array_item = [];
            $tmp_data_user = [];
            $tmp_data_user = $this->student_data->get_student_data_detail($value['id']);
            $info_id_user = !empty($tmp_data_user['info']['id']) ? $tmp_data_user['info']['id'] : '';
            $info_date_register  = !empty($tmp_data_user['info']['create_date']) ? $tmp_data_user['info']['create_date'] : '';
            $tag_name =  !empty($tmp_data_user['meta']['name']) ? $tmp_data_user['meta']['name'] : '';
            $type_name_course = !empty($tmp_data_user['course']['valid'][0]) ? $tmp_data_user['course']['valid'][0]['type'] : '';
            $str_type_name =  $this->get_name_type_course($type_name_course);
            $course_name = !empty($tmp_data_user['course']['valid'][0]['course_name']) ? $tmp_data_user['course']['valid'][0]['course_name'] : '';
            $array_item = array(
                'id' =>  $info_id_user,
                'date_register' => $info_date_register,
                'tag_name' => $tag_name,
                'tag_type_course' => $str_type_name,
                'course_name' => $course_name
            );
            array_push($data_user_detail, $array_item);
        }
        return $data_user_detail;
    }

    public function get_name_type_course($valid)
    {
        $name_course = '';
        $course_name = $this->configVar['course_type'];
        
        switch ($valid) {
            case '0':
                $name_course = $course_name[VALUE_COURSE_TYPE_NORMAL];
                break;
            case '1':
                $name_course = $course_name[VALUE_COURSE_TYPE_LIMITED];
                break;
            case '2':
                $name_course = $course_name[VALUE_COURSE_TYPE_FREE];
                break;
            default:
                # code...
                break;
        }
        return $name_course;
    }
}

/* End of file entry.php */
/* Location: ./application/controllers/admin/entry.php */
