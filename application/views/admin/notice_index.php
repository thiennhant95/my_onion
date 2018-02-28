<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <div class="panel panel-dotted">
        <div class="panel-heading">
          <span class="text-blue">マイページお知らせ設定</span>
        </div>
        <div class="panel-body">

          <div class="block-30">
            <div class="alert alert-danger text-center" id="error_notice" style="display: none">
              <h3>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                <strong>更新エラー</strong>
              </h3>
              <p>何度も失敗する場合はシステム担当へお問い合わせください。</p>
            </div>
          </div>

          <form class="form-horizontal" method="post" id="notice_form">

            <section>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">お知らせ内容</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="contents" rows="5"><?php
                      $filename = FCPATH."files/notice.txt";
                      $myfile = fopen($filename, "r") or die("Unable to open file!");
                      if(filesize($filename) > 0) {
                          echo fread($myfile, filesize($filename));
                      }
                      fclose($myfile);
                      ?></textarea>
                </div>
              </div>
            </section>
          <hr class="hr-dashed">

          <div class="block-30 text-center text-red text-small">
            <strong>
              ※空にして「更新」すると何も表示されません。
              <br>HTMLタグの使用（太字や赤字にするなど）が可能です。
            </strong>
          </div>
        </div>
      </div>

      <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="<?php echo site_url('admin')?>">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <button class="btn btn-warning btn-block" id="update_notice" href="<?php echo site_url('admin/notice')?>">
              <span>作成</span>
            </button>
          </p>
        </div>
          </form>
      </div>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<button style=" visibility: hidden;" type="button" id="popup" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
</button>

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
<script>
    //update data
    $(document).ready(function() {
        $("#update_notice").click(function(e) {
            e.preventDefault();
            var url = $(this).attr("href");
            $.ajax({
                type: 'POST',
                data: $('#notice_form').serialize(),
                url: url,
                dataType:'json',
                success: function (data) {
                    if (data.status  == 1) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-success');
                        $("#status_update").html("<b>情報を更新しました。 </b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                                window.location = url_top + '/notice';
                            });
                        }, 1000);
                    }
                    else if (data.status ==0)
                    {
                        $('#error_notice').css('display','block');
                    }
                }
            });
        });
    });
</script>
