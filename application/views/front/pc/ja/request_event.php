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

      <form class="form-horizontal" action="<?php echo  base_url('/request/save_request_event') ?>"  method="POST">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">現在募集中のイベント・短期教室一覧</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-10 col-sm-offset-2">
                  <?php 
                  foreach ($Course_Limited as $key => $value) {
                    $checked = ($key==0?"checked":'');
                    $html_0='<div class="radio"><label>';
                    $html_1='';
                    $html_2='</label></div>';
                    $start_date = date_create((isset($value['start_date'])?$value['start_date']:''));
                    $end_date = date_create((isset($value['end_date'])?$value['end_date']:''));
                    $html_1.= "<input type='radio' name='event' value='".$value['id']."' ".$checked." >".$value['course_name']."(".date_format($start_date,'m/d').'～'.date_format($end_date,'m/d').")";
                    echo $html_0.$html_1.$html_2;
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
