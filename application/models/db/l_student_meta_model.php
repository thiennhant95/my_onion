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
    public function update_tagMeta( $arrayDataMeta , $student_id=NULL)
    {
        $session_student = $this->session->userdata('admin_account');
        $admin_id = $session_student['id'];

        if( $student_id != NULL || $admin_id != NULL ){

            foreach ($arrayDataMeta as $key => $value) {
                $query = $this->db->select('id')->from('l_student_meta')->where([ 'student_id' => $student_id ,'tag' => $key]);
                $result = $this->db->get()->result_array();
                if ($key === 'enquete' ) $value = json_encode( $value );
                if( count( $result ) > 0)
                {
                  $this->db->update('l_student_meta', [ 'value' => $value , 'update_id' => $admin_id ] , [ 'student_id' => $student_id, 'tag' => $key  ] );
                }
                else
                {
                    $this->db->insert('l_student_meta', [ 'student_id' => $student_id, 'tag' => $key ,'value'=>$value , 'create_id' => $admin_id ] );
                }
            }
            return TRUE;
        }

        return FALSE;  
    }
}
