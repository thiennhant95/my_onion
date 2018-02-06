<?php
//-------------------------------------------------------
// 
// 生徒処理用モデル
// ※このモデルで直接DBを操作しないこと
// 
//-------------------------------------------------------
class Student_model extends DB_Model {

    // 生徒情報
    protected $student = array();
    protected $student_copy = array();

    // 生徒コース情報
    protected $student_course = array();

    protected $student_id = NULL;

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('db/m_student_model');
        $this->load->model('db/l_student_meta_model');
        $this->load->model('db/l_student_course_model');
        $this->load->model('db/l_student_class_model');
        $this->load->model('db/l_student_bus_route_model');
        $this->load->model('db/m_course_model');
        $this->load->model('db/m_bus_course_model');
        $this->load->model('db/m_distance_model');
    }

    /**
     * 生徒IDを指定して生徒情報を取得する
     * @param   
     * @return  
     */
    public function get_student_data($student_id) {
        // 返却値配列
        $this->student = array(
            'info'      => array(), // 基本情報
            'meta'      => array(), // メタデータ
            'family'    => array(), // 他の家族会員情報
            'course'    => array(   // コース情報
                'all'               => array(),
                'free_course'       => array(),
                'limited_course'    => array(),
                'valid'             => array(),
            ), 
            'class'     => array(   // クラス情報
                'all'       => array(),
                'valid'     => array(),
            ),
            'bus_route' => array(   // バス利用情報
                'all'       => array(),
                'valid'     => array(),
            ),
        );

        if ($student_id == $this->student_id) {
            return $this->student_copy;
        }

        $this->student_id = $student_id;

        // 生徒基本情報取得
        $result = $this->m_student_model->select_by_id($student_id);
        if (empty($result)) return $this->student;
        $this->student['info'] = $result[0];

        // メタデータ取得
        $result = $this->l_student_meta_model->select_by_id($student_id, 'student_id');
        foreach ($result as $row) {
            $this->student['meta'][ $row['tag'] ] = $row['value'];
        }

        // 他の家族会員情報取得
        $result = $this->m_student_model->get_family($student_id);
        foreach ($result as $row) {
            $this->student['family'][ $row['id'] ] = $row;
        }

        // コース情報取得
        $course = $this->l_student_course_model->select_by_id($student_id, 'student_id');
        foreach ($course as $row) {
            $this->student['course']['all'][ $row['id'] ] = $row;
        }
        foreach ($course as $row) {
            if ($this->m_course_model->is_course_free_by_id($row['course_id'])) {
                // 無料コース
                $this->student['course']['free_course'][ $row['id'] ] = $row;
            } else if ($this->m_course_model->is_course_limited_by_id($row['course_id'])) {
                // 期間限定
                $this->student['course']['limited_course'][ $row['id'] ] = $row;
            } else if (is_valid_date(get_datetime(), $row['start_date'], $row['end_date'])) {
                // 有効なコース
                $this->student['course']['valid'][ $row['id'] ] = $row;
            }
        }

        // クラス情報取得
        $class = $this->l_student_class_model->select_by_id($student_id, 'student_id');
        foreach ($class as $row) {
            $this->student['class']['all'][ $row['id'] ] = $row;
        }
        foreach ($class as $row) {
            if (is_valid_date(get_datetime(), $row['start_date'], $row['end_date'])) {
                $this->student['class']['valid'][ $row['id'] ] = $row;
            }
        }

        // バス利用情報取得
        $bus_route = $this->l_student_bus_route_model->select_by_id($student_id, 'student_id');
        foreach ($bus_route as $row) {
            $this->student['bus_route']['all'][ $row['id'] ] = $row;
        }
        foreach ($bus_route as $row) {
            if (is_valid_date(get_datetime(), $row['start_date'], $row['end_date'])) {
                $this->student['bus_route']['valid'][ $row['id'] ] = $row;
            }
        }

        $this->student_copy = $this->student;
        return $this->student;
    }



    /**
     * 生徒に対して、年月日の日付のプロパティを返却する
     * @param   integer 生徒ID
     * @param   integer 年
     * @param   integer 月
     * @param   integer 日
     * @return  array   
     */
    public function get_date_propaty($student_id, $year, $month, $day) {
        $this->load->model('db/schedule_system_model');
        $this->load->model('db/schedule_class_model');
        $this->load->model('db/schedule_bus_model');

        // 返却値配列
        $result = array(
            'closed'            => FALSE,    // TRUE:休館日
            'construction'      => FALSE,    // TRUE:設備工事日
            'test'              => FALSE,    // TRUE:テスト期間
            'absenced_no_express'   => FALSE,    // TRUE:無連絡欠席
            'presence'          => FALSE,    // TRUE:出席
            'absence'           => FALSE,    // TRUE:欠席
            'future_presence'   => FALSE,    // TRUE:出席予定
            'future_absence'    => FALSE,    // TRUE:休み予定
            'future_transfer'   => FALSE,    // TRUE:振替予定
            'future_transfer_cancel'   => FALSE,    // TRUE:振替キャンセル
//            'future_transfer_id' => NULL,    // TRUE:振替予定日
//            'transfer_possible' => FALSE,    // TRUE:振替可能日
        );

        // 休館日 設定
        $result['closed'] = $this->schedule_system_model->is_closed_day($year, $month, $day);

        // 設備工事日 設定
        $result['construction'] = $this->schedule_system_model->is_construction_day($year, $month, $day);

        // テスト日 設定
        $result['test'] = $this->schedule_system_model->is_test_day($year, $month, $day);

        // 生徒のクラス出欠プロパティ取得
        $student_porp = $this->schedule_class_model->get_student_class_propaty($student_id, $year, $month, $day);
        switch ($student_porp) {
            case VALUE_SCHEDULE_PROP_FUTURE_PRESENCE:           // 出席予定
                $result['future_presence'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_FUTURE_TRANSFER:           // 振替出席予定
                $result['future_transfer'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_FUTURE_ABSENCE:            // 欠席予定
                $result['future_absence'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_PRESENCE:                  // 出席
                $result['presence'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_ABSENCE:                   // 欠席
                $result['absence'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_ABSENCED_NO_EXPRESS:       // 無連絡欠席
                $result['absenced_no_express'] = TRUE;
                break;
            case VALUE_SCHEDULE_PROP_FUTURE_TRANSFER_CANCEL:       // 振替キャンセル
                $result['future_transfer_cancel'] = TRUE;
                break;
        }
        
        return $result;
    }


    /**
     * 生徒が欠席した日のうち、振替していない日のレコードを取得する
     * @param   integer 生徒ID
     * @return  array   
     */
    public function get_rest_date_no_transfer($student_id) {
        $this->load->model('db/schedule_system_model');
        $this->load->model('db/schedule_class_model');
        $this->load->model('db/schedule_bus_model');

        $transfer_available = array();

        // 当月に振替可能な日を取得
        return $this->schedule_class_model->get_rest_date_no_transfer($student_id, date("Y"), date("m"));
    }


    /**
     * 振替可能な日の一覧を返却する（欠席した日に対して、振り返る事ができる日の一覧）
     * @param   integer 生徒ID
     * @param   integer 生徒クラス予約スケジュールID
     * @return  array   
     */
    public function get_available_transfer_date($student_id, $schedule_class_id) {

        // 生徒のスケジュールを取得
        $schedule_class = $this->schedule_class_model->select_by_id($schedule_class_id);
        if (!isset($schedule_class[0]) || $schedule_class[0]['student_id'] != $student_id) {
            return array();
        }

        // 振替できる開始日と終了日を取得
        list($start_day, $end_day) = $this->schedule_system_model->get_transfer_period($schedule_class[0]['target_date']);

        // 上記の期間の中で、振替可能な日を取得する
        $result = $this->schedule_system_model->get_transfer_date_list($schedule_class_id, $start_day, $end_day, $schedule_class);

        return $result;
    }
    private function get_nearest($array){
        if(array_key_exists('start_date',$array[0])&&array_key_exists('end_date',$array[0]))
        {
            $now = date_create(date('Y-m-d'));
            $maxstartdate = date_create('0000-00-00');
            $k = 0;
            foreach ($array as $key => $row) {

                $startdate = date_create($row['start_date']);
                if($startdate >= $maxstartdate && $startdate <= $now )
                {
                    $maxstartdate = $startdate ;
                    $k=$key;
                }
                    
            }
            return $k;
        }
        return -1;     
    }
    private function new_is_valid_date($startdate,$enddate){
        $startdate = strtotime($startdate);
        $enddate = strtotime($enddate);
        if($startdate < $enddate && $enddate > strtotime(date('Y-m-d')))
            return TRUE;
        return FALSE;
    }
    public function get_student_data_detail($student_id) {

        $this->student = array(
            'info'      => array(), 
            'meta'      => array(), 
            'family'    => array(), 
            'course'    => array(  
                'all'=>  array(), 
                'nearest'   => array(),

            ), 
            'class'     => array(   
                'all'       => array(),
                'valid'     => array(),
            ),
            'bus_route' => array(   
                'all'       => array(),
                'valid'     => array(),
            ),
            'distance'=>array(),
        );

        if ($student_id == $this->student_id) {
            return $this->student_copy;
        }
        $this->student_id = $student_id;

        //data info basic
        $result = $this->m_student_model->select_by_id($student_id);
        if (empty($result)) return $this->student;
        $this->student['info'] = $result[0];
        //data meta
        $result = $this->l_student_meta_model->select_by_id($student_id, 'student_id');
        foreach ($result as $row) {
            $this->student['meta'][ $row['tag'] ] = $row['value'];
        }
        //data family
        $result = $this->m_student_model->get_family_detail($student_id);
        foreach ($result as $row) {
            $this->student['family'][] = $row;
        }

        //get data course
        $allcourse = $this->m_course_model->getData_Course_valid();
        $this->student['course']['all'] = $allcourse;
        $course = $this->l_student_course_model->getData_course_by_studentid($student_id);
        $Course_nearest_index = $this->get_nearest( $course );
        if($Course_nearest_index >= 0)
        {
            $this->student['course']['nearest'] = $course[$Course_nearest_index];
            $class = $this->m_course_model->getData_class_by_id($course[$Course_nearest_index]['course_id']);
            $this->student['course']['nearest']['class'] = $class;
            // foreach ($class as $key => $value)
            // {
               
            // }
            $this->student['course']['nearest']['classjoin'] = $this->l_student_course_model->getData_student_class_by_studentcourse_id($course[$Course_nearest_index]['student_course'],$student_id);
        }      

        //data class
        $student_course_id = $this->student['course']['nearest']['course_id'];
        $class = $this->l_student_class_model->select_by_id($student_id, 'student_id');
        foreach ($class as $row) {
            $this->student['class']['all'][] = $row;
            if( $row['student_course_id']==$student_course_id && $row['student_id']==$student_id)
            {
                 $this->student['class']['nearest']['class_info']=$this->m_class_model->select_by_id($row['class_id'],'id');
                 $this->student['class']['nearest']['student_class_info']=$row;
            }
        }

        
        //data bus

        $bus_route = $this->l_student_bus_route_model->select_by_id($student_id, 'student_id');
        foreach ($bus_route as $row) {
            $this->student['bus_route']['all'][] = $row;
        }

        foreach ($bus_route as $key => $row) {
            if ($this->new_is_valid_date( $row['start_date'], $row['end_date'])) {

                $this->student['bus_route']['valid'][$key] = $row;
                $data_l_student_class = $this->l_student_class_model->get_student_class_detail_by_id($row['student_class_id']);
                $bus_course = $this->m_bus_course_model->select_by_id($data_l_student_class[0]['class_id'],'class_id');

                $this->student['bus_route']['valid'][$key]['classinfo']=$data_l_student_class;
                $i=0;
                foreach ($bus_course as  $subrow) {
                    $this->student['bus_route']['valid'][$key]['bus_course'][$i] =  $subrow ;
                    $bus_stop = $this->m_bus_course_model->getData_Bus_stop_by_class_id($subrow['class_id']);
                    foreach ($bus_stop as  $value) {
                        $this->student['bus_route']['valid'][$key]['bus_course'][$i]['bus_stop'][]= $value ;
                    }
                }
                $i++;    
            }
        }

        //data distance
        $distance = $this->m_distance_model->select_all();
        $this->student['distance'] = $distance;

        return $this->student;
    }

    public function get_limit_list_user($limit, $started){
        $this->db->select()
            ->from('m_student')
            ->where('status', NOT_OK)
            ->order_by('create_date', 'DESC')
            ->limit($limit, $started);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_total_user_inactive($condition)
    {
        # code...
        $this->db->select()
            ->from('m_student')
            ->where($condition);
        $query = count($this->db->get()->result_array());
        return $query;

    }
}
