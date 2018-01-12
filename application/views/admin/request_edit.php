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
          <span class="text-violet">契約変更詳細</span>
          <a href="#0" class="btn btn-primary btn-sm pull-right">
            <strong>CSV出力</strong>
          </a>
        </div>
        <div class="panel-body">

          <section>
            <div class="table-responsive">
              <table class="table table-lg table-violet table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>申請日</th>
                    <th>申請内容</th>
                    <th>処理状況</th>
                    <th>処理日</th>
                    <th>手数料</th>
                    <th>MEDLEY</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>12345</th>
                    <td><a href="#0" class="btn btn-default">玉葱　太郎</a></td>
                    <td>2017/9/1</td>
                    <td>バス変更</td>
                    <td>未処理</td>
                    <td>---</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>

          <form>
            <section>
              <div class="block-30">
                <div class="panel panel-dotted panel-red">
                  <div class="panel-body text-center">
                    <h3 class="h4">
                      <strong>変更前：ベビー週1【BM2】</strong>
                    </h3>
                    <p>
                      <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                    </p>
                    <h3 class="text-red">
                      <strong>変更後：ベビー週4【BA1・BM2・BA4・BM5】</strong>
                    </h3>
                  </div>
                </div>

                <div class="block-15 text-center">
                  <label class="radio-inline">
                    <input type="radio" name="" value="option1"> 未処理
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="" value="option2"> 承認（処理済）
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="" value="option3"> 保留
                  </label>
                </div>
                <textarea class="form-control" rows="3" placeholder="保留時の会員へのメッセージ（受付にて直接手続きする等）"></textarea>
                <div class="block-15 text-center">
                  <label class="radio-inline">
                    <input type="radio" name="" value="option1"> 手数料発生
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="" value="option2"> 手数料免除
                  </label>
                </div>
                <div class="block-15 text-center">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="" value=""> MEDLEY入力
                  </label>

                </div>
              </div>
            </section>
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


  <main class="content content-dark">
    <div class="container">

      <div class="panel panel-dotted">
        <div class="panel-heading">
          <span class="text-violet">契約変更詳細</span>
          <a href="#0" class="btn btn-primary btn-sm pull-right">
            <strong>CSV出力</strong>
          </a>
        </div>
        <div class="panel-body">

          <section>
            <div class="table-responsive">
              <table class="table table-lg table-violet table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>申請日</th>
                    <th>申請内容</th>
                    <th>処理状況</th>
                    <th>処理日</th>
                    <th>手数料</th>
                    <th>MEDLEY</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>12345</th>
                    <td><a href="#0" class="btn btn-default">玉葱　太郎</a></td>
                    <td>2017/9/1</td>
                    <td>バス変更</td>
                    <td>未処理</td>
                    <td>---</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>

          <form>
            <section>
              <div class="block-30">
                <div class="panel panel-dotted panel-red">
                  <div class="panel-body text-center">
                    <h3 class="h4">
                      <strong>変更前：千葉市花見川区xxx-xxx</strong>
                    </h3>
                    <p>
                      <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                    </p>
                    <h3 class="text-red">
                      <strong>変更後：八千代市八千代台xx-xxxx</strong>
                    </h3>
                  </div>
                </div>
                <div class="block-15 text-center">
                  <label class="radio-inline">
                    <input type="radio" name="" value="option1"> 未確認
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="" value="option2"> 確認済み
                  </label>
                </div>
                <div class="block-15 text-center">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="" value=""> MEDLEY入力
                  </label>

                </div>
              </div>
            </section>
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
