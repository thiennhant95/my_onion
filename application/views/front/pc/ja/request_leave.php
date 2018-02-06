<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading bg-blue-green h3">休会届</h1>

      <form class="form-horizontal" id="form_request_leave" action="<?php echo  base_url('/request/save_request_leave') ?>"  method="POST">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">休会期間</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="col-sm-5">
                    <div class="input-group">
                      <span class="input-group-addon" id="fa-calendar-start"><span class="fa fa-calendar"></span></span>
                      <input class="form-control " type="text" id="start_date_request_leave" name="start_date" placeholder="YYYY-MM" readonly>
                     </div>
                  </div>
                  <div class="col-sm-2"><center><small>から</small></center></div>
                  <div class="col-sm-5">
                    <div class="input-group">
                      <span class="input-group-addon" id="fa-calendar-end"><span class="fa fa-calendar"></span></span>
                      <input class="form-control " type="text" id="end_date_request_leave" name="end_date" placeholder="YYYY-MM"   readonly>
                    </div>
                  </div>


                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">休会理由</div>
            <div class="panel-body">
              <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <textarea class="form-control" name="note" rows="4"></textarea>
                </div>
              </div>
              <div class="block-30">
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-danger">
                      <div class="panel-heading"></div>
                      <div class="panel-body text-danger text-small">
                        届出の期間は休会する月の前月末日です。
                        <br> 休会費は1ヶ月3,240円です。
                        <br>
                        <br> ※口座振替の処理上、休会開始月の会費が練習コース料金分引き落とされる場合があります。
                        <br> その場合、後ほど差額を返金いたします。
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <button class="btn btn-success btn-lg btn-long" id="submit_request_leave">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>申請する</span>
          </button>
        </div>
      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
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
    jQuery.validator.addMethod("greaterThan", function(value, element, params) {
        if($("input[name="+params[0]+"]").val()!='')
        {
          $start_date = $("input[name="+params[0]+"]").val();
          if((new Date($start_date))>=(new Date(value)))
          {
            return false;
          }
          
        }
         return true;
    },'Must be greater than start date');
    jQuery.validator.addMethod("lessThan", function(value, element, params) {
        if($("input[name="+params[0]+"]").val()!='')
        {
          $end_date = $("input[name="+params[0]+"]").val();
          if((new Date($end_date))<(new Date(value)))
          {
            return false;
          }
          
        }
         return true;
    },'Must be less than end date');

    $('#start_date_request_leave,#end_date_request_leave').datepicker(options).on('changeDate', function(ev){
         $( "form#form_request_leave" ).valid();
    });

    $('span#fa-calendar-start').click(function(){
      $('input[id=start_date_request_leave]').datepicker("show");
    });
    $('span#fa-calendar-end').click(function(){
      $('input[id=end_date_request_leave]').datepicker("show");
    });

    $('form#form_request_leave').validate({
      debug: false,
      errorElement: "span",
        rules:{
          start_date:{
              required:true,
              date:true,
              lessThan:["end_date"]
              
          },
          end_date:{
            required:true,
            date:true,
            greaterThan:["start_date"]
          },
        },
        messages:{
          start_date:{
              required:"required",
              date: "invalid !"
          },
          end_date:{
            required:"required",
            date: "invalid !"
          },
        },
        errorClass: "label label-danger",
        errorPlacement: function(errorClass, element) {
            errorClass.insertAfter(element.closest("div"));
        },
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        },
    })

    $('button[id=submit_request_leave]').click(function(){
      if($( "form#form_request_leave" ).valid())
      {
        $( "form#form_request_leave" ).submit();
      }
    });
    
  });
</script>
