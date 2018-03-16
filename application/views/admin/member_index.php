<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">
      <div id="js_msg_err_member">
        <div class="block-30">
          <div class="alert alert-danger text-center">
            <h3>
              <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
              <strong>ERROR!</strong>
            </h3>
            <p></p>
          </div>
        </div>
        <hr class="hr-dashed">
      </div>
      
      <h1 class="lead-heading bg-blue-green h3">会員一覧</h1>

      <div class="panel panel-dotted">
        <div class="panel-body">

          <div class="block-30 text-center">
            <button class="btn btn-danger btn-lg btn-long" id="goto_page">新規会員登録</button>
          </div>

          <form id="" method="post">
            <div>
              <div class="panel panel-dotted panel-blue-green">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h3 class="panel-title">
                    <a class="btn btn-link btn-block btn-lg" role="button" data-toggle="collapse" data-parent="#searchBox" href="#searchBoxCollapse">
                      <strong>絞り込み検索</strong>
                      <br>
                      <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                  </h3>
                </div>
                <div id="searchBoxCollapse" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="block-30">
                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">会員番号</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="number" class="form-control" id = "id_from" name="id_from" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="number" class="form-control" id = "id_to" name="id_to" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">氏名</label>
                        <div class="col-sm-4">
                          <input type="text"  class="form-control" id = "name" name="name" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">氏名カナ</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id = "name_kana" name="name_kana" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">性別</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id = "sex" name="sex" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">生年月日</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id = "birthday" name="birthday" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">郵便番号</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id = "zip" name="zip" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">住所</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="address" name="address" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">TEL</label>
                        <div class="col-sm-4">
                          <input type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" id="tel" name="tel" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">緊急連絡先</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="emergency_tel" name="emergency_tel" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">入会年月日</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="join_date" name="join_date" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">休会期間</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" id="leave_duration_from" name="leave_duration_from" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" id="leave_duration_to" name="leave_duration_to" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">休会理由</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="quit_reason" name="quit_reason" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">退会日付</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" id ="drawal_date_from" name="drawal_date_from" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" id="drawal_date_to" name="drawal_date_to" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">練習コース</label>
                        <div class="col-sm-4">
                          <div class="form">
                            <input type="text" class="form-control" id="practice_course" name="practice_course" value="" placeholder="はコースコードで">
                            <!-- <input type="text" class="form-control" id="practice_course_from" name="practice_course" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" id="practice_course_to" name="practice_course_to" value="" placeholder="TO"> -->
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">級</label>
                        <div class="col-sm-4">
                          <div class="">
                            <input type="text" class="form-control" id="level" name="level" value="" placeholder="級">
                            <!-- <input type="text" class="form-control" id="level_from" name="level_from" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="level_to" id="level_to" value="" placeholder="TO"> -->
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">クラス</label>
                        <div class="col-sm-4">
                          <div class="">
                            <input type="text" class="form-control" id="class_from" name="class_from" value="" placeholder="クラス">
                            <!-- <input type="text" class="form-control" id="class_from" name="class_from" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" id="class_to" name="class_to" value="" placeholder="TO"> -->
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">退会者</label>
                        <div class="col-sm-10">
                          <label class="checkbox-inline">
                            <input type="checkbox" id='all_user'> 含める
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" id='sub_user'> 含めない
                          </label>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="panel-footer">
                  <div class="block-30 text-center">
                    <a class="btn btn-primary btn-lg btn-long" id = "search_button">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <span>検索</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-30" id="js-scroll-to">
              <span class="pull-left text-small">検索結果&#58;
                <strong class="h4" id="js-count_rel">
                  <?php if(!empty($rel_search_top[1])){
                    echo $rel_search_top[1];
                  }else{
                    echo 0;
                  }
                  ?>
                </strong> 件
              </span>
              <a class="btn btn-default btn-sm pull-right" id = "js-export-csv">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <span>この条件のCSVを出力</span>
              </a>
            </div>

          </form>

          <form action="<?php echo base_url('/admin/member/export_filter');?>" method = "POST">
            <input type="hidden" id="condition_search" value = '' name = "data_input_search">
            
            <?php if(isset($condition_input)){?>
              <input type="hidden" id = "condition_text" name = "type_condition" value = "<?php $tmp_condition = !empty($condition_input['type_condition']) ?  $condition_input['type_condition'] : ''; echo $tmp_condition;?>">
              <input type="hidden" id = "input_text" name = "text_condition" value = "<?php $tmp_condition_text_filter = !empty($condition_input['text_filter']) ?  $condition_input['text_filter'] : ''; echo $tmp_condition_text_filter;?>">
            <?php }?>
            <input type="submit" style ="display:none" id="submit_form_csv">
          </form>

          <hr class="hr-dashed">


          <section>
            <div class="table-responsive">
              <table class="table table-lg table-blue-green table-outline mb-0" id="table_list_member">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>練習コース</th>
                    <th>クラス</th>
                    <th>級・組</th>
                    <th>バス停</th>
                    <th>状態</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                
                  <?php if(!empty($rel_search_top[0])){?>
                    <?php foreach ($rel_search_top[0] as $key_stop => $value_stop) {?>
                      <tr>
                        <td><?php echo $value_stop['id'];?></td>
                        <td><?php echo $value_stop['name'];?></td>
                        <td><?php echo $value_stop['course_name'];?></td>
                        <td><?php echo $value_stop['base_class_sign'];?></td>
                        <td><?php echo $value_stop['class_name'];?></td>
                        <td><?php echo $value_stop['bus_stop_name'];?></td>
                        <td><?php 
                          $string_status = '';
                          switch ($value_stop['status']) {
                              case "0":
                                  $string_status = '未処理状態';
                                  break;
                              case "1":
                                  $string_status = '入会中';
                                  break;
                              case "2":
                                  $string_status = '退会保留中';
                                  break;
                              default:
                                  $string_status = '退会済み';
                                  break;
                          }
                          echo $string_status;?></td>
                        <td><a href="<?php echo base_url('admin/member/detail/'.$value_stop['id']);?>" class="btn btn-success btn-sm btn-block">詳細</a></td>
                        
                      </tr>
                    <?php }?>
                  <?php }else{?>
                    <tr>
                      <td colspan = "7" style ="text-align: center">データがありません。</td>
                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>

      <div class="block-15 text-center" id="pagination">
        <?php if(!empty($pagination)){?>
          <?php echo $pagination; ?>
        <?php }?>
      </div>
    </div>

  </main>

  <script>
    //load data member
    $(document).on('ready',function(){
        var data_input_search_item;
        $.fn.datepicker.dates['jp'] = {
            days: ["日", "月", "火", "水", "木", "金", "土", "日"],
            daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
            daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
            months:  ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            monthsShort:  ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],
            today: "今日",
            clear: "クリア",
            weekStart: 0
        };
        var options={
            isRTL: false,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            language:'jp',
            orientation: "auto right",
        };

        $("#leave_duration_from").datepicker({
            isRTL: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
            language:'jp',
            orientation: "auto right"
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#leave_duration_to').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('#leave_duration_to').datepicker('setStartDate', null);
        });

        $("#leave_duration_to").datepicker({
            isRTL: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
            language:'jp',
            orientation: "auto right"
        }).on('changeDate', function (selected) {
            var endDate = new Date(selected.date.valueOf());
            $('#leave_duration_from').datepicker('setEndDate', endDate);
        }).on('clearDate', function (selected) {
            $('#leave_duration_from').datepicker('setEndDate', null);
        });


        $("#drawal_date_from").datepicker({
            isRTL: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
            language:'jp',
            orientation: "auto right"
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#drawal_date_to').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('#drawal_date_to').datepicker('setStartDate', null);
        });
        
        $("#drawal_date_to").datepicker({
            isRTL: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
            language:'jp',
            orientation: "auto right"
        }).on('changeDate', function (selected) {
            var startDate = new Date(selected.date.valueOf());
            $('#drawal_date_from').datepicker('setStartDate', startDate);
        }).on('clearDate', function (selected) {
            $('#drawal_date_from').datepicker('setStartDate', null);
        });

        $('#join_date').datepicker(options).on('changeDate', function(ev){
        });
        $('#birthday').datepicker(options).on('changeDate', function(ev){
        });

        $("#search_button").on('click',function (e) {
          
          let data = get_value_input();
          let flag_check_ft = check_input_type_from(data);
          e.preventDefault();
          if(flag_check_ft){
            load_request_data(0);
          }else{
            // alert('');
            let msg = '「会員番号」データが無効です';
            show_div_err(msg);
          }
         
        });

        //set number relsult
        function set_number_of_rel(number) {
          $('#js-count_rel').html(number);
        }
        //scroll to
        function srcoll_to_div(id_div) {
          $('html,body').animate({
                    scrollTop: $(id_div).offset().top},
                'slow');
        }
        function reset_table() {
          $('#table_list_member tbody').html('');
          $('#pagination').html('');
        }
        function set_condition(data) {
          $('#condition_search').val(data);
        }

        function show_div_err(msg) {
          srcoll_to_div('.content-dark');
          $('#js_msg_err_member').show();
          setTimeout(function(){
            $('#js_msg_err_member').fadeOut();
          }, 2000);
          $('#js_msg_err_member p').html(msg);
        }
        // load data list member
        function load_request_data(page)
        {
            data_input_search_item = get_value_input();
            var status_input = false;
            $.each(data_input_search_item, function(index, value) {
                if((value == '') || (value == false)){      
                }else{
                  status_input = true;
                  return false;
                }
            });
            var tmp_input_json = JSON.stringify(data_input_search_item);
            set_condition(tmp_input_json);
            if(status_input){
              $.ajax({
                url:"<?php echo base_url(); ?>admin/member/ajax_load_member_filter/"+page,
                method:"POST",
                dataType:"json",
                data:{data_input_search: data_input_search_item},
                success:function(data)
                {
                  set_number_of_rel(data.total);
                  srcoll_to_div('#js-scroll-to');
                  reset_table();
                  $('#table_list_member tbody').html(data.list);
                  $('#pagination').html(data.pagination);
                }
              });
            }else{
              $.ajax({
                url:"<?php echo base_url(); ?>admin/member/ajax_load_list_member/"+page,
                method:"POST",
                dataType:"json",
                data:{flag_load: 'all'},
                success:function(data)
                {
                  set_number_of_rel(data.total);
                  srcoll_to_div('#js-scroll-to');
                  reset_table();
                  $('#table_list_member tbody').html(data.list);
                  $('#pagination').html(data.pagination);
                }
              });
            }
        }

        function get_value_input() {
          var data_input = [];
          var all_user = $("#all_user").prop("checked") ? true : false;
          var sub_user = $("#sub_user").prop("checked") ? true : false;
          data_input = {'id_from': $('#id_from').val(),
                        'id_to': $('#id_to').val(),
                        'name': $('#name').val(),
                        'name_kana': $('#name_kana').val(),
                        'sex': $('#sex').val(),
                        'birthday': $('#birthday').val(),
                        'zip': $('#zip').val(),
                        'address': $('#address').val(),
                        'tel': $('#tel').val(),
                        'emergency_tel': $('#emergency_tel').val(),
                        'enter_date': $('#join_date').val(),//ngày nhập hội
                        'leave_duration_from': $('#leave_duration_from').val(),//khoảng thời gian bắt đầu tạm nghỉ
                        'leave_duration_to': $('#leave_duration_to').val(),//khoảng thời gian kết thúc nghỉ
                        'quit_reason': $('#quit_reason').val(),
                        'drawal_date_from': $('#drawal_date_from').val(),//thời gian rời hội
                        'drawal_date_to': $('#drawal_date_to').val(),//thời gian rời hội
                        'practice_course': $('#practice_course').val(),
                        'level': $('#level').val(),
                        'class_from': $('#class_from').val(),
                        // 'level_to': $('#level_to').val(),
                        // 'class_from': $('#class_from').val(),
                        // 'class_to': $('#class_to').val(),
                        'all_user': all_user,
                        'sub_user': sub_user,
                      };
        return data_input;
      }

      $(document).on("click", ".pagination-main li a", function(event){
          event.preventDefault();
          var href = $(this).attr("href");
          var page =$(this).attr("href").match(/\d+$/);
          if (page==null)
          {
              page=0;
          }
          load_request_data(page);
      });
      
      $('#js-export-csv').on('click', function() {
        if(($('#condition_search').val() != '') || (($('#condition_text').val() != '') && $('#condition_text').val())){
          $( "#submit_form_csv" ).trigger( "click" ); 
        }else{
          let msg = 'データがありません。';
          show_div_err(msg);
        }
      })

      $('#goto_page').on('click', function() {
        // window.location.replace("https:" + "<?php //echo base_url('/entry');?>");
        window.open("https:" + "<?php echo base_url('/entry');?>",'_blank');
      })

      function check_input_type_from(data) {
        var status = true;
        if((data['id_from'] != "") &&  (data['id_to'] != "") ){
          if(data['id_from'] > data['id_to']){
            status = false;
          }
        }
        return status;
      }

    });
  </script>
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
