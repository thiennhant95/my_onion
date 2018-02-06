<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading bg-main h3">退会届</h1>

      <form class="form-horizontal" id="form_request_withdrawal" action="<?php echo  base_url('/request/save_request_withdrawal') ?>"  method="POST">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">退会届</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="col-sm-5">
                    <div class="input-group">
                      <span class="input-group-addon" id="fa-calendar-quick"><span class="fa fa-calendar" ></span></span>
                      <input class="form-control" type="text" id="quit_date_request_with_dra" name="quit_date" placeholder="YYYY-MM-DD"  readonly>
                     </div>
                  </div>
                  <div class="col-sm-5 control-text">
                    <small>で退会します。</small>
                  </div>
              </div>
                </div>
                
            </div>
          </div>
        </section>
                
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">退会理由</div>
            <div class="panel-body">
              <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2">
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="目標達成">目標達成</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="多忙（学校・仕事）">多忙（学校・仕事）</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="体調不良（病気）">体調不良（病気）</label>
                  </div>
                  <div class="col-sm-10 col-sm-offset-2">
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="転居">転居</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="時間が合わない">時間が合わない</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="けが">けが</label>
                  </div>
                  <div class="col-sm-10 col-sm-offset-2">
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="進学・進級">進学・進級</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="経済的理由">経済的理由</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="プールが嫌い">プールが嫌い</label>
                  </div>
                  <div class="col-sm-10 col-sm-offset-2">
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="他の習い事を行う">他の習い事を行う</label>
                    <label class="col-sm-4"><input  type="checkbox" name="reason[]" value="指導への不満">指導への不満</label>
                  </div>
              </div>
              <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <label class="col-sm-2">その他</label>
                  <textarea class="form-control" name="note" rows="4"></textarea>
                </div>
              </div>
              <div class="block-30">
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-danger">
                      <div class="panel-heading"></div>
                      <div class="panel-body text-danger text-small">
                        届出の期間は退会する月の前月末日です。
                        <br> 休会費は1ヶ月3,240円です。
                        <br>
                        <br>口座振替の処理上、休会開始月の会費が練習コース料金分引き落とされる場合があります。
                        <br>その場合、後ほど差額を返金いたします。
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <button class="btn btn-success btn-lg btn-long" type="submit">
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
        format: "yyyy-mm-dd",
        titleFormat: "yyyy-mm-dd",
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
    $('input[id=quit_date_request_with_dra]').datepicker(options).on('changeDate', function(ev){
         $( this ).valid();
    });
    $('span#fa-calendar-quick').click(function(){
      $('input[id=quit_date_request_with_dra]').datepicker("show");
    });
    $('form#form_request_withdrawal').validate({
        rules:{
          quit_date:{
              required:true,
              date:true,
          },
        },
        messages:{
          quit_date:{
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

    $('button[id=submit_request]').click(function(){
      if($( "form#form_request_withdrawal" ).valid())
      {
        $( "form#form_request_withdrawal" ).submit();
      }
      
    });
  });
</script>
