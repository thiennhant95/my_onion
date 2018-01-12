<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-memo bg-green h3">各種変更申請</h1>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">新規入会時ご案内の再確認</div>
          <div class="panel-body">
            <ul class="btn-list-inline">
              <li>
                <a class="btn-icon btn-icon-bus" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">バスコース変更</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-change bg-light-blue" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">練習コース変更</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-school bg-yellow" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">イベント・短期教室参加申請</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-mail-config bg-blue" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">通知メール設定</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-note bg-violet" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">基本情報変更</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">申請履歴</div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-lg table-history mb-0">
                <thead>
                  <tr>
                    <th>申請番号</th>
                    <th>申請日時</th>
                    <th>申請内容</th>
                    <th>申請状況</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>12345</th>
                    <td>2017/9/1 21:59</td>
                    <td>休会届</td>
                    <td>申請中</td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>2017/9/1 21:59</td>
                    <td>バスコース変更</td>
                    <td>保留
                      <br>本件につきまして、クラブ受付にてスタッフへお問い合わせください</td>
                  </tr>
                  <tr class="complete">
                    <th>12345</th>
                    <td>2017/9/1 21:59</td>
                    <td>基本情報変更</td>
                    <td>完了（承認）</td>
                  </tr>
                  <tr class="complete">
                    <th>12345</th>
                    <td>2017/9/1 21:59</td>
                    <td>練習コース変更</td>
                    <td>完了（承認）</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
