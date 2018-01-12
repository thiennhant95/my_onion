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
          <span class="text-blue-green">新規ネット申し込み（未処理）一覧</span>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-lg table-blue-green table-outline mb-0">
              <thead>
                <th>会員番号</th>
                <th>申込日時</th>
                <th>氏名</th>
                <th>申込区分</th>
                <th>コース名</th>
                <th></th>
              </thead>
              <tbody>
                <tr>
                  <td>12345</td>
                  <td>2017/09/01 21：59</td>
                  <td>玉葱　太郎</td>
                  <td>入会</td>
                  <td>一般</td>
                  <td>
                    <a href="#0" class="btn btn-success">
                      <span>処理</span>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>12345</td>
                  <td>2017/09/01 21：59</td>
                  <td>玉葱　太郎</td>
                  <td>入会</td>
                  <td>一般</td>
                  <td>
                    <a href="#0" class="btn btn-success">
                      <span>処理</span>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>12345</td>
                  <td>2017/09/01 21：59</td>
                  <td>玉葱　太郎</td>
                  <td>入会</td>
                  <td>一般</td>
                  <td>
                    <a href="#0" class="btn btn-success">
                      <span>処理</span>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="block-15 text-center">
        <nav>
          <ul class="pagination pagination-main">
            <li class="disabled">
              <a href="#" aria-label="Previous">
                <span aria-hidden="true">«</span>
              </a>
            </li>
            <li class="active">
              <a href="#0">1
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li>
              <a href="#0">2</a>
            </li>
            <li>
              <a href="#0">3</a>
            </li>
            <li>
              <a href="#0">4</a>
            </li>
            <li>
              <a href="#0">5</a>
            </li>
            <li>
              <a href="#" aria-label="Next">
                <span aria-hidden="true">»</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
