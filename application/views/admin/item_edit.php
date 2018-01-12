<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading h3">
        <span>品目登録</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">品名コード</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" value="14" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">科目</label>
              <div class="col-sm-5">
                <select class="form-control">
                  <option value="">入会金</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">品名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="入会金" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">売り単価</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" value="6,000" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">仕入単価</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" value="0" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">税計算</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="tax" value=""> する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="tax" value=""> しない
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">在庫管理</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="stock" value=""> する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="stock" value=""> しない
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">在庫数</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" value="0" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">分類</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" value="1" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">画面表示</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="display" value=""> する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="display" value=""> しない
                </label>
              </div>
            </div>

          </form>

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
            <a class="btn btn-success btn-block" href="#0">
              <span>更新</span>
            </a>
          </p>
        </div>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
