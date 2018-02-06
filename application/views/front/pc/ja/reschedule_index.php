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
          <div class="panel-heading">ジュニアコース 週1回</div>
          <div class="panel-body">

            <div class="block-30">
              <div class="alert alert-danger text-center text-block">
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> 13日のCクラスは定員オーバーのため振替できません。</span>
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> 無連絡欠席日があります。お休み申請しないと振替できません。</span>
              </div>
            </div>

            <!-- <div class="block-15">
              <div class="row calender-caption align-items-center">
                <div class="col-xs-12 col-sm-4 text-left">
                  <a class="btn btn-success" href="#0">
                    <i class="fa fa-angle-double-left"></i>
                    <span>2月</span>
                  </a>
                </div>
                <div class="col-xs-12 col-sm-4 text-center">
                  <p class="lead mb-0">
                    <strong class="text-break">
                      <span>2015年</span>
                      <span>8月</span>
                    </strong>
                  </p>
                </div>
                <div class="col-xs-12 col-sm-4 text-right">
                  <a class="btn btn-success" href="#0">
                    <span>3月</span>
                    <i class="fa fa-angle-double-right"></i>
                  </a>
                </div>
              </div>
            </div> -->

            <div class="block-15">
              <!-- <table class="calendar">
                <tr class="weekdays">
                  <th scope="col">日</th>
                  <th scope="col">月</th>
                  <th scope="col">火</th>
                  <th scope="col">水</th>
                  <th scope="col">木</th>
                  <th scope="col">金</th>
                  <th scope="col">土</th>
                </tr>
                <tr class="days">
                  <td class="day other-month">
                    <div class="date sun">27</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">28</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">29</div>
                    <div class="label label-calender label-alert">無連絡欠席</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">30</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">31</div>
                  </td>
                  <td class="day">
                    <div class="date">1</div>
                  </td>
                  <td class="day">
                    <div class="date sat">2</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">3</div>
                  </td>
                  <td class="day">
                    <div class="date">4</div>
                    <div class="label label-calender label-success">休館</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">5</div>
                  </td>
                  <td class="day">
                    <div class="date">6</div>
                    <div class="label label-calender label-primary">出</div>
                  </td>
                  <td class="day">
                    <div class="date">7</div>
                  </td>
                  <td class="day">
                    <div class="date">8</div>
                  </td>
                  <td class="day">
                    <div class="date sat">9</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">10</div>
                  </td>
                  <td class="day">
                    <div class="date">11</div>
                  </td>
                  <td class="day">
                    <div class="date">12</div>
                  </td>
                  <td class="day">
                    <div class="date">13</div>
                    <div class="label label-calender label-danger">欠</div>
                  </td>
                  <td class="day">
                    <div class="date">14</div>
                  </td>
                  <td class="day">
                    <div class="date">15</div>
                  </td>
                  <td class="day">
                    <div class="date sat">16</div>
                    <a class="label label-calender label-outline-blue" href="#0">振替可能</a>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">17</div>
                  </td>
                  <td class="day">
                    <div class="date">18</div>
                  </td>
                  <td class="day">
                    <div class="date">19</div>
                  </td>
                  <td class="day">
                    <div class="date">20</div>
                    <div class="label label-calender label-outline-orange">休</div>
                  </td>
                  <td class="day">
                    <div class="date">21</div>
                    <div class="label label-calender label-main">振</div>
                  </td>
                  <td class="day">
                    <div class="date">22</div>
                  </td>
                  <td class="day">
                    <div class="date sat">23</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">24</div>
                  </td>
                  <td class="day">
                    <div class="date">25</div>
                  </td>
                  <td class="day">
                    <div class="date">26</div>
                  </td>
                  <td class="day">
                    <div class="date">27</div>
                  </td>
                  <td class="day">
                    <div class="date">28</div>
                  </td>
                  <td class="day">
                    <div class="date">29</div>
                  </td>
                  <td class="day">
                    <div class="date sat">30</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">31</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">1</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">2</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">3</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">4</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">5</div>
                  </td>
                  <td class="day other-month">
                    <div class="date sat">6</div>
                  </td>
                </tr>
              </table> -->
              <div id='calendar'></div>
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
      <section class="modal fade" id="modalTransfer" tabindex="-1" role="dialog" aria-labelledby="modalTransfer">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">お休み &frasl; 振替予定設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>2017 年9 月27 日　[C]15：55 ～</strong>
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
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替テスト</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">受ける</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">送迎バス</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">送迎のバスに乗る</option>
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

    </div>
  </main>
  <script>
    $(document).ready(function () {

      var initialLocaleCode = 'ja';

      function fmt(date) {
        return date.format("YYYY-MM-DD HH:mm");
      }
      function format_month(date){
        return date.format('M');
      }
      function format_year(date){
        return date.format('YYYY');
      }

      function get_prev_month() {
        
        var current_month_tmp = $('#calendar').fullCalendar('getDate').format('M');
        var last_month_tmp = current_month_tmp - 1;
        var next_month_tmp = (+current_month_tmp == 12) ? '' : (+current_month_tmp + 1);

        if(last_month_tmp == 0){
          $('.fc-pre_event-button').html('< Last year');
        }else{
          $('.fc-pre_event-button').html('< ' + last_month_tmp + '月');
        }
        
        if(next_month_tmp == ''){
          $('.fc-next_event-button').html('Next year >');
        }else{
          $('.fc-next_event-button').html(next_month_tmp + '月' + ' >');
        }

      }

      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var last_month = (m - 1) <= 0 ? 'Last Year' : (m - 1);
      var next_month = (m == 12) ? 'Next Year' : (m + 2);
      
      var calendar = $('#calendar').fullCalendar({
        editable: true,
        locale: initialLocaleCode,
        customButtons: {
          pre_event: {
            text: '<' + last_month,
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

        // Convert the allDay from string to boolean
        eventRender: function (event, element, view) {
          if (event.allDay === 'true') {
            event.allDay = true;
          } else {
            event.allDay = false;
          }
        },

        selectable: true,
        selectHelper: true,

        select: function (start, end, allDay) {
          var title = prompt('Event Title:');
          if (title) {
            var start = fmt(start);
            var end = fmt(end);
            $.ajax({
              url: 'add_events.php',
              data: 'title=' + title + '&start=' + start + '&end=' + end,
              type: "POST",
              success: function (json) {
                //alert('Added Successfully');
              }
            });
            calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
            );
          }
          calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function (event, delta) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
            url: 'update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json) {
              //alert("Updated Successfully");
            }
          });
        },
        eventClick: function (event) {
          var decision = confirm("Do you want to remove event?");
          if (decision) {
            $.ajax({
              type: "POST",
              url: "delete_event.php",
              data: "&id=" + event.id,
              success: function (json) {
                $('#calendar').fullCalendar('removeEvents', event.id);
                //alert("Updated Successfully");
              }
            });
          }
        },
        eventResize: function (event) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
            url: 'update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json) {
              //alert("Updated Successfully");
            }
          });
        },
        viewRender: function (event) {
        }
      });

    });
  </script>
  <?php require_once("contents_footer.php"); ?>
  
</body>

</html>
