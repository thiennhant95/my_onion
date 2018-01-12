<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_user_registration.php"); ?>

  <main id="page_init" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted">
        <div class="panel-heading"></div>
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <span class="form-send-confirm-display text-light">玉葱太郎</span>
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

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <p class="form-send-confirm-text text-light">
                  <strong>〒XXX-XXXX　千葉県千葉市花見川区～～～～</strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong>XXX-XXXX-XXXX</strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong>xxx@xxxx.xx.xx</strong>
                </p>
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

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスの利用</label>
              <div class="col-sm-5">
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value=""> 利用しない
                </label>
              </div>
              <div class="col-sm-4">
                <div class="block-15">
                  <a href="#0" class="btn btn-outline-blue btn-small btn-block" target="_blank">
                    <i class="fa fa-external-link-square" aria-hidden="true"></i>
                    <span>送迎バスのご案内</span>
                    <br>
                    <small>(別ウィンドウで開きます)</small>
                  </a>
                </div>
              </div>
            </div>

            <hr>

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

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">お申込みコース</label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="app" value="" checked> 新規入会
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">ジュニア</option>
                        </select>
                      </div>
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">週2回</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="app" value="" checked> 短期水泳教室
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-10 col-sm-8">
                        <select class="form-control">
                          <option value="">春の短期水泳教室(3/25～29)</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="app" value="" checked> 無料体験
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">ジュニア　</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コーチへの伝達事項</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>

          </form>

        </div>
        <div class="panel-footer text-center">
          <div class="block-30">
            <a href="#0" class="btn btn-success btn-lg btn-long">
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              <span id="confirm">送信内容を確認</span>
            </a>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="#0">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>


  <main id="page_complete" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted text-center">
        <div class="panel-heading">
          <div class="block-30 text-break">
            <i class="fa fa-check-circle form-send-confirm-icon" aria-hidden="true"></i>
            <strong>
              <span>このたびは当クラブへの</span>
              <span>お申込みありがとうございました。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">
          <div class="text-light">
            <h5>
              <strong>お申込み番号</strong>
            </h5>
            <p class="form-send-confirm-display">
              <strong>XXXXXXXX</strong>
            </p>
          </div>
          <div class="block-30 text-break">
            <strong>
              <span>当クラブの営業時間内にご来館いただき、</span>
              <span>受付までお申し出ください。</span>
            </strong>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="#0">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>


  <?php require_once("contents_footer.php"); ?>
</body>

</html>


<script>
    $(function() {
        $('#page_complete').css('display','none');

        $('main#page_init').on('click', 'span#confirm', function(event) {
            event.preventDefault();
            $('#page_init').css('display','none');
            $('#page_complete').css('display','block');
        });
    })
</script>
