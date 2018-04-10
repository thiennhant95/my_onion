<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once("head.php"); ?>
</head>

<body>
<?php require_once("contents_header_mypage.php"); ?>

<main class="content content-dark">
    <div class="container">

        <h1 class="lead-heading lead-heading-icon-school bg-yellow h3">イベント・短期教室参加申請</h1>

        <form id="form_request_event">
            <section>
                <div class="panel panel-dotted">
                    <div class="panel-heading">現在募集中のイベント・短期教室一覧</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-2">
                                <?php
                                    if( count( $course_limit ) > 0 )
                                    {
                                        foreach ( $course_limit as $key => $value ) {
 
                                            $checked =  $key == '0' ? 'checked' : '';
                                            $html_0 ='<div class="radio"><label>';
                                            $html_1 ='';
                                            $html_2 ='</label></div>';
                                            $start_date = date_create( (isset ( $value['start_date'] ) && $value['start_date'] != INVALID_DATE && $value['start_date'] != '' ? $value['start_date'] : '') );
                                            $end_date = date_create( (isset ( $value['end_date'] ) && $value['end_date'] != INVALID_DATE && $value['end_date'] != '' ? $value['end_date'] : '') );
    
                                            $html_1.= "<input  type='radio' name='event' value='".$value['course_id']."' ".$checked." >".$value['course_name']."(".date_format($start_date,'m/d').'～'.date_format($end_date,'m/d').")";
                                            echo $html_0.$html_1.$html_2;
                                            
                                        }
                                    }
                                else{
                                    echo "<b> 現在、募集はありません </b>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="panel panel-dotted">
                    <div class="panel-heading">備考</div>
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
                                            この申請では参加申し込みは完了しません。（定員人数に対する仮押さえ予約となります）
                                            <br> クラブ受付にて参加費用をお支払い頂きました時点でお申込み完了となりますのでご注意ください。
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
            <button class="btn btn-success btn-lg btn-long" id="btnsubmit"  >
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
        $('form#form_request_event').validate({
            rules:{
                event:{
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
                }
            },
            errorClass : "label label-danger",
            highlight: function (element, errorClass, validClass) {
                return false;
            },
            unhighlight: function (element, errorClass, validClass) {
                return false;
            },
        });
        $('#btnsubmit').click(function(){
            if( $( "form#form_request_event" ).valid() )
            {
                $event = $('input[name=event]:checked').val();
                $note = $('textarea[name=note]').val();
                $data = {event : $event , note : $note};
                $.ajax({
                    url : '/request/save_request_event ' ,
                    type : 'POST' ,
                    data : $data ,
                    success : function (res) {
                        if( res == 'success' )
                        {
                            $('.modal-body').addClass('alert alert-success');
                            $("#status_update").html("<b>イベント・短期教室参加を申請しました。</b>");
                            $('#myModal').modal('show');
                            window.setTimeout(function () {
                                $('#myModal').fadeToggle(300, function () {
                                    $('#myModal').modal('hide');
                                    window.location = '/request/complete';
                                });
                            }, 1000);
                        }
                        else
                        {
                            $('.modal-body').addClass('alert alert-danger');
                            $("#status_update").html("<b>イベント・短期教室参加の申請に失敗しました。</b>");
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