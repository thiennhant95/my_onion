<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main id="page_init" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          
          <div class="rounded-corners-1 mb-50">
            <h2 class="title-1 mb-20">新規お申込み</h2>
            <form class="form-horizontal">
              <section>
                <div class="panel panel-card">
                  <div class="panel-heading bg-midnight-Blue align-left pl-30">本日の初日会員一覧（2名）</div>
                  <div class="panel-body-2 bg-albatre table-responsive">
                    <table class="table table-style-1">
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">氏名</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">フリガナ</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">生年月日</th>
                        <td class="bg-white table-border-none">

                          <select class="form-control select-type-2 w-xs-100per w-md-30per">
                            <option value="">2000年</option>
                          </select>

                          <select class="form-control select-type-2 w-xs-100per w-md-30per">
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

                          <select class="form-control select-type-2 w-xs-100per w-md-30per">
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
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">性別</th>
                        <td class="bg-white table-border-none">
                          <div class="col-sm-10 text-gray">
                            <label class="radio-inline">
                              <input name="sex" value="" type="radio"> 男性
                            </label>
                            <label class="radio-inline">
                              <input name="sex" value="" type="radio"> 女性
                            </label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">郵便番号</th>
                        <td class="bg-white table-border-none">
                          <div class="row post-input">
                            <div class="col-xs-6 col-md-3 postal-code-line postal-code-line-gray">
                              <input class="form-control post-input-main" value="" placeholder="" type="number">
                            </div>
                            <div class="col-xs-6 col-md-3">
                              <input class="form-control post-input-main" value="" placeholder="" type="number">
                            </div>
                            <div class="col-xs-12 col-md-3">
                              <a href="#0" class="btn btn-main">〒 住所に反映</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">住所</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-xs-100per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">メールアドレス</th>
                        <td class="bg-white table-border-none">
                          <div class="row">
                            <div class="col-sm-6">
                              <input class="form-control w-xs-100per" value="" placeholder="" type="text">
                            </div>
                            <div class="col-sm-6 text-gray">
                              <input value="" type="checkbox"> メールアドレスなし
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">電話番号</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">緊急連絡先</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </section>


              <section class="mb-30">
                <div class="panel panel-card">
                  <div class="panel-heading bg-rouge align-left pl-30">【入会者が未成年の場合】</div>
                  <div class="panel-body-2 pt-10 bg-milky-pink table-responsive">
                    <h2 class="title-1 mb-20" style="text-decoration: underline;">※入会者が未成年の場合のみ記入</h2>
                    <table class="table table-style-1" width="100%" class="text-gray">
                      <tr>
                        <th class="align-right table-border-none">保護者氏名</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">学校名</th>
                        <td class="bg-white table-border-none">
                          <input class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">学年</th>
                        <td class="bg-white table-border-none">
                          <select class="form-control w-xs-100per w-md-40per">
                            <option value="">幼稚園</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </section>


              <section>

                <div class="panel panel-card">
                  <div class="panel-heading g-green bg-deep-green align-left pl-30">【希望練習コース・泳力アンケートなど】</div>
                  <div class="panel-body-2 pt-10 bg-ice-green table-responsive">
                    <h2 class="title-1 mb-20" style="text-decoration: underline;">※入会者が未成年の場合のみ記入</h2>
                    <table class="table table-style-1" width="100%" class="text-gray">
                      <tr>
                        <th class="align-right table-border-none">希望練習コース</th>
                        <td class="bg-white text-gray table-border-none">ジュニア週２</td>
                      </tr>
                      <tr>
                        <th class="align-right bg-plae-lemmon text-gray table-border-none">コースコード<br><span style="font-size:11px">（スタッフ入力欄）</span></th>
                        <td class="bg-white table-border-none">
                          <select class="form-control w-xs-100per">
                            <option value="">1341　ジュニア週2</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none ">クラス早見表</th>
                        <td class="bg-white table-border-none">

                          <div class="table-responsive">
                            <table class="table table-bordered table-hover table-lg table-center">
                              <thead>
                                <tr>
                                  <th>　</th>
                                  <th>M<br>11:00～</th>
                                  <th>A<br>13:30～</th>
                                  <th>B<br>14:40～</th>
                                  <th>C<br>15:55～</th>
                                  <th>D<br>17:05～</th>
                                  <th>E<br>18:05～</th>
                                  <th>F<br>19:20～</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>火</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>水</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>木</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>金</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>土</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-plae-lemmon">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                                <tr>
                                  <td>日</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                  <td class="bg-gainsboro">　</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right bg-plae-lemmon text-gray table-border-none">コースコード<br><span style="font-size:11px">（スタッフ入力欄）</span></th>
                        <td class="bg-white table-border-none">
                          <div class="row">
                            <div class="col-xs-5">
                              <select class="form-control w-xs-100per">
                                <option value="">JD2</option>
                              </select>
                            </div>
                            <div class="col-xs-5">
                              <select class="form-control w-xs-100per">
                                <option value="">JE3</option>
                              </select>
                            </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right table-border-none">申請時の泳力</th>
                        <td class="bg-white table-border-none pl-30">
                          <div class="row text-gray mb-15">
                            <label class="radio-inline">
                              <input name="level-manage" value="" type="radio"> 水に顔をつけることができ
                            </label><br>
                            <label class="radio-inline">
                              <input name="level-manage" value="" type="radio"> 水に顔をつけることができない
                            </label>
                          </div>
                          <div class="row text-gray mb-15">
                            <div class="checkbox">
                              <label>
                                <input value="" type="checkbox"> 潜れる
                              </label>　
                              <label>
                                <input value="" type="checkbox"> 浮かべる
                              </label>
                            </div>
                          </div>

                          <div class="row mb-15">
                            <table>
                              <tr>
                                <td>バタ足</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                                <td class="pl-30">板キック</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>背泳ぎ</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                                <td class="pl-30">クロール</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>平泳ぎ</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                                <td class="pl-30">バタフライ</td>
                                <td>
                                  <select class="form-control w-xs-100per">
                                    <option value="">25M</option>
                                  </select>
                                </td>
                              </tr>
                            </table>
                          </div>
                          
                          <div class="row text-gray mb-15">
                            備考　
                              <input class="w-xs-75per" type="text" name="">
                            
                          </div>

                          <div class="row text-gray mb-15">
                            <div class="checkbox">
                              <label>
                                <input value="" type="checkbox"> 無料体験に参加したことがある
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input value="" type="checkbox"> 短期水泳教室に参加したことがある
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input value="" type="checkbox"> 当クラブまたは他クラブに通っていたことがある
                              </label>
                            </div>
                          </div>



                          <div class="text-gray mb-15">
                            <div class="form-group row">

                              クラブ名　<input class="w-xs-20per" type="text" name="">　

                              <select class="form-control select-type-1 w-xs-20per">
                                <option value="">2000年</option>
                              </select> 年　

                              <select class="form-control select-type-1 w-xs-20per">
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
                              </select> 月退会

                            </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none">コーチへの<br>伝達事項</th>
                        <td class="bg-white table-border-none text-gray">
                          <textarea name="" class="w-xs-100per" rows="1"></textarea>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none">バスの利用</th>
                        <td class="bg-white table-border-none text-gray">
                          <div class="text-gray">
                            <label class="radio-inline"><input name="level-manage" value="" type="radio"> する</label>　
                            <label class="radio-inline"><input name="level-manage" value="" type="radio"> しない</label>
                          </div>
                          <div class="mb-15">
                            <table>
                              <tbody>
                                <tr>
                                  <td>行き</td>
                                  <td>
                                    <select class="form-control w-xs-100per">
                                      <option value="">⑧ 花見川コース</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-control w-xs-100per">
                                      <option value="">【8380】 花見川交番前</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>帰り</td>
                                  <td>
                                    <select class="form-control w-xs-100per">
                                      <option value="">⑧ 花見川コース</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-control w-xs-100per">
                                      <option value="">【8380】 花見川交番前</option>
                                    </select>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">IC カード番号</th>
                        <td class="bg-white table-border-none text-gray">
                          <input class="w-xs-50per" name="" type="text">　
                          <a class="button-link-1 bg-deep-green" href="">最新読込カードIDを反映</a>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">ライフチェック</th>
                        <td class="bg-white table-border-none text-gray">
                            <div class="checkbox">
                              <label>
                                <input value="" type="checkbox">
                              </label>
                            </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">初回レッスン日</th>
                        <td class="bg-white table-border-none">

                          <select class="form-control select-type-1 w-xs-30per">
                            <option value="">2000年</option>
                          </select>

                          <select class="form-control select-type-1 w-xs-30per">
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

                          <select class="form-control select-type-1 w-xs-30per">
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
                        </td>
                      </tr>


                      <tr>
                        <th class="align-right bg-plae-lemmon text-gray table-border-none">メモ・特記事項<br>
                        <span style="font-size:11px">（スタッフ用）</span></th>
                        <td class="bg-white table-border-none text-gray">
                          <textarea name="" class="w-xs-100per" rows="1"></textarea>
                        </td>
                      </tr>

                    </table>
                  </div>
                </div>
              </section>

              <div class="block-30 align-center">
                <a href="#0" class="btn bg-light-blue btn-lg btn-long">
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                  <span id="button_entry_explain">誓約書へ</span>
                </a>
              </div>
            </form>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_explain" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3 mb-50">
            <h2 class="title-3 mb-20">新入会員の皆様へ</h2>
            <div class="pdf-area">
              <object data="/images/hanamigawasw/test.pdf" type="application/pdf" width="100%" height="100%">
                <iframe src="test.pdf" width="100%" height="100%">
                  <p><b>表示されない時の表示</b>: <a href="test.pdf">PDF をダウンロード</a>.</p>
                </iframe>
              </object>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_entry_contract">誓約書へ</span>
              </a>
            </div>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>


  <main id="entry_minority" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <div class="box-style-2">
              <h2 class="title-2 mb-30">誓約書</h2>
              <p class="mb-50">
                入会者は、健康状態にあり、水泳練習への参加に支障がないものと認め健康状態についての一切とクラブ規則を遵守することを保護者の責任として誓約します。
              </p>
              <p class="mb-50">2017年9月10日</p>
              <div class="align-center">
                <dl class="dl-style-1">
                  <dt>入会者名</dt>
                  <dd>玉葱　太郎</dd>
                  <dt>保護者氏名</dt>
                  <dd>玉葱　花絵</dd>
                </dl>
              </div>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_entry_minority">誓約書します</span>
              </a>
            </div>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_majority" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <div class="box-style-2">
              <h2 class="title-2 mb-30">誓約書</h2>
              <p class="mb-20">
                花見川スイミングクラブへの入会にあたり、下記のとおり誓約します。
              </p>
              <p class="align-center mb-20">記</p>
              <ol class="mb-50 ol-style-1">
                <li>入会者は水泳練習にあたって健康上の支障はありませ。</li>
                <li>水泳練習にあたっての入会者の健康状態は、入会者本人及び家族の責任で管理します。</li>
                <li>別紙「プール利用にあたってのお願い」を読みましたので、確認注意事項及びスタッフの指示に従い、事故の無いように留意します。</li>
                <li>プール施設内において、入会者の健康状態が原因で事故が発生した場合は、入会者及び家族の責任で一切を処理し、クラブには何らご迷惑をおかけしません。</li>
                <li>水泳練習に差し支えない場合でも、身体的理由で定期的に通院している場合にはお知らせします。</li>
              </ol>
              <p class="mb-50">2017年9月10日</p>
              <div class="align-center">
                <dl class="dl-style-1">
                  <dt>入会者名</dt>
                  <dd>玉葱　太郎</dd>
                  <dt>家族名</dt>
                  <dd>玉葱　花絵</dd>
                  <dt>続柄</dt>
                  <dd>母</dd>
                </dl>
              </div>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_button_entry_majority">誓約書します</span>
              </a>
            </div>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_complete" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <h2 class="title-2 mb-30 mt-30">新規入会登録完了</h2>

            <div class="box-style-1 mb-30 bg-lightpink">
              <h3 class="box-style-1-title text-deep-red">初回お支払い金額</h3>
              <p class="box-style-1-text text-gray">XX,XXXX 円</p>
            </div>

            <div class="box-style-1 text-lightpink bg-aquatint">
              <h3 class="box-style-1-title text-konjyou">マイページ仮パスワード</h3>
              <p class="box-style-1-text text-gray">XXXX</p>
            </div>

            <div class="block-30 align-center">
              <a href="#0" class="btn bg-light-blue btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span>完了</span>
              </a>
            </div>

          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>



<script>
    $(function() {
        entry_disp_view('#page_init');

        $('main#page_init').on('click', 'span#button_entry_explain', function(event) {
            event.preventDefault();
            entry_disp_view('#entry_explain');
        });

        $('main#entry_explain').on('click', 'span#button_entry_contract', function(event) {
            event.preventDefault();

            // 申込者の年齢チェックによって、どちらを表示するか表示を振り分ける
            if (1) {
                // 未成年者用 誓約書表示
                entry_disp_view('#entry_minority');
            } else {
                // 成年用 誓約書表示
                entry_disp_view('#entry_majority');
            }
        });

        $('main#entry_minority').on('click', 'span#button_entry_minority', function(event) {
            event.preventDefault();
            entry_disp_view('#entry_complete');
        });

        $('main#entry_majority').on('click', 'span#button_entry_majority', function(event) {
            event.preventDefault();
            entry_disp_view('#entry_complete');
        });

    })

    function entry_disp_view(id) {
        $('#page_init').css('display','none');
        $('#entry_explain').css('display','none');
        $('#entry_minority').css('display','none');
        $('#entry_majority').css('display','none');
        $('#entry_complete').css('display','none');

        $(id).css('display','block');
    }
</script>
