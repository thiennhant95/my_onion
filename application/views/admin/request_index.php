<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <form class="form-horizontal" id="request" method="post" action="<?php echo site_url('admin/request/export_csv') ?>">
  <main class="content content-dark">
    <div class="container">

      <div class="panel panel-dotted">
        <div class="panel-heading">
          <span class="text-violet">契約変更申請一覧</span>
          <a onclick="document.getElementById('request').submit();" class="btn btn-primary btn-sm pull-right">
            <strong>CSV出力</strong>
          </a>
        </div>
        <div class="panel-body">

          <section>
              <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-xs-4 col-sm-3">
                    <input class="form-control " type="text" id="start_date_request_change" name="date_start" placeholder="YYYY-MM-DD">
                </div>
                <div class="col-xs-1 sub-label">
                  <p class="text-center">〜</p>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <input class="form-control " type="text" id="end_date_request_change" name="date_end" placeholder="YYYY-MM-DD">
                </div>
                <div class="col-xs-9 col-sm-3">
                  <select class="form-control" name="type">
                      <option  value="1">申請内容</option>
                      <option  value="<?php echo PRACTICE_COURSE?>"><?php echo PRACTICE_COURSE?></option>
                      <option value="<?php echo BUS_COURSE?>"><?php echo BUS_COURSE?></option>
                      <option value="<?php echo EVENT_ENTRY?>"><?php echo EVENT_ENTRY?></option>
                      <option value="<?php echo NOTICE_OF_ABSENCE?>"><?php echo NOTICE_OF_ABSENCE?></option>
                      <option value="<?php echo NOTICE_OF_WITHDRAWAL?>"><?php echo NOTICE_OF_WITHDRAWAL?></option>
                      <option value="<?php echo CHANGE_BASIC_INFORMATION?>"><?php echo CHANGE_BASIC_INFORMATION?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="input-group">
                      <input type="hidden" name="verify_submit" id="verify_submit">
                      <input type="text" name="free_text_search" id="search" class="form-control" placeholder="フリーワード検索">
                    <span class="input-group-btn">
                      <button class="btn btn-main btn-long" type="button" id="search_request">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
          </section>

          <hr class="hr-dashed">

          <section>
            <input type="hidden" name="status" id="status" value="list_all">
            <div class="block-30">
              <nav class="master-nav">
                <ul class="nav nav-pills" role="group">
                  <li role="presentation" id="not_confirm">
                    <a href="#0">未処理</a>
                  </li>
                  <li role="presentation" id="confirm">
                    <a href="#0">処理済み</a>
                  </li>
                  <li role="presentation" id="reserve">
                    <a href="#0">保留</a>
                  </li>
                  <li role="presentation" class="active" id="list_all">
                    <a href="#0">全て</a>
                  </li>
                </ul>
              </nav>
            </div>

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
                    <th>確認</th>
                  </tr>
                </thead>
                <tbody id="request_table">
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>


        <div class="block-15 text-center" id="pagination">
        </div>
    </div>
      </form>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<div class="bg_load" style="display: none" id="bg_load"></div>
<div class="wrapper" style="display: none" id="wrapper">
    <div class="inner">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<script>
    //format datetime
    $(function () {
        var month = (new Date()).getMonth() + 1;
        var year  = (new Date()).getFullYear();
        $('input[type=eu-date]').w2field('date',  { format: 'd.m.yyyy' });
        $('input[type=eu-dateA]').w2field('date', { format: 'd.m.yyyy', start:  '5.' + month + '.' + year, end: '25.' + month + '.' + year });
        $('input[type=jp-date1]').w2field('date', { format: 'yyyy/mm/dd', end: $('input[type=jp-date2]') });
        $('input[type=jp-date2]').w2field('date', { format: 'yyyy/mm/dd', start: $('input[type=jp-date1]') });
        $('input[type=eu-time]').w2field('time',  { format: 'h24' });
        $('input[type=eu-timeA]').w2field('time', { format: 'h24', start: '8:00 am', end: '4:30 pm' });});


    //load data request rerseve
    $(document).ready(function(){
        $("#reserve").click(function (e) {
            e.preventDefault();
            $('#reserve').addClass('active');
            $('#confirm').removeClass('active');
            $('#not_confirm').removeClass('active');
            $('#list_all').removeClass('active');
            $('#status').val('2');
            $('#verify_submit').val('');
            load_request_data(0);
        });
    });

    //load data request confirm
    $(document).ready(function(){
        $("#confirm").click(function (e) {
            e.preventDefault();
            $('#reserve').removeClass('active');
            $('#confirm').addClass('active');
            $('#not_confirm').removeClass('active');
            $('#list_all').removeClass('active');
            $('#status').val('0');
            $('#verify_submit').val('');
            load_request_data(0);
        });
    });
    $(document).ready(function(){
        $("#not_confirm").click(function (e) {
            e.preventDefault();
            $('#reserve').removeClass('active');
            $('#confirm').removeClass('active');
            $('#not_confirm').addClass('active');
            $('#list_all').removeClass('active');
            $('#status').val('1');
            $('#verify_submit').val('');
            load_request_data(0);
        });
    });

    $(document).ready(function(){
        $("#list_all").click(function (e) {
            e.preventDefault();
            $('#reserve').removeClass('active');
            $('#confirm').removeClass('active');
            $('#not_confirm').removeClass('active');
            $('#list_all').addClass('active');
            $('#status').val('list_all');
            $('#verify_submit').val('');
            load_request_data(0);
        });
    });

    // search
    $(document).ready(function(){
        $("#search_request").click(function (e) {
            e.preventDefault();
            $("#bg_load").css('display','block');
            $("#wrapper").css('display','block');
            $('html,body').animate({
                    scrollTop: $(".table-responsive").offset().top},
                'slow');
            $(".bg_load").fadeOut("slow");
            $(".wrapper").fadeOut("slow");
            $('#verify_submit').val('verify_submit');
            load_request_data(0);
        });
    });
    // load data reschedule
    function load_request_data(page)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/request/ajax_load_list/"+page,
            method:"POST",
            dataType:"json",
            data:$('#request').serialize(),
            success:function(data)
            {
                $('#request_table').html('');
                $('#request_table').html(data.list);
                $('#pagination').html('');
                $('#pagination').html(data.pagination);
            }
        });
    }

    load_request_data(0);

    $(document).ready(function(){

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
    });

    $.fn.datepicker.dates['jp'] = {
        days: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
        months:  ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        monthsShort:  ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        today: "今日",
        clear: "クリア",
        weekStart: 0
    };
    var options={
        isRTL: false,
        format: 'yyyy-mm-dd',
        minViewMode: 'days',
        todayHighlight: true,
        autoclose: true,
        language:'jp',
        orientation: "auto right",
    };

    $('#start_date_request_change').datepicker(options).on('changeDate', function(ev){
        var startVal = $('#start_date_request_change').val();
        $('#end_date_request_change').data('datepicker').setStartDate(startVal);
    });
    $('#end_date_request_change').datepicker(options).on('changeDate', function(ev){
        var endVal = $('#end_date_request_change').val();
        $('#start_date_request_change').data('datepicker').setEndDate(endVal );
    });
</script>