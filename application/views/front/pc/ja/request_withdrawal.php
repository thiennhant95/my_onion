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

      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">退会届</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6 col-sm-offset-2">
                  <div class="form-group">
                    <div class="col-sm-7">
                      <select class="form-control">
                        <option value="">2017年</option>
                      </select>
                    </div>
                    <div class="col-sm-5">
                      <select class="form-control">
                        <option value="">1月</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 control-text">
                  <small>で退会します。</small>
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
                <div class="col-sm-8 col-sm-offset-2">
                  <textarea class="form-control" name="" rows="4"></textarea>
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
          <a href="#0" class="btn btn-success btn-lg btn-long">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>申請する</span>
          </a>
        </div>
      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
