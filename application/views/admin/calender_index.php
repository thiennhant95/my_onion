<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>
  <main class="content content-dark">
    <div class="container">
      <form class="form-horizontal">

        <div class="panel panel-dotted">
          <div class="panel-heading">
            <span class="text-blue">カレンダー設定</span>
          </div>
          <div class="panel-body">

            <!-- <div class="block-30">
              <div class="alert alert-danger text-center">
                <h3>
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <strong>更新エラー</strong>
                </h3>
                <p>何度も失敗する場合はシステム担当へお問い合わせください。</p>
              </div>
            </div> -->

            <!-- <hr class="hr-dashed"> -->
            <div class="block-15 text-center">
              <button class="btn btn-success btn-long" type = "button" id = "absent_date" disabled>休館</button>
              <button class="btn btn-warning btn-long" type = "button" id = "test_examp" disabled>テスト</button>
            </div>

            <div class="block-15">
              <div id='calendar'></div>
            </div>
          </div>
        </div>

        <div class="panel panel-dotted">
          <div class="panel-heading">
            <span class="text-blue">振替不可日の設定</span>
          </div>
          <div class="panel-body">
            <div class="block-15 text-center">
              <button type = "button" class="btn btn-success btn-long btn-lg" id = "add_date_input">
                <span>設定追加</span>
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
            </div>

            <div id="block_input_date">
              <?php 
                if(!empty($rel_intransfer))
                {
                  $list_date_selected = json_decode($rel_intransfer[0]['contents']);
                  $id_intransfer = $rel_intransfer[0]['id'];?>
                  <input type = "hidden" value="<?php echo $id_intransfer?>">
                  <?php foreach ($list_date_selected as $key_select => $value_select) {?>
                    <div class="row block-15">
                        <div class="col-sm-4 col-sm-offset-2">
                          <select class="form-control">
                            <?php 
                              foreach ($my_month as $key_month => $value_month) {
                                if($key_month != '0'){
                                  if($value_select == $key_month){ 
                            ?>
                                <option selected value=" <?php echo $key_month; ?>"><?php echo $value_month;?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $key_month; ?>">
                                  <?php echo $value_month;?>
                                </option>
                            <?php 
                                  }
                                }
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-3"><a class="btn delete-intransfer btn-default btn-block">
                          <i class="fa fa-trash-o" aria-hidden="true"></i><span>削除</span></a>
                        </div>
                    </div>
                  <?php    
                      }
                    }
                  ?>
            </div>
          </div>
        </div>

        <div class="block-15 text-center row">
          <div class="col-sm-4 col-sm-offset-2">
            <p>
              <a class="btn btn-default btn-block">
                <span>戻る</span>
              </a>
            </p>
          </div>
          <div class="col-sm-4">
            <p>
              <a id = "update_date_transfer" class="btn btn-warning btn-block">
                <span>更新</span>
              </a>
            </p>
          </div>
        </div>

      </form>
    </div>
      <!-- DEV TRI CUSTOME -->
      <button id="show_show_btn" type="button" style = "display:none" class="btn btn-link btn-sm" data-toggle="modal" data-target="#showMsgCalendar">show list option</button>
      <section class="modal fade" id="showMsgCalendar" role="dialog" aria-labelledby="showMsgCalendar">
        <div class="modal-dialog modal fix-width-modal">
          
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-center">
                  <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                  <strong>通知</strong>
              </h3>
            </div>
            <div class="modal-body">
              
              <div class="" style = "text-align: center ">
                  
                <span id="msg_alert_calender" center>

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
      <!-- prop confirm -->
      <button id="show_show_confirm" type="button" style = "display:none" class="btn btn-link btn-sm" data-toggle="modal" data-target="#showConfCalendar">show list option</button>
      <section class="modal fade" id="showConfCalendar" role="dialog" aria-labelledby="showConfCalendar">
        <div class="modal-dialog modal">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-center">
                  <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                  <strong>通知</strong>
              </h3>
            </div>
            <div class="modal-body">
              <div class="" style = "text-align: center ">
                <p center>
                この内容を削除します。よろしいでしょうか？
                </p>
              </div>
            </div>
            <div class="modal-footer">
              
                <button type="button" id = "remove_event_date" class="btn btn-success fix-df-btn" data-dismiss="modal">OK</button>
            
                <button type="button" class="btn btn-danger fix-df-btn" data-dismiss="modal">キャンセル</button>
              
            </div>
          </div>
        </div>
      </section>
      <!--END DEV TRI CUSTOME -->
  </main>
  <script>

    $(document).on('ready',function () {

      var initialLocaleCode = 'ja',
          arr_monday = [],
          date = new Date(),
          d = date.getDate(),
          m = date.getMonth() + 1,
          y = date.getFullYear(),
          start_date_selected = '',
          end_date_selected = '',
          month_current_select = '',
          year_current_select = '',
          all_day_select = '',
          last_month = (m - 1) <= 0 ? '去年' : (m - 1),
          next_month = (m == 12) ? '来年' : (m + 1),
          list_monday = [];

      var MONDAY = "<?php echo EVERY_MONDAY ?>",
          TUESDAY = "<?php echo EVERY_TUESDAY ?>",
          WENDAY = "<?php echo EVERY_WENDAY ?>",
          THUSDAY = "<?php echo EVERY_THUSDAY ?>",
          FRIDAY = "<?php echo EVERY_FRIDAY ?>",
          SATUDAY = "<?php echo EVERY_SATUDAY ?>",
          SUNDAY = "<?php echo EVERY_SUNDAY ?>",
          DATE_TEST = "<?php echo DATE_TEST ?>",
          DATE_CLOSED = "<?php echo DATE_CLOSED ?>";

      var calendar = $('#calendar').fullCalendar({
        editable: false,
        locale: initialLocaleCode,
        unselectAuto: false,
        displayEventTime: false,
        customButtons: {
          pre_event: {
            text: '< ' + last_month + '月',
            click: function() {
              $('#calendar').fullCalendar('prev');
              get_prev_month();
            }
          },
          next_event: {
            text: next_month + '月' + ' >',
            click: function() {
              $('#calendar').fullCalendar('next');
              get_prev_month();
            }
          }
        },
        header: {
          left: 'pre_event',
          center: 'title',
          right: 'next_event'
        },
        // events: "events.php",
        eventRender: function (event, element, view) {
          if (event.allDay === 'true') {
            event.allDay = true;
          } 
          else {
            event.allDay = false;
          }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
          
          start_date_selected = fmt(start);
          end_date_selected = fmt(end);
          all_day_select = allDay;
          let tmp_date = start_date_selected;
          if ($.inArray(tmp_date, arr_monday) == -1){
            enable_button_action();
          }else{
            disabled_button_action();
          }
          uncheck_multiple_date();
          srcoll_to_div('#absent_date');
        },
        eventDrop: function (event, delta) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
          });
        },
        eventClick: function (event) {
          if($(this).hasClass('monday_class')){

            let msg = '休館日!';
            show_msg_alert(msg);
            $('#calendar').fullCalendar( 'unselect' );

          }else{
            var id_date_current;
            var flag_has_closed = $(this).hasClass('closed_class_btn');
            var flag_has_test = $(this).hasClass('test_class_btn');
            id_date_current = event.id;

            $('#show_show_confirm').trigger('click');
            $('#remove_event_date').on('click', function () {
              if(flag_has_closed){
                remove_closed_date(id_date_current);
              }
              if(flag_has_test){
                remove_test_date(id_date_current);
              }
            });
            
          }
          
        },
        eventResize: function (event) {
          // var start = fmt(event.start);
          // var end = fmt(event.end);
          // $.ajax({
          //   url: 'update_events.php',
          //   data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
          //   type: "POST",
          //   success: function (json) {
          //   }
          // });
        },
        viewRender: function (event) {
          var tmp_current_moment = $('#calendar').fullCalendar('getDate').format('YYYY-MM-DD');
          month_current_select = $('#calendar').fullCalendar('getDate').format('M');
          year_current_select = $('#calendar').fullCalendar('getDate').format('YYYY');
          
          get_list_date_test();
          get_list_date_absent();
          var tmp_date_set =  new Date(tmp_current_moment);
          var tmp_list_mondays = getMondays(tmp_date_set);
          
          arr_monday = []
          for (let index = 0; index < tmp_list_mondays.length; index++) {
            
            var date = new Date(tmp_list_mondays[index]);
            var tmp_get_fmt_month = ('0'+(date.getMonth()+1)).slice(-2);
            var tmp_get_fmt_date  = ('0'+ date.getDate()).slice(-2);
            var date_convert = date.getFullYear() + '-' + tmp_get_fmt_month + '-' +  tmp_get_fmt_date + ' ' + '00:00';
            arr_monday.push(date_convert);
            $('#calendar').fullCalendar('renderEvent',
              {
                title: DATE_CLOSED,
                start: date_convert,
                className : "closed_class_btn monday_class",
              },false // make the event "stick"
            );
            
          }
        }
      });

      function fmt(date) {
        return date.format("YYYY-MM-DD HH:mm");
      }
      
      function enable_button_action() {
        $('#absent_date').removeAttr('disabled');
        $('#test_examp').removeAttr('disabled');
      }

      function disabled_button_action() {
        $('#absent_date').attr('disabled','true');
        $('#test_examp').attr('disabled','true');
      }

      function get_prev_month() {
        
        var current_month_tmp = $('#calendar').fullCalendar('getDate').format('M'),
            last_month_tmp = current_month_tmp - 1,
            next_month_tmp = (+current_month_tmp == 12) ? '' : (+current_month_tmp + 1);

        if(last_month_tmp == 0){
          $('.fc-pre_event-button').html('< 去年');
        }
        else{
          $('.fc-pre_event-button').html('< ' + last_month_tmp + '月');
        }
        if(next_month_tmp == ''){
          $('.fc-next_event-button').html('来年>');
        }
        else{
          $('.fc-next_event-button').html(next_month_tmp + '月' + ' >');
        }
      }

      function getMondays(date) {
        var d = new Date(date),
        month = d.getMonth(),
        mondays = [];
        d.setDate(1);
        // // Get the first Monday in the month
        while (d.getDay() !== 1) {
            d.setDate(d.getDate() + 1);
        }
        // Get all the other Mondays in the month
        while (d.getMonth() === month) {
            mondays.push(new Date(d.getTime()));
            d.setDate(d.getDate() + 7);
        }
        return mondays;
      }
 
      $('#absent_date').click(function() {
        register_date_absent(start_date_selected);
      });

      $('#test_examp').click(function() {
        register_date_test(start_date_selected);
      });

      function remove_closed_date(id_selected) {

        $('#calendar').fullCalendar('removeEvents', id_selected);
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/update_closed_date');?>",
          dataType: 'json',
          data: {
            delete_closed: 1,
            id_of_date_del: id_selected
          },
          success: function (rel) {
          }
        })

      }

      function remove_test_date(id_selected) {

        $('#calendar').fullCalendar('removeEvents', id_selected);
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/update_test_date');?>",
          dataType: 'json',
          data: {
            delete_test: 1,
            id_of_date_del: id_selected
          },
          success: function (rel) {
          }
        })
      }

      function register_date_absent(date_select) {

        month_current_select = $('#calendar').fullCalendar('getDate').format('M');
        year_current_select = $('#calendar').fullCalendar('getDate').format('YYYY');

        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/register_date_absent');?>",
          dataType: 'json',
          data: {
            date_absent: 1,
            start_date_selected: start_date_selected,
            month_current_select: month_current_select,
            year_data_post: year_current_select,
          },
          success: function (data_rel) {
            switch (data_rel.status) {
              case 'update':
              case 'insert':
                calendar.fullCalendar('renderEvent',
                  {
                    id: data_rel.id_rel,
                    title: DATE_CLOSED,
                    start: start_date_selected,
                    end: start_date_selected,
                    className : "closed_class_btn"
                  },
                  false
                );
                break;
              case 'FAIL':
                let msg = '休館日に変更する前にテスト日を削除してください。';//hãy xóa ngày test trước khi đổi thành ngày nghỉ
                show_msg_alert(msg);
                break;
              default:
                break;
            }
          }
        })

      }

      function register_date_test(date_select) {

        month_current_select = $('#calendar').fullCalendar('getDate').format('M');
        year_current_select = $('#calendar').fullCalendar('getDate').format('YYYY');

        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/register_date_test');?>",
          dataType: 'json',
          data: {
            date_test: 1,
            start_date_selected: date_select,
            month_current_select: month_current_select,
            year_data_post: year_current_select,
          },
          success: function (data_result) {
            switch (data_result.status) {
              case 'update':
              case 'insert':
                calendar.fullCalendar('renderEvent',
                  {
                    id: data_result.id_rel,
                    title: DATE_TEST,
                    start: start_date_selected,
                    end: start_date_selected,
                    className : "test_class_btn"
                  },
                  false
                );
                break;
              case 'FAIL':
                let msg = 'テスト日に変更する前に休館日を削除してください。';//xóa ngày nghỉ trước khi đổi thành ngày test
                show_msg_alert(msg);
                break;
              default:
                break;
            }
          }
        })
      }

      function get_list_date_absent() {
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/load_data_absent');?>",
          data: {
            month_post: month_current_select,
            year_post: year_current_select
          },
          dataType: 'JSON',
          success: function (result) {
            if(result['list_data']){
              result['list_data'].forEach(element => {
                calendar.fullCalendar('renderEvent',
                  {
                    id: element.id,
                    title: DATE_CLOSED,
                    start: element.target_date,
                    end: element.target_date,
                    className : "closed_class_btn",
                  },
                  false // make the event "stick"
                );
              });
            }
          }
        });
      }

      function get_list_date_test() {
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('admin/calender/load_data_test');?>",
          data: {
            month_post_test: month_current_select,
            year_post_test: year_current_select
          },
          dataType: 'JSON',
          success: function (result) {
            if(result['list_data_test']){
              result['list_data_test'].forEach(element => {
                calendar.fullCalendar('renderEvent',
                    {
                      id: element.id,
                      title: DATE_TEST,
                      start: element.target_date,
                      end: element.target_date,
                      className : "test_class_btn"
                    },
                    false // make the event "stick"
                );
              });
            }
          }
        });
      }

      function get_date_of_month(year_input, month_input) {
        return new Date(year_input, month_input, 0).getDate();
      }

      function get_list_data_of_month(){

        var myHtml = "",
            myHtmlDay = "",
            myHtmlWeek = "",
            leng_of_month = get_date_of_month(year_current_select, month_current_select),
            array_day_of_week = [];
        
        array_day_of_week = {'mon' : MONDAY, 'tue' : TUESDAY , 'wed': WENDAY, 'thu' : THUSDAY, 'fri' : FRIDAY, 'sat'  : SATUDAY, 'sun' : SUNDAY};
        
        for (let key in array_day_of_week) {
          myHtmlWeek += '<option value="'+ key +'">' + array_day_of_week[key] + '</option>';
        }

        for (let index = 1; index <= leng_of_month; index++) {
          myHtmlDay += '<option value="'+ index +'">' + index + '日</option>';
        }
        myHtml = myHtmlDay + myHtmlWeek;

        return myHtml;
      }

      function uncheck_multiple_date() {
        if($('.fc-week div').hasClass('fc-highlight-skeleton')){
            var count = '';
            count = $('.fc-highlight').attr("colSpan");
            if(count > 1){
              calendar.fullCalendar( 'unselect' );
              start_date_selected = '';
              end_date_selected = '';
              all_day_select = '';
              month_current_select = '';
              year_current_select = '';
              return false;
            }
        };
      }

      $('#add_date_input').click(function() {

        var tmp_data_option = get_list_data_of_month();
        myHtml =  '<div class="row block-15"><div class="col-sm-4 col-sm-offset-2"><select class="form-control">' + tmp_data_option + 
                  '</select></div><div class="col-sm-3"><a class="btn delete-intransfer btn-default btn-block">' + 
                  '<i class="fa fa-trash-o" aria-hidden="true"></i><span>削除</span>' + 
                  '</a></div> </div>';
        $("#block_input_date").append(myHtml);

      });

      //update date intransfer
      $('#update_date_transfer').click(function () {

        var my_array = [];
        var item_val = '';

        $('#block_input_date').find('select').each( function(key, value) {
          item_val =  $( this ).val().trim();
          my_array.push(item_val);
        });

        if(my_array.length > 0){
          var tmp_json_string = JSON.stringify(my_array);
          $.ajax({
            type: "POST",
            url: "https:" + "<?php echo base_url('admin/calender/register_date_intransfer');?>",
            dataType: 'json',
            data: {
              flag_register_transfer: 1,
              month_data_post: month_current_select,
              year_data_post: year_current_select,
              list_date_selected :  tmp_json_string
            },
            success: function (rel) {
              location.reload();
            }
          })
        }

      });

      $(document).on ("click", ".delete-intransfer", function () {
        
        var item_delete = $(this).parent().parent();
        var tmp_date_del = $(this).parent().parent().find('select option:selected').val();
        var id_intransfer_tmp = $(this).parent().parent().parent().find('input').val();
        item_delete.remove();

        if(tmp_date_del){
          tmp_date_del = tmp_date_del.trim();
          $.ajax({
            type: "POST",
            url: "https:" + "<?php echo base_url('admin/calender/delete_date_intransfer');?>",
            dataType: 'json',
            data: {
              flag_delete_transfer: 1,
              date_delete: tmp_date_del,
              id_edit: id_intransfer_tmp
            },
            success: function (rel) {
            }
          })
        }

      });
      
      function show_msg_alert(msg) {
        $( "#show_show_btn" ).trigger( "click" ); 
        $('#msg_alert_calender').html(msg);
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
