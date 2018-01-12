<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">
      <form class="form-horizontal">

        <div class="panel panel-dotted">
          <div class="panel-heading">
            <span class="text-blue">カレンダー設定</span>
          </div>
          <div class="panel-body">

            <div class="block-30">
              <div class="alert alert-danger text-center">
                <h3>
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <strong>更新エラー</strong>
                </h3>
                <p>何度も失敗する場合はシステム担当へお問い合わせください。</p>
              </div>
            </div>

            <hr class="hr-dashed">

            <div class="block-15">
              <div class="row calender-caption align-items-center">
                <div class="col-xs-12 col-sm-4 text-left">
                  <a class="btn btn-success" href="#0">
                    <i class="fa fa-angle-double-left"></i>
                    <span>8月</span>
                  </a>
                </div>
                <div class="col-xs-12 col-sm-4 text-center">
                  <p class="lead mb-0">
                    <strong class="text-break">
                      <span>2017年</span>
                      <span>9月</span>
                    </strong>
                  </p>
                </div>
                <div class="col-xs-12 col-sm-4 text-right">
                  <a class="btn btn-success" href="#0">
                    <span>10月</span>
                    <i class="fa fa-angle-double-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="block-15 text-center">
              <button class="btn btn-success btn-long">休館</button>
              <button class="btn btn-warning btn-long">テスト</button>
            </div>

            <div class="block-15">
              <table class="calendar">
                <tr class="weekdays">
                  <th scope="col">日</th>
                  <th scope="col">月</th>
                  <th scope="col">火</th>
                  <th scope="col">水</th>
                  <th scope="col">木</th>
                  <th scope="col">金</th>
                  <th scope="col">土</th>
                </tr>
                <tr class="days">
                  <td class="day other-month">
                    <div class="date sun">27</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">28</div>
                    <div class="label label-calender label-success">休館</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">29</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">30</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">31</div>
                  </td>
                  <td class="day">
                    <div class="date">1</div>
                  </td>
                  <td class="day">
                    <div class="date sat">2</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">3</div>
                  </td>
                  <td class="day">
                    <div class="date">4</div>
                    <div class="label label-calender label-success">休館</div>
                  </td>
                  <td class="day">
                    <div class="date">5</div>
                  </td>
                  <td class="day">
                    <div class="date">6</div>
                  </td>
                  <td class="day">
                    <div class="date">7</div>
                  </td>
                  <td class="day">
                    <div class="date">8</div>
                  </td>
                  <td class="day">
                    <div class="date sat">9</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">10</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">11</div>
                    <div class="label label-calender label-success">休館</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">12</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">13</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">14</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date">15</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                  <td class="day">
                    <div class="date sat">16</div>
                    <div class="label label-calender label-warning">テスト</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">17</div>
                  </td>
                  <td class="day">
                    <div class="date">18</div>
                    <div class="label label-calender label-success">休館</div>
                  </td>
                  <td class="day">
                    <div class="date">19</div>
                  </td>
                  <td class="day">
                    <div class="date">20</div>
                  </td>
                  <td class="day">
                    <div class="date">21</div>
                  </td>
                  <td class="day">
                    <div class="date">22</div>
                  </td>
                  <td class="day">
                    <div class="date sat">23</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">24</div>
                  </td>
                  <td class="day">
                    <div class="date">25</div>
                    <div class="label label-calender label-success">休館</div>
                  </td>
                  <td class="day">
                    <div class="date">26</div>
                  </td>
                  <td class="day">
                    <div class="date">27</div>
                  </td>
                  <td class="day">
                    <div class="date">28</div>
                  </td>
                  <td class="day">
                    <div class="date">29</div>
                  </td>
                  <td class="day">
                    <div class="date sat">30</div>
                  </td>
                </tr>
                <tr>
                  <td class="day">
                    <div class="date sun">31</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">1</div>
                    <div class="label label-calender label-success">休館</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">2</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">3</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">4</div>
                  </td>
                  <td class="day other-month">
                    <div class="date">5</div>
                  </td>
                  <td class="day other-month">
                    <div class="date sat">6</div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="panel panel-dotted">
          <div class="panel-heading">
            <span class="text-blue">振替不可日の設定</span>
          </div>
          <div class="panel-body">
            <div class="block-15 text-center">
              <button class="btn btn-success btn-long btn-lg">
                <span>設定追加</span>
                <i class="fa fa-plus" aria-hidden="true"></i>
              </button>
            </div>

            <div class="row block-15">
              <div class="col-sm-4 col-sm-offset-2">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
              <div class="col-sm-3">
                <a href="#0" class="btn btn-default btn-block">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                  <span>削除</span>
                </a>
              </div>
            </div>

            <div class="row block-15">
              <div class="col-sm-4 col-sm-offset-2">
                <select class="form-control">
                  <option value="">20日</option>
                </select>
              </div>
              <div class="col-sm-3">
                <a href="#0" class="btn btn-default btn-block">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                  <span>削除</span>
                </a>
              </div>
            </div>
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
              <a class="btn btn-warning btn-block" href="#0">
                <span>更新</span>
              </a>
            </p>
          </div>
        </div>

      </form>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
