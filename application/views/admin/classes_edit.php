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
        <span>クラス編集</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラスコード</label>
              <div class="col-sm-5">
                <select class="form-control">
                  <option value="">B</option>
                </select>
              </div>
              <div class="col-sm-5">
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラス名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">級管理</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="level-manage" value=""> する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="level-manage" value=""> しない
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バス利用</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="use-bus" value=""> あり
                </label>
                <label class="radio-inline">
                  <input type="radio" name="use-bus" value=""> なし
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">授業曜日</label>
              <div class="col-sm-10">
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 月
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 火
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 水
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 木
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 金
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 土
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" value=""> 日
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">有効/無効</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 有効
                </label>
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 無効
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
