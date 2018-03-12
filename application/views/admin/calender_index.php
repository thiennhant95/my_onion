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

            <div class="block-30">
              <div class="alert alert-danger text-center">
                <h3>
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <strong>更新エラー</strong>
                </h3>
                <p>何度も失敗する場合はシステム担当へお問い合わせください。</p>
              </div>
            </div>

            <hr class="hr-dashed">
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
                        <div class="col-sm-3"><a href="#0" class="btn delete-intransfer btn-default btn-block">
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
              <a class="btn btn-default btn-block" href="#0">
                <span>戻る</span>
              </a>
            </p>
          </div>
          <div class="col-sm-4">
            <p>
              <a id = "update_date_transfer" class="btn btn-warning btn-block" href="#0">
                <span>更新</span>
              </a>
            </p>
          </div>
        </div>

      </form>
    </div>
  </main>
  <script>
    $(document).on('ready',function () {

      var initialLocaleCode = 'ja',
          date = new Date(),
          d = date.getDate(),
          m = date.getMonth() + 1,
          y = date.getFullYear(),
          start_date_selected = '',
          end_date_selected = '',
          month_current_select = '',
          year_current_select = '',
          all_day_select = '',
          last_month = (m - 1) <= 0 ? 'Last Year' : (m - 1),
          next_month = (m == 12) ? 'Next Year' : (m + 1),
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
          
          enable_button_action();
          start_date_selected = fmt(start);
          end_date_selected = fmt(end);
          all_day_select = allDay;
          uncheck_multiple_date();
          
        },
        eventDrop: function (event, delta) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
          });
        },
        eventClick: function (event) {
          var decision = confirm("Do you want to remove event?");
          var id_date_current;
          if (decision) {
            if($(this).hasClass('closed_class_btn')){
              id_date_current = event.id;
              remove_closed_date(id_date_current);
            }
            if($(this).hasClass('test_class_btn')){
              id_date_current = event.id;
              remove_test_date(id_date_current);
            }
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

          month_current_select = $('#calendar').fullCalendar('getDate').format('M');
          year_current_select = $('#calendar').fullCalendar('getDate').format('YYYY');
          
          get_list_date_test();
          get_list_date_absent();
          // console.log(list_modays);
          //lây danh sach cac ngay t2 cua nam gan vao 1 mang sau do forearch chen ngay nghi vao. 
          // Can code ham kiem tra xem do phai la t2 ko, neu ko thi ko dc edit va ko dc set la ngay test
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
        $('#absent_date').attr('disabled');
        $('#test_examp').attr('disabled');
      }

      function get_prev_month() {
        
        var current_month_tmp = $('#calendar').fullCalendar('getDate').format('M'),
            last_month_tmp = current_month_tmp - 1,
            next_month_tmp = (+current_month_tmp == 12) ? '' : (+current_month_tmp + 1);

        if(last_month_tmp == 0){
          $('.fc-pre_event-button').html('< Last year');
        }
        else{
          $('.fc-pre_event-button').html('< ' + last_month_tmp + '月');
        }
        if(next_month_tmp == ''){
          $('.fc-next_event-button').html('Next year >');
        }
        else{
          $('.fc-next_event-button').html(next_month_tmp + '月' + ' >');
        }
      }

      function getMondays(date) {
        var d = date || new Date(),
            month = d.getMonth(),
            mondays = [];
    
        d.setDate(1);
    
        while (d.getDay() !== 1) {
            d.setDate(d.getDate() + 1);
        }
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
                alert('ERROR! THIS IS TEST DAY');
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
                alert('ERROR, THIS IS DAY OFF');
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
                  '</select></div><div class="col-sm-3"><a href="#0" class="btn delete-intransfer btn-default btn-block">' + 
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
      
    });
  </script>
  
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
