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
        <span>バスコース登録 &frasl; ルート設定</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスコースコード</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="14" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスコース名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="さつきコース　C" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラス</label>
              <div class="col-sm-5">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">定員</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <hr>

            <div class="panel panel-default">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-lg table-center">
                  <thead>
                    <tr>
                      <th>巡回順</th>
                      <th>乗車場所名</th>
                      <th>行き（時間）</th>
                      <th>帰り（時間）</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input type="text" class="form-control" value="1" placeholder="">
                      </td>
                      <td>
                        <select class="form-control">
                          <option value="">1009 さつきが丘団地</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <a href="#0" class="btn btn-default btn-block btn-sm">削除</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" value="2" placeholder="">
                      </td>
                      <td>
                        <select class="form-control">
                          <option value="">1010 さつき第二バス停</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <a href="#0" class="btn btn-default btn-block btn-sm">削除</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" class="form-control" value="3" placeholder="">
                      </td>
                      <td>
                        <select class="form-control">
                          <option value="">1020 さつき第一バス停</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <input type="text" class="form-control" value="00:00" placeholder="">
                      </td>
                      <td>
                        <a href="#0" class="btn btn-default btn-block btn-sm">削除</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="block-15 text-center row">
              <div class="col-sm-8 col-sm-offset-2">
                <a class="btn btn-info btn-block" href="#0">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  <span>乗車場所を追加</span>
                </a>
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
