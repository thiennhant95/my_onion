<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model','member_model');
        $this->load->library("pagination");
    }
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
            $this->view(0);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    //DEV TRÍ VV_JSC
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
        return $html;
    }

    //end code tìm kiếm

    //export CSV
    public function export_filter() {
        if ($this->error_flg) return;
        try {
            if(isset($_POST['data_input_search'])){
                if(!empty($_POST['data_input_search'])){
                    $limit_record = 10;
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
    public function UpdateInfoMember($id = NULL)
    {
        if ($id==NULL) return;
        $this->load->model('db/l_student_meta_model');
        $this->load->model('db/m_student_model');
        $this->load->model('db/l_student_course_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/l_student_bus_route_model');
        $info_data = isset($_POST['infodata'])?$_POST['infodata']:'';
        $meta_data = isset($_POST['metadata'])?$_POST['metadata']:'';
        $course_join = isset($_POST['course_join'])?$_POST['course_join']:'';
        $course_class_join = isset($_POST['course_class_join'])?$_POST['course_class_join']:'';
        $bus_route_join = isset($_POST['bus_route_join'])?$_POST['bus_route_join']:'';

        if($info_data=='' || $meta_data=='' || $course_join== '') {echo "UnSuccessfully";exit();}

        if( $this->m_student_model->new_update_by_id($info_data,$id) )
        {
            if($this->l_student_meta_model->update_tagMeta($meta_data,$id))
            {
                if($this->l_student_course_model->Update_course($course_join))
                {
                    if($this->l_student_class_model->Update_class($course_class_join))
                    {
                        echo "Successfully";
                        exit();
                    }  
                }  
            }  
        }
        else
        {
            echo "UnSuccessfully";
            exit();
        }
        
    }
    public function get_data_bus_stop()
    {
        
        $course_id = isset($_GET['course_id'])?$_GET['course_id']:'';
        if ($course_id==='') return;
        $this->load->model('db/m_bus_course_model');
        $result = $this->m_bus_course_model->getData_Bus_stop_by_id($course_id);

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
        $course_id = isset($_POST['course_id'])?$_POST['course_id']:'';
        $student_id = isset($_POST['student_id'])?$_POST['student_id']:'';
        if($course_id!='' && $student_id!='')
        {
            $this->load->model('db/m_course_model');
            $this->load->model('db/l_student_class_model');
            $this->load->model('db/l_student_course_model');
            $this->load->model('db/m_bus_course_model');
            $this->load->model('db/l_student_bus_route_model');
            $this->load->model('db/m_bus_route_model');
            $course = array();

                $classes = $this->m_course_model->getData_class_by_id($course_id);
                foreach ($classes as $key => $value) {
                    $course['classes'][]=$value;
                }
            
                $classesjoin = $this->l_student_course_model->get_valid_course_by($course_id,$student_id);
                foreach ($classesjoin as $key => $value) {
                    $course['classjoin'][]=$value;
                }
// echo json_encode($course);
//             exit();
                if(count($classesjoin)>0)
                {
                     //student join bus_route
                    foreach ($classesjoin as $key => $value) {

                    $course['bus_course']['all'][$key]['arr'] = $this->m_bus_course_model->get_data_class_and_bus_course($value['class_id']);
                    $bus_coures = $course['bus_course']['all'][$key]['arr'];
                    foreach($bus_coures as $subkey =>$subvalue){
                        $course['bus_course']['all'][$key]['arr'][$subkey]['bus_stop'][] = $this->m_bus_course_model->getData_Bus_stop_by_id($subvalue['id']);
                    }
                   
                    $course['bus_course']['all'][$key]['student_join_route'] = $this->l_student_bus_route_model->select_by_id($value['student_class_id'],'student_class_id') ;
                    $student_join_route = $course['bus_course']['all'][$key]['student_join_route']; 

                    $course['bus_course']['all'][$key]['student_join_route']['bus_go'] = $this->m_bus_route_model->select_by_id($student_join_route[0]['bus_route_go_id'],'id');
                    $course['bus_course']['all'][$key]['student_join_route']['bus_ret'] = $this->m_bus_route_model->select_by_id($student_join_route[0]['bus_route_ret_id'],'id');
                    }
                    
                    if(count($course['bus_course']['all'])>0)
                    {
                        $html = array();
                        foreach ($course['bus_course']['all'] as $key => $value) {
                          
                          $week = ($this->config->item('my_config'))['week_num'];
                          $week_num = 0;
                          $index = random_string('alnum', 10);
                          $base_class_sign = '';
                          $class_name ='';
                          $class_id = '';
                          $html_2='';
                          $html_5= '';
                          $html_8='';
                          $html_11='';

                          $id_go = isset($value['student_join_route']['bus_go'][0]['bus_course_id'])?$value['student_join_route']['bus_go'][0]['bus_course_id']:'';
                          $id_ret = isset($value['student_join_route']['bus_ret'][0]['bus_course_id'])?$value['student_join_route']['bus_ret'][0]['bus_course_id']:'';
                          $id_stop_go = isset($value['student_join_route']['bus_go'][0]['bus_stop_id'])?$value['student_join_route']['bus_go'][0]['bus_stop_id']:'';
                          $id_stop_ret = isset($value['student_join_route']['bus_ret'][0]['bus_stop_id'])?$value['student_join_route']['bus_ret'][0]['bus_stop_id']:'';

                            foreach ($value['arr'] as $subkey => $subvalue) {

                                $selected_go = '';
                                $selected_ret = '';
                                $selected_stop_go='';
                                $selected_stop_ret = '';
                                $base_class_sign = $subvalue['base_class_sign'];
                                $class_name = $subvalue['class_name'];
                                $class_id = $subvalue['class_id'];

                                  foreach ($course['classjoin'] as $element) {
                                      if($element['class_id']==$class_id)
                                      {
                                            $week_num = $element['week_num'];
                                      }
                                  }

                                if($subvalue['id']===$id_go)
                                {
                                  $selected_go = "selected";
                                  if($subvalue['bus_stop'])
                                  {
                                    foreach ($subvalue['bus_stop'][0] as $sub_key_stop => $sub_value_stop) {
                                      if($sub_value_stop['bus_stop_id']===$id_stop_go) $selected_stop_go = "selected";
                                      $html_5.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_go.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                      $selected_stop_go ='';
                                    }
                                  }  
                                } 
                                $html_2.= '<option value='.$subvalue['id'].' '.$selected_go.'>'.$subvalue['bus_course_name'].'</option>';


                                if($subvalue['id']===$id_ret) 
                                {
                                  $selected_ret = "selected";
                                  if($subvalue['bus_stop'])
                                  {
                                    foreach ($subvalue['bus_stop'][0] as $sub_key_stop => $sub_value_stop) {
                                      if($sub_value_stop['bus_stop_id']===$id_stop_ret) $selected_stop_ret = "selected";
                                      $html_11.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_ret.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                      $selected_stop_ret='';
                                    }
                                  }
                                }
                                $html_8.= '<option value='.$subvalue['id'].' '.$selected_ret.'>'.$subvalue['bus_course_name'].'</option>'; 
                            }
                          $html_0 ='<div class="element_bus_course" data-sign="'.$base_class_sign.'-'.$week_num.'" data-id="'.$class_id.'"><div for="" class"col-sm-2 control-label " id="classnameforbus">'.$week[$week_num].'<br>('.$class_name.')</div>';
                          $html_1 ='<div class="form-group">
                                  <label for="" class="col-sm-2 control-label">行き</label>
                                  <div class="col-sm-5">
                                  <select class="form-control bus_course" name="bus_course_go_'.$index.'" onchange="changeBuscoure(this)">';
                          $html_3 ='</select>
                                    </div>';
                          $html_4 ='<div class="col-sm-5">
                                    <select class="form-control bus_stop" name="bus_stop_go_'.$index.'" >';
                          $html_6 ='</select>
                                    </div>
                                    </div>';
                          $html_7 = '<div class="form-group">
                                  <label for="" class="col-sm-2 control-label">帰り</label>
                                  <div class="col-sm-5">
                                  <select class="form-control bus_course" name="bus_course_ret_'.$index.'" onchange="changeBuscoure(this)">';
                          $html_9 = '</select>
                                     </div>';
                          $html_10 = '<div class="col-sm-5">
                                  <select class="form-control bus_stop" name="bus_stop_ret_'.$index.'" >';
                          $html_12 = '</select></div></div></div>';

                            $html[]=$html_0.$html_1.$html_2.$html_3.$html_4.$html_5.$html_6.$html_7.$html_8.$html_9.$html_10.$html_11.$html_12;
                        } 

                        $course['bus_course']['html_select_bus_course'] =  $html;
                    }
                }
            echo json_encode($course);
            exit();
        }
    }
    public function add_bus_course_view()
    {
        
        $class_id = isset($_POST['class_id'])?$_POST['class_id']:'';
        $class_name = isset($_POST['class_name'])?$_POST['class_name']:'';
        $base_class_sign =  isset($_POST['base_class_sign'])?$_POST['base_class_sign']:'';
        $week = isset($_POST['week_num'])?$_POST['week_num']:'';
        if($class_name==''|| $class_id==''|| $week=='' || $base_class_sign=='') exit();
        $this->load->model('db/m_bus_course_model');

        $bus_couse = $this->m_bus_course_model->select_by_id($class_id,'class_id');
        
        if(count($bus_couse)>0)
        {
            foreach($bus_couse as $key=>$value)
            {
                $bus_couse[$key]['bus_stop']=$this->m_bus_course_model->getData_Bus_stop_by_id($value['id']);
            }

              $week_num = ($this->config->item('my_config'))['week_num'];
              $index = random_string('alnum', 10);
              $html_0 ='<div class="element_bus_course" data-sign="'.$base_class_sign.'-'.$week.'" data-id="'.$class_id.'"><div for="" class"col-sm-2 control-label " id="classnameforbus">'.$week_num[$week].'<br>('.$class_name.')</div>';
              $html_1 ='<div class="form-group">
                      <label for="" class="col-sm-2 control-label">行き</label>
                      <div class="col-sm-5">
                      <select class="form-control bus_course" name="bus_course_go_'.$index.'" onchange="changeBuscoure(this)">';
              $html_2='';
              $html_3 ='</select>
                        </div>';
              $html_4 ='<div class="col-sm-5">
                        <select class="form-control bus_stop" name="bus_stop_go_'.$index.'" >';
              $html_5= '';
              $html_6 ='</select>
                        </div>
                        </div>';
              $html_7 = '<div class="form-group">
                      <label for="" class="col-sm-2 control-label">帰り</label>
                      <div class="col-sm-5">
                      <select class="form-control bus_course" name="bus_course_ret_'.$index.'" onchange="changeBuscoure(this)">';
              $html_8='';
              $html_9 = '</select>
                         </div>';
              $html_10 = '<div class="col-sm-5">
                      <select class="form-control bus_stop" name="bus_stop_ret_'.$index.'" >';
              $html_11 ='';
              $html_12 = '</select></div></div></div>';
              
              
              foreach ($bus_couse as $key => $value) {
                $selected = '';
                if($key==0) $selected ="seleceted";
                   $html_2.= '<option value='.$value['id'].' '.$selected.' >'.$value['bus_course_name'].'</option>';
                   $html_8.= '<option value='.$value['id'].'>'.$value['bus_course_name'].'</option>';

                   foreach($bus_couse[$key]['bus_stop'] as $subkey=>$subvalue)
                  {
                    if($key==0)
                    {
                        $html_5.= '<option value='.$subvalue['bus_stop_id'].'>【'.$subvalue['bus_stop_code'].'】'.$subvalue['bus_stop_name'].'</option>';
                        $html_11.= '<option value='.$subvalue['bus_stop_id'].'>【'.$subvalue['bus_stop_code'].'】'.$subvalue['bus_stop_name'].'</option>';
                    }
                  }
              }
              echo $html_0.$html_1.$html_2.$html_3.$html_4.$html_5.$html_6.$html_7.$html_8.$html_9.$html_10.$html_11.$html_12;
            exit();
        }
            
    }
    //END DEV BAO VV_JSC
}

/* End of file member.php */
/* Location: ./application/controllers/admin/member.php */