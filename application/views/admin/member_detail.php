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
        <span>会員詳細</span>
      </h1>

      <div class="block-15 text-right">
        <a href="#0" class="btn btn-default btn-long">
          <i class="fa fa-jpy" aria-hidden="true"></i>
          <span>会費・振替情報</span>
        </a>
      </div>

      <div class="panel panel-dotted">
        <div class="panel-heading">基本契約情報</div>
        <div class="panel-body">

          <div class="alert alert-info text-center">
            <i class="fa fa-pause" aria-hidden="true"></i>
            <strong>休会中</strong>
          </div>
          <div class="alert alert-danger text-center">
            <i class="fa fa-user-times" aria-hidden="true"></i>
            <strong>会員機能ロック</strong>
          </div>
          <div class="alert alert-glay text-center">
            <i class="fa fa-window-close-o" aria-hidden="true"></i>
            <strong>退会</strong>
          </div>

          <section>
            <div class="table-responsive">
              <table class="table table-outline">
                <tbody>
                  <tr>
                    <th>氏名</th>
                    <td>花見川　太郎</td>
                    <th>会員番号</th>
                    <td>xxxxxxxxxxx</td>
                  </tr>
                  <tr>
                    <th>コース</th>
                    <td>JC木　JC金</td>
                    <th>級</th>
                    <td>7級</td>
                  </tr>
                  <tr>
                    <th>指導開始日</th>
                    <td>xxxx年xx月xx日（xx年xヶ月）</td>
                    <th>生年月日</th>
                    <td>xxxx年xx月xx日（xx歳）</td>
                  </tr>
                  <tr>
                    <th>健康管理連絡事項</th>
                    <td class="text-red" colspan="3">皮膚が弱いのでシャワー念入り</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="block-15 text-center">
              <a href="#0" class="btn btn-warning btn-long">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <span>詳細確認・編集</span>
              </a>
            </div>
          </section>

          <section>
            <h3 class="h4 text-blue-green">家族全員</h3>
            <div class="table-responsive">
              <table class="table table-lg table-blue-green table-outline mb-0">
                <thead>
                  <tr>
                    <th>会員番号</th>
                    <th>氏名</th>
                    <th>練習コース</th>
                    <th>クラス</th>
                    <th>級・組</th>
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

      <div class="panel panel-dotted">
        <div class="panel-heading">最新出席状況</div>
        <div class="panel-body">
          <div class="block-15">
            <span>2017/09/01 18:32 現在</span>
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

          <div class="block-15 text-center">
            <a href="#0" class="btn btn-warning btn-long">
              <i class="fa fa-history" aria-hidden="true"></i>
              <span>履歴一覧</span>
            </a>
          </div>
        </div>
      </div>

      <div class="panel panel-dotted">
        <div class="panel-heading">出席状況</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-6">
              <h4>
                <strong>8月</strong>
              </h4>
              <div class="table-responsive">
                <table class="table table-bordered table-fixed table-text-center">
                  <thead>
                    <th></th>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                  </thead>
                  <tbody>
                    <tr>
                      <th>1</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>2</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>
                        <small>都合</small>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>3</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>
                        <small>体調</small>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>4</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>-</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>5</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>6</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table table-outline">
                  <tbody>
                    <tr>
                      <th>結果1</th>
                      <td>kよわい 　(真島）</td>
                      </td>
                    </tr>
                    <tr>
                      <th>結果2</th>
                      <td>後半kさがる　（市川）</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-sm-6">
              <h4>
                <strong>9月</strong>
              </h4>
              <div class="table-responsive">
                <table class="table table-bordered table-fixed table-text-center">
                  <thead>
                    <th></th>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                  </thead>
                  <tbody>
                    <tr>
                      <th>1</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>2</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>
                        <small>都合</small>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>3</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>
                        <small>体調</small>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>4</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>-</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>5</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>6</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table table-outline">
                  <tbody>
                    <tr>
                      <th>結果1</th>
                      <td>
                        <strong class="text-red">7級合格（山口）</strong>
                      </td>
                      </td>
                    </tr>
                    <tr>
                      <th>結果2</th>
                      <td></td>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <hr class="hr-dashed">

          <div class="block-15 text-center">
            <a href="#0" class="btn btn-warning btn-long">
              <i class="fa fa-retweet" aria-hidden="true"></i>
              <span>振替操作</span>
            </a>
          </div>
        </div>
      </div>

      <div class="panel panel-dotted">
        <div class="panel-heading">指導メモ更新履歴</div>
        <div class="panel-body">
          <ul class="link-list">
            <li>
              <span>けんかっぱやい – 2017/9/1（真島）</span>
            </li>
            <li>
              <span>肩の関節が弱い – 2017/9/1（山口）</span>
            </li>
            <li>
              <span>キック弱い – 2017/9/1（市川）</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="panel panel-dotted">
        <div class="panel-heading">成績</div>
        <div class="panel-body">
          <div class="table-responsive"></div>
          <table class="table table-outline table-blue table-text-center">
            <thead>
              <th>組・級</th>
              <th>合格日</th>
              <th>担当</th>
            </thead>
            <tbody>
              <tr>
                <td>8</td>
                <td>2017/8/5</td>
                <td>小林</td>
              </tr>
              <tr>
                <td>7</td>
                <td>2017/9/7</td>
                <td>山口</td>
              </tr>
            </tbody>
          </table>

          <div class="table-responsive">
            <table class="table table-outline table-blue-green table-text-center">
              <thead>
                <th colspan="4">自由形</th>
              </thead>
              <tbody>
                <tr>
                  <th>月日</th>
                  <th>タイム</th>
                  <th>M</th>
                  <th>担当</th>
                </tr>
                <tr>
                  <td>2017/06/10</td>
                  <td>00’00”00</td>
                  <td></td>
                  <td>コーチA</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-outline table-blue-green table-text-center">
              <thead>
                <th colspan="4">背泳ぎ</th>
              </thead>
              <tbody>
                <tr>
                  <th>月日</th>
                  <th>タイム</th>
                  <th>M</th>
                  <th>担当</th>
                </tr>
                <tr>
                  <td>2017/06/10</td>
                  <td>00’00”00</td>
                  <td></td>
                  <td>コーチA</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-outline table-blue-green table-text-center">
              <thead>
                <th colspan="4">クロール</th>
              </thead>
              <tbody>
                <tr>
                  <th>月日</th>
                  <th>タイム</th>
                  <th>M</th>
                  <th>担当</th>
                </tr>
                <tr>
                  <td>2017/06/10</td>
                  <td>00’00”00</td>
                  <td></td>
                  <td>コーチA</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-outline table-blue-green table-text-center">
              <thead>
                <th colspan="4">平泳ぎ</th>
              </thead>
              <tbody>
                <tr>
                  <th>月日</th>
                  <th>タイム</th>
                  <th>M</th>
                  <th>担当</th>
                </tr>
                <tr>
                  <td>2017/06/10</td>
                  <td>00’00”00</td>
                  <td></td>
                  <td>コーチA</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="table-responsive">
            <table class="table table-outline table-blue-green table-text-center">
              <thead>
                <th colspan="4">個人メドレー</th>
              </thead>
              <tbody>
                <tr>
                  <th>月日</th>
                  <th>タイム</th>
                  <th>M</th>
                  <th>担当</th>
                </tr>
                <tr>
                  <td>2017/06/10</td>
                  <td>00’00”00</td>
                  <td></td>
                  <td>コーチA</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
