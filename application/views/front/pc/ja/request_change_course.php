<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-change bg-light-blue h3">練習コース変更</h1>

      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">練習コース変更</div>
            <div class="panel-body">

              <section>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">現在のコース</label>
                  <div class="col-sm-5 control-text">
                    <span class="label label-md label-main">ジュニアコース</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">現在の級</label>
                  <div class="col-sm-5 control-text">
                    <span class="label label-md label-info">6級</span>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">変更後コース</label>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">ジュニアフリーコース</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-xs-12 col-sm-2 control-label">変更月</label>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">2017年10月</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-2">
                    <strong>
                      <small class="text-danger">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> 月の途中での変更を希望される方は、クラブ受付まで直接お問い合わせください。</small>
                    </strong>
                  </div>
                </div>
              </section>

              <hr class="hr-dashed">

              <section>
                <h2 class="h4 text-center">
                  <strong>希望する曜日・時間をタップしてください。</strong>
                </h2>
                <div class="table-responsive">
                  <table class="date-selector table table-bordered" data-counter="#count">
                    <thead>
                      <th></th>
                      <th>
                        <span class="type">M</span>
                        <span class="time">11:00～</span>
                      </th>
                      <th>
                        <span class="type">A</span>
                        <span class="time">13:30～</span>
                      </th>
                      <th>
                        <span class="type">B</span>
                        <span class="time">14:40～</span>
                      </th>
                      <th>
                        <span class="type">C</span>
                        <span class="time">15:55～</span>
                      </th>
                      <th>
                        <span class="type">D</span>
                        <span class="time">17:05～</span>
                      </th>
                      <th>
                        <span class="type">E</span>
                        <span class="time">18:05～</span>
                      </th>
                      <th>
                        <span class="type">F</span>
                        <span class="time">19:20～</span>
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <th>火</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr>
                      <tr>
                        <th>水</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr>
                      <tr>
                        <th>木</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr>
                      <tr>
                        <th>金</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr>
                      <tr>
                        <th>土</th>
                        <td class="disabled"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="disabled"></td>
                      </tr>
                      <tr>
                        <th>日</th>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                        <td class="disabled"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="text-center">
                  <p class="block-15">
                    <span class="label label-danger label-lg">
                      あと
                      <span id="count">0</span>
                      ヶ所変更できます。
                    </span>
                  </p>
                  <p>
                    <strong>
                      <small class="text-danger">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        <span>練習コースの変更には手数料が324円発生いたします。</span>
                      </small>
                    </strong>
                  </p>
                </div>
              </section>

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
