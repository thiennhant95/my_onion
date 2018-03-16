<!DOCTYPE html>
<html lang="ja">
<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">
      <h1 class="lead-heading lead-heading-icon-calender bg-main h3">欠席･振替申請</h1>
      <section>
        <div class="panel panel-dotted">
          <div class="panel-heading">
            <?php if (!empty($course)) {
              foreach ($course as $key => $value) {
                echo $value['course_name'];
              }
            }?>
          </div>
          <div class="panel-body">

            <div class="block-30" id="waring-msg">
              <div class="alert alert-danger text-center text-block">
                <span><i class="fa fa-info-circle fix-left-reschedule" aria-hidden="true"></i><span>
                <!-- <span><i class="fa fa-info-circle" aria-hidden="true"></i> 13日のCクラスは定員オーバーのため振替できません。</span>
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> 無連絡欠席日があります。お休み申請しないと振替できません。</span> -->
              </div>
            </div>

            <div class="block-15">
              <div id='calendar_recheduce'></div>
            </div>

            <div class="text-center">
              <p class="block-15">
                <span class="label label-danger label-lg">あと 1 回振替できます。</span>
              </p>
              <p class="text-break">
                <span>振替日を</span>
                <span class="label label-outline-blue">振替可能</span>
                <span>の中からタップしてください。</span>
              </p>
              <p class="block-15 text-break">
                <span>出席予定日をお休みする際は</span>
                <span>日付をタップしてください。</span>
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- モーダルサンプル表示用リンク -->
      <div class="container">
        <h5>
          <small><i class="fa fa-info-circle" aria-hidden="true"></i> 以下モーダル表示サンプルです。</small>
        </h5>
        <ul>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalTransfer">P2: お休み／振替予定設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalCompleteOyasumi">P2: おやすみにしました</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalCompleteFurikae">P2: 振替日を設定しました</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalTransfer2">P3: 振替予定設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancel">P4: 振替キャンセル設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancelDone">P4: 振替キャンセル設定（完了）</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancel2">P5: 振替キャンセル設定（休みをキャンセルして通常通り出席する）</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancelDone2">P5: 振替キャンセル設定（休み予定をキャンセルしました。）</button>
          </li>
          
        </ul>
      </div>
      <!-- Modal: お休み／振替予定設定 -->
      <section class="modal fade" id="modalTransfer" role="dialog" >
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">お休み &frasl; 振替予定設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong class = "date-select-tmp">
                  <!-- name coure + class + time -->
                </strong>
              </h5>
              <hr class="hr-dashed">
              <form class="form-horizontal">
                <!-- chọn ngày  -->
                <!-- <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替日</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">あとで決める</option>
                    </select>
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">時間</label>
                  <div class="col-sm-7">
                    <select class="form-control" id = "fill_select_time">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替テスト</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">受ける</option>
                      <option value="">受けない</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">送迎バス</label>
                  <div class="col-sm-7">
                    <select class="form-control" id="list_bus">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">理由</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">病気</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">理由</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-info btn-block">お休みする</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal: お休みにしました -->
      <section class="modal fade" id="modalCompleteOyasumi" tabindex="-1" role="dialog" aria-labelledby="modalCompleteOyasumi">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>お休みにしました</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: 振替日を設定しました -->
      <section class="modal fade" id="modalCompleteFurikae" tabindex="-1" role="dialog" aria-labelledby="modalCompleteFurikae">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>振替日を設定しました</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P3 振替予定設定 -->
      <section class="modal fade" id="modalTransfer2" tabindex="-1" role="dialog" aria-labelledby="modalTransfer2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替予定設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>2017 年9 月27 日</strong>
              </h5>
              <hr class="hr-dashed">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替日</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">あとで決める</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">時間</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">C 15：15〜</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-info btn-block">振替出席する</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P4 振替キャンセル設定 -->
      <section class="modal fade" id="modalFurikaeCancel" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>2017 年9 月27 日</strong>
              </h5>
              <hr class="hr-dashed">
              <dl class="dl-horizontal">
                <dt>テスト</dt>
                <dd>受ける</dd>
              </dl>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-info btn-block">振替をキャンセルする</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Modal: P4 振替キャンセル設定  振替予定をキャンセルしました -->
      <section class="modal fade" id="modalFurikaeCancelDone" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancelDone">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>振替予定をキャンセルしました。</strong>
              </h5>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P5 振替キャンセル設定（休みをキャンセルして通常通り出席する） -->
      <section class="modal fade" id="modalFurikaeCancel2" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancel2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>2017 年9 月27 日　[C]15：55 ～</strong>
              </h5>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-info btn-block">休みをキャンセルして通常通り出席する</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P5 振替キャンセル設定（休み予定をキャンセルしました。） -->
      <section class="modal fade" id="modalFurikaeCancelDone2" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancelDone2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>休み予定をキャンセルしました。</strong>
              </h5>
              <hr class="hr-dashed">
              <p class="text-center text-block">
                <span>2017 年9 月27 日 [C]15:55 ～</span>
                <span>の振替予定もキャンセルしました。</span>
              </p>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- dev TRI VV-JSC custome page-->
      
      <button id="show_list_select" type="button" style = "display:none" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalSelectOption">show list option</button>
          
      <section class="modal fade" id="modalSelectOption" role="dialog" aria-labelledby="modalSelectOption">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>LIST ACTION</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  
                      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalTransfer" data-dismiss="modal">お休み／振替予定設定</button>
                     
                      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalTransfer2" data-dismiss="modal">振替予定設定</button>
                    
                      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalFurikaeCancel" data-dismiss="modal">振替キャンセル設定</button>
                    
                      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalFurikaeCancel2" data-dismiss="modal"> 振替キャンセル設定</button>
                     
                    <!-- <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                      <span></span>
                    </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end custome page -->

    </div>
  </main>
  <script>
    $(document).on('ready',function () {  

      var MONDAY = "<?php echo EVERY_MONDAY ?>",
          TUESDAY = "<?php echo EVERY_TUESDAY ?>",
          WENDAY = "<?php echo EVERY_WENDAY ?>",
          THUSDAY = "<?php echo EVERY_THUSDAY ?>",
          FRIDAY = "<?php echo EVERY_FRIDAY ?>",
          SATUDAY = "<?php echo EVERY_SATUDAY ?>",
          SUNDAY = "<?php echo EVERY_SUNDAY ?>",
          DATE_TEST = "<?php echo DATE_TEST ?>",
          DATE_CLOSED = "<?php echo DATE_CLOSED ?>";

      var date = new Date();
      var initialLocaleCode = 'ja';
      var d = date.getDate();
      var m = date.getMonth() + 1;
      var y = date.getFullYear();
      var tmp_m = m - 1;
      var last_month = tmp_m <= 0 ? 'Last Year' : tmp_m + '月';
      var next_month = (m == 12) ? 'Next Year' : (m + 1);
      var start_date_selected = "";
      var arr_monday = [];
      var calendar = $('#calendar_recheduce').fullCalendar({

        locale: initialLocaleCode,
        displayEventTime: false,
        unselectAuto: false,
        customButtons: {
          pre_event: {
            text: '< ' + last_month,
            click: function() {
              $('#calendar_recheduce').fullCalendar('prev');
              get_prev_month();
            }
          },
          next_event: {
            text: next_month + '月' + ' >',
            click: function() {
              $('#calendar_recheduce').fullCalendar('next');
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
          // console.log(event);
          // console.log(element);
          // console.log(view);
          // if (event.allDay === 'true') {
          //   event.allDay = true;
          // } 
          // else {
          //   event.allDay = false;
          // }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {

          start_date_selected = fmt_date(start);
          uncheck_multiple_date();
          if(start_date_selected){
            let tmp_date = start_date_selected + ' 00:00';
            if ($.inArray(tmp_date, arr_monday) == -1){
              check_type_date();
            }else{
              srcoll_to_div('.header-mypage',' CLOSED DATE, can not register');
            }
            let tmp_data_class =  get_class_current();
            get_class_current(start_date_selected);
          }       
          
        },
        eventDrop: function (event, delta) {
          // var start = fmt(event.start);
          // var end = fmt(event.end);
          // $.ajax({
          // });
        },
        eventClick: function (event) {
          // var decision = confirm("Do you want to remove event?");
          // var id_date_current;
          // if (decision) {
          //   if($(this).hasClass('closed_class_btn')){
          //     id_date_current = event.id;
          //     remove_closed_date(id_date_current);
          //   }
          //   if($(this).hasClass('test_class_btn')){
          //     id_date_current = event.id;
          //     remove_test_date(id_date_current);
          //   }
          // }
          // alert(1);
          // $('#modalSelectOption').click();
        },
        eventResize: function (event) {
        },
        viewRender: function (event) {
          // console.log(list_modays);
          month_current_select = $('#calendar_recheduce').fullCalendar('getDate').format('M');
          year_current_select = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY');
          var tmp_current_moment = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY-MM-DD');
          
          get_list_date_test();
          get_list_date_absent();

          var tmp_date_set =  new Date(tmp_current_moment);
          var tmp_list_mondays = getMondays(tmp_date_set);
          arr_monday = [];
          for (let index = 0; index < tmp_list_mondays.length; index++) {
            
            var date = new Date(tmp_list_mondays[index]);
            var tmp_get_fmt_month = ('0'+(date.getMonth()+1)).slice(-2);
            var tmp_get_fmt_date  = ('0'+ date.getDate()).slice(-2);
            var date_convert = date.getFullYear() + '-' + tmp_get_fmt_month + '-' +  tmp_get_fmt_date + ' ' + '00:00';
            
            arr_monday.push(date_convert);
            $('#calendar_recheduce').fullCalendar('renderEvent',
              {
                title: DATE_CLOSED,
                start: date_convert,
                className : "closed_class_btn monday_class",
              },false // make the event "stick"
            );
            
          }
        }
      });

      function get_list_date_absent() {
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('reschedule/load_data_absent');?>",
          data: {
            month_post: month_current_select,
            year_post: year_current_select
          },
          dataType: 'JSON',
          success: function (result) {
            if(result['list_data']){
              $.each(result['list_data'], function( key ,element) {
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
          url: "https:" + "<?php echo base_url('reschedule/load_data_test');?>",
          data: {
            month_post_test: month_current_select,
            year_post_test: year_current_select
          },
          dataType: 'JSON',
          success: function (result) {
            if(result['list_data_test']){
              $.each(result['list_data_test'], function( key ,element ) {
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

      function check_type_date() {
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('reschedule/check_type_date');?>",
          data: {
            start_date_selected : start_date_selected
          },
          dataType: 'JSON',
          success: function (result) {
            switch (result.type_date) {
              case 1:
                srcoll_to_div('.header-mypage',' CLOSED DATE, can not register');
                break;
              case 2:
                srcoll_to_div('.header-mypage',' TEST DATE, can not register');
                break;
              case 3:
                srcoll_to_div('.header-mypage',' NOTRANSFER DATE, can not register');
                break;
              case 4:
                srcoll_to_div('.header-mypage',' CONSTRUCTION DATE, can not register');
                break;
              default:
                hiden_waring();
                $( "#show_list_select" ).trigger( "click" ); 
                break;
            }
          }
        });
      }

      function fmt(date) {
        return date.format("YYYY-MM-DD HH:mm");
      }
      function fmt_date(date) {
        return date.format("YYYY-MM-DD");
      }
      function format_month(date){
        return date.format('M');
      }
      function format_year(date){
        return date.format('YYYY');
      }
      function srcoll_to_div(id_div, msg) {
        $('html,body').animate({
                  scrollTop: $(id_div).offset().top},
              'slow');
        $('#waring-msg').css('display', 'block');
        $('.alert-danger span').find('span').text(msg);
      }
      function hiden_waring(){
        $('#waring-msg').css('display', 'none');
      }

      function get_prev_month() {
        
        var current_month_tmp = $('#calendar_recheduce').fullCalendar('getDate').format('M');
        var last_month_tmp = current_month_tmp - 1;
        var next_month_tmp = (+current_month_tmp == 12) ? '' : (+current_month_tmp + 1);

        (last_month_tmp == 0) ? $('.fc-pre_event-button').html('< Last year') : $('.fc-pre_event-button').html('< ' + last_month_tmp + '月');
        (next_month_tmp == '') ? $('.fc-next_event-button').html('Next year >') : $('.fc-next_event-button').html(next_month_tmp + '月' + ' >');

      }

      function uncheck_multiple_date() {
        if($('.fc-week div').hasClass('fc-highlight-skeleton')){
            var count = '';
            count = $('.fc-highlight').attr("colSpan");
            if(count > 1){
              calendar.fullCalendar( 'unselect' );
              start_date_selected = '';
              return false;
            }
        };
      }

      $('#modalTransfer').on('show.bs.modal', function (e) {
        $('body').css('padding-right', '0px');
      });

      $('#modalSelectOption').on('show.bs.modal', function (e) {
        $('body').css('padding-right', '0px');
      });

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

      function fill_date_click(date_selected, str_info_class) {

        let date_jp  = conver_date_jp(date_selected);
        let box_show_date = $('.date-select-tmp');
        box_show_date.html(date_jp + ' ' + str_info_class);
      }

      function conver_date_jp(date_input) {

        let tmp_date = new Date(date_input);
        let tmp_day = tmp_date.getDate();
        let tmp_month = tmp_date.getMonth();
        let tmp_year = tmp_date.getFullYear();
        let date_jp = [tmp_year ,'年',tmp_month ,'月', tmp_day,'日'].join(' ');
        
        return date_jp;
      
      }
      
      function get_class_current(date_selected_curr) {
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('reschedule/get_info_class_current');?>",
          data: {
            start_date_selected : start_date_selected
          },
          dataType: 'JSON',
          success: function (result) {
            let tmp_str_info = result.db_class_str;
            let tmp_select_calender = result.calendar_class;
            fill_selected_time(tmp_select_calender);
            fill_date_click(date_selected_curr, tmp_str_info);
            $('#list_bus').html(result.db_bus);
          }
        });
      }

      function fill_selected_time(db_calendar) {
        let tmp_ojb = $('#fill_select_time');

        tmp_ojb.html(db_calendar);
      }

      $('#fill_select_time').on('change', function name() {
        let tmp_id = $('#fill_select_time').val();
        $.ajax({
          type: "POST",
          url: "https:" + "<?php echo base_url('reschedule/get_busroute_of_class');?>",
          data: {
            id_class_selected : tmp_id
          },
          dataType: 'JSON',
          success: function (result) {
            $('#list_bus').html(result.html);
          }
        });
      })
    });
  </script>
  <?php require_once("contents_footer.php"); ?>
  
</body>

</html>
