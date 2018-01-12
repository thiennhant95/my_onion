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
        <div class="panel-heading">欠席・振替申請一覧</div>
        <div class="panel-body">

          <section>
            <form class="form-horizontal">
              <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-xs-4 col-sm-3">
                  <select class="form-control">
                    <option name="class" value="">xxxx/xx/xx</option>
                  </select>
                </div>
                <div class="col-xs-1 sub-label">
                  <p class="text-center">〜</p>
                </div>
                <div class="col-xs-4 col-sm-3">
                  <select class="form-control">
                    <option name="class" value="">xxxx/xx/xx</option>
                  </select>
                </div>
                <div class="col-xs-9 col-sm-3">
                  <select class="form-control">
                    <option name="class" value="">申請内容</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <input type="text" class="form-control" name="class" value="" placeholder="">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">練習コース</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="course" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="course" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> ベビー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> 園児
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> ジュニア
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> ジュニアフリー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> 成人
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> フラワー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> 選手・育成
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> オールフリー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> 平日フリー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> 週末フリー
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="course" value=""> フリー月3回
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">クラス</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="class" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="class" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> M
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> A
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> B
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> C
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> D
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> E
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class" value=""> F
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">級</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="rank" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="rank" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> パンダ1
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> パンダ2
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> ウマ1
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> ウマ2
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> クジラ1
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> クジラ1
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 16
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 15
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 14
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 13
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 12
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 11
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 10
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 9
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 8
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 7
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 6
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 5
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 4
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 3
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 2
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="rank" value=""> 1
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center">
                <a href="" class="btn btn-warning btn-long">リスト表示</a>
              </div>
              <div class="block-30 text-center">
                <a href="" class="btn btn-primary btn-long btn-lg">CSV出力</a>
              </div>
            </form>
          </section>

          <hr class="hr-dashed">


          <section>
            <div class="table-responsive">
              <table class="table table-lg table-red table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名（コース）級</th>
                    <th>対象日時</th>
                    <th>申請内容</th>
                    <th>理由</th>
                    <th>振替先日時</th>
                    <th>テスト</th>
                    <th>ステータス</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>xxxxxxxx</th>
                    <td>
                      <a class="btn btn-default" href="#0">花見川　太郎</a>（ジュニア）7級
                    </td>
                    <td>2017年9月7日C</td>
                    <td>欠席＆振替</td>
                    <td>病気</td>
                    <td>2017年9月7日C</td>
                    <td>
                      <span class="text-danger">受ける</span>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>xxxxxxxx</th>
                    <td>
                      <a class="btn btn-default" href="#0">花見川　太郎</a>（ジュニア）6級
                    </td>
                    <td>2017年9月7日C</td>
                    <td>欠席</td>
                    <td>その他（寒い）</td>
                    <td></td>
                    <td>---</td>
                    <td>---</td>
                  </tr>
                  <tr class="complete">
                    <th>xxxxxxxx</th>
                    <td>
                      <a class="btn btn-default" href="#0">花見川　太郎</a>（ジュニア）5級
                    </td>
                    <td>2017年9月7日D</td>
                    <td>振替</td>
                    <td></td>
                    <td>2017年9月14日B</td>
                    <td>
                      <span class="text-danger">受けない</span>
                    </td>
                    <td>振替キャンセル</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
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
