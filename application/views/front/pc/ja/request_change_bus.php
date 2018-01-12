<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-bus-user bg-red h3">バス乗降連絡</h1>

      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">バス乗降連絡</div>
            <div class="panel-body">

              <section>
                <div class="row block-15">
                  <div class="col-sm-10 col-sm-offset-1">
                    <p>
                      <span>「この日は行きだけ乗らない。帰りいつも通り帰る。」</span>
                      <span>「この日、行きだけ他のバス停から乗りたい。」</span>
                      <span>など、特定の日に限ったバスの乗降予定変更を承ります。</span>
                      <span>
                        今後ずっと変更の場合は、
                        <a href="#0" target="_blank">こちらからコース変更申請
                          <i class="fa fa-external-link-square" aria-hidden="true"></i>
                        </a>
                        をしてください。
                      </span>
                    </p>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">基本バスコース</label>
                  <div class="col-sm-5 control-text">
                    <span>⑧花見川コース</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">乗車場所</label>
                  <div class="col-sm-5 control-text">
                    <span>【8380】花見川交番前</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">降車場所</label>
                  <div class="col-sm-5 control-text">
                    <span>【8380】花見川交番前</span>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <h2 class="text-center text-danger block-30 h4">
                  <i class="fa fa-info-circle" aria-hidden="true"></i>
                  <strong>申請は乗車予定時刻の2時間前までになります。</strong>
                </h2>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">日時</label>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">2017年10月</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">1日</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">C(15：55)</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">行きの乗車場所</label>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">乗らない</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">----------</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">帰りの乗車場所</label>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">⑧花見川コース</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <select class="form-control">
                      <option value="">【8380】花見川交番前</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">理由</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="" placeholder="">
                  </div>
                </div>
              </section>

            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <a href="#0" class="btn btn-success btn-lg btn-long">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>連絡する</span>
          </a>
        </div>
      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
