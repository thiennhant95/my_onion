<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Bus_route extends ADMIN_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('db/m_bus_route_model','bus_route');
            $this->load->model('db/m_bus_course_model','bus_course');
            $this->load->model('db/m_class_model','class');
            $this->load->model('db/m_bus_stop_model','bus_stop');
            $this->load->library("pagination");
        }
        /**
         * バスコースマスター
         *
         * @param
         * @return
         *
        */
        public function index(  ) {
            if ($this->error_flg) return;
            try {
                $pagin=$this->paginationConfig;
                $pagin["base_url"] = '/admin/bus_route/index';
                $pagin['full_tag_open']   = '<ul class="pagination pagination-md pagination-main">';
                $pagin['full_tag_close']  = '</ul>';
                $pagin['total_rows'] = count($this->bus_course->get_list());
                $this->pagination->initialize($pagin);
                $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $data['bus_course_list']=$this->bus_course->get_list_bus_course($pagin["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
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
                $data['class_list']=$this->class->get_list(array('invalid_flg'=> "=".DATA_OFF));
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
                        $route_order =$this->input->post('bus_route_order');
                        $route_order=explode(',',$route_order);
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
                        echo json_encode(array('status'=>DATA_ON));
                        die();
                    }
                    else if ($this->form_validation->run() == false)
                    {
                        echo json_encode(array('status'=>DATA_OFF));
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
                $data['class_list']=$this->class->get_list(array('invalid_flg'=> "=".DATA_OFF));
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
                        $route_order =$this->input->post('bus_route_order');
                        $route_order=explode(',',$route_order);
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
                        echo json_encode(array('status'=>DATA_ON));
                        die();
                    }
                    else if ($this->form_validation->run() == false)
                    {
                        echo json_encode(array('status'=>DATA_OFF));
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
                    'delete_flg'=>DATA_ON,
                    'delete_date'=>date('Y-m-d H:i:s')
                );
                $this->bus_course->update_by_id($dataUpdate);
                echo json_encode(array('status'=>DATA_ON));
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

        /**
         *
         * Copy bus course
         * @param
         * @return
         *
         */
        public function copy($id=NULL)
        {
            if ($this->error_flg) return;
            try {
                $bus_course= $this->bus_course->select_by_id($id)[0];
                $bus_route=$this->bus_route->get_list(array('bus_course_id'=> "=".$id));
                $data_bus_course = array(
                    'bus_course_code'=>$bus_course['bus_course_code'],
                    'bus_course_name'=>$bus_course['bus_course_name'],
                    'class_id'=>$bus_course['class_id'],
                    'max'=>$bus_course['max'],
                );
                $this->bus_course->insert($data_bus_course);
                $id_last=$this->bus_course->get_last_insert_id();
                foreach ($bus_route as $row_bus_route)
                {
                    $data_bus_route= array(
                        'bus_course_id'=>$id_last,
                        'route_order' =>$row_bus_route['route_order'],
                        'bus_stop_id' =>$row_bus_route['bus_stop_id'],
                        'go_time'=>$row_bus_route['go_time'],
                        'ret_time'=>$row_bus_route['ret_time'],
                    );
                    $this->bus_route->duplicate_insert($data_bus_route);
                }
                $data_json=$this->bus_course->select_by_id($id_last)[0];
                $class_name= $this->class->select_by_id($data_json['class_id'])[0];
                $data_json['class_name']=$class_name['class_name'];
                echo json_encode($data_json);
                die();
            } catch (Exception $e) {
                $this->_show_error($e->getMessage(), $e->getTraceAsString());
            }
        }


        /**
         *
         * export Csv
         * @param
         * @return
         *
         */
        public function export() {
            if ($this->error_flg) return;
            try {
                $limit=LIMIT_CSV;
                $count_bus_course=count($this->bus_course->get_list());
                $count_num=ceil($count_bus_course/$limit);
                for ($i=0;$i<$count_num; $i++)
                {
                    $offset=$i*$limit;
                    $data[]=$this->bus_course->export_csv($limit,$offset);
                }
                array_unshift($data[0],array("バスコースコード","バスコース名","クラス","定員"));
                $this->load->helper('csv');
                array_to_csv($data, 'bus_course_'.date('Ymd').'.csv');
            }
            catch (Exception $e)
            {
                $this->_show_error($e->getMessage(), $e->getTraceAsString());
            }
        }

        public function export_bus_route() {
            if ($this->error_flg) return;
            try {
                $limit=LIMIT_CSV;
                $count_bus_route=count($this->bus_route->get_list());
                $count_num=ceil($count_bus_route/$limit);
                for ($i=0;$i<$count_num; $i++)
                {
                    $offset=$i*$limit;
                    $data[]=$this->bus_route->export_csv($limit,$offset);
                }
                array_unshift($data[0],array("品名コード","品名","科目","売り単価","仕入単価","在庫数","分類"));
                $this->load->helper('csv');
                array_to_csv($data, 'bus_route_'.date('Ymd').'.csv');
            }
            catch (Exception $e)
            {
                $this->_show_error($e->getMessage(), $e->getTraceAsString());
            }
        }





    }

    /* End of file bus_route.php */
    /* Location: ./application/controllers/admin/bus_route.php */
