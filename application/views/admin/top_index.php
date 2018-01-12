<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">


      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row btn-list-row block-15">
              <div class="col-sm-6">
                <a class="button-large bg-rouge" href="">新規お申し込み</a>
              </div>
              <div class="col-sm-6">
                <a class="button-large bg-midnight-Blue" href="">新入会員の皆様へ</a>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="form-search mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="rounded-corners-1 pb-10">
              <form action="" method="">

                <div class="row">
                  <div class="col-sm-5 align-center mb-5">
                    <table width="100%">
                      <tr>
                        <td><img src="/images/hanamigawasw/icon_magnifying_glass.svg" style="width:35px"></td>
                        <td><input class="form-control" type="text" name="" placeholder="氏名・番号・学校名等"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-5 align-center mb-5">
                    <select class="form-control">
                      <option value="">練習コース</option>
                    </select>
                  </div>
                  <div class="col-sm-2 align-center mb-5">
                    <input class="submit-btn bg-blue-green" type="submit" value="会員検索">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>


      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row btn-list-row block-15">
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 lead-heading-icon-men bg-blue-green" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>会員一覧</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 lead-heading-icon-mail bg-yellow" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>緊急お知らせ</span>
                      <small>メール</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-memo-2 bg-violet" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>契約変更<br>申請一覧</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-iccard bg-yellow-green" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>ICカード<br>入退室管理</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-calender-2 bg-carnation-pink" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>レッスン<br>出欠管理</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-bus-02 bg-deep-green" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>送迎バス<br>乗降管理</span>
                    </span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="button-type-1">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
            </div>
          </div>
        </div>
      </section><!-- .button-type-1 -->




      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">本日の初日会員一覧（2名）</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">コース</th>
                        <th class="bg-sirahuji text-gray">クラス</th>
                        <th class="bg-sirahuji text-gray">コーチへの連絡事項</th>
                        <th class="bg-sirahuji text-gray">泳力<br>アンケート</th>
                        <th class="bg-sirahuji text-gray"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>12345</td>
                        <td>玉葱　太郎</td>
                        <td>ジュニア</td>
                        <td>C</td>
                        <td>人見知りでおとなしいです</td>
                        <td class="align-left">■潜れる<br>■バタ足25M</td>
                        <td>
                          <div class="block-30 text-center">
                            <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                              <span>確認</span>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>12345</td>
                        <td>玉葱　太郎</td>
                        <td>ジュニア</td>
                        <td>C</td>
                        <td>人見知りでおとなしいです</td>
                        <td class="align-left">■潜れる<br>■バタ足25M</td>
                        <td>
                          <div class="block-30 text-center">
                            <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                              <span>確認</span>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">本日の無料体験者一覧（１名）</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">コース</th>
                        <th class="bg-sirahuji text-gray">クラス</th>
                        <th class="bg-sirahuji text-gray">コーチへの連絡事項</th>
                        <th class="bg-sirahuji text-gray">泳力<br>アンケート</th>
                        <th class="bg-sirahuji text-gray"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>12345</td>
                        <td>玉葱　太郎</td>
                        <td>ジュニア</td>
                        <td>C</td>
                        <td>人見知りでおとなしいです</td>
                        <td class="align-left">■潜れる<br>■バタ足25M</td>
                        <td>
                          <div class="block-30 text-center">
                            <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                              <span>確認</span>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">開催中の短期水泳教室</div>
              <div class="panel-body pl-30 pr-30 pt-10 pb-10">
                <div class="table-responsive">
                  <table width="100%" class="">
                    <tbody>
                      <tr>
                        <td class="align-left">春の短期水泳教室（3/25～29）</td>
                        <td class="align-right">
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long border-radius-0">
                            <span>会員一覧</span>
                          </a>　
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long border-radius-0">
                            <span>出欠管理</span>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">バス乗降変更連絡</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1 bg-plae-lemmon text-gray">
                    <tbody>
                      <tr>
                        <td class="">12345</td>
                        <td class="">2017/09/01</td>
                        <td class="">玉葱　太郎</td>
                        <td class="">一般</td>
                        <td class="align-right">
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                            <span>確認</span>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">2週間連絡のない会員</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1 bg-plae-lemmon text-gray">
                    <tbody>
                      <tr>
                        <td class="">12345</td>
                        <td class="">2017/09/01</td>
                        <td class="">玉葱　太郎</td>
                        <td class="">一般</td>
                        <td class="align-right">
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                            <span>確認</span>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">新規ネット申し込み（未処理）一覧</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-border-1 table-lg table-center">
                    <tr>
                      <td>12345</td>
                      <td>2017/09/01</td>
                      <td>21：59</td>
                      <td>玉葱　太郎</td>
                      <td>入会</td>
                      <td>一般</td>
                      <td class="align-center">
                        <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                          <span>処理</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>12345</td>
                      <td>2017/09/01</td>
                      <td>21：59</td>
                      <td>玉葱　太郎</td>
                      <td>入会</td>
                      <td>一般</td>
                      <td class="align-center">
                        <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                          <span>処理</span>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>12345</td>
                      <td>2017/09/01</td>
                      <td>21：59</td>
                      <td>玉葱　太郎</td>
                      <td>入会</td>
                      <td>一般</td>
                      <td class="align-center">
                        <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                          <span>処理</span>
                        </a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">契約変更申請（未処理）一覧</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-border-1 table-lg table-center">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">申請日</th>
                        <th class="bg-sirahuji text-gray">申請内容</th>
                        <th class="bg-sirahuji text-gray">処理状況</th>
                        <th class="bg-sirahuji text-gray">処理日</th>
                        <th class="bg-sirahuji text-gray">手数料</th>
                        <th class="bg-sirahuji text-gray">　</th>
                      </tr>
                    </thead>
                    <tr>
                      <td>12345</td>
                      <td>玉葱　太郎</td>
                      <td>2017/09/01</td>
                      <td>コース変更</td>
                      <td>未処理</td>
                      <td>-</td>
                      <td>　</td>
                      <td class="align-center">
                        <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                          <span>処理</span>
                        </a>
                      </td>
                    </tr>
                  </table>
                </div>
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
