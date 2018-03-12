<?php
//-------------------------------------------------------
// 
// システム用モデル
// ※このモデルで直接DBを操作しないこと
// 
//-------------------------------------------------------
class Member_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('student_model','student');
    }

    public function get_list_member_all($limit, $start)
    {
        $query = "SELECT SQL_CALC_FOUND_ROWS `STD`.`id`, `lsm`.`student_id`, `lsco`.`student_id`, `lsco`.`course_id`, `lsm`.`tag`, `lsm`.`value`,`lstc`.`student_id`, `STD`.`status`, `mcls`.`id`, `mcls`.`base_class_sign`, `mcls`.`class_name`, `mco`.`course_name`, `mbr`.`id`, `lsbr`.`bus_route_ret_id`, `mbst`.`id`, `mbr`.`bus_stop_id`, `mbst`.`bus_stop_name` FROM (`m_student` STD) LEFT JOIN `l_student_meta` lsm ON `std`.`id` = `lsm`.`student_id` LEFT JOIN `l_student_course` lsco ON `lsm`.`student_id` = `lsco`.`student_id` LEFT JOIN `m_course` mco ON `mco`.`id` = `lsco`.`course_id` LEFT JOIN `l_student_class` lstc ON `lstc`.`student_id` = `STD`.`id` LEFT JOIN `m_class` mcls ON `mcls`.`id` = `lstc`.`class_id` LEFT JOIN `l_student_bus_route` lsbr ON `lsbr`.`student_id` = `STD`.`id` LEFT JOIN `m_bus_route` mbr ON `mbr`.`id` = `lsbr`.`bus_route_ret_id` LEFT JOIN `m_bus_stop` mbst ON `mbst`.`id` = `mbr`.`bus_stop_id` WHERE `lsm`.`tag` = 'name'  GROUP BY `std`.`id`  LIMIT $limit OFFSET $start";
        $data = $this->db->query($query)->result_array();
        $query_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $total = $query_total->row()->count;

        return array('0'=>$data,'1'=>$total);
        // $this->db->select('SQL_CALC_FOUND_ROWS m_student.id, l_student_meta.tag, l_student_meta.value, l_student_course.student_id, l_student_course.course_id, m_student.status, m_class.base_class_sign, m_class.class_name, m_course.course_name, l_student_bus_route.bus_route_ret_id, m_bus_route.bus_stop_id, m_bus_stop.bus_stop_name',FALSE);

        // $this->db->from('m_student');
        // $this->db->join('l_student_meta' , 'l_student_meta.student_id = m_student.id', 'left');
        // $this->db->join('l_student_course' , 'l_student_course.student_id = m_student.id', 'left');
        // $this->db->join('m_course', 'm_course.id = l_student_course.course_id', 'left');
        // $this->db->join('l_student_class', 'l_student_class.student_id = m_student.id', 'left');
        // $this->db->join('m_class', 'm_class.id = l_student_class.class_id', 'left');
        // $this->db->join('l_student_bus_route', 'l_student_bus_route.student_id = m_student.id', 'left');
        // $this->db->join('m_bus_route', 'm_bus_route.id = l_student_bus_route.bus_route_ret_id', 'left');
        // $this->db->join('m_bus_stop', 'm_bus_stop.id = m_bus_route.bus_stop_id', 'left');
        // $this->db->where('m_student.delete_flg','0');
        // $this->db->where('l_student_meta.tag','name');
        // $this->db->group_by("m_student.id");
        // $this->db->limit($limit,$start);

        // $data = $this->db->get()->result_array();
        // $query_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        // $total = $query_total->row()->count;

        // return array('0'=>$data,'1'=>$total);

        
    }

    public function check_valid_tag($array_data)
    {
        $status = FALSE;
        foreach ($array_data as $key => $value) {
                if(($key == 'id_from')||($key == 'all_user')||($key == 'id_to')||($key == 'sub_user')||
                ($key == 'class_from')||($key == 'class_to')||($key == 'level_from')||($key == 'level_to')
                ||($key == 'practice_course_from')||($key == 'practice_course_to')){
                    
                }else{
                    if($value != ''){
                        $status = TRUE;//input tag có ít nhất một trường có giá trị
                        break;
                    }
                }
        }
        return  $status;
    }

    public function check_valid_condition2($array_data)
    {
        $status = FALSE;
        foreach ($array_data as $key => $value) {
                if(($key == 'class_from')||($key == 'class_to')||($key == 'level_from')||($key == 'level_to')
                ||($key == 'practice_course_from')||($key == 'practice_course_to')){
                    if($value != ''){
                        $status = TRUE;//input tag có ít nhất một trường có giá trị
                        break;
                    }
                }else if(($key == 'all_user')||($key == 'sub_user')){
                    if($value == "true"){
                        $status = TRUE;//input tag có ít nhất một trường có giá trị
                        break;
                    }
                }
        }
        return  $status;
    }

    public function get_student_meta_tag($student_id)
    {
        
        $result = $this->student->select_by_id($student_id, 'student_id', 'l_student_meta');
        $data = [];
        foreach ($result as $row) {
            $data['meta'][$row['tag']] = $row['value'];
        }
        return $data;
    }
    public function check_null($array_input)
    {   
        $arr_item_not_null = [];
        foreach ($array_input as $key => $value) {
            if(($key == 'id_from')||($key == 'all_user')||($key == 'id_to')||($key == 'sub_user')||
                ($key == 'class_from')||($key == 'class_to')||($key == 'level_from')||($key == 'level_to')
                ||($key == 'practice_course_from')||($key == 'practice_course_to')){
                    
                }else{
                    if($value != ''){
                        $arr_item_not_null[] = $key;
                    }
                }
            
        }
        return $arr_item_not_null;
    }

    public function conver_date_time($db_time)
    {
        $rel = !empty($db_time) ? strtotime($db_time) : NULL;
        return $rel;
    }
    public function filter_list_member($limit, $start, $type)
    {
        $data_filltered = [];
        $data_search_rel  = [];
        $data_search_filtered = [];

        $data_input_condition = $this->input->post('data_input_search');
        $tmp_conver = is_array($data_input_condition) ? NULL : json_decode($data_input_condition, true);
        $data_input_condition = !empty($tmp_conver) ? $tmp_conver : $data_input_condition;
        $value_id_form = $data_input_condition['id_from'];
        $value_id_to = $data_input_condition['id_to'];
        $check_space_id_f = ctype_space($value_id_form);
        $check_space_id_t = ctype_space($value_id_to);

        $this->db->select('m_student.id, l_student_course.student_id, l_student_course.course_id, m_student.status, m_class.base_class_sign, m_class.class_name, m_course.course_name, l_student_bus_route.bus_route_ret_id, m_bus_route.bus_stop_id, m_bus_stop.bus_stop_name');
        $this->db->from('m_student');
        $this->db->join('l_student_course' , 'l_student_course.student_id = m_student.id', 'left');
        $this->db->join('m_course', 'm_course.id = l_student_course.course_id', 'left');
        $this->db->join('l_student_class', 'l_student_class.student_id = m_student.id', 'left');
        $this->db->join('m_class', 'm_class.id = l_student_class.class_id', 'left');
        $this->db->join('l_student_bus_route', 'l_student_bus_route.student_id = m_student.id', 'left');
        $this->db->join('m_bus_route', 'm_bus_route.id = l_student_bus_route.bus_route_ret_id', 'left');
        $this->db->join('m_bus_stop', 'm_bus_stop.id = m_bus_route.bus_stop_id', 'left');
        $this->db->where('m_student.delete_flg','0');
            
        if(!$check_space_id_f && !$check_space_id_t){
            if(!empty($value_id_form)){
                $condition_filter_id_from  = array('m_student.id >=' => $value_id_form );
                $this->db->where($condition_filter_id_from);
            }
            if(!empty($value_id_to)){
                $condition_filter_id_to  = array('m_student.id <=' => $value_id_to);
                $this->db->where($condition_filter_id_to);
            }
        }

        $check_info_course = $this->check_valid_condition2($data_input_condition);
        if($check_info_course){

            $cdt_course_from = $data_input_condition['practice_course_from'];
            $cdt_course_to = $data_input_condition['practice_course_to'];
            $check_space_cf = ctype_space($cdt_course_from);
            $check_space_cto = ctype_space($cdt_course_to);

            if($check_space_cf && $check_space_cto){
                $condition_filter_id  = array('l_student_course.course_id >=' => $value_id_form , 'l_student_course.course_id <=' => $value_id_to);
                $this->db->where($condition_filter_id);
            }
            //còn các đk khóa học, lớp học, cấp đang chờ khách hàng xác nhận
            if($data_input_condition['all_user'] != true){
                $condition_exit_group = array('m_student.status !=' => 3 );
                $this->db->where($condition_exit_group);
            }

            if($data_input_condition['sub_user'] == true){
                $condition_exit_group = array('m_student.status !=' => 3 );
                $this->db->where($condition_exit_group);
            }

        }
        $this->db->order_by('m_student.id', 'ASC');
        $this->db->group_by("m_student.id");
        $data_rel_tmp = $this->db->get()->result_array();
        $check_tag_condition = $this->check_valid_tag($data_input_condition);
        $data_filltered = $data_rel_tmp;
      
        if(!empty($data_rel_tmp)){
            foreach ($data_rel_tmp as $row_rel) {

                $rel_meta = $this->get_student_meta_tag($row_rel['id']);
                if(!empty($rel_meta['meta'])){
                    $row_rel['name'] = isset($rel_meta['meta']['name']) ? $rel_meta['meta']['name'] : '';
                    $row_rel['name_kana'] = isset($rel_meta['meta']['name_kana']) ? $rel_meta['meta']['name_kana'] : '';
                    $row_rel['birthday'] = isset($rel_meta['meta']['birthday']) ? $rel_meta['meta']['birthday'] : '';
                    $row_rel['sex'] = isset($rel_meta['meta']['sex']) ? $rel_meta['meta']['sex'] : '';
                    $row_rel['zip'] = isset($rel_meta['meta']['zip']) ? $rel_meta['meta']['zip'] : '';   
                    $row_rel['address'] = isset($rel_meta['meta']['address']) ? $rel_meta['meta']['address'] : '';
                    $row_rel['tel'] = isset($rel_meta['meta']['tel']) ? $rel_meta['meta']['tel'] : '';
                    $row_rel['enter_date'] = isset($rel_meta['meta']['enter_date']) ? $rel_meta['meta']['enter_date'] : '';
                    $row_rel['emergency_tel'] = isset($rel_meta['meta']['emergency_tel']) ? $rel_meta['meta']['emergency_tel'] : '';
                    $row_rel['rest_start_date'] = isset($rel_meta['meta']['rest_start_date']) ? $rel_meta['meta']['rest_start_date'] : '';
                    $row_rel['quit_reason'] = isset($rel_meta['meta']['quit_reason']) ? $rel_meta['meta']['quit_reason'] : '';
                    $row_rel['quit_date'] = isset($rel_meta['meta']['quit_date']) ? $rel_meta['meta']['quit_date'] : '';         
                }
                $data_search_rel[] = $row_rel;                    
            }
            
            $check_null_list = $this->check_null($data_input_condition);

            if($check_tag_condition){

                foreach ($data_search_rel as $row_fill) {

                    $flag_status = FALSE;
                    if(!empty($check_null_list)){

                        foreach ($check_null_list as $key => $value) {

                            switch ($value) {
                                case 'leave_duration_from':

                                        $tmp_conver_date_input = $this->conver_date_time($data_input_condition[$value]);
                                        $tmp_conver_date_data = $this->conver_date_time($row_fill['rest_start_date']);

                                        $flag_status = (!empty($tmp_conver_date_data)) && ($tmp_conver_date_data >= $tmp_conver_date_input ) ? TRUE : FALSE;
                                    break;

                                case 'drawal_date_from':

                                        $tmp_conver_date_input = $this->conver_date_time($data_input_condition[$value]);
                                        $tmp_conver_date_data = $this->conver_date_time($row_fill['quit_date']);

                                        $flag_status = (!empty($tmp_conver_date_data)) && ($tmp_conver_date_data >= $tmp_conver_date_input ) ? TRUE : FALSE;
                                    break;

                                case 'leave_duration_to':
                                
                                        $tmp_conver_date_input = $this->conver_date_time($data_input_condition[$value]);
                                        $tmp_conver_date_data = $this->conver_date_time($row_fill['rest_start_date']);
                                        
                                        $flag_status = (!empty($tmp_conver_date_data)) && ($tmp_conver_date_data <= $tmp_conver_date_input ) ? TRUE : FALSE;
                                    break;
                                case 'drawal_date_to':
                                
                                        $tmp_conver_date_input = $this->conver_date_time($data_input_condition[$value]);
                                        $tmp_conver_date_data = $this->conver_date_time($row_fill['quit_date']);
                                        
                                        $flag_status = (!empty($tmp_conver_date_data)) && ($tmp_conver_date_data <= $tmp_conver_date_input ) ? TRUE : FALSE;
                                    break;
                                
                                default:
                                        $flag_status = (strlen(strstr($row_fill[$value], $data_input_condition[$value])) > 0) ? TRUE : FALSE;
                                    break;
                            }
                            if(!$flag_status){
                                break;
                            }
                        }
                    }
                    if($flag_status){
                        $data_search_filtered[] = $row_fill;
                    }
                }
                $data_filltered = $data_search_filtered;    
            }else{
                $data_filltered = $data_search_rel;    
            }
                        
        }
        
        $total = count($data_filltered);
        
        $rel = ($type == FILTER_ACTION) || ($type == CSV_ACTION_UN_GET_TOTAL) ? array_slice( $data_filltered, $start, $limit) : NULL;
        if($type == CSV_ACTION_UN_GET_TOTAL){
            return $rel;
        }else{
            return array('0'=>$rel,'1'=>$total);
        }
        
    }
    
    public function filer_type_singe_condition($limit,$start)
    {
        if(isset($_POST['text_condition'])){
            
            $input_search = $this->input->post('text_condition');
            $type_search = $this->input->post('type_condition');
            
            $this->db->select('SQL_CALC_FOUND_ROWS m_student.id, l_student_course.student_id, l_student_course.course_id, m_student.status, m_class.base_class_sign, m_class.class_name, m_course.course_name, l_student_bus_route.bus_route_ret_id, m_bus_route.bus_stop_id, m_bus_stop.bus_stop_name, l_student_meta.tag, l_student_meta.value',FALSE);
            $this->db->from('m_student');
            $this->db->join('l_student_meta' , 'l_student_meta.student_id = m_student.id', 'left');
            $this->db->join('l_student_course' , 'l_student_course.student_id = m_student.id', 'left');
            $this->db->join('m_course', 'm_course.id = l_student_course.course_id', 'left');
            $this->db->join('l_student_class', 'l_student_class.student_id = m_student.id', 'left');
            $this->db->join('m_class', 'm_class.id = l_student_class.class_id', 'left');
            $this->db->join('l_student_bus_route', 'l_student_bus_route.student_id = m_student.id', 'left');
            $this->db->join('m_bus_route', 'm_bus_route.id = l_student_bus_route.bus_route_ret_id', 'left');
            $this->db->join('m_bus_stop', 'm_bus_stop.id = m_bus_route.bus_stop_id', 'left');
            $this->db->where('m_student.delete_flg','0');

            $condition_filter = array();
            switch ($type_search) {
                case 'id':
                    $this->db->like('m_student.id', $input_search);
                    break;
                case 'practice_course':
                    $this->db->like('m_course.course_name', $input_search);
                    break;
                case 'level':
                    $this->db->like('m_class.base_class_sign', $input_search);
                    break;
                case 'class_current':
                    $this->db->like('m_class.class_name', $input_search);
                    break;
                default:
                    $this->db->like('l_student_meta.value', $input_search);
                    $this->db->where('l_student_meta.tag',$type_search);
                    break;
            }

            $this->db->order_by('m_student.id', 'ASC');
            $this->db->group_by("m_student.id");
            $this->db->limit($limit,$start);

            $data = $this->db->get()->result_array();
            $query_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
            $total = $query_total->row()->count;

            return array('0'=>$data,'1'=>$total);

        }
        

    }
}
