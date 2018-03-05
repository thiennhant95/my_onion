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
                    <?php if(!empty($user['course']['nearest']['course_name'])){?>
                      <span class="label label-md label-main"><?php echo $user['course']['nearest']['course_name'];?></span>
                    <?php }?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">現在の級</label>
                  <div class="col-sm-5 control-text">
                  
                  <?php if(!empty($user['class']['nearest']['class_info'])){?>
                    <span class="label label-md label-info"><?php echo $user['class']['nearest']['class_info'][0]['class_name']?>級</span>
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
                          if(!empty($user['course']['nearest']['course_id'])){
                            $id_course_current = $user['course']['nearest']['course_id'];
                          }
                        ?>
                        <?php foreach ($user['course']['all'] as $key => $value) {?>
                          <option value="<?php echo $value['id'];?>" <?php if($value['id'] == $id_course_current){ echo "selected";}?>> <?php echo  $value['course_name'];?></option>
                        <?php }?>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">変更月</label>
                  <div class="col-sm-5">
                  <input class="form-control " type="text" id="start_date_request_change" name="start_date" placeholder="YYYY-MM">
                    <!-- <select class="form-control">
                      <option value="">2017年10月</option>
                    </select> -->
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
          <?php if(!empty($user['course']['nearest']['course_id'])){ ?>
            <input type = "hidden" id = "course_old" value = "<?php echo $user['course']['nearest']['course_id']?>"/>
          <?php }?>
          <div class="list_old_class">
            <?php if(!empty($list_class_selected)){?>
              <?php foreach ($list_class_selected as $key => $value_lcs) { ?>
                <input type = "hidden" value = "<?php echo $value_lcs['class_id']?>" />
              <?php }?>
            <?php }?>
          </div>
          
        </div>
      </form>

    </div>
  </main>
  <script>
    $(document).on('ready', function(){
      count_active();
      var list_class_new = [];
      list_class_new = get_list_class_selected();
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
            // e.preventDefault();
            $('html,body').animate({
                    scrollTop: $("#start_date_request_change").offset().top},
                'slow');
            setTimeout(() => {
              list_class_new = [];
              list_class_new = get_list_class_selected();
            }, 2000);
          }
        });
        count_active();
      })
      
      $(document).on ("click", "#table_change_course tbody tr td", function () {
        if ( !$(this).hasClass( 'disabled' ) ) {
          if($(this).hasClass( 'selected' )){
            $(this).removeClass( 'selected' );
            var name_new = $(this).attr('class');
            $(this).html(name_new);
            var id_selected = $(this).attr('id');
            id_selected = conver_id(id_selected);
            list_class_new = sub_list_class(id_selected, list_class_new);
          }else{
            var id_selected = $(this).attr('id');
            id_selected = conver_id(id_selected);
            list_class_new = sub_list_class(id_selected, list_class_new);
            $(this).addClass('selected');
            $(this).html('選択');
          }
          count_active();
        }
      });

      function count_active() {
        var count = 0;
        $('#table_change_course tbody tr').find('td').each (function() {
          
          if(($(this).hasClass('disabled')) || ($(this).hasClass('selected'))){
          }else{
            count++;
          }
        })
        $('#count').html(count-7);
      }
      
      function get_list_class_selected() {
        var list_data = [];
        
        $('#table_change_course tbody tr').find('td').each (function() {
          console.log(1);
          if($(this).hasClass('selected')){
            console.log(2);
          }
          if($(this).hasClass('selected')){
            var id_select = conver_id($(this).attr('id'));
            console.log(id_select);
            list_data.push(id_select);
          }
        });
        return  list_data;
        console.log(list_data);
      }

      function sub_list_class(id_selected, list_class) {
        id_selected = conver_id(id_selected);
        var status = list_class.indexOf(id_selected); 
        if(status != -1){
          list_class.splice(status, 1);
        }else{
          list_class.push(id_selected);
        }
        return list_class;
        
      }

      function conver_id(id) {
        var arr = id.split('_');
        var id_last = arr[1];
        return id_last;
      }
      $('#change_course_btn').on('click', function () {
        var course_old = $('#course_old').val();
        var list_class_old = [];
        $('.list_old_class').find('input').each (function() {
          var class_id = $(this).val();
          list_class_old.push(class_id);
        });
        var course_new = $('#select_course').val();
        var date_change =  $('#start_date_request_change').val();
        if(date_change){
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
              // window.location.href = "https:" + "<?php echo base_url('request/change_course_complete');?>"; 
            }
          });
        }else{
          alert('Please select date change');
        }
      })

  });
  </script>
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
