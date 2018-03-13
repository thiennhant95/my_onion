<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <div class="panel panel-dotted">
        <div class="panel-heading">
          <span class="text-violet">契約変更詳細</span>
          <a style="display: none" href="#0" class="btn btn-primary btn-sm pull-right">
            <strong>CSV出力</strong>
          </a>
        </div>
        <div class="panel-body">

          <section>
            <div class="table-responsive">
              <table class="table table-lg table-violet table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>申請日</th>
                    <th>申請内容</th>
                    <th>処理状況</th>
                    <th>処理日</th>
                    <th>手数料</th>
                    <th>MEDLEY</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $contents=json_decode($get_request['contents'],true);
                switch ($get_request['type'])
                {
                    case 'bus_change_once':
                        $get_request['type_jp']='バス乗降連絡';
                        break;
                    case 'bus_change_eternal':
                        $get_request['type_jp']='バスコース変更';
                        break;
                    case 'course_change':
                        $get_request['type_jp']='練習コース変更';
                        break;
                    case 'recess':
                        $get_request['type_jp']='休会届';
                        break;
                    case 'quit':
                        $get_request['type_jp']='退会届';
                        break;
                    case 'event_entry':
                        $get_request['type_jp']='イベント・短期教室参加申請';
                        break;
                    case 'address_change':
                        $get_request['type_jp']='住所変更申請';
                        break;
                }
                switch ($get_request['status'])
                {
                    case '0':
                        $get_request['status_jp']='未処理/未確認';
                        break;
                    case '1':
                        $get_request['status_jp']='承認/処理済み/確認済み';
                        break;
                    case '2':
                        $get_request['status_jp']='保留';
                        break;
                }
                switch ($get_request['comission_flg'])
                {
                    case '0': $get_request['comission_flg_jp']='無し'; break;
                    case '1': $get_request['comission_flg_jp']='手数料発生'; break;
                    case '2': $get_request['comission_flg_jp']='免除'; break;
                }
                switch ($get_request['melody_flg'])
                {
                    case '0': $get_request['melody_flg_jp']='未'; break;
                    case '1':$get_request['melody_flg_jp']='済'; break;
                }
                if ($get_request['process_date']==NULL)
                {
                    $get_request['process_date']='---';
                }
                else
                {
                    $get_request['process_date'] = date('Y-m-d', strtotime($get_request['process_date']));
                }
                ?>
                  <tr>
                    <th><?php echo $get_request['student_id']?></th>
                    <td><a href="<?php echo  site_url('admin/member/detail/'.$get_request['student_id'])?>" class="btn btn-default"><?php echo $get_request['name']?></a></td>
                    <td><?php echo date('Y-m-d',strtotime($get_request['update_date']))?></td>
                    <td><?php echo $get_request['type_jp']?></td>
                    <td><?php echo $get_request['status_jp']?></td>
                    <td><?php echo $get_request['process_date']?></td>
                    <td><?php echo $get_request['comission_flg_jp']?></td>
                    <td><?php echo $get_request['melody_flg_jp']?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
          <form method="post" id="request_form">
            <section>
              <div class="block-30">
                <div class="panel panel-dotted panel-red">
                  <div class="panel-body text-center">
                      <?php
                      if(isset($get_request['old_course'])) {
                          ?>
                          <h3 class="h4">
                              <strong>
                                  <?php
                                  echo $get_request['old_course'].'【';
                                  foreach ($get_request['class_old'] as $row_class_old)
                                  {
                                      if ($row_class_old==end($get_request['class_old']))
                                      {
                                          echo $row_class_old;
                                          $data_old_class[]=$row_class_old;
                                      }
                                      if ($row_class_old!=end($get_request['class_old'])) {
                                          echo $row_class_old . "・";
                                          $data_old_class[]=$row_class_old;
                                      }                                  }
                                  echo "】";
                                  ?>
                              </strong>
                          </h3>
                          <p>
                              <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                          </p>
                          <h3 class="text-red">
                              <strong>
                                  <?php
                                  echo $get_request['new_course'].'【';
                                  foreach ($get_request['class_new'] as $row_class_new)
                                  {
                                      if ($row_class_new==end($get_request['class_new']))
                                      {
                                          echo $row_class_new;
                                          $data_new_class[]=$row_class_new;
                                      }
                                      if ($row_class_new!=end($get_request['class_new'])) {
                                          echo $row_class_new . "・";
                                          $data_new_class[]=$row_class_new;
                                      }
                                  }
                                  echo "】";
                                  ?>
                              </strong>
                          </h3>
                          <input type="hidden" name="course_old" value="<?php echo $get_request['old_course_id']?>">
                          <input type="hidden" name="course_new" value="<?php echo $get_request['new_course_id']?>">
                          <input type="hidden" name="date_change" value="<?php echo $get_request['date_change']?>">
                          <?php
                          $class_old = base64_encode(serialize($get_request['class_old_id']));
                          $class_new = base64_encode(serialize($get_request['class_new_id']));
//                          foreach ($get_request['class_new_id'] as $n) {
//                              ?>
<!--                              <input type="hidden" name="class_new[]" value="--><?php //echo $n?><!--">-->
<!--                              --><?php
//                          }
                          ?>
                          <input type="hidden" name="class_old" value="<?php echo $class_old?>">
                          <input type="hidden" name="class_new" value="<?php echo $class_new?>">
                          <?php
                          //
//                          foreach ($get_request['class_old_id']as $l)
//                          {
//                              ?>
<!--                              <input type="hidden" name="class_old[]" value="--><?php //echo $l?><!--">-->
<!--                              --><?php
//                          }
                              ?>
                          <input type="hidden" name="type_course" value="<?php echo COURSE_CHANGE?>">
                          <?php
                      }
                      if ($get_request['type']==ADDRESS_CHANGE)
                      {
                          ?>
                          <h3 class="h4">
                              <strong>
                                  <?php
                                  echo $get_request['address_before'];
                                  ?>
                              </strong>
                          </h3>
                          <p>
                              <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                          </p>
                          <h3 class="text-red">
                              <strong>
                                  <?php
                                  echo $get_request['address_after'];
                                  ?>
                                  <input type="hidden" name="address_after" value="<?php echo $get_request['address_after']?>">
                              </strong>
                          </h3>
                          <?php
                      }
                      if ($get_request['type']==QUIT)
                      {
                          ?>
                          <h3 class="text-red">
                              <strong>
                                  <?php
                                  echo '退会理由：';
                                  foreach ($get_request['reason'] as $row_reason)
                                  {
                                      if ($row_reason==end($get_request['reason']))
                                      {
                                          echo $row_reason;
                                      }
                                      if ($row_reason!=end($get_request['reason'])) {
                                          echo $row_reason . " - ";
                                      }
                                  }
                                  if ($get_request['memo']!=null) {
                                      echo "<br>" . 'その他：' . $get_request['memo'];
                                  }
                                  ?>
                                  <input type="hidden" name="quit_date" value="<?php echo $get_request['quit_date']?>">
                                  <input type="hidden" name="reason" value="<?php echo implode(',',$get_request['reason'])?>">
                                  <input type="hidden" name="memo" value="<?php echo $get_request['memo']?>">
                              </strong>
                          </h3>
                          <?php
                      }
                      if ($get_request['type']==RECESS)
                      {
                          ?>
                          <h3 class="text-red">
                              <strong>
                                  <?php
                                  echo '開始日：'.$get_request['start_date'];
                                  echo '<br>'.'終了日：'.$get_request['end_date'];
                                  if ($get_request['reason']!=null) {
                                      echo "<br>" . '理由：' . $get_request['reason'];
                                  }
                                  ?>
                                  <input type="hidden" name="start_date" value="<?php echo $get_request['start_date']?>">
                                  <input type="hidden" name="end_date" value="<?php echo $get_request['end_date']?>">
                                  <input type="hidden" name="reason" value="<?php echo $get_request['reason']?>">
                              </strong>
                          </h3>
                      <?php
                      }

                      if ($get_request['type']==EVENT_TRY)
                      {
                          ?>
                          <h3 class="text-red">
                              <strong>
                                  <?php
                                  echo 'コース名：'.$get_request['course_name'];
                                  if ($get_request['memo']!=null) {
                                      echo "<br>" . '理由：' . $get_request['memo'];
                                  }
                                  ?>
                                  <input type="hidden" name="event_course_id" value="<?php echo $get_request['course_id']?>">
                                  <input type="hidden" name="memo" value="<?php echo $get_request['memo']?>">
                              </strong>
                          </h3>
                          <?php
                      }
                      if ($get_request['type']==BUS_CHANGE_ETERNAL)
                      {
                          ?>
                          <input type="hidden" name="type_bus" value="<?php echo BUS_CHANGE_ETERNAL?>">
                      <?php
                          if ($get_request['bus_use_flg']==DATA_OFF)
                            {
                                  ?>
                                  <h3 class="text-red">
                                      <strong>バスを使わない</strong>
                                  </h3>
                                <input type="hidden" name="not_use_bus" value="<?php echo ZERO ?>">
                                  <?php
                            }
                            elseif ($get_request['bus_use_flg']==DATA_ON)
                              {
                                  $postvalue = base64_encode(serialize($get_request['body_content']));
                                  ?>
                                  <input type="hidden" name="use_bus" value="<?php echo ONE ?>">
                                  <input type="hidden" name="body_content" value="<?php echo $postvalue?>">
                                  <input type="hidden" name="date_change_bus" value="<?php echo $get_request['change_date_bus']?>">
                                  <?php
                                      foreach ($get_request['content'] as $key_content=> $row_content) {
                                          echo "<h3><strong>"."クラス：".$key_content."</strong></h3>";
                                          foreach ($row_content as $bus_key=> $bus_row)
                                          {
                                              if ($bus_key==ZERO)
                                              {
                                                  ?>
                                                  <h4>
                                                      行きの乗車場所：
                                                  </h4>
                                                  <?php
                                              }
                                              if ($bus_key==TWO)
                                              {
                                                  ?>
                                                  <h4>
                                                      帰りの降車場所：
                                                  </h4>
                                                  <?php
                                              }
                                                  ?>
                                              <?php
                                              if ($bus_key==ZERO || $bus_key==TWO)
                                              {
                                                  ?>
                                                  <h3 class="h4">
                                                      <strong><?php echo $bus_row['bus_course_name']."【".$bus_row['route_order']."】".$bus_row['bus_stop_name']?></strong>
                                                  </h3>
                                                  <?php
                                              }
                                              ?>
                                              <p  class="arrow_down_<?php echo $bus_key?>">
                                                  <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                              </p>
                                              <?php
                                              if ($bus_key==ONE || $bus_key==THREE)
                                              {
                                                  ?>
                                                  <h3 class="text-red">
                                                      <strong><?php echo $bus_row['bus_course_name']."【".$bus_row['route_order']."】".$bus_row['bus_stop_name']?></strong>
                                                  </h3>
                                                  <br>
                                                  <?php
                                              }
                                          }
                                              ?>
                                              <hr>
                                              <?php
                                      }
                                  ?>
                                  <?php
                              }
                      }
                      ?>
                  </div>
                </div>

                <div class="block-15 text-center">
                  <label class="radio-inline">
                    <input type="radio" name="status" value="<?php echo ZERO?>" <?php if ($get_request['status']==ZERO) echo "checked"?>> 未処理
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" value="<?php echo ONE?>"  <?php if ($get_request['status']==ONE) echo "checked"?>> 承認（処理済）
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" value="<?php echo TWO?>"  <?php if ($get_request['status']==TWO) echo "checked"?>> 保留
                  </label>
                </div>
                <textarea class="form-control" rows="3" name="message" placeholder="保留時の会員へのメッセージ（受付にて直接手続きする等）"><?php
                    if ($get_request['message']!=NULL)
                    {
                        echo $get_request['message'];
                    }
                    ?></textarea>
                <div class="block-15 text-center">
                  <label class="radio-inline">
                    <input type="radio" name="comission_flg" value="<?php echo ONE?>" <?php if ($get_request['comission_flg']==ONE) echo "checked"?>> 手数料発生
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="comission_flg" value="<?php echo TWO?>" <?php if ($get_request['comission_flg']==TWO) echo "checked"?>> 手数料免除
                  </label>
                </div>
                <div class="block-15 text-center">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="medley" value="<?php echo ONE?>" <?php if ($get_request['melody_flg']==DATA_ON) echo "checked"?>> MEDLEY入力
                  </label>
                </div>
              </div>
            </section>
        </div>
      </div>
        <?php if (isset($get_request['first_time_change_bus'])==0) {?>
        <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="<?php echo site_url('admin/request')?>">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <button id="update_request" class="btn btn-success btn-block" href="<?php echo site_url('admin/request/edit/'.$get_request['id'])?>">
              <span>更新</span>
            </button>
          </p>
        </div>
            <?php
            }
            ?>
      </div>
    </div>

  </main>

  <?php
    if (isset($get_bus_course) && $get_request['first_time_change_bus']==1) {
        ?>
        <main class="content content-dark">
            <div class="container">

                <div class="panel panel-dotted">
                    <div class="panel-heading">
                        <span class="text-violet">契約変更詳細</span>
                        <a style="display: none" href="#0" class="btn btn-primary btn-sm pull-right">
                            <strong>CSV出力</strong>
                        </a>
                    </div>
                    <div class="panel-body">

                        <section>
                            <div class="table-responsive">
                                <table class="table table-lg table-violet table-outline mb-0">
                                    <thead>
                                    <tr>
                                        <th>会員番号</th>
                                        <th>氏名</th>
                                        <th>申請日</th>
                                        <th>申請内容</th>
                                        <th>処理状況</th>
                                        <th>処理日</th>
                                        <th>手数料</th>
                                        <th>MEDLEY</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $contents=json_decode($get_bus_course['contents'],true);
                                    switch ($get_bus_course['type'])
                                    {
                                        case 'bus_change_once':
                                            $get_bus_course['type_jp']='バス乗降連絡';
                                            break;
                                        case 'bus_change_eternal':
                                            $get_bus_course['type_jp']='バスコース変更';
                                            break;
                                        case 'course_change':
                                            $get_bus_course['type_jp']='練習コース変更';
                                            break;
                                        case 'recess':
                                            $get_bus_course['type_jp']='休会届';
                                            break;
                                        case 'quit':
                                            $get_bus_course['type_jp']='退会届';
                                            break;
                                        case 'event_entry':
                                            $get_bus_course['type_jp']='イベント・短期教室参加申請';
                                            break;
                                        case 'address_change':
                                            $get_bus_course['type_jp']='住所変更申請';
                                            break;
                                    }
                                    switch ($get_bus_course['status'])
                                    {
                                        case '0':
                                            $get_bus_course['status_jp']='未処理/未確認';
                                            break;
                                        case '1':
                                            $get_bus_course['status_jp']='承認/処理済み/確認済み';
                                            break;
                                        case '2':
                                            $get_bus_course['status_jp']='保留';
                                            break;
                                    }
                                    switch ($get_bus_course['comission_flg'])
                                    {
                                        case '0': $get_bus_course['comission_flg_jp']='無し'; break;
                                        case '1': $get_bus_course['comission_flg_jp']='手数料発生'; break;
                                        case '2': $get_bus_course['comission_flg_jp']='免除'; break;
                                    }
                                    switch ($get_bus_course['melody_flg'])
                                    {
                                        case '0': $get_bus_course['melody_flg_jp']='未'; break;
                                        case '1':$get_bus_course['melody_flg_jp']='済'; break;
                                    }
                                    if ($get_bus_course['process_date']==NULL)
                                    {
                                        $get_bus_course['process_date']='---';
                                    }
                                    else
                                    {
                                        $get_bus_course['process_date'] = date('Y-m-d', strtotime($get_bus_course['process_date']));
                                    }
                                    ?>
                                    <tr>
                                        <th><?php echo $get_bus_course['student_id']?></th>
                                        <td><a href="<?php echo  site_url('admin/member/detail/'.$get_bus_course['student_id'])?>" class="btn btn-default"><?php echo $get_request['name']?></a></td>
                                        <td><?php echo date('Y-m-d',strtotime($get_bus_course['create_date']))?></td>
                                        <td><?php echo $get_bus_course['type_jp']?></td>
                                        <td><?php echo $get_bus_course['status_jp']?></td>
                                        <td><?php echo $get_bus_course['process_date']?></td>
                                        <td><?php echo $get_bus_course['comission_flg_jp']?></td>
                                        <td><?php echo $get_bus_course['melody_flg_jp']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                            <section>
                                <div class="block-30">
                                    <div class="panel panel-dotted panel-red">
                                        <div class="panel-body text-center">
                                            <input type="hidden" name="request_bus_id" value="<?php echo $get_bus_course['id']?>">
                                            <?php
                                            if ($get_request['bus_use_flg']==DATA_OFF)
                                            {
                                                ?>
                                                <h3 class="text-red">
                                                    <strong>バスを使わない</strong>
                                                </h3>
                                                <input type="hidden" name="not_use_bus" value="<?php echo ZERO ?>">
                                                <?php
                                            }
                                            elseif ($get_request['bus_use_flg']==DATA_ON)
                                            {
                                                $postvalue = base64_encode(serialize($get_request['body_content']));
                                                ?>
                                                <input type="hidden" name="use_bus" value="<?php echo ONE ?>">
                                                <input type="hidden" name="date_change_bus" value="<?php echo $get_request['change_date_bus']?>">
                                                <input type="hidden" name="body_content" value="<?php echo $postvalue?>">
                                                <?php
                                                foreach ($get_request['content'] as $key_content=> $row_content) {
                                                    echo "<h3><strong>"."クラス：".$key_content."</strong></h3>";
                                                    foreach ($row_content as $bus_key=> $bus_row)
                                                    {
                                                        if ($bus_key==ZERO)
                                                        {
                                                            ?>
                                                            <h4>
                                                                行きの乗車場所：
                                                            </h4>
                                                            <?php
                                                        }
                                                        if ($bus_key==TWO)
                                                        {
                                                            ?>
                                                            <h4>
                                                                帰りの降車場所：
                                                            </h4>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($bus_key==ZERO || $bus_key==TWO)
                                                        {
                                                            ?>
                                                            <h3 class="h4">
                                                                <strong><?php echo $bus_row['bus_course_name']."【".$bus_row['route_order']."】".$bus_row['bus_stop_name']?></strong>
                                                            </h3>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p  class="arrow_down_<?php echo $bus_key?>">
                                                            <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                                        </p>
                                                        <?php
                                                        if ($bus_key==ONE || $bus_key==THREE)
                                                        {
                                                            ?>
                                                            <h3 class="text-red">
                                                                <strong><?php echo $bus_row['bus_course_name']."【".$bus_row['route_order']."】".$bus_row['bus_stop_name']?></strong>
                                                            </h3>
                                                            <br>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <hr>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type_bus_course" value="<?php echo BUS_CHANGE_ETERNAL?>">
                                    <div class="block-15 text-center">
                                        <label class="radio-inline">
                                            <input type="radio" name="comission_flg_bus" value="<?php echo ONE?>" <?php if ($get_bus_course['comission_flg']==ONE) echo "checked"?>> 手数料発生
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="comission_flg_bus" value="<?php echo TWO?>" <?php if ($get_bus_course['comission_flg']==TWO) echo "checked"?>> 手数料免除
                                        </label>
                                    </div>
                                    <div class="block-15 text-center">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="medley_bus" value="<?php echo ONE?>" <?php if ($get_bus_course['melody_flg']==DATA_ON) echo "checked"?>> MEDLEY入力
                                        </label>
                                    </div>
                                </div>
                            </section>
                    </div>
                </div>

                <div class="block-15 text-center row">
                    <div class="col-sm-4 col-sm-offset-2">
                        <p>
                            <a class="btn btn-default btn-block" href="<?php echo site_url('admin/request')?>">
                                <span>戻る</span>
                            </a>
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <p>
                            <button id="update_request" class="btn btn-success btn-block" href="<?php echo site_url('admin/request/edit/'.$get_request['id'])?>">
                                <span>更新</span>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            </form>
        </main>
        <?php
    }
  ?>


  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<button style=" visibility: hidden;" type="button" id="popup" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
</button>

<div id="myModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="status_update"></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid }
</style>

<script type="text/javascript">
    //update data
    $(document).ready(function() {
        $("#update_request").click(function(e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.ajax({
                type: 'POST',
                data: $('#request_form').serialize(),
                url: url,
                dataType:'json',
                success: function (data) {
                    if (data.status  == 1) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-success');
                        $("#status_update").html("<b>情報を更新しました。 </b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                                window.location = url_top + '/request';
                            });
                        }, 1000);
                    }
                }
            });
    });
    });

    //
    $(document).ready(function() {
        $('.arrow_down_1').css('display','none');
        $('.arrow_down_3').css('display','none');
        $('.arrow_down_5').css('display','none');
        $('.arrow_down_7').css('display','none');
        $('.arrow_down_9').css('display','none');
        $('.arrow_down_11').css('display','none');
        $('.arrow_down_13').css('display','none');
    });
</script>
