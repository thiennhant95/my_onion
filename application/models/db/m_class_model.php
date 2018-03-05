<?php
class M_class_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * l_student_class.idを指定してクラス情報を取得する
     * @param   integer l_student_class.id
     * @return  array   クラス情報
     */
    public function get_student_class($l_student_class_id) {
        $params = array(
            $l_student_class_id,
        );

        $query =  'SELECT c.* FROM m_class c ';
        $query .= 'LEFT JOIN l_student_class sc ON sc.class_id = c.id ';
        $query .= 'WHERE sc.id = ? ';
        $res = $this->db->query($query, $params);
        return $res->row_array();
    }

    /**
     * Get list class
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function get_list_class($limit, $start)
    {
        $sql = 'select m_class.id,m_class.course_id,m_class.class_code,m_class.class_name,m_class.invalid_flg,m_class.grade_manage_flg,m_class.week,m_class.max_count,m_class.use_bus_flg
                from m_class JOIN m_course ON m_class.course_id = m_course.id 
                where m_class.delete_flg = 0 and m_course.delete_flg=0
                order by m_class.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Get list export CSV
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    function export_csv($limit, $start)
    {
        global $data_class;
        $sql = 'select m_course.short_course_name,m_class.base_class_sign,m_class.class_code,m_class.class_name,m_class.week,m_class.use_bus_flg,m_class.start_time,m_class.end_time,m_class.max_count
                from m_class JOIN m_course ON m_class.course_id = m_course.id 
                where m_class.delete_flg = 0 and m_course.delete_flg=0
                order by m_class.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
       $data=$query->result_array();
        foreach ($data as $row):
                $row['week']=explode(',',$row['week']);
                if (in_array(SUNDAY,$row['week']))
                    $day[]="日";
                if (in_array(MONDAY,$row['week']))
                    $day[]= "月";
                if (in_array(TUESDAY,$row['week']))
                    $day[]= "火";
                if (in_array(WEDNESDAY,$row['week']))
                    $day[]="水";
                if (in_array(THURSDAY,$row['week']))
                    $day[]= "木";
                if (in_array(FRIDAY,$row['week']))
                    $day[]= "金";
                if (in_array(SATURDAY,$row['week']))
                    $day[]="土";
                 $row['week']=implode('、',$day);
                 $row_class['week']=$row['week'];
                 $row['use_bus_flg']==0?$row['use_bus_flg']='バス利用する':$row['use_bus_flg']='バス利用しない';
                 $data_class[]=$row;
                unset($day);
        endforeach;
        return $data_class;
    }

    /**
     * get list number of pupils
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function number_of_pupils($course_id)
    {
       $sql='select  sum(m_class.max_count) as count_total from m_class where m_class.course_id='.$course_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
