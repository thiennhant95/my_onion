<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/l_student_request_model','request');
        $this->load->model('db/l_student_course_model','student_course');
        $this->load->model('db/l_student_class_model','student_class');
        $this->load->model('student_model','student');
        $this->load->model('db/l_student_meta_model','student_meta');
        $this->load->model('db/m_bus_course_model','bus_course');
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_student_model','student_model');
        $this->load->model('db/l_student_event_model','event_model');
        $this->load->model('db/m_bus_route_model','bus_route');
        $this->load->model('db/m_bus_stop_model','bus_stop');
        $this->load->model('db/l_student_bus_route_model','student_bus_route');
        $this->load->library("pagination");
    }

    /**
     * 契約変更申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            admin_layout_view('request_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }


    /**
     * Ajax load list
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function ajax_load_list(){
        if ($this->error_flg) return;
        try {
            //load request list
            if (!$this->input->post('verify_submit')) {
                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/request/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
                $data['request_list'] = $this->request->get_list_request($pagin["per_page"], $data['page']);
                $pagin['total_rows'] = $data['request_list'][1];
                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();
                $list_search = $this->result_html($data['request_list'][0]);
                echo json_encode(array('list' => $list_search, 'pagination' => $data['pagination']));
                die();
            }

            //load request list search
            elseif ($this->input->post('verify_submit'))
            {
                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/request/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
                $data['request_list'] = $this->request->search_get_list_request($pagin["per_page"], $data['page']);
                $pagin['total_rows'] = $data['request_list'][1];
                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();
                $list_search = $this->result_html($data['request_list'][0]);
                echo json_encode(array('list' => $list_search, 'pagination' => $data['pagination']));
                die();
            }
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * Return html
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function result_html($data=NULL)
    {
        if ($this->error_flg) return;
        try {
            global $html;
            if ($data) {
                foreach ($data as $row):
                    switch ($row['type'])
                    {
                        case 'bus_change_once':
                            $row['type']='バス乗降連絡';
                            break;
                        case 'bus_change_eternal':
                            $row['type']='バスコース変更';
                            break;
                        case 'course_change':
                            $row['type']='練習コース変更';
                            break;
                        case 'recess':
                            $row['type']='休会届';
                            break;
                        case 'quit':
                            $row['type']='退会届';
                            break;
                        case 'event_entry':
                            $row['type']='イベント・短期教室参加申請';
                            break;
                        case 'address_change':
                            $row['type']='住所変更申請 ';
                            break;
                    }
                    switch ($row['status'])
                    {
                        case '0':
                            $row['status']='未処理/未確認';
                            break;
                        case '1':
                            $row['status']='承認/処理済み/確認済み';
                            break;
                        case '2':
                            $row['status']='保留';
                            break;
                    }
                    if ($row['process_date']==NULL)
                    {
                        $row['process_date']='---';
                    }
                    else
                    {
                        $row['process_date'] = date('Y-m-d', strtotime($row['process_date']));
                    }
                    switch ($row['comission_flg'])
                    {
                        case '0':
                            $row['comission_flg']='無';
                            break;
                        case '1':
                            $row['comission_flg']='手数料発生';
                            break;
                        case '2': $row['comission_flg']='免除';
                            break;
                    }
                    switch ($row['melody_flg'])
                    {
                        case '0':
                            $row['melody_flg']='未';
                            break;
                        case '1':
                            $row['melody_flg']='済';
                            break;
                    }
                    $row_content=json_decode($row['contents'],true);
                if ($row['comission_flg']=='免除') {
                    $html .= '
                          <tr>
                            <th>' . $row['student_id'] . '</th>
                            <td>' . $row['name'] . '</td> 
                            <td>' . date('Y-m-d',strtotime($row['create_date'])). '</td> 
                            <td>' . $row['type'] . '</td> 
                            <td>' . $row['status'] . '</td> 
                            <td>' . $row['process_date'] . '</td> 
                            <td style="color: red">' . $row['comission_flg'] . '</td> 
                            <td>' . $row['melody_flg'] . '</td>
                            <td><a href="' . site_url('admin/request/edit/' . $row['id']) . '" class="btn btn-success btn-sm btn-block">確認</a></td>                     
                         </tr>
                    ';
                }
                    if ($row['comission_flg']!='免除') {
                        $html .= '
                          <tr>
                            <th>' . $row['student_id'] . '</th>
                            <td>' . $row['name'] . '</td> 
                            <td>' . date('Y-m-d',strtotime($row['create_date'])). '</td> 
                            <td>' . $row['type'] . '</td> 
                            <td>' . $row['status'] . '</td> 
                            <td>' . $row['process_date']. '</td> 
                            <td>' . $row['comission_flg'] . '</td> 
                            <td>' . $row['melody_flg'] . '</td>
                            <td><a href="' . site_url('admin/request/edit/' . $row['id']) . '" class="btn btn-success btn-sm btn-block">確認</a></td>                     
                         </tr>
                    ';
                    }
                endforeach;
            }
            else {
                $html .= '
                          <tr>
                            <td colspan="9"><b>見つからない。</b></td>       
                         </tr>';
            }
            return $html;
        }
        catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /** Export CSV student request
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function export_csv()
    {
        if ($this->error_flg) return;
        try {
            $limit=LIMIT_CSV;
            $count_request=$this->request->export_csv(DATA_OFF,DATA_OFF,TRUE);
            $count_num=ceil($count_request/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->request->export_csv($limit,$offset,FALSE);
            }
            if (isset($data)) {
                array_unshift($data[0], array("ID", "生徒ID", "学生の名前", "申請日", "申請内容", "処理状況", "処理日", "手数料", "MEDLEY"));
                $this->load->helper('csv');
                array_to_csv($data, 'request_' . date('Ymd') . '.csv');
            }
            else
            {
                $this->session->set_flashdata('message', "<div class='alert alert-danger'>空のCSVをエクスポートすることはできません。</div>");
                redirect('admin/request');
            }
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * 契約変更申請一覧
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_request']=$this->request->select_by_id($id)[0];
            $data['get_request']['name']=$this->student->get_student_data($data['get_request']['student_id'])['meta']['name'];
            $contents=json_decode($data['get_request']['contents'],true);


            //get change course
            if ($data['get_request']['type']==COURSE_CHANGE)
            {
                $data['get_request']['old_course']=$this->course->select_by_id($contents['course_id_old'])[0]['course_name'];
                $data['get_request']['new_course']=$this->course->select_by_id($contents['course_id_new'])[0]['course_name'];
                $data['get_request']['old_course_id']=$this->course->select_by_id($contents['course_id_old'])[0]['id'];
                $data['get_request']['new_course_id']=$this->course->select_by_id($contents['course_id_new'])[0]['id'];
                $list=$this->class->get_list();
                foreach ($contents['list_class_old'] as $row_class_old)
                {
                    foreach ($list as $row_class)
                    {
                        if ($row_class['id']==$row_class_old)
                        {
                            $class_old[]=$row_class['class_code'];
                            $class_old_id[]=$row_class['id'];
                        }
                    }
                }

                foreach ($contents['list_class_new'] as $row_class_new)
                {
                    foreach ($list as $row_class)
                    {
                        if ($row_class['id']==$row_class_new)
                        {
                            $class_new[]=$row_class['class_code'];
                            $class_new_id[]=$row_class['id'];
                        }
                    }
                }

                $data['get_request']['class_old']=$class_old;
                $data['get_request']['class_new']=$class_new;
                $data['get_request']['class_old_id']=$class_old_id;
                $data['get_request']['class_new_id']=$class_new_id;

                //get change bus
                $get_bus_course = $this->request->get_where(array('student_id' => $data['get_request']['student_id'], 'type' => BUS_CHANGE_ETERNAL));
                if ($get_bus_course!=null) {
                    $contents = json_decode($get_bus_course[0]['contents'], true);
                    if ($get_bus_course[0] != NULL && empty($contents['class_id'])) {
                        $data['get_bus_course'] = $this->request->get_where(array('student_id' => $data['get_request']['student_id'], 'type' => BUS_CHANGE_ETERNAL))[0];
                    }
                    $get_change_course = $this->request->get_where(array('student_id' => $data['get_request']['student_id'], 'type' => COURSE_CHANGE));
                    $data['get_request']['bus_use_flg']=$contents['bus_use_flg'];
                    $data['change_date']['change_date']=$contents['change_date'];
                    unset($contents['bus_use_flg']);
                    unset($contents['change_date']);

                    //data change bus
                    foreach ($contents as $key_contents => $row_contents)
                    {
                        $class[]=$this->class->select_by_id($key_contents)['0'];
                        foreach ($row_contents as $child_contents)
                        {
                            if (isset($child_contents['bus_route_go_id_before'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_go_id_before'])[0];
                            }
                            if (isset($child_contents['bus_route_go_id_after'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_go_id_after'])[0];
                            }
                            if (isset($child_contents['bus_route_ret_id_before'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_ret_id_before'])[0];
                            }
                            if (isset($child_contents['bus_route_ret_id_after'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_ret_id_after'])[0];
                            }
                        }
                    }
                    foreach ($get_bus_route as $bus=> $bus_course)
                    {
                        foreach ($bus_course as $bus_course_key=>$bus_row)
                        {
                            $bus_row['bus_stop_name']=$this->bus_stop->select_by_id($bus_row['bus_stop_id'])[0]['bus_stop_name'];
                            $bus_row['bus_course_name']=$this->bus_course->select_by_id($bus_row['bus_course_id'])[0]['bus_course_name'];
                            $get_bus_route_new[$bus][] =$bus_row;
                        }
                    }
                    $data['get_request']['class']=$class;
                    $data['get_request']['body_content']=$get_bus_route_new;
                    foreach ($class as $class_row)
                    {
                        $name_class[]=$class_row['class_name'];
                        $id_class[]=$class_row['id'];
                    }
                    $get_bus_route_new=array_combine($name_class,$get_bus_route_new);
                    $data['get_request']['class_id']=$id_class;
                    $data['get_request']['content']=$get_bus_route_new;
                }
            }

            //get change  address
            if ($data['get_request']['type']==ADDRESS_CHANGE)
            {
                $data['get_request']['address_before']=$contents['address_before'];
                $data['get_request']['address_after']=$contents['address_after'];
            }

            //get event-short course
            if ($data['get_request']['type']==EVENT_TRY)
            {
                $data['get_request']['course_id']=$contents['course_id'];
                $data['get_request']['course_name']=$this->course->select_by_id($contents['course_id'])[0]['course_name'];
                $data['get_request']['memo']=$contents['memo'];
            }

            //get quit
            if ($data['get_request']['type']==QUIT)
            {
                $data['get_request']['quit_date']=$contents['quit_date'];
                $data['get_request']['reason']=$contents['reason'];
                $data['get_request']['memo']=isset($contents['memo'])?$contents['memo']:'';
            }

            //get recess
            if ($data['get_request']['type']==RECESS)
            {
                $data['get_request']['start_date']=$contents['start_date'];
                $data['get_request']['end_date']=$contents['end_date'];
                $data['get_request']['reason']=$contents['reason'];
            }

            //get change bus
            if ($data['get_request']['type']==BUS_CHANGE_ETERNAL)
            {
                $get_change_course = $this->request->get_where(array('student_id' => $data['get_request']['student_id'], 'type' => COURSE_CHANGE));
                    $data['get_request']['bus_use_flg']=$contents['bus_use_flg'];
                    $data['change_date']['change_date']=$contents['change_date'];
                    unset($contents['bus_use_flg']);
                    unset($contents['change_date']);
                    foreach ($contents as $key_contents => $row_contents)
                    {
                        $class[]=$this->class->select_by_id($key_contents)['0'];
                        foreach ($row_contents as $child_contents)
                        {
                            if (isset($child_contents['bus_route_go_id_before'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_go_id_before'])[0];
                            }
                            if (isset($child_contents['bus_route_go_id_after'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_go_id_after'])[0];
                            }
                            if (isset($child_contents['bus_route_ret_id_before'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_ret_id_before'])[0];
                            }
                            if (isset($child_contents['bus_route_ret_id_after'])) {
                                $get_bus_route[$key_contents][] = $this->bus_route->select_by_id($child_contents['bus_route_ret_id_after'])[0];
                            }
                        }
                    }
                    foreach ($get_bus_route as $bus=> $bus_course)
                    {
                        foreach ($bus_course as $bus_course_key=>$bus_row)
                        {
                            $bus_row['bus_stop_name']=$this->bus_stop->select_by_id($bus_row['bus_stop_id'])[0]['bus_stop_name'];
                            $bus_row['bus_course_name']=$this->bus_course->select_by_id($bus_row['bus_course_id'])[0]['bus_course_name'];
                            $get_bus_route_new[$bus][] =$bus_row;
                        }
                    }
                    $data['get_request']['class']=$class;
                    $data['get_request']['body_content']=$get_bus_route_new;
                    foreach ($class as $class_row)
                    {
                        $name_class[]=$class_row['class_name'];
                        $id_class[]=$class_row['id'];
                    }
                    $get_bus_route_new=array_combine($name_class,$get_bus_route_new);
                    $data['get_request']['class_id']=$id_class;
                    $data['get_request']['content']=$get_bus_route_new;
            }

            //update data request
            if ($this->input->post()) {
                $dataUpdate = array(
                    'id' => $id,
                    'message' => $this->input->post('message'),
                    'status' => $this->input->post('status'),
                    'comission_flg' => $this->input->post('comission_flg'),
                    'melody_flg' => $this->input->post('medley') ?: DATA_OFF,
                    'process_date' => date('Y-m-d'),
                );
                $this->request->update_by_id($dataUpdate);

                //if input status= 承認（処理済）
                if ($this->input->post('status') == ONE) {
                    if ($data['get_request']['status'] != ONE) {

                    //update address new
                    if (isset($_POST['address_after'])) {
                        $this->student_meta->update_student_meta($data['get_request']['student_id'], 'address', $this->input->post('address_after'));
                    }

                    //update quit
                    if (isset($_POST['quit_date'])) {
                        $quit_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'quit_date'"));
                        if ($quit_meta != null) {
                            $this->student_meta->update_student_meta($data['get_request']['student_id'], 'quit_date', $this->input->post('quit_date'));
                            $this->student_meta->update_student_meta($data['get_request']['student_id'], 'reason', $this->input->post('quit_date'));
                            $this->student_meta->update_student_meta($data['get_request']['student_id'], 'memo', $this->input->post('memo'));
                        } else {
                            $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'quit_date', 'value' => $this->input->post('quit_date')));
                            $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'reason', 'value' => $this->input->post('reason')));
                            if ($this->input->post('memo') != null) {
                                $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'memo', 'value' => $this->input->post('memo')));
                            }
                        }
                        $this->student_model->update_by_id(array('id' => $data['get_request']['student_id'], 'status' => THREE));
                    }

                    //update recess
                    if (isset($_POST['start_date'])) {
                        $recess_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'rest_start_date'"));
                        if ($recess_meta != null) {
                            $this->student_meta->update_student_meta($data['get_request']['student_id'], 'rest_start_date', $this->input->post('start_date'));
                            $this->student_meta->update_student_meta($data['get_request']['student_id'], 'rest_end_date', $this->input->post('end_date'));
                        } else {
                            $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'rest_start_date', 'value' => $this->input->post('start_date')));
                            $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'rest_end_date', 'value' => $this->input->post('end_date')));
                        }
                        $this->student_model->update_by_id(array('id' => $data['get_request']['student_id'], 'rest_flg' => TWO));
                    }

                    //update event entry
                    if (isset($_POST['event_course_id'])) {
                        $check_event = $this->event_model->get_list(array('course_id' => '=' . $this->input->post('event_course_id'), 'student_id' => '=' . $data['get_request']['student_id']));
                        if ($check_event == null) {
                            $this->event_model->insert(array('student_id' => $data['get_request']['student_id'], 'course_id' => $this->input->post('event_course_id')));
                        }
                    }

                    //update change bus
                    if (isset($_POST['type_bus']))
                    {
                        //not use bus
                        if (isset($_POST['not_use_bus']))
                        {
                            $use_bus_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'bus_use_flg'"));
                            if ($use_bus_meta!=null)
                            {
                                $this->student_meta->update_student_meta($data['get_request']['student_id'], 'bus_use_flg', ZERO);
                            }
                            else if ($use_bus_meta==null)
                            {
                                $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'bus_use_flg', 'value' =>ZERO));
                            }
                        }

                        //use bus
                        if (isset($_POST['use_bus']))
                        {
                            $use_bus_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'bus_use_flg'"));
                            if ($use_bus_meta!=null)
                            {
                                $this->student_meta->update_student_meta($data['get_request']['student_id'], 'bus_use_flg', ONE);
                            }
                            else if ($use_bus_meta==null)
                            {
                                $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'bus_use_flg', 'value' =>ONE));
                            }
                            $postvalue = unserialize(base64_decode($_POST['body_content']));
                            foreach ($postvalue as $key_content =>$row_content)
                            {
                                $this->student_bus_route->edit_by_where(array('student_id' => $data['get_request']['student_id'], 'student_class_id' => $key_content,'bus_route_go_id'=>$row_content['0']['id'],'bus_route_ret_id'=>$row_content['2']['id']),array('bus_route_go_id'=>$row_content['1']['id'],'bus_route_ret_id'=>$row_content['3']['id']));
                            }
                        }
                    }

                    //update course
                    if (isset($_POST['type_course'])) {
                            //update student course
                            $this->student_course->edit_by_where(array('student_id' => $data['get_request']['student_id'], 'course_id' => $this->input->post('course_old')), array('course_id' => $this->input->post('course_new')));

                            // delete old class if new class < old class (delete_flg=1)
                            if (count($_POST['class_new']) < count($_POST['class_old'])) {
                                $class_old = array_slice($_POST['class_old'], count($_POST['class_new']));
                                foreach ($class_old as $old) {
                                    $this->student_class->edit_by_where(array('student_id' => $data['get_request']['student_id'], 'class_id' => $old), array('delete_flg' => DATA_ON));
                                }
                            }

                            //update student class
                            foreach ($_POST['class_old'] as $old_key => $old) {
                                foreach ($_POST['class_new'] as $new_key => $new) {
                                    if ($old_key == $new_key) {
                                        $this->student_class->edit_by_where(array('student_id' => $data['get_request']['student_id'], 'class_id' => $old), array('class_id' => $new, 'student_course_id' => $this->input->post('course_new')));
                                    }
                                }
                            }

                            // add student new class if new class > old class
                            if (count($_POST['class_new']) > count($_POST['class_old'])) {
                                $class_new = array_slice($_POST['class_new'], count($_POST['class_old']));
                                foreach ($class_new as $new) {
                                    $dataInsert = array(
                                        'student_course_id' => $this->input->post('course_new'),
                                        'student_id' => $data['get_request']['student_id'],
                                        'class_id' => $new
                                    );
                                    $this->student_class->insert($dataInsert);
                                }
                            }
                        }

                        //update bus course
                        if (isset($_POST['type_bus_course'])) {

                            $dataUpdate = array(
                                'id'=>$_POST['request_bus_id'],
                                'status' => ONE,
                                'comission_flg' => $this->input->post('comission_flg_bus'),
                                'melody_flg' => $this->input->post('medley_bus') ?: DATA_OFF,
                                'process_date' => date('Y-m-d'),
                            );
                            $this->request->update_by_id($dataUpdate);
                            //not use bus
                            if (isset($_POST['not_use_bus']))
                            {
                                $use_bus_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'bus_use_flg'"));
                                if ($use_bus_meta!=null)
                                {
                                    $this->student_meta->update_student_meta($data['get_request']['student_id'], 'bus_use_flg', ZERO);
                                }
                                else if ($use_bus_meta==null)
                                {
                                    $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'bus_use_flg', 'value' =>ZERO));
                                }
                            }

                            //use bus
                            if (isset($_POST['use_bus']))
                            {
                                $use_bus_meta = $this->student_meta->get_list(array('student_id' => '=' . $data['get_request']['student_id'], 'tag' => '=' . "'bus_use_flg'"));
                                if ($use_bus_meta!=null)
                                {
                                    $this->student_meta->update_student_meta($data['get_request']['student_id'], 'bus_use_flg', ONE);
                                }
                                else if ($use_bus_meta==null)
                                {
                                    $this->student_meta->insert(array('student_id' => $data['get_request']['student_id'], 'tag' => 'bus_use_flg', 'value' =>ONE));
                                }
                                $postvalue = unserialize(base64_decode($_POST['body_content']));
                                foreach ($postvalue as $key_content =>$row_content)
                                {
                                    $this->student_bus_route->edit_by_where(array('student_id' => $data['get_request']['student_id'], 'student_class_id' => $key_content,'bus_route_go_id'=>$row_content['0']['id'],'bus_route_ret_id'=>$row_content['2']['id']),array('bus_route_go_id'=>$row_content['1']['id'],'bus_route_ret_id'=>$row_content['3']['id']));
                                }
                            }
                        }
                    }
            }
                echo json_encode(array('status'=>DATA_ON));
                die();
            }
            $this->viewVar=$data;
            admin_layout_view('request_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
}

/* End of file request.php */
/* Location: ./application/controllers/admin/request.php */