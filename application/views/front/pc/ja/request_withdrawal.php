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
<form id="form_request_withdrawal">  
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
        format: "yyyy-mm-dd",
        titleFormat: "yyyy-mm-dd",
        weekStart: 0
    };
    var options = {
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        language:'jp',
        orientation: "auto right",
        startDate: new Date() 
    };
    $('input[id=quit_date_request_with_dra]').datepicker(options).on('changeDate', function(ev){
         $( this ).valid();
    });
    $('span#fa-calendar-quick').click(function(){
      $('input[id=quit_date_request_with_dra]').datepicker('show');
    });
    $('form#form_request_withdrawal').validate({
        rules:{
          quit_date:{
              required:true,
          },
          note :{
            maxlength : 100 ,
          }
        },
        messages:{
          quit_date:{
              required:"この項目は必須です",
          },
        note : {
            maxlength : " 100文字以下で入力してください。 !"
          }
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
      if($( "form#form_request_withdrawal" ).valid())
      {   
        $quit_date = $('input[name = quit_date]').val();
        $reasons= {};
        $('input[name^="reason"]:checked').each(function(index) {

            $reasons[index] = $(this).val();
        });
        $note = $('textarea[name = note]').val();
        $data = {quit_date : $quit_date , note : $note , reason: $reasons};

        $.ajax({
              url : '/request/save_request_withdrawal ' ,
              type : 'POST' ,
              data : $data ,
              success : function (res) {
                if( res == 'success' )
                {
                  $('#myModal').modal('show');
                  $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>退会を申請しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = '/request/complete';
                        });
                    }, 1000);
                }
                else{
                    
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>退会の申請に失敗しました。</b>");
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
