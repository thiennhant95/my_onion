<?php
class M_course_model extends DB_Model {

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
     * コースが無料体験コースかどうかチェックする
     * @param   integer コースID
     * @return  boolean TRUE:無料体験コース FALSE:無料体験コースでない
     */
    public function is_course_free_by_id($course_id) {
        $params = array(
            $course_id,
            VALUE_COURSE_TYPE_FREE,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT 1 AS result FROM m_course ';
        $query .= 'WHERE id = ? AND id IN (SELECT id FROM m_course WHERE `type` = ? AND delete_flg = ?) ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * コースが無料体験コースかどうかチェックする
     * @param   array   コース情報（m_courseのレコード）
     * @return  boolean TRUE:無料体験コース FALSE:無料体験コースでない
     */
    public function is_course_free($course) {
        if (isset($course['type']) && $course['type'] == VALUE_COURSE_TYPE_FREE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * コースが期間限定コースかどうかチェックする
     * @param   integer コースID
     * @return  boolean TRUE:期間限定コース FALSE:期間限定コースでない
     */
    public function is_course_limited_by_id($course_id) {
        $params = array(
            $course_id,
            VALUE_COURSE_TYPE_LIMITED,
            DATA_NOT_DELETED,
        );
        $query =  'SELECT 1 AS result FROM m_course ';
        $query .= 'WHERE id = ? AND id IN (SELECT id FROM m_course WHERE `type` = ? AND delete_flg = ?) ';
        $res = $this->db->query($query, $params);
        if (!empty($res->row_array())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * コースが期間限定コースかどうかチェックする
     * @param   array   コース情報（m_courseのレコード）
     * @return  boolean TRUE:期間限定コース FALSE:期間限定コースでない
     */
    public function is_course_limited($course) {
        if (isset($course['type']) && $course['type'] == VALUE_COURSE_TYPE_LIMITED) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_list_course($limit, $start)
    {
        $sql = 'select * from m_course
                where m_course.delete_flg =0 
                order by m_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function export_csv($limit, $start)
    {
        global $data_course;
        $sql = 'select course_code,course_name,short_course_name,grade_manage_flg,cost_item_id,
                rest_item_id,bus_item_id,change_flg ,practice_max,practice_type,type,start_date,
                end_date,regist_start_date,regist_end_date,join_condition,max_count
                from m_course
                where m_course.delete_flg =0
                order by m_course.id ASC 
                limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        $data=$query->result_array();
        $data_item=$this->db->get('m_item')->result_array();

        foreach ($data as $row):
            foreach ($data_item as $row_item):
                if ($row_item['id']==$row['cost_item_id'])
                {
                    $row['cost_item_id']=$row_item['sell_price'];
                }
                endforeach;
            foreach ($data_item as $row_item):
                if ($row_item['id']==$row['rest_item_id'])
                {
                    $row['rest_item_id']=$row_item['sell_price'];
                }
                endforeach;
            foreach ($data_item as $row_item):
                if ($row_item['id']==$row['bus_item_id'])
                {
                    $row['bus_item_id']=$row_item['sell_price'];
                }
                endforeach;
            $row['grade_manage_flg']=DATA_OFF? $row['grade_manage_flg']='管理しない':$row['grade_manage_flg']='管理する';
            $row['change_flg']=DATA_OFF? $row['change_flg']='なし':$row['change_flg']='あり';
            $row['practice_max']=DATA_OFF? $row['change_flg']='フリー':$row['change_flg'];
            $row['practice_type']=DATA_OFF? $row['practice_type']='週':$row['practice_type']='月';
            if ($row['type']==DATA_OFF){
                $row['type']='通常';
            }
            else if ($row['type']==DATA_ON){
                $row['type']='期間限定（短期）';
            }
            else
            {
                $row['type']='無料';
            }
            $row['start_date']       = new DateTime($row['start_date']);
            $row['start_date']->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $row['start_date']     = $row['start_date']->format("d/m/Y");

            $row['end_date']       = new DateTime($row['end_date']);
            $row['end_date']->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $row['end_date']     = $row['end_date']->format("d/m/Y");

            $row['regist_start_date']       = new DateTime($row['regist_start_date']);
            $row['regist_start_date']->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $row['regist_start_date']     = $row['regist_start_date']->format("d/m/Y");

            $row['regist_end_date']       = new DateTime($row['regist_end_date']);
            $row['regist_end_date']->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $row['regist_end_date']     = $row['regist_end_date']->format("d/m/Y");

            $row['join_condition']=str_replace('"','',$row['join_condition']);
            $row['join_condition']=str_replace('{',"",$row['join_condition']);
            $row['join_condition']=str_replace('}','',$row['join_condition']);
            $row['join_condition']=str_replace(",","、",$row['join_condition']);
            $row['join_condition']=str_replace("age","年齢",$row['join_condition']);
            $row['join_condition']=str_replace("grade","年齢",$row['join_condition']);
            $row['join_condition']=str_replace("swimming_ability","泳力",$row['join_condition']);
            $row['join_condition']=str_replace("free_lesson:","",$row['join_condition']);
            $row['join_condition']=str_replace("short_lesson:","",$row['join_condition']);
            $row['join_condition']=str_replace("dive:","",$row['join_condition']);
            $row['join_condition']=str_replace("float:","",$row['join_condition']);
            $row['join_condition']=str_replace("experience:status:","",$row['join_condition']);
            $row['join_condition']=str_replace("face_into_water:","",$row['join_condition']);
            $row['join_condition']=str_replace("not_face_into_water:","",$row['join_condition']);
//            $row['join_condition']=str_replace("0","",$row['join_condition']);

            $data_course[]=$row;
        endforeach;
        return $data_course;
    }





}
