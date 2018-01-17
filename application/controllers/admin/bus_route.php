<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bus_route extends ADMIN_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db/m_bus_route_model','bus_route');
        $this->load->model('db/m_bus_course_model','bus_course');
        $this->load->model('db/m_class_model','class');
        $this->load->model('db/m_bus_stop_model','bus_stop');
    }
    /**
     * バスコースマスター
     *
     * @param   
     * @return  
     *
    */
    public function index() {
        if ($this->error_flg) return;
        try {
            $data['bus_course_list']=$this->bus_course->get_list();
            $data['bus_route_list']=$this->bus_route->get_list();
            $data['class_list']=$this->class->get_list();
            $this->viewVar=$data;
            admin_layout_view('bus_route_index', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     * バスコース登録編集
     *
     * @param   
     * @return  
     *
    */
    public function edit($id = NULL) {
        if ($this->error_flg) return;
        try {
            $data['get_bus_course']=$this->bus_course->select_by_id($id)[0];
            $data['class_list']=$this->class->get_list();
            $data['bus_route_list']=$this->bus_route->get_list(array('bus_course_id'=> "=".$id));
            $data['bus_stop_list']=$this->bus_stop->get_list();
            if ($this->input->post())
            {
                if($this->input->post('bus_course_code') != $data['get_bus_course']['bus_course_code'])
                {
                    $is_unique =  '|is_unique[m_bus_course#bus_course_code]';
                }
                else {
                    $is_unique =  '';
                }
                $this->form_validation->set_rules('bus_course_code', 'bus_course_code', 'required|trim|xss_clean'.$is_unique);
                if ($this->form_validation->run() == true) {
                    //update bus course
                    $dataUpdate = array(
                        'id'=>$id,
                        'bus_course_code'=>$this->input->post('bus_course_code'),
                        'bus_course_name'=>$this->input->post('bus_course_name'),
                        'class_id'=>$this->input->post('class_id'),
                        'max'=>$this->input->post('max')
                    );
                    $this->bus_course->update_by_id($dataUpdate);
                    //update bus route
                    $route_id =$this->input->post('route_id');
                    $route_order =$this->input->post('route_order');
                    $bus_stop_id=$this->input->post('bus_stop_id');
                    $go_time=$this->input->post('go_time');
                    $ret_time=$this->input->post('ret_time');

                      foreach ($route_order as $key=>$value)
                      {
                          //go time
                          $go_time[$key] = explode(':', $go_time[$key]);
                          $go_time[$key] = implode('',$go_time[$key]);
                          if (strlen($go_time[$key])==3) {
                              $go_time[$key] = substr_replace($go_time[$key], '0', 0, 0);
                          }
                          //ret time
                          $ret_time[$key] = explode(':', $ret_time[$key]);
                          $ret_time[$key] = implode('',$ret_time[$key]);
                          if (strlen($ret_time[$key])==3) {
                              $ret_time[$key] = substr_replace($ret_time[$key], '0', 0, 0);
                          }
                          $data_Bus_Route= array(
                              'id'=>$route_id[$key],
                              'route_order' =>$route_order[$key],
                              'bus_stop_id' =>$bus_stop_id[$key],
                              'go_time'=>$go_time[$key],
                              'ret_time'=>$ret_time[$key],
                          );
                          if ($data_Bus_Route['id']!=NULL)
                          {
                              $this->bus_route->update_by_id($data_Bus_Route);
                          }
                          if ($data_Bus_Route['id']== NULL)
                          {
                              $data_Bus_Route= array(
                                  'route_order' =>$route_order[$key],
                                  'bus_course_id'=>$id,
                                  'bus_stop_id' =>$bus_stop_id[$key],
                                  'go_time'=>$go_time[$key],
                                  'ret_time'=>$ret_time[$key],
                              );
                              $this->bus_route->insert($data_Bus_Route);
                          }
                      }
                      echo "1";
                      die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo "0";
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('bus_route_edit', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

    /**
     *
     *
     * @param
     * @return
     *
     */
    public function create() {
        if ($this->error_flg) return;
        try {
            $data['class_list']=$this->class->get_list();
            $data['bus_stop_list']=$this->bus_stop->get_list();
            if ($this->input->post())
            {
                $this->form_validation->set_rules('bus_course_code', 'bus_course_code', 'required|trim|xss_clean|is_unique[m_bus_course#bus_course_code]');
                if ($this->form_validation->run() == true) {
                    //update bus course
                    $dataInsert = array(
                        'bus_course_code'=>$this->input->post('bus_course_code'),
                        'bus_course_name'=>$this->input->post('bus_course_name'),
                        'class_id'=>$this->input->post('class_id'),
                        'max'=>$this->input->post('max')
                    );
                    $this->bus_course->insert($dataInsert);
                    $id=$this->bus_course->get_last_insert_id();

                    //update bus route
                    $route_order =$this->input->post('route_order');
                    $bus_stop_id=$this->input->post('bus_stop_id');
                    $go_time=$this->input->post('go_time');
                    $ret_time=$this->input->post('ret_time');

                    foreach ($route_order as $key=>$value)
                    {
                        //go time
                        $go_time[$key] = explode(':', $go_time[$key]);
                        $go_time[$key] = implode('',$go_time[$key]);
                        if (strlen($go_time[$key])==3) {
                            $go_time[$key] = substr_replace($go_time[$key], '0', 0, 0);
                        }
                        //ret time
                        $ret_time[$key] = explode(':', $ret_time[$key]);
                        $ret_time[$key] = implode('',$ret_time[$key]);
                        if (strlen($ret_time[$key])==3) {
                            $ret_time[$key] = substr_replace($ret_time[$key], '0', 0, 0);
                        }
                        $data_Bus_Route= array(
                            'bus_course_id'=>$id,
                            'route_order' =>$route_order[$key],
                            'bus_stop_id' =>$bus_stop_id[$key],
                            'go_time'=>$go_time[$key],
                            'ret_time'=>$ret_time[$key],
                        );
                        $this->bus_route->insert($data_Bus_Route);
                    }
                    echo "1";
                    die();
                }
                else if ($this->form_validation->run() == false)
                {
                    echo "0";
                    die();
                }
            }
            $this->viewVar = $data;
            admin_layout_view('bus_route_create', $this->viewVar);
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }
    /**
     *
     *
     * @param
     * @return
     *
     */
    public function delete($id = NULL) {
        if ($this->error_flg) return;
        try {
            $dataUpdate = array(
                'id'=>$id,
                'delete_flg'=>'1',
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->bus_course->update_by_id($dataUpdate);
            echo json_encode(array('status'=>'1'));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }


    /**
     *
     *
     * @param
     * @return
     *
     */
    public function delete_bus_route($id = NULL) {
        if ($this->error_flg) return;
        try {
            $dataUpdate = array(
                'id'=>$id,
                'delete_flg'=>'1',
                'delete_date'=>date('Y-m-d H:i:s')
            );
            $this->bus_route->update_by_id($dataUpdate);
            echo json_encode(array("success" => true));
        } catch (Exception $e) {
            $this->_show_error($e->getMessage(), $e->getTraceAsString());
        }
    }

}

/* End of file bus_route.php */
/* Location: ./application/controllers/admin/bus_route.php */