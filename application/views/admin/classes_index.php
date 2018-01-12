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
        <span>マスター設定</span>
        <a href="#0" class="btn btn-default btn-sm pull-right">
          <strong>CSV出力</strong>
        </a>
      </h1>

      <nav class="master-nav">
        <ul class="nav nav-pills" role="group">
          <li role="presentation">
            <a href="#0">練習コース</a>
          </li>
          <li role="presentation" class="active">
            <a href="#0">クラス</a>
          </li>
          <li role="presentation">
            <a href="#0">バス停</a>
          </li>
          <li role="presentation">
            <a href="#0">バスコース</a>
          </li>
          <li role="presentation">
            <a href="#0">品名</a>
          </li>
          <li role="presentation">
            <a href="#0">科目</a>
          </li>
          <li role="presentation">
            <a href="#0">級</a>
          </li>
          <li role="presentation">
            <a href="#0">種目</a>
          </li>
          <li role="presentation">
            <a href="#0">距離</a>
          </li>
          <li role="presentation" class="disabled">
            <a href="#0">銀行・支店</a>
          </li>
          <li role="presentation" class="disabled">
            <a href="#0">ゆうちょ銀行</a>
          </li>
        </ul>
      </nav>

      <hr>

      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-lg table-center">

            <thead>
              <tr>
                <th>クラスレコード</th>
                <th>クラス名</th>
                <th>級管理</th>
                <th>授業曜日</th>
                <th>定員</th>
                <th>バス利用</th>
                <th>有効・無効</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>BA1</td>
                <td>BA火　13:30</td>
                <td>しない</td>
                <td>火</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                </td>
              </tr>
              <tr>
                <td>BA4</td>
                <td>BA金　13:30</td>
                <td>しない</td>
                <td>金</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                </td>
              </tr>
              <tr class="disabled">
                <td>BM2</td>
                <td>BM水　11:00</td>
                <td>しない</td>
                <td>水</td>
                <td></td>
                <td></td>
                <td>無効</td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm disabled">編集</a>
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
            <span>新規登録</span>
          </a>
        </div>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
