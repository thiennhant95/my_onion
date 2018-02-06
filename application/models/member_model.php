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
    }

    public function filter_data($condition_id, $condition_tag)
    {
        
        $string_query = '';
        $where_name = '';
        $group_by = "";
        // if(!empty($condition_tag)){
        //     $count = count($condition_tag);
        //     $where_name = "WHERE";
        //     $group_by = " GROUP BY `std`.`id`";
        //     for ($i=0; $i < $count ; $i++) { 
        //         if((($i - 1) == ($count - 2))){
        //             $string_query .= "(`tag` LIKE '%".$condition_tag[$i]['tag']."%' AND `value` LIKE '%".$condition_tag[$i]['value']."%')";
        //         }
        //         else{
        //             $string_query .= "(`tag` LIKE '%".$condition_tag[$i]['tag']."%' AND `value` LIKE '%".$condition_tag[$i]['value']."%')".' OR ';
        //         }
        //     }
        // }
        $query = 'SELECT * FROM (`m_student` std) LEFT JOIN `l_student_meta` lsm ON `std`.`id` = `lsm`.`student_id` LEFT JOIN `l_student_course` lsco ON `lsm`.`student_id` = `lsco`.`student_id` '. $where_name . $string_query .$group_by ;
        $query .= ' UNION ';
        $query .= 'SELECT * FROM (`m_student` std) RIGHT JOIN `l_student_meta` lsm ON `std`.`id` = `lsm`.`student_id` RIGHT JOIN `l_student_course` lsco ON `lsm`.`student_id` = `lsco`.`student_id` '. $where_name . $string_query .$group_by ;
        // if(!empty($condition_id)){
        //     $this->db->where($condition_id);
        // }
        $data = $this->db->query($query)->result_array();
        return $data;
    }



    


}
