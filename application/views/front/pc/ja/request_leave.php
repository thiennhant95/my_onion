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

      <form  id="form_request_leave">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">休会期間</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="col-sm-5">
                    <div class="input-group">
                      <span class="input-group-addon" id="fa-calendar-start"><span class="fa fa-calendar"></span></span>
                      <input class="form-control date_leave" type="text" id="start_date_request_leave" name="start_date" placeholder="YYYY-MM" readonly>
                     </div>
                  </div>
                  <div class="col-sm-2"><center><small>から</small></center></div>
                  <div class="col-sm-5">
                    <div class="input-group">
                      <span class="input-group-addon" id="fa-calendar-end"><span class="fa fa-calendar"></span></span>
                      <input class="form-control date_leave" type="text" id="end_date_request_leave" name="end_date" placeholder="YYYY-MM"   readonly>
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
</form>
        <div class="block-30 text-center">
          <button class="btn btn-success btn-lg btn-long" id="btnsubmit">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>申請する</span>
          </button>
        </div>
      

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<div id="myModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="status_update"></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid }
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $.fn.datepicker.dates['jp'] = {
        days: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
        months:  ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        monthsShort:  ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
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
        startDate: new Date() 
    };
    $( function(){
      $('.date_leave').datepicker(options);
      var curr_date = new Date();
      curr_date.setMonth(curr_date.getMonth() + 1);
      $('#end_date_request_leave').data('datepicker').setStartDate(curr_date);
    });
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
    },'休会終了は休会開始以降で入力してください。');
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
    },'休会開始は休会終了の値以下で入力してください');

    $('#start_date_request_leave').datepicker(options).on('changeDate', function(ev){
         var start_date = $(this).val();
         start_date = new Date(start_date);
         start_date.setMonth(start_date.getMonth() + 1 );
         $('#end_date_request_leave').data("datepicker").setStartDate(start_date);
         $( "form#form_request_leave" ).valid();
    });
    $('#end_date_request_leave').datepicker(options).on('changeDate', function(ev){
         var end_date = $(this).val();
         end_date = new Date(end_date);
         end_date.setMonth(end_date.getMonth() - 1 );
         $('#start_date_request_leave').data("datepicker").setEndDate(end_date);
         $( "form#form_request_leave" ).valid();
    });
    $('span#fa-calendar-start').click(function(){
      $('#start_date_request_leave').datepicker("show");
    });
    $('span#fa-calendar-end').click(function(){
      $('#end_date_request_leave').datepicker("show");
    });

    $('form#form_request_leave').validate({
      debug: false,
      errorElement: "span",
        rules:{
          start_date:{
              required:true,   
          },
          end_date:{
            required:true,
          },
          note :{
            maxlength : 100 ,
          }
        },
        messages:{
          start_date:{
              required:"この項目は必須です",
          },
          note : {
            maxlength : " 100文字以下で入力してください。 !"
          },
          end_date:{
            required:"この項目は必須です",
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

   $('#btnsubmit').click(function(){
      if($( "form#form_request_leave" ).valid())
      {   
        var start_date = $('#start_date_request_leave').val();
        var end_date = $('#end_date_request_leave').val();
        var reason = $('textarea[name=note]').val();
        var data = {start_date : start_date , end_date : end_date , note : reason };
        $.ajax({
          url : '/request/save_request_leave ' ,
          type : 'POST' ,
          data : data ,
          success : function (res) {
            if( res == 'success' )
            {
              
              $('.modal-body').addClass('alert alert-success');
              $("#status_update").html("<b>休会を申請しました。</b>");
              $('#myModal').modal('show');
              window.setTimeout(function () {
                $('#myModal').fadeToggle(300, function () {
                      $('#myModal').modal('hide');
                      window.location = '/request/complete';
                });
              }, 1000);
            }
            else{
              
              $('.modal-body').addClass('alert-danger');
              $("#status_update").html("<b>休会の申請に失敗しました。</b>");
              $('#myModal').modal('show');
              $('#myModal').fadeToggle(300, function () {
                      $('#myModal').modal('hide');
              });   
            }
          }
        });
      }
    });
  });
</script>
