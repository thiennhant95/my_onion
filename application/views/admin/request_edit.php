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
          <a href="#0" class="btn btn-primary btn-sm pull-right">
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
                        $get_request['type']='バス乗降連絡';
                        break;
                    case 'bus_change_eternal':
                        $get_request['type']='バスコース変更';
                        break;
                    case 'course_change':
                        $get_request['type']='練習コース変更';
                        break;
                    case 'recess':
                        $get_request['type']='休会届';
                        break;
                    case 'quit':
                        $get_request['type']='退会届';
                        break;
                    case 'event_entry':
                        $get_request['type']='イベント・短期教室参加申請';
                        break;
                    case 'address_change':
                        $get_request['type']='住所変更申請';
                        break;
                }
                switch ($get_request['status'])
                {
                    case '0':
                        $get_request['status']='未処理/未確認';
                        break;
                    case '1':
                        $get_request['status']='承認/処理済み/確認済み';
                        break;
                    case '2':
                        $get_request['status']='保留';
                        break;
                }
                switch ($get_request['comission_flg'])
                {
                    case '0': $get_request['comission_flg']='無し'; break;
                    case '1': $get_request['comission_flg']='手数料発生'; break;
                    case '2': $get_request['comission_flg']='免除'; break;
                }
                switch ($get_request['melody_flg'])
                {
                    case '0': $get_request['melody_flg']='未'; break;
                    case '1':$get_request['melody_flg']='済'; break;
                }
                ?>
                  <tr>
                    <th><?php echo $get_request['student_id']?></th>
                    <td><a href="<?php ?>" class="btn btn-default"><?php echo $get_request['name']?></a></td>
                    <td><?php echo $contents['date_change']?></td>
                    <td><?php echo $get_request['type']?></td>
                    <td><?php echo $get_request['status']?></td>
                    <td><?php  echo $get_request['process_date']?:'---'?></td>
                    <td><?php echo $get_request['comission_flg']?></td>
                    <td><?php echo $get_request['melody_flg']?></td>
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
                                      }
                                      if ($row_class_old!=end($get_request['class_old'])) {
                                          echo $row_class_old . "・";
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
                                      }
                                      if ($row_class_new!=end($get_request['class_new'])) {
                                          echo $row_class_new . "・";
                                      }
                                  }
                                  echo "】";
                                  ?>
                              </strong>
                          </h3>
                          <?php
                      }
                      if ($get_request['type']=='住所変更申請')
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
                              </strong>
                          </h3>
                          <?php
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
                    <input type="checkbox" name="medley" value="<?php echo ONE?>"> MEDLEY入力
                  </label>

                </div>
              </div>
            </section>
          </form>

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

  </main>

  <?php
    if (isset($get_bus_course)) {
        ?>
        <main class="content content-dark">
            <div class="container">

                <div class="panel panel-dotted">
                    <div class="panel-heading">
                        <span class="text-violet">契約変更詳細</span>
                        <a href="#0" class="btn btn-primary btn-sm pull-right">
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
                                            $get_bus_course['type']='バス乗降連絡';
                                            break;
                                        case 'bus_change_eternal':
                                            $get_bus_course['type']='バスコース変更';
                                            break;
                                        case 'course_change':
                                            $get_bus_course['type']='練習コース変更';
                                            break;
                                        case 'recess':
                                            $get_bus_course['type']='休会届';
                                            break;
                                        case 'quit':
                                            $get_bus_course['type']='退会届';
                                            break;
                                        case 'event_entry':
                                            $get_bus_course['type']='イベント・短期教室参加申請';
                                            break;
                                        case 'address_change':
                                            $get_bus_course['type']='住所変更申請 ';
                                            break;
                                    }
                                    switch ($get_bus_course['status'])
                                    {
                                        case '0':
                                            $get_bus_course['status']='未処理/未確認';
                                            break;
                                        case '1':
                                            $get_bus_course['status']='承認/処理済み/確認済み';
                                            break;
                                        case '2':
                                            $get_bus_course['status']='保留';
                                            break;
                                    }
                                    switch ($get_bus_course['comission_flg'])
                                    {
                                        case '0': $get_bus_course['comission_flg']='無し'; break;
                                        case '1': $get_bus_course['comission_flg']='手数料発生'; break;
                                        case '2': $get_bus_course['comission_flg']='免除'; break;
                                    }
                                    switch ($get_bus_course['melody_flg'])
                                    {
                                        case '0': $get_bus_course['melody_flg']='未'; break;
                                        case '1':$get_bus_course['melody_flg']='済'; break;
                                    }
                                    ?>
                                    <tr>
                                        <th><?php echo $get_bus_course['student_id']?></th>
                                        <td><a href="<?php ?>" class="btn btn-default"><?php echo $get_request['name']?></a></td>
                                        <td><?php echo $contents['date_change']?></td>
                                        <td><?php echo $get_bus_course['type']?></td>
                                        <td><?php echo $get_bus_course['status']?></td>
                                        <td><?php  echo $get_bus_course['process_date']?:'---'?></td>
                                        <td><?php echo $get_bus_course['comission_flg']?></td>
                                        <td><?php echo $get_bus_course['melody_flg']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        <form>
                            <section>
                                <div class="block-30">
                                    <div class="panel panel-dotted panel-red">
                                        <div class="panel-body text-center">
                                            <h3 class="h4">
                                                <strong>変更前：千葉市花見川区xxx-xxx</strong>
                                            </h3>
                                            <p>
                                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                                            </p>
                                            <h3 class="text-red">
                                                <strong>変更後：八千代市八千代台xx-xxxx</strong>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="block-15 text-center">
                                        <label class="radio-inline">
                                            <input type="radio" name="" value="option1"> 未確認
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="" value="option2"> 確認済み
                                        </label>
                                    </div>
                                    <div class="block-15 text-center">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="" value=""> MEDLEY入力
                                        </label>

                                    </div>
                                </div>
                            </section>
                        </form>

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
                            <a class="btn btn-success btn-block" href="#0">
                                <span>更新</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </main>
        <?php
    }
  ?>


  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<script type="text/javascript">
    //update data
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
                                window.location = url_top + '/style';
                            });
                        }, 1000);
                    }
                    else if (data.status  == 0) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-danger');
                        $("#status_update").html("<b>この種目コードは既存しています。他の種目コードを入力してください。 </b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                            });
                        }, 10000);
                    }
                }
            });
    });
</script>
