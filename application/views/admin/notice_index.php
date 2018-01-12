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
            <div class="alert alert-danger text-center">
              <h3>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                <strong>更新エラー</strong>
              </h3>
              <p>何度も失敗する場合はシステム担当へお問い合わせください。</p>
            </div>
          </div>

          <form class="form-horizontal">

            <section>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">お知らせ内容</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5">本日、悪天候の為送迎バスの到着に遅れが生じております。ご迷惑をおかけしますが、よろしくお願い致します。</textarea>
                </div>
              </div>
            </section>

          </form>

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
            <a class="btn btn-default btn-block" href="#0">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <a class="btn btn-warning btn-block" href="#0">
              <span>作成</span>
            </a>
          </p>
        </div>
      </div>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
