<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reschedule extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('db/l_student_reserve_change_model','student_reserve');
        $this->load->model('db/m_course_model','course');
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_grade_model','grade');
        $this->load->library("pagination");

    }

    /**
     * 欠席振替申請一覧(1ページ目)
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            admin_layout_view('reschedule_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * Load list student reserve change by Ajax
     * @access public
     * @author Tran Thien Nhan - VietVang JSC
     */
    public function ajax_loader()
    {
        if ($this->error_flg) return;
        try {
            if (!$this->input->post('verify_submit')) {
                $data['course_list'] = $this->course->get_list();
                global $course_list;
                foreach ($data['course_list'] as $row) {
                    $course_list .= '<label class="checkbox-inline">
                                 <input type="checkbox" name="course[]" value="' . $row['id'] . '">' . $row['course_name'] . '
                                 </label>';
                }
                $data['class_list'] = $this->class->get_list();
                $data['grade_list'] = $this->grade->get_list();
                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/reschedule/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $pagin['total_rows'] = count($this->student_reserve->get_list());
                $this->pagination->initialize($pagin);
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
                $data['student_reserve_list'] = $this->student_reserve->get_list_student_reserve($pagin["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
                $list_search = $this->result_html($data['student_reserve_list']);
                echo json_encode(array('list' => $list_search, 'pagination' => $data['pagination'], 'course_list' => $course_list, 'class_list' => $data['class_list']));
                die();
            } else if ($this->input->post('verify_submit')) {
                $pagin = $this->paginationConfig;
                $pagin["base_url"] = '/admin/reschedule/index';
                $pagin['full_tag_open'] = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close'] = '</ul>';
                $data['page'] = ($this->uri->segment(FOUR)) ? $this->uri->segment(FOUR) : DATA_OFF;
                $data['student_reserve_list'] = $this->student_reserve->get_list_student_reserve_search($pagin["per_page"], $data['page']);
                $pagin['total_rows'] = $data['student_reserve_list'][1];
                $this->pagination->initialize($pagin);
                $data['pagination'] = $this->pagination->create_links();
                $list_search = $this->result_html($data['student_reserve_list'][0]);
                echo json_encode(array('list' => $list_search, 'pagination' => $data['pagination']));
                die();
            }
        }
        catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    public function result_html($data=NULL)
    {
        if ($this->error_flg) return;
        try {
            global $html;
            if ($data) {
                foreach ($data as $row):
                    $row_content=json_decode($row['contents'],true);
                    if ($row['status'] == DATA_ON) {
                        $html .= '
                          <tr class="disabled">
                            <th>' . $row['student_id'] . '</th>
                            <td><a class="btn btn-default" href="#0">' . $row['name'] . '</a>(' . $row['course_name'] . ')' . $row['class_name'] . '</td> 
                            <td>' . $row['target_date'] . '</td> 
                            <td>' . $row_content['contents'] . '</td> 
                            <td>' . $row['reason'] . '</td> 
                            <td>' . $row['dist_date'] . '</td> 
                            <td><span class="text-danger">' . $row['test'] . '</span></td> 
                            <td>' . $row['status'] . '</td>                  
                         </tr>
                    ';
                    }
                    if ($row['status'] == DATA_OFF) {
                        $html .= '
                          <tr>
                            <th>' . $row['student_id'] . '</th>
                            <td><a class="btn btn-default" href="#0">' . $row['name'] . '</a>(' . $row['course_name'] . ')' . $row['class_name'] . '</td> 
                            <td>' . $row['target_date'] . '</td> 
                            <td>' . $row_content['contents'] . '</td> 
                            <td>' . $row['reason'] . '</td> 
                            <td>' . $row['dist_date'] . '</td> 
                            <td><span class="text-danger">' . $row['test'] . '</span></td> 
                            <td>' . $row['status'] . '</td>                  
                         </tr>
                    ';
                    }
                endforeach;
            }
            else {
                $html .= '
                          <tr>
                            <td colspan="8"><b>見つからない</b></td>       
                         </tr>';
            }
            return $html;
        }
        catch (Exception $e) {
                $this->_show_error($e->getMessage(), $e->getTraceAsString());
            }
    }

    public function export_csv()
    {
        if ($this->error_flg) return;
        try {
            $limit=1000;
            $count_reschedule=$this->student_reserve->export_csv(0,0,TRUE);
            $count_num=ceil($count_reschedule/$limit);
            for ($i=0;$i<$count_num; $i++)
            {
                $offset=$i*$limit;
                $data[]=$this->student_reserve->export_csv($limit,$offset,FALSE);
            }
            array_unshift($data[0],array("級コード","級名"));
            $this->load->helper('csv');
            array_to_csv($data, 'reschedule_'.date('Ymd').'.csv');
        }
        catch (Exception $e)
        {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file reschedule.php */
/* Location: ./application/controllers/admin/reschedule.php */