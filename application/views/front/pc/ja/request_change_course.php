<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-change bg-light-blue h3">練習コース変更</h1>

      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">練習コース変更</div>
            <div class="panel-body">

              <section>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">現在のコース</label>
                  <div class="col-sm-5 control-text">
                    <?php if(!empty($user['course']['valid'][0]['course_name'])){?>
                      <span class="label label-md label-main"><?php echo $user['course']['valid'][0]['course_name'];?></span>
                    <?php }?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">現在の級</label>
                  <div class="col-sm-5 control-text">
                  
                  <?php if(!empty($user['course']['valid']['classjoin'])){?>
                    <span class="label label-md label-info"><?php echo $user['course']['valid']['classjoin'][0]['base_class_sign']?>級</span>
                  <?php }?>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">変更後コース</label>
                  <div class="col-sm-5">
                    <select class="form-control" id ="select_course">
                      <?php if(!empty($user['course']['all'])){?>
                        <?php 
                          $id_course_current = '';
                          if(!empty($user['course']['valid'][0]['course_id'])){
                            $id_course_current = $user['course']['valid'][0]['course_id'];
                          }
                        ?>
                        <?php foreach ($user['course']['all'] as $key => $value) {?>
                          <?php if($value['type'] == '0'){?>
                            <option value="<?php echo $value['id'];?>" <?php if($value['id'] == $id_course_current){ echo "selected";}?>> <?php echo  $value['course_name'];?></option>
                          <?php }?>
                        <?php }?>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">変更月</label>
                  <div class="col-sm-5">
                    <input class="form-control " type="text" id="start_date_request_change" name="start_date" placeholder="YYYY-MM">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-2">
                    <strong>
                      <small class="text-danger">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> 月の途中での変更を希望される方は、クラブ受付まで直接お問い合わせください。</small>
                    </strong>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <h2 class="h4 text-center">
                  <strong>希望する曜日・時間をタップしてください。</strong>
                </h2>
                <div class="table-responsive">
                  <table class="date-selector table table-bordered" data-counter="#count" id="table_change_course">
                    <thead>
                      <th></th>
                      <th>
                        <span class="type">M</span>
                        <span class="time">11:00～</span>
                      </th>
                      <th>
                        <span class="type">A</span>
                        <span class="time">13:30～</span>
                      </th>
                      <th>
                        <span class="type">B</span>
                        <span class="time">14:40～</span>
                      </th>
                      <th>
                        <span class="type">C</span>
                        <span class="time">15:55～</span>
                      </th>
                      <th>
                        <span class="type">D</span>
                        <span class="time">17:05～</span>
                      </th>
                      <th>
                        <span class="type">E</span>
                        <span class="time">18:05～</span>
                      </th>
                      <th>
                        <span class="type">F</span>
                        <span class="time">19:20～</span>
                      </th>
                    </thead>
                    <tbody>
                      
                      <!-- <tr>
                        <th>火</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr> -->
                      <?php echo $html;?>
                      
                    </tbody>
                  </table>
                </div>

                <div class="text-center">
                  <p class="block-15">
                    <span class="label label-danger label-lg">
                      あと
                      <span id="count">0</span>
                      ヶ所変更できます。
                    </span>
                  </p>
                  <p>
                    <strong>
                      <small class="text-danger">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>練習コースの変更には手数料が324円発生いたします。</span>
                      </small>
                    </strong>
                  </p>
                </div>
              </section>

            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <a class="btn btn-success btn-lg btn-long" id = "change_course_btn">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>変更する</span>
          </a>
        </div>
        <div id="infor_hidden">
          <?php if(!empty($user['course']['valid'][0]['course_id'])){ ?>
            <input type = "hidden" id = "course_old" value = "<?php echo $user['course']['valid'][0]['course_id']?>"/>
          <?php }?>
          <div class="list_old_class">
            <?php if(!empty($list_class_selected)){?>
              <?php foreach ($list_class_selected as $key_lcs => $value_lcs) { ?>
                <input type = "hidden" value = "<?php echo $value_lcs['week_num'].'_'.$value_lcs['class_id']?>" />
              <?php }?>
            <?php }?>
          </div>
          <?php if(!empty($practice_max)){?>
            <?php foreach ($practice_max as $key_practice => $value_practice) {?>
              <input type = "hidden" id = "practice_course" value = "<?php echo $value_practice['practice_max']?>" />
            <?php }?>
          <?php }?>
        </div>
      </form>
      <!-- DEV TRÍ CUSTOM  VV_JSC       -->
      <button id="show_show_btn" type="button" style = "display:none" class="btn btn-link btn-sm" data-toggle="modal" data-target="#showMsg">show list option</button>
      <section class="modal fade" id="showMsg" role="dialog" aria-labelledby="showMsg">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>WARNING!</strong>
              </h4>
              <div class="" style = "text-align: center ">
                  
                <span id = "msg_alert" center>

              </span>
              </div>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row" style = "text-align: center ">
              <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- END CUSTOM -->
    </div>
  </main>
  <script>
    $(document).on('ready', function(){

      count_active();
      var list_class_new = [];
      list_class_new = get_list_class_selected();
      var practice_max_of_course = $('#practice_course').val();

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

      var options = {
          isRTL: false,
          format: 'yyyy-mm',
          minViewMode: 'months',
          todayHighlight: true,
          autoclose: true,
          language:'jp',
          orientation: "auto right",
      };

      $('#start_date_request_change').datepicker(options).on('changeDate', function(ev){
      });

      $('#select_course').on('change', function() {
        var id_course =  $(this).val();

        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('request/change_course_ajax');?>",
          dataType: 'json',
          data: {
            flag_change_coure: 1,
            id_course : id_course
          },
          success: function (data_result) {

            $('#table_change_course tbody').html('');
            $('#table_change_course tbody').html(data_result.html);
            $('html,body').animate({
                    scrollTop: $("#start_date_request_change").offset().top},
                'slow');

            setTimeout(function(){
              list_class_new = [];
              list_class_new = get_list_class_selected();
            }, 2000);
            practice_max_of_course = data_result.practice_max
            
          }
        });
        count_active();
      })
      
      $(document).on ("click", "#table_change_course tbody tr td", function () {
        
        if ( !$(this).hasClass( 'disabled' ) ) {

          count_active();
          var total_select = count_item_selected();
          if((total_select + 1) > practice_max_of_course){
            if($(this).hasClass( 'selected' )){
              
              $(this).removeClass( 'selected' );
              var name_new = $(this).attr('class');
              $(this).html(name_new);
              var id_selected = $(this).attr('id');
              list_class_new = sub_list_class(id_selected, list_class_new);
              
            }else{
              

              var tmp_class = $(this).parent();
              var tmp_ = true;
              $(tmp_class).find('td').each (function() {
  
                if($(this).hasClass('selected')){
                  tmp_ = false;
                  return false;
                }
              });
              
              if(tmp_){
                var msg = "MAX PRACTICE " + practice_max_of_course;
                show_msg(msg);
              }
            }
            
          } else {
            if($(this).hasClass( 'selected' )){

              $(this).removeClass( 'selected' );
              var name_new = $(this).attr('class');
              $(this).html(name_new);
              var id_selected = $(this).attr('id');
              list_class_new = sub_list_class(id_selected, list_class_new);

            } else {
              var tmp_class = $(this).parent();
              var tmp_ = true;
              $(tmp_class).find('td').each (function() {
  
                if($(this).hasClass('selected')){
                  tmp_ = false;
                  return false;
                }
              });
              
              if(tmp_){
                var id_selected = $(this).attr('id'); 
                list_class_new = sub_list_class(id_selected, list_class_new);
                $(this).addClass('selected');
                $(this).html('選択');
                var tmp_class = $(this).parent();
              }

            }
          } 
        }
      });

      function count_item_selected() {
        var count_tmp = 0;
        $('#table_change_course tbody tr').find('td').each (function() {
          ($(this).hasClass('selected')) ? count_tmp++ : 0;
        })
        return count_tmp;
      }

      function count_active() {
        var count = 0;
        $('#table_change_course tbody tr').find('td').each (function() {
          ($(this).hasClass('disabled')) || ($(this).hasClass('selected')) ? 1 : count++;
        })
        $('#count').html(count-7);
      }
      
      function get_list_class_selected() {
        var list_data = [];
        $('#table_change_course tbody tr').find('td').each (function() {
  
          if($(this).hasClass('selected')){
            var id_select = $(this).attr('id');
            list_data.push(id_select);
          }

        });
        return  list_data;
      }

      function sub_list_class(id_selected, list_class) {

        // id_selected = conver_id(id_selected);
        var status = list_class.indexOf(id_selected); 
        (status != -1) ? list_class.splice(status, 1) : list_class.push(id_selected);
        return list_class;
        
      }

      function conver_id(id) {

        var arr = id.split('_');
        var id_last = arr[1];
        return id_last;

      }

      $('#change_course_btn').on('click', function () {

        var course_new = $('#select_course').val();
        var date_change =  $('#start_date_request_change').val();
        var date_now = formatDate();

        var course_old = $('#course_old').val();
        var list_class_old = [];
        $('.list_old_class').find('input').each (function() {
          var class_id = $(this).val();
          list_class_old.push(class_id);
        });
        
        if(date_change){

          if(date_change <= date_now ){

            srcoll_to_div('#start_date_request_change');
            var err_msg = '変更月は次の月以降で入力してください。';//vui lòng chọn tháng trong tương lai
            show_msg(err_msg);

          } 
          else {

            $.ajax({
              type: "POST",
              url: "https:" + "<?php echo base_url('request/change_class_of_course_ajax');?>",
              dataType: 'json',
              data: {
                flag_change_class: 1,
                id_course_new : course_new,
                list_class_new: list_class_new,
                list_class_old: list_class_old,
                id_course_old : course_old,
                date_change : date_change
              },
              success: function (data_result) {
                // console.log(data_result);
                window.location.href = "https:" + "<?php echo base_url('request/change_course_complete');?>"; 
              }
            });

          }
        }
        else{

          srcoll_to_div('#start_date_request_change') ;
          var err_msg = '変更月を入力してください。';//vui lòng chọn tháng để chuyển đổi
          show_msg(err_msg);
          
        }
      })

      function formatDate() {
          var d = new Date(),
              month = '' + (d.getMonth() + 1),
              day = '' + d.getDate(),
              year = d.getFullYear();

          if (month.length < 2) month = '0' + month;
          if (day.length < 2) day = '0' + day;

          return [year, month].join('-');
      }

      function show_msg(string) {
        $('#show_show_btn').trigger('click');
        $('#msg_alert').html(string);
      }

      function srcoll_to_div(id_div) {
        $('html,body').animate({
                  scrollTop: $(id_div).offset().top},
              'slow');
      }

  });
  </script>
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
