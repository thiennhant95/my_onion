<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <section>
        <div class="row">
          <div class="col-xs-6 text-break">
            <span class="label label-info label-lg">6級</span>
            <span><strong>2017年1月23日合格</strong></span>
          </div>
          <div class="col-xs-6 text-break">
            <span class="label label-success label-lg">2年6ヶ月</span>
            <span><strong>2014年7月入会</strong></span>
          </div>
        </div>
      </section>

      <section>
        <div class="block-30" role="alert">
          <h2 class="h3 text-primary">お知らせ</h2>
          <p class="content03-text-2 mb-xs-30">
            本日、悪天候のため送迎バスの到着に遅れが生じております。
            <br> ご迷惑をおかけしますがよろしくお願い致します。
          </p>
        </div>
        <div class="center-block text-center block-15">
          <div class="alert alert-warning text-center" role="alert">
            新しいメッセージがあります！
          </div>
        </div>
        <div class="alert alert-danger text-center" role="alert">
          <h3 class="lead">
            <strong>現在休会中です。</strong>
          </h3>
          <p>
            2017年11月1日より元の練習コースへ復帰します。
            <br> 休会を延長される場合は、再度休会申請を行ってください。
          </p>
        </div>
      </section>

      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">

            <div class="row btn-list-row block-15">
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-calender bg-red" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>練習コース振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-swim bg-light-blue" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>練習コース振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-medal bg-yellow" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>練習コース振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-memo bg-green" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>練習コース振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
            </div>

            <p class="text-center">
              <a href="" class="btn btn-link">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span>ヘルプ・お困りのときはこちら</span>
              </a>
            </p>

          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-card">
          <div class="panel-heading bg-light-blue text-center">通学・練習コース出席記録</div>
          <div class="panel-body">

            <div class="row align-items-center">
              <div class="col-xs-6">
                <span>2017/09/01 18:32 現在</span>
              </div>
              <div class="col-xs-6 text-right">
                <button class="btn-reload"></button>
              </div>
            </div>

            <div class="row row-table-wrapper text-center">
              <div class="col-sm-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="bg-light-blue" colspan="2">行き</th>
                    </tr>
                  </thead>
                  <tbody data-mh="assign-table">
                    <tr>
                      <th>バス乗車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>バス降車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>入館</th>
                      <td>00:00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="bg-red">出席</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="bg-logo" data-mh="assign-table">
                        <h3>
                          <strong>16：02</strong>
                        </h3>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="bg-green" colspan="2">帰り</th>
                    </tr>
                  </thead>
                  <tbody data-mh="assign-table">
                    <tr>
                      <th>バス乗車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>バス降車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>入館</th>
                      <td>00:00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </section>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
