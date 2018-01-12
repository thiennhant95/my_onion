<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading bg-blue-green h3">会員一覧</h1>

      <div class="panel panel-dotted">
        <div class="panel-body">

          <div class="block-30 text-center">
            <button class="btn btn-danger btn-lg btn-long">新規会員登録</button>
          </div>

          <form>
            <div id="searchBox">
              <div class="panel panel-dotted panel-blue-green">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h3 class="panel-title">
                    <a class="btn btn-link btn-block btn-lg" role="button" data-toggle="collapse" data-parent="#searchBox" href="#searchBoxCollapse">
                      <strong>絞り込み検索</strong>
                      <br>
                      <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                  </h3>
                </div>
                <div id="searchBoxCollapse" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="block-30">
                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">会員番号</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">氏名</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">氏名カナ</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">性別</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">生年月日</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">郵便番号</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">住所</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">TEL</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">緊急連絡先</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">入会年月日</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">休会期間</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">休会理由</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" name="class" value="" placeholder="">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">退会日付</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">練習コース</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">級</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">クラス</label>
                        <div class="col-sm-4">
                          <div class="form-fromto">
                            <input type="text" class="form-control" name="class" value="" placeholder="FROM">
                            <span class="form-fromto-split">〜</span>
                            <input type="text" class="form-control" name="class" value="" placeholder="TO">
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="並び順">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <input type="text" class="form-control" name="class" value="" placeholder="順位">
                        </div>
                        <div class="col-xs-4 col-sm-2">
                          <label>
                            <input type="checkbox" value="option1">
                            <small>
                              <strong>出力</strong>
                            </small>
                          </label>
                        </div>
                      </div>

                      <div class="form-group form-group-sm form-gutter-half clearfix mb-1">
                        <label for="" class="control-label text-small col-sm-2">退会者</label>
                        <div class="col-sm-10">
                          <label class="checkbox-inline">
                            <input type="checkbox" value="option1"> 含める
                          </label>
                          <label class="checkbox-inline">
                            <input type="checkbox" value="option2"> 含めない
                          </label>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="panel-footer">
                  <div class="block-30 text-center">
                    <a href="" class="btn btn-primary btn-lg btn-long">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <span>検索</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-30">
              <span class="pull-left text-small">検索結果&#58;
                <strong class="h4">XX</strong> 件
              </span>
              <a href="" class="btn btn-default btn-sm pull-right">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <span>この条件のCSVを出力</span>
              </a>
            </div>

          </form>

          <hr class="hr-dashed">


          <section>
            <div class="table-responsive">
              <table class="table table-lg table-blue-green table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>練習コース</th>
                    <th>クラス</th>
                    <th>級・組</th>
                    <th>バス停</th>
                    <th>状態</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>12345</th>
                    <td>花見川　太郎</td>
                    <td>ベビー</td>
                    <td>A</td>
                    <td>パンダ</td>
                    <td>2006 ユトリシア入口</td>
                    <td></td>
                    <td>
                      <a href="#0" class="btn btn-success btn-block btn-sm">詳細</a>
                    </td>
                  </tr>
                  <tr class="complete">
                    <th>12345</th>
                    <td>花見川　太郎</td>
                    <td>フラワー</td>
                    <td>C</td>
                    <td>6級</td>
                    <td>2006 ユトリシア入口</td>
                    <td>退会</td>
                    <td>
                      <a href="#0" class="btn btn-success btn-block btn-sm">詳細</a>
                    </td>
                  </tr>
                  <tr class="bg-info">
                    <th>12345</th>
                    <td>花見川　太郎</td>
                    <td>一般</td>
                    <td>C</td>
                    <td>6級</td>
                    <td>2006 ユトリシア入口</td>
                    <td>休会中</td>
                    <td>
                      <a href="#0" class="btn btn-success btn-block btn-sm">詳細</a>
                    </td>
                  </tr>
                  <tr class="bg-danger">
                    <th>12345</th>
                    <td>花見川　太郎</td>
                    <td>一般</td>
                    <td>C</td>
                    <td>6級</td>
                    <td>2112 八千代台駅東口</td>
                    <td>会員機能ロック</td>
                    <td>
                      <a href="#0" class="btn btn-success btn-block btn-sm">詳細</a>
                    </td>
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
