<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading bg-blue-green h3">
        <span>会員基本契約情報編集</span>
      </h1>

      <form class="form-horizontal">

        <div class="panel panel-dotted">
          <div class="panel-heading">基本契約情報</div>
          <div class="panel-body">

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">会員番号</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">生年月日</label>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control">
                  <option value="">1月</option>
                  <option value="">2月</option>
                  <option value="">3月</option>
                  <option value="">4月</option>
                  <option value="">5月</option>
                  <option value="">6月</option>
                  <option value="">7月</option>
                  <option value="">8月</option>
                  <option value="">9月</option>
                  <option value="">10月</option>
                  <option value="">11月</option>
                  <option value="">12月</option>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control">
                  <option value="">1日</option>
                  <option value="">2日</option>
                  <option value="">3日</option>
                  <option value="">4日</option>
                  <option value="">5日</option>
                  <option value="">6日</option>
                  <option value="">7日</option>
                  <option value="">8日</option>
                  <option value="">9日</option>
                  <option value="">10日</option>
                  <option value="">11日</option>
                  <option value="">12日</option>
                  <option value="">13日</option>
                  <option value="">14日</option>
                  <option value="">15日</option>
                  <option value="">16日</option>
                  <option value="">17日</option>
                  <option value="">18日</option>
                  <option value="">19日</option>
                  <option value="">20日</option>
                  <option value="">21日</option>
                  <option value="">22日</option>
                  <option value="">23日</option>
                  <option value="">24日</option>
                  <option value="">25日</option>
                  <option value="">26日</option>
                  <option value="">27日</option>
                  <option value="">28日</option>
                  <option value="">29日</option>
                  <option value="">30日</option>
                  <option value="">31日</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 男性
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 女性
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">郵便番号</label>
              <div class="col-xs-3 col-sm-2 col-md-1 postal-code-line">
                <input type="number" class="form-control" value="" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 col-md-1">
                <input type="number" class="form-control" value="" placeholder="">
              </div>
              <div class="col-xs-3">
                <a href="#0" class="btn btn-main">&#12306; 住所に反映</a>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" value="" placeholder="">
              </div>
              <div class="col-sm-5">
                <label class="checkbox-inline">
                  <input type="checkbox" value="">
                  <small>メールアドレスなし</small>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">緊急連絡先</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="row">
              <div class="col-sm-9 col-sm-offset-2">
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <strong class="text-small">入会者が未成年の場合のみ記入</strong>
                  </div>
                  <div class="panel-body text-light">
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">学校名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">保護者氏名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">学年</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="hr-dashed">

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コースコード</label>
              <div class="col-sm-10">
                <select class="form-control">
                  <option value="">1341　ジュニア週2</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラスコード</label>
              <div class="col-sm-5">
                <select class="form-control">
                  <option value="">JD2</option>
                </select>
              </div>
              <div class="col-sm-5">
                <select class="form-control">
                  <option value="">JE3</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">申込時の泳力</label>
              <div class="col-sm-10">
                <div class="block-15">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができない
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <label for="" class="control-label">備考</label>
                      <input type="text" class="form-control" value="" placeholder="">
                    </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>

                  <div class="row block-15">
                    <div class="col-sm-6">
                      <label for="" class="control-label">クラブ名</label>
                      <input type="text" class="form-control" value="" placeholder="">
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="control-label">退会</label>
                      <div class="row">
                        <div class="col-xs-6">
                          <select class="form-control">
                            <option value="">2000年</option>
                          </select>
                        </div>
                        <div class="col-xs-6">
                          <select class="form-control">
                            <option value="">1月</option>
                            <option value="">2月</option>
                            <option value="">3月</option>
                            <option value="">4月</option>
                            <option value="">5月</option>
                            <option value="">6月</option>
                            <option value="">7月</option>
                            <option value="">8月</option>
                            <option value="">9月</option>
                            <option value="">10月</option>
                            <option value="">11月</option>
                            <option value="">12月</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コーチへの伝達事項</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスの利用</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 利用しない
                </label>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">行き</label>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">⑧花見川コース</option>
                    </select>
                  </div>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">【8380】花見川交番前</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">帰り</label>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">⑧花見川コース</option>
                    </select>
                  </div>
                  <div class="col-sm-5">
                    <select class="form-control">
                      <option value="">【8380】花見川交番前</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ICカード番号</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" value="" placeholder="">
              </div>
              <div class="col-sm-5">
                <a href="#0" class="btn btn-main">最新読込カードIDを反映</a>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">ライフチェック</label>
              <div class="col-sm-10 form-inline">
                <div class="checkbox mr-1">
                  <label>
                    <input type="checkbox" value="">
                  </label>
                </div>
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
                <select class="form-control">
                  <option value="">1月</option>
                  <option value="">2月</option>
                  <option value="">3月</option>
                  <option value="">4月</option>
                  <option value="">5月</option>
                  <option value="">6月</option>
                  <option value="">7月</option>
                  <option value="">8月</option>
                  <option value="">9月</option>
                  <option value="">10月</option>
                  <option value="">11月</option>
                  <option value="">12月</option>
                </select>
                <select class="form-control">
                  <option value="">1日</option>
                  <option value="">2日</option>
                  <option value="">3日</option>
                  <option value="">4日</option>
                  <option value="">5日</option>
                  <option value="">6日</option>
                  <option value="">7日</option>
                  <option value="">8日</option>
                  <option value="">9日</option>
                  <option value="">10日</option>
                  <option value="">11日</option>
                  <option value="">12日</option>
                  <option value="">13日</option>
                  <option value="">14日</option>
                  <option value="">15日</option>
                  <option value="">16日</option>
                  <option value="">17日</option>
                  <option value="">18日</option>
                  <option value="">19日</option>
                  <option value="">20日</option>
                  <option value="">21日</option>
                  <option value="">22日</option>
                  <option value="">23日</option>
                  <option value="">24日</option>
                  <option value="">25日</option>
                  <option value="">26日</option>
                  <option value="">27日</option>
                  <option value="">28日</option>
                  <option value="">29日</option>
                  <option value="">30日</option>
                  <option value="">31日</option>
                </select>
              </div>

            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">初回レッスン</label>
              <div class="col-sm-10 form-inline">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
                <select class="form-control">
                  <option value="">1月</option>
                  <option value="">2月</option>
                  <option value="">3月</option>
                  <option value="">4月</option>
                  <option value="">5月</option>
                  <option value="">6月</option>
                  <option value="">7月</option>
                  <option value="">8月</option>
                  <option value="">9月</option>
                  <option value="">10月</option>
                  <option value="">11月</option>
                  <option value="">12月</option>
                </select>
                <select class="form-control">
                  <option value="">1日</option>
                  <option value="">2日</option>
                  <option value="">3日</option>
                  <option value="">4日</option>
                  <option value="">5日</option>
                  <option value="">6日</option>
                  <option value="">7日</option>
                  <option value="">8日</option>
                  <option value="">9日</option>
                  <option value="">10日</option>
                  <option value="">11日</option>
                  <option value="">12日</option>
                  <option value="">13日</option>
                  <option value="">14日</option>
                  <option value="">15日</option>
                  <option value="">16日</option>
                  <option value="">17日</option>
                  <option value="">18日</option>
                  <option value="">19日</option>
                  <option value="">20日</option>
                  <option value="">21日</option>
                  <option value="">22日</option>
                  <option value="">23日</option>
                  <option value="">24日</option>
                  <option value="">25日</option>
                  <option value="">26日</option>
                  <option value="">27日</option>
                  <option value="">28日</option>
                  <option value="">29日</option>
                  <option value="">30日</option>
                  <option value="">31日</option>
                </select>
              </div>
            </div>

            <div class="block-15 bg-warning">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">休会</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="">
                    </label>
                  </div>
                  <select class="form-control">
                    <option value="">2000年</option>
                  </select>
                  <select class="form-control">
                    <option value="">1月</option>
                    <option value="">2月</option>
                    <option value="">3月</option>
                    <option value="">4月</option>
                    <option value="">5月</option>
                    <option value="">6月</option>
                    <option value="">7月</option>
                    <option value="">8月</option>
                    <option value="">9月</option>
                    <option value="">10月</option>
                    <option value="">11月</option>
                    <option value="">12月</option>
                  </select>
                  <select class="form-control">
                    <option value="">1日</option>
                    <option value="">2日</option>
                    <option value="">3日</option>
                    <option value="">4日</option>
                    <option value="">5日</option>
                    <option value="">6日</option>
                    <option value="">7日</option>
                    <option value="">8日</option>
                    <option value="">9日</option>
                    <option value="">10日</option>
                    <option value="">11日</option>
                    <option value="">12日</option>
                    <option value="">13日</option>
                    <option value="">14日</option>
                    <option value="">15日</option>
                    <option value="">16日</option>
                    <option value="">17日</option>
                    <option value="">18日</option>
                    <option value="">19日</option>
                    <option value="">20日</option>
                    <option value="">21日</option>
                    <option value="">22日</option>
                    <option value="">23日</option>
                    <option value="">24日</option>
                    <option value="">25日</option>
                    <option value="">26日</option>
                    <option value="">27日</option>
                    <option value="">28日</option>
                    <option value="">29日</option>
                    <option value="">30日</option>
                    <option value="">31日</option>
                  </select>
                  <span class="form-fromto-split">〜</span>
                  <select class="form-control">
                    <option value="">2000年</option>
                  </select>
                  <select class="form-control">
                    <option value="">1月</option>
                    <option value="">2月</option>
                    <option value="">3月</option>
                    <option value="">4月</option>
                    <option value="">5月</option>
                    <option value="">6月</option>
                    <option value="">7月</option>
                    <option value="">8月</option>
                    <option value="">9月</option>
                    <option value="">10月</option>
                    <option value="">11月</option>
                    <option value="">12月</option>
                  </select>
                  <select class="form-control">
                    <option value="">1日</option>
                    <option value="">2日</option>
                    <option value="">3日</option>
                    <option value="">4日</option>
                    <option value="">5日</option>
                    <option value="">6日</option>
                    <option value="">7日</option>
                    <option value="">8日</option>
                    <option value="">9日</option>
                    <option value="">10日</option>
                    <option value="">11日</option>
                    <option value="">12日</option>
                    <option value="">13日</option>
                    <option value="">14日</option>
                    <option value="">15日</option>
                    <option value="">16日</option>
                    <option value="">17日</option>
                    <option value="">18日</option>
                    <option value="">19日</option>
                    <option value="">20日</option>
                    <option value="">21日</option>
                    <option value="">22日</option>
                    <option value="">23日</option>
                    <option value="">24日</option>
                    <option value="">25日</option>
                    <option value="">26日</option>
                    <option value="">27日</option>
                    <option value="">28日</option>
                    <option value="">29日</option>
                    <option value="">30日</option>
                    <option value="">31日</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="block-15 bg-gray">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">退会</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="">
                    </label>
                  </div>
                  <select class="form-control">
                    <option value="">2000年</option>
                  </select>
                  <select class="form-control">
                    <option value="">1月</option>
                    <option value="">2月</option>
                    <option value="">3月</option>
                    <option value="">4月</option>
                    <option value="">5月</option>
                    <option value="">6月</option>
                    <option value="">7月</option>
                    <option value="">8月</option>
                    <option value="">9月</option>
                    <option value="">10月</option>
                    <option value="">11月</option>
                    <option value="">12月</option>
                  </select>
                  <select class="form-control">
                    <option value="">1日</option>
                    <option value="">2日</option>
                    <option value="">3日</option>
                    <option value="">4日</option>
                    <option value="">5日</option>
                    <option value="">6日</option>
                    <option value="">7日</option>
                    <option value="">8日</option>
                    <option value="">9日</option>
                    <option value="">10日</option>
                    <option value="">11日</option>
                    <option value="">12日</option>
                    <option value="">13日</option>
                    <option value="">14日</option>
                    <option value="">15日</option>
                    <option value="">16日</option>
                    <option value="">17日</option>
                    <option value="">18日</option>
                    <option value="">19日</option>
                    <option value="">20日</option>
                    <option value="">21日</option>
                    <option value="">22日</option>
                    <option value="">23日</option>
                    <option value="">24日</option>
                    <option value="">25日</option>
                    <option value="">26日</option>
                    <option value="">27日</option>
                    <option value="">28日</option>
                    <option value="">29日</option>
                    <option value="">30日</option>
                    <option value="">31日</option>
                  </select>
                  <div class="checkbox ml-1">
                    <label>
                      <input type="checkbox" value="">
                      <small>保留</small>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15 bg-danger">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">会員ロック</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="">
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15 bg-info">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">MEDLEY</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="">
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メモ・特記事項</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="block-30 text-center">
          <a href="#0" class="btn btn-warning btn-long">
            <span>更新</span>
          </a>
        </div>

      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
