<?php
class L_student_meta_model extends DB_Model {

    /**
     * construct
     * @param
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function check_token( $token ) {
        $array = array( 'tag' => 'token', 'value' => $token );
        $this->db->select( 'student_id' )->from( 'l_student_meta' )->where( $array );
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function select_student_metas( $student_id ) {
        $this->db->select()->from( 'l_student_meta' )->where( array( 'student_id' => $student_id ) );
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function select_student_meta( $student_id, $tag ) {
        $this->db->select()->from( 'l_student_meta' )->where( array( 'student_id' => $student_id, 'tag' => $tag ) );
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function update_student_meta( $student_id, $tag, $value ) {
        $query = $this->db->update('l_student_meta', array( 'value' => $value ), array('student_id' => $student_id, 'tag' => $tag ) );
        if ( $query === FALSE ) {
            return 'error';
        } else return 'success';
    }
    public function update_tagMeta($arrayDataMeta,$student_id=NULL)
    {
        $query = " REPLACE INTO ".$this->tbl." (student_id,tag, value,orderby,update_id,update_date,delete_flg)VALUES(?,?,?,?,?,?,?) ";
        foreach ($arrayDataMeta as $key => $value) {
            if($key=='enquete') $value = json_encode($value);
            $params=[$student_id,$key,$value,'0','0', date('Y-m-d H:i:s') ,'0'];

            if (FALSE === $this->db->query($query,$params)) {
                logerr($query);
                throw new Exception();
            }
        }
        return true;
    }
}
