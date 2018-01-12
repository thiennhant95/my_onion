<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-note bg-violet h3">基本情報変更</h1>

      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">氏名・性別・生年月日</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">氏名</label>
                <div class="col-sm-5 control-text">
                  <span>玉葱　太郎</span>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">性別</label>
                <div class="col-sm-5 control-text">
                  <span>男性</span>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">生年月日</label>
                <div class="col-sm-5 control-text">
                  <span>1990年12月3日（XX歳）</span>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">保護者</label>
                <div class="col-sm-5 control-text">
                  <span>玉葱　花絵</span>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">住所</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">&#12306;</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" value="123-4567" placeholder="">
                </div>
                <div class="col-sm-7">
                  <input type="text" class="form-control" value="千葉県千葉市美浜区稲毛海岸5-1-2" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">連絡先</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">電話番号</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" value="" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">緊急連絡先</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メールアドレス</label>
                <div class="col-sm-10">
                  <input type="mail" class="form-control" value="" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">学校</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">学校名</label>
                <div class="col-sm-10">
                  <input type="mail" class="form-control" value="" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">学年</label>
                <div class="col-sm-3">
                  <select class="form-control">
                    <option value="">幼稚園</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">健康管理連絡事項</div>
            <div class="panel-body">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <textarea class="form-control" name="" rows="4"></textarea>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">ホエールくん ログインパスワード</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">新パスワード</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" value="" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <a href="#0" class="btn btn-success btn-lg btn-long">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>変更する</span>
          </a>
        </div>

      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
