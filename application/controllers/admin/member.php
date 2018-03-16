<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model','member_model');
        $this->load->library("pagination");
	$this->load->model('db/m_bus_course_model');
        $this->load->model('db/m_class_model');
        $this->load->model('db/m_course_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/l_student_course_model');
        $this->load->model('db/l_student_bus_route_model');
        $this->load->model('db/m_bus_route_model');
    }
    
    //DEV TRÍ VV_JSC
    /**
     * 会員一覧(1ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            // $this->view(0);
            if(isset($_POST['text_condition'])){

                $input_text = $this->input->post('text_condition');
                $type_condition = $this->input->post('type_condition');

                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/member/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;

                $data['rel_search_top'] = $this->member_model->filer_type_singe_condition($pagin["per_page"], $data['page']);
                $pagin['total_rows'] = $data['rel_search_top'][1];
                $total_rel = $data['rel_search_top'][1];

                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();
                $data['condition_input'] = array('type_condition' => $type_condition , 'text_filter' =>$input_text );
                $this->viewVar = $data;
                admin_layout_view('member_index', $this->viewVar);

            }else{
                admin_layout_view('member_index', $this->viewVar);
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function ajax_load_list_member()
    {
        if ($this->error_flg) return;
        try {

            if(isset($_POST['flag_load'])){

                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/member/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;

                $data['list_member'] = $this->member_model->get_list_member_all($pagin["per_page"], $data['page']);
                $pagin['total_rows'] = $data['list_member'][1];
                $total_rel = $data['list_member'][1];

                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();
                $list_member = $this->create_html_member($data['list_member'][0]);
                echo json_encode(array('list' => $list_member, 'pagination' => $data['pagination'], 'total' => $total_rel));
                die();

            }
            
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function create_html_member($data)
    {
        $html = '';
        foreach ($data as $key => $value) {
            $html .= '<tr>';
                //id
                $html .= '<td>'.$value['student_id'].'</td>';
                //name kana
                $html .= '<td>'.$value['value'].'</td>';
                //course name
                $html .= '<td>'.$value['course_name'].'</td>';
                //class basinge
                $html .= '<td>'.$value['base_class_sign'].'</td>';
                //class name code
                $html .= '<td>'.$value['class_name'].'</td>';
                //buss name
                $html .= '<td>'.$value['bus_stop_name'].'</td>';
                //status
                $status = $this->get_status_student($value['status']);
                $html .= '<td>'.$status.'</td>';
                $html .= '<td><a href="'.base_url('admin/member/detail/'.$value['student_id']).'" class="btn btn-success btn-sm btn-block">詳細</a></td>';                    
                
            $html .= '</tr>';
        }

        return $html;
    }

    public function get_status_student($type)
    {
        $string_status = '';
        switch ($type) {
            case 0:
                $string_status = '未処理状態';
                break;
            case 1:
                $string_status = '入会中';
                break;
            case 2:
                $string_status = '退会保留中';
                break;
            default:
                $string_status = '退会済み';
                break;
        }
        return $string_status;
    }

    //code tìm kiếm 
    public function ajax_load_member_filter()
    {
        if ($this->error_flg) return;
        try {
            if(isset($_POST['data_input_search'])){

                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/member/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;

                $data['list_member'] = $this->member_model->filter_list_member($pagin["per_page"], $data['page'], FILTER_ACTION);
                $pagin['total_rows'] = $data['list_member'][1];

                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();

                $list_member = $this->create_html_member_filter($data['list_member'][0]);
                $total_rel = $data['list_member'][1];

                echo json_encode(array('list' => $list_member, 'pagination' => $data['pagination'], 'total' => $total_rel));
                die();

            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }

    }

    public function create_html_member_filter($array_list_member)
    {
        $html = '';
        if(!empty($array_list_member)){
            foreach ($array_list_member as $key => $value) {
                $html .= '<tr>';
                    //id
                    $html .= '<td>'.$value['id'].'</td>';
                    //name kana
                    $html .= '<td>'.$value['name'].'</td>';
                    //course name
                    $html .= '<td>'.$value['course_name'].'</td>';
                    //class basinge
                    $html .= '<td>'.$value['base_class_sign'].'</td>';
                    //class name code
                    $html .= '<td>'.$value['class_name'].'</td>';
                    //buss name
                    $html .= '<td>'.$value['bus_stop_name'].'</td>';
                    //status
                    $status = $this->get_status_student($value['status']);
                    $html .= '<td>'.$status.'</td>';
                    $html .= '<td><a href="'.base_url('admin/member/detail/'.$value['id']).'" class="btn btn-success btn-sm btn-block">詳細</a></td>';                    
                    
                $html .= '</tr>';
            }
        }else{
            $html .= '<tr>'.'<td colspan = 8 style = "text-align: center">データがありません。</td>'.'</tr>' ;
        }
        
        return $html;
    }

    //end code tìm kiếm

    //export CSV
    public function export_filter() {
        if ($this->error_flg) return;
        try {
            if(isset($_POST['data_input_search'])){
                $limit_record = 10;
                if(!empty($_POST['data_input_search'])){
                    
                    $data_tmp = $this->member_model->filter_list_member(0,0, FILTER_ACTION);
                    $total_rel = $data_tmp[1];
                    $num_row = ceil($total_rel/$limit_record);
                    $data = [];
                    for ($i = 0; $i < $num_row; $i++) { 
                        $offset = $i*$limit_record;
                        $tmp_db = $this->member_model->filter_list_member($limit_record, $offset, CSV_ACTION_UN_GET_TOTAL);
                        
                        if(!empty($tmp_db)){
                            foreach ($tmp_db as $row) {
                                $data[] =  $this->custome_field_csv($row);
                            }
                        }
                        
                    }
                    array_unshift($data ,array('会員番号','氏名','練習コース','クラス','級・組','バス停', '状態'));
                    $this->load->helper('csv');
                    export_csv_member($data, 'list_member_filter_'.date('YmdH:i:s').'.csv');

                } else {

                    if(!empty($_POST['type_condition'])){

                        $data_tmp  = $this->member_model->filer_type_singe_condition($limit_record,0);
                        $total_rel =  $data_tmp[1];
                        $num_row = ceil($total_rel/$limit_record);
                        $data_export = [];

                        for ($i=0; $i < $num_row; $i++) { 

                            $offset = $i*$limit_record;
                            $tmp_db_exp = $this->member_model->filer_type_singe_condition($limit_record, $offset);
                            if(!empty($tmp_db_exp[0])){
                                foreach ($tmp_db_exp[0] as $row) {
                                    $data_export[] = $this->custome_field_csv($row);
                                }

                            }
                        }
                        array_unshift($data_export ,array('会員番号','氏名','練習コース','クラス','級・組','バス停', '状態'));
                        $this->load->helper('csv');
                        export_csv_member($data_export, 'list_member_filter_'.date('YmdH:i:s').'.csv');
                    }
                }
            }

        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function custome_field_csv($array_csv)
    {
        $rel = [];
        $sort_data = [];
        foreach ($array_csv as $key => $value) {
            switch ($key) {
                case 'id':
                case 'name':
                case 'course_name':
                case 'base_class_sign':
                case 'class_name':
                case 'bus_stop_name':
                    $rel[$key] = $value;
                    break;
                case 'status':
                    $tmp_name_status = $this->get_status_student($value);
                    $rel[$key] = $tmp_name_status;
                    break;
                default:
                    break;
            }
        }
        if(!empty($rel)){
            $sort_data['id'] = trim($rel['id']);
            $sort_data['name'] =  trim($rel['name']);
            $sort_data['course_name'] =  trim($rel['course_name']);
            $sort_data['base_class_sign'] =  trim($rel['base_class_sign']);
            $sort_data['class_name'] =  trim($rel['class_name']);
            $sort_data['bus_stop_name'] =  trim($rel['bus_stop_name']);
            $sort_data['status'] =  trim($rel['status']);
        }
        return $sort_data;
    }

    //end export CSV
    //END DEV TRÍ VV_JSC

    /**
     * 会員一覧
     *
     * @param   
     * @return  
     *
    */
    public function view($page = NULL) {
        if ($this->error_flg) return;
        try {
            admin_layout_view('member_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    // DEV BAO VV_JSC
    /**
     * 会員編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $this->load->model('student_model');
            $data= $this->student_model->get_student_data_detail($id);
            // echo '<pre>'.print_r($data).'</pre>';
            // exit();
            $this->viewVar = $data;
            $distance = $this->m_distance_model->select_all();
            $this->viewVar['distance'] = $distance;
            admin_layout_view('member_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 会員詳細
     *
     * @param   
     * @return  
     *
    */
    public function detail($id = NULL) {
        if ($this->error_flg) return;
        try {
            $this->load->model('student_model');
            $data= $this->student_model->get_student_data_detail($id);
            admin_layout_view('member_detail', $data);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    public function Update_data_Member($id = NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/l_student_meta_model');
        $this->load->model('db/m_student_model');
        $this->load->model('db/l_student_course_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/l_student_bus_route_model');
	$this->load->model('db/l_student_request_model');
        $info_data = isset($_POST['infodata'])?$_POST['infodata']:'';
        $meta_data = isset($_POST['metadata'])?$_POST['metadata']:'';
        $course_join = isset($_POST['course_join'])?$_POST['course_join']:'';
        $course_class_join = isset($_POST['course_class_join'])?$_POST['course_class_join']:'';
        $bus_route_join = isset($_POST['bus_route_join'])?$_POST['bus_route_join']:'';
	$session_student = $this->session->userdata('admin_account');
        $admin_id = $session_student['id'];
        if($info_data =='' || $meta_data =='' || $course_join == '') { echo " UnSuccessfully "; exit(); }
        try{
            if( $this->m_student_model->new_update_by_id($info_data,$id) )
            {	
	    	$current_date = date('Y-m-d H:i:s');

                foreach ($info_data as $key => $value) {
                    if($key == 'status' && $value == '3')
                    {
                        $result_search = $this->l_student_request_model->Search_request_notyet_processed( $id , QUIT );
                        if( count( $result_search ) > 0 )
                        {
                            $id_1 = $result_search[0]['id'];                 
                            $this->db->update('l_student_request', array( 'status' => DATA_ON , 'update_id' => $admin_id,'update_date' => $current_date ), array('id'=>$id_1 ) );   
                        }
                    }
                    else if($key == 'rest_flg' && $value == '2')
                    {
                        $result_search_2 = $this->l_student_request_model->Search_request_notyet_processed( $id , RECESS );
                        if( count( $result_search_2 ) > 0 )
                        {
                            $id_1 = $result_search_2[0]['id'];              
                            $this->db->update('l_student_request', array( 'status' => DATA_ON , 'update_id' => $admin_id, 'update_date' => $current_date ), array('id'=>$id_1 ) );  
                        }
                    }
                }
                if($this->l_student_meta_model->update_tagMeta($meta_data,$id))
                {
                    if($this->l_student_course_model->Update_course($course_join))
                    {
                        if($this->l_student_class_model->Update_class($course_class_join))
                        {

                           if( $this->l_student_bus_route_model->Update_bus_route_join($bus_route_join)  )
                           {
                                echo "Successfully";
                                exit();
                           } 
                        }  
                    }  
                }  
            }
            echo " UnSuccessfully ";
            exit();
        }
        catch(Exception $e)
        {
            echo " UnSuccessfully ";
            exit();
        }    
        
    }
    public function get_data_bus_stop()
    {
        
        $bus_course_id = isset( $_POST['bus_course_id'] ) ? $_POST['bus_course_id']:'';
        if ($bus_course_id =='' ) return;
        $this->load->model('db/m_bus_course_model');
        $result = $this->m_bus_course_model->getData_Bus_stop_by_id( $bus_course_id );

        echo json_encode($result);
        exit();
    }
    public function getData_class_by_id_course($id=NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/m_course_model');
        $result = $this->m_course_model->getData_class_by_id($id);
        echo json_encode($result);
    }
    public function switch_course_view()
    {
            $course_id = isset( $_POST['course_id'] ) ? $_POST['course_id'] : '';
            $student_id = isset( $_POST['student_id'] ) ? $_POST['student_id'] : '';
            if( $course_id == '' || $student_id == '' || intval( $student_id ) < 0 || intval( $course_id ) < 0 ) {  echo '' ; exit(); } 

            $classes = $this->m_course_model->getData_class_by_id( $course_id );
            $classes_join = $this->l_student_course_model->get_valid_course_by( $course_id , $student_id );

            $result = array();
            $array_base_class = ['','M','A','B','C','D','E','F'];
            $config = $this->configVar;
            $week = $config['week_num'];
            $count_week = count( $week );

            $body_table = '';
                for( $i=0 ; $i < 7 ; $i++){

                  $x = ( $i+2 >= $count_week ) ? ($i-5) : ($i+2);
                  $tag_tr = '<tr>';
                  foreach( $array_base_class as $key => $value ){

                    $choose = '';
                    $class_id = '';
                    $class = 'bg-gainsboro';
                    
                    if($key == 0)
                    {
                      $tag_tr.= '<th>'.$week[$x].'</th>';
                    }
                    elseif( $key != 0 ){

                      $ishas = FALSE;
                      if( count($classes_join) > 0 )
                      {
                        foreach ( $classes_join as $subkey_1 => $subvalue_1 ) { 

                            if( $value == $subvalue_1['base_class_sign'] && $subvalue_1['week_num'] == strval($x)  )
                            {
                              $class_id = $subvalue_1['class_id'];
                              $choose = '選択';
                              $class = 'bg-rouge';
                              $ishas = TRUE ;
                              break;
                            }
                        }
                      }
                      if( $ishas === FALSE &&  count($classes) > 0 )
                      {
                        foreach ( $classes as $subkey_2 => $subvalue_2 ) {
                          if( $value == $subvalue_2['base_class_sign'] &&  strpos( $subvalue_2['week'] , strval($x) ) !== false )
                          {
                            $class_id = $subvalue_2['class_id']; 
                            $class = 'bg-plae-lemmon';
                            $week_full = $subvalue_2['week_full'];
                            if( strpos( $week_full , strval($x) ) !== false ) $class = 'bg-red';
                            break;
                          }
                        }
                      }

                      $data_id = $class_id != '' ? 'data-id = "'.$class_id.'" ' : '';
                      $data_base = 'data-base = "'.$value.'-'. $x .'"  ' ;
                      $data_class = 'class = "'.$class.'" ' ;

                      $tag_tr.= '<td '.$data_class. $data_base.$data_id. ' onclick=" choose_class(this) ">'.$choose.'</td>';
                    }                          
                  }
                  $tag_tr .= '</tr>';
                  $body_table .= $tag_tr;
                }
                $result['body_table'] = $body_table ;

            $label_class_join = '';
                if( count($classes_join) > 0 )
                {
                    foreach ($classes_join as $key => $value) {
                        $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
                        $html_1 = 'data-class="'.$value['base_class_sign'].'-'.$value['week_num'].'" data-id='.$value['class_id'].'>'.$value['class_code'].' </label>';     
                        $label_class_join.= $html_0.$html_1;     
                    }
                }
                $result['label_class_join'] = $label_class_join ;
                
            $bus_couse_join = '' ;
                if( count( $classes_join ) > 0 )
                {
                    foreach ( $classes_join as $key => $value ) {

                        $classes_join[$key]['bus_course'] = $this->m_bus_course_model->get_data_class_and_bus_course( $value['class_id'] );
                        $bus_coures = $classes_join[$key]['bus_course'] ;

                        foreach( $bus_coures as $subkey =>$subvalue ){
                            $classes_join[$key]['bus_course'][$subkey]['bus_stop'] = $this->m_bus_course_model->getData_Bus_stop_by_id( $subvalue['id'] );
                        }
                       
                        $classes_join[$key]['student_join_route'] = $this->l_student_bus_route_model->select_by_id( $value['student_class_id'] , 'student_class_id' ) ;
                        $student_join_route = $classes_join[$key]['student_join_route'] ;
                        if(  $student_join_route )
                        {
                            $classes_join[$key]['student_join_route']['bus_go'] = $this->m_bus_route_model->select_by_id( $student_join_route[0]['bus_route_go_id'],'id' );
                            $classes_join[$key]['student_join_route']['bus_ret'] = $this->m_bus_route_model->select_by_id( $student_join_route[0]['bus_route_ret_id'],'id');
                        }
                    }
                    
                    foreach ( $classes_join as $key => $value ) {

                        if(  $value['student_join_route'] )
                        {
                            
                            $html_2='';
                            $html_5= '';
                            $html_8= '';
                            $html_11='';
                            $index = random_string('alnum', RANDOM_STRING_LENGTH );
                            $base_class_sign = isset( $value['base_class_sign'] ) ? $value['base_class_sign'] : '';
                            $class_name = isset( $value['class_name'] ) ? $value['class_name'] : '';
                            $class_id = isset( $value['class_id'] ) ? $value['class_id'] : '';
                            $week_num = isset( $value['week_num'] ) ? $value['week_num'] : '';
                            $id_go = isset( $value['student_join_route']['bus_go'][0]['bus_course_id'] ) ? $value['student_join_route']['bus_go'][0]['bus_course_id'] : '';
                            $id_ret = isset( $value['student_join_route']['bus_ret'][0]['bus_course_id'] ) ? $value['student_join_route']['bus_ret'][0]['bus_course_id'] : '';
                            $id_stop_go = isset( $value['student_join_route']['bus_go'][0]['bus_stop_id'] ) ? $value['student_join_route']['bus_go'][0]['bus_stop_id'] : '';
                            $id_stop_ret = isset( $value['student_join_route']['bus_ret'][0]['bus_stop_id'] ) ? $value['student_join_route']['bus_ret'][0]['bus_stop_id'] : '';

                            foreach ( $value['bus_course'] as $subkey => $subvalue ) {

                                $selected_go = '';
                                $selected_ret = '';
                                $selected_stop_go = '';
                                $selected_stop_ret = '';

                                if( $subvalue['id'] === $id_go )
                                {
                                  $selected_go = "selected";
                                  if( $subvalue['bus_stop'] )
                                  {
                                    foreach ( $subvalue['bus_stop'] as $sub_key_stop => $sub_value_stop ) {

                                      if( $sub_value_stop['bus_stop_id'] === $id_stop_go ) $selected_stop_go = "selected";
                                      $html_5.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_go.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                      $selected_stop_go ='';

                                    }
                                  }  
                                } 
                                $html_2.= '<option value='.$subvalue['id'].' '.$selected_go.'>'.$subvalue['bus_course_name'].'</option>';


                                if( $subvalue['id'] === $id_ret ) 
                                {
                                  $selected_ret = "selected";
                                  if( $subvalue['bus_stop'] )
                                  {
                                    foreach ( $subvalue['bus_stop'] as $sub_key_stop => $sub_value_stop ) {
                                      if( $sub_value_stop['bus_stop_id']===$id_stop_ret ) $selected_stop_ret = "selected";
                                      $html_11.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_ret.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                      $selected_stop_ret='';
                                    }
                                  }
                                }
                                $html_8.= '<option value='.$subvalue['id'].' '.$selected_ret.'>'.$subvalue['bus_course_name'].'</option>'; 
                            }

                            $html_0  ='<div class="element_bus_course" data-sign="'.$base_class_sign.'-'.$week_num.'" data-id="'.$class_id.'"><div for="" class"col-sm-2 control-label " id="classnameforbus">'.$week[$week_num].'<br>('.$class_name.')</div>';
                            $html_1  ='<div class="form-group">
                                  <label for="" class="col-sm-2 control-label">行き</label>
                                  <div class="col-sm-5">
                                  <select class="form-control bus_course" name="bus_course_go_'.$index.'" onchange="changeBuscoure(this)">';
                            $html_3  ='</select>
                                    </div>';
                            $html_4  ='<div class="col-sm-5">
                                    <select class="form-control bus_stop" name="bus_stop_go_'.$index.'" >';
                            $html_6  ='</select>
                                    </div>
                                    </div>';
                            $html_7  = '<div class="form-group">
                                  <label for="" class="col-sm-2 control-label">帰り</label>
                                  <div class="col-sm-5">
                                  <select class="form-control bus_course" name="bus_course_ret_'.$index.'" onchange="changeBuscoure(this)">';
                            $html_9  = '</select>
                                     </div>';
                            $html_10  = '<div class="col-sm-5">
                                  <select class="form-control bus_stop" name="bus_stop_ret_'.$index.'" >';
                            $html_12 = '</select></div></div></div>';
                            $bus_couse_join.= $html_0.$html_1.$html_2.$html_3.$html_4.$html_5.$html_6.$html_7.$html_8.$html_9.$html_10.$html_11.$html_12;

                            if( $key == 0)
                            {
                                $set_same  = '<div class="checkbox ml-1" id="set_same"><label style="margin: 0px auto 10px 142px;padding-top: 0px;" onclick ="check_set_same()">';
                                $set_same .= '<input type="checkbox" id = "check_set_same">'; 
                                $set_same .= '<small>上記と同じ設定をする</small></label></div>';
                                $bus_couse_join .= $set_same;
                            }
                        }    
                    }
                } 
                $result['bus_couse_join'] = $bus_couse_join;
            echo json_encode( $result );
            exit();
    }
    public function add_click_view()
    {

        $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
        $week_num = isset($_POST['week_num']) ? $_POST['week_num'] : '';
        if( $class_id == ''|| $week_num == '' )  { echo ''; exit(); }
        

        $result = array(); 
        // $class = $this->m_class_model->select_by_id( $class_id ,'id' ); 
        $class = $this->m_class_model->Get_data_class( $class_id , $week_num );      

        $class_name = $class[0]['class_name'] ;
        $base_class_sign = $class[0]['base_class_sign'] ;
        $class_code = $class[0]['class_code'] ;

        $html_label  = '<label  class="col-sm-2 control-label sub_class_join" ';
        $html_label .= 'data-class="' . $base_class_sign . '-' . $week_num . '" data-id="' . $class_id. '">' . $class_code.' </label>';
        $result['html_label_class_join'] =  $html_label;

        if( $class && $class[0]['use_bus_flg'] !== '1' ) 
        { 
            $bus_couse = $this->m_bus_course_model->select_by_id( $class_id ,'class_id' );
                  $config = $this->configVar;
                  $week= $config['week_num'];
                  $index = random_string('alnum', RANDOM_STRING_LENGTH );
                  $html_0 ='<div class="element_bus_course" data-sign="'.$base_class_sign.'-'.$week_num.'" data-id="'.$class_id.'"><div for="" class"col-sm-2 control-label " id="classnameforbus">'.$week[$week_num].'<br>('.$class_name.')</div>';
                  $html_1 ='<div class="form-group">
                          <label for="" class="col-sm-2 control-label">行き</label>
                          <div class="col-sm-5">
                          <select class="form-control bus_course" name="bus_course_go_'.$index.'" onchange="changeBuscoure(this)">';
                  $html_2 ='';
                  $html_3 ='</select>
                            </div>';
                  $html_4 ='<div class="col-sm-5">
                            <select class="form-control bus_stop" name="bus_stop_go_'.$index.'" >';
                  $html_5 = '';
                  $html_6 ='</select>
                            </div>
                            </div>';
                  $html_7 = '<div class="form-group">
                          <label for="" class="col-sm-2 control-label">帰り</label>
                          <div class="col-sm-5">
                          <select class="form-control bus_course" name="bus_course_ret_'.$index.'" onchange="changeBuscoure(this)">';
                  $html_8 = '';
                  $html_9 = '</select>
                             </div>';
                  $html_10 = '<div class="col-sm-5">
                          <select class="form-control bus_stop" name="bus_stop_ret_'.$index.'" >';
                  $html_11 = '';
                  $html_12 = '</select></div></div></div>';
                  
            if( count( $bus_couse ) > 0 )
            {
                foreach( $bus_couse as $key => $value )
                {
                    $bus_couse[$key]['bus_stop']=$this->m_bus_course_model->getData_Bus_stop_by_id( $value['id'] );
                }

                foreach ( $bus_couse as $key => $value ) {
                    $selected = '';
                    if( $key == 0 ) $selected ="seleceted";
                       $html_2.= '<option value='.$value['id'].' '.$selected.' >'.$value['bus_course_name'].'</option>';
                       $html_8.= '<option value='.$value['id'].'>'.$value['bus_course_name'].'</option>';

                    foreach( $bus_couse[$key]['bus_stop'] as $subkey => $subvalue )
                    {
                        if( $key == 0 )
                        {
                            $html_5.= '<option value='.$subvalue['bus_stop_id'].'>【'.$subvalue['bus_stop_code'].'】'.$subvalue['bus_stop_name'].'</option>';
                            $html_11.= '<option value='.$subvalue['bus_stop_id'].'>【'.$subvalue['bus_stop_code'].'】'.$subvalue['bus_stop_name'].'</option>';
                        }
                    }
                }
            }
            else
            {
                $html_2 = '<option  > データがありません。 </option>';
                $html_8 = '<option  > データがありません。 </option>';
                $html_5 = '<option  > データがありません。 </option>';
                $html_11 = '<option > データがありません。 </option>';
            }

            $result['html_bus_course'] = $html_0.$html_1.$html_2.$html_3.$html_4.$html_5.$html_6.$html_7.$html_8.$html_9.$html_10.$html_11.$html_12;
        }
        echo json_encode( $result );
        exit();       
    }
    //END DEV BAO VV_JSC
}

/* End of file member.php */
/* Location: ./application/controllers/admin/member.php */
