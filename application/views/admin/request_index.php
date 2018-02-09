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
          <span class="text-violet">契約変更申請一覧</span>
          <a href="#0" class="btn btn-primary btn-sm pull-right">
            <strong>CSV出力</strong>
          </a>
        </div>
        <div class="panel-body">

          <section>
            <form class="form-horizontal">
              <div class="form-group">
                <div class="col-sm-1"></div>
                <div class="col-xs-4 col-sm-3">
                    <input type="jp-date1" name="date_start" class="form-control">
                </div>
                <div class="col-xs-1 sub-label">
                  <p class="text-center">〜</p>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <input type="jp-date2" name="date_end" class="form-control">
                </div>
                <div class="col-xs-9 col-sm-3">
                  <select class="form-control">
                    <option name="class" value="">申請内容</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="input-group">
<!--                      <form method="post">-->
                      <input type="hidden" name="verify_submit" id="verify_submit" minlength="4" >
<!--                          <input type="submit">dsdsd</input>-->
<!--                      </form>-->
                      <input type="text" id="search" class="form-control" placeholder="フリーワード検索">
                    <span class="input-group-btn">
                      <button class="btn btn-main btn-long" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </form>
          </section>

          <hr class="hr-dashed">

          <section>

            <div class="block-30">
              <nav class="master-nav">
                <ul class="nav nav-pills" role="group">
                  <li role="presentation">
                    <a href="#0">未処理</a>
                  </li>
                  <li role="presentation">
                    <a href="#0">処理済み</a>
                  </li>
                  <li role="presentation">
                    <a href="#0">保留</a>
                  </li>
                  <li role="presentation" class="active">
                    <a href="#0">全て</a>
                  </li>
                </ul>
              </nav>
            </div>

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
                    <th>確認</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>バス変更</td>
                    <td>未処理</td>
                    <td>---</td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
                    </td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>住所変更</td>
                    <td>未処理</td>
                    <td>---</td>
                    <td></td>
                    <td></td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
                    </td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>コース変更</td>
                    <td>処理済み</td>
                    <td>2017/9/1</td>
                    <td>無</td>
                    <td></td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
                    </td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>休会</td>
                    <td>処理済み</td>
                    <td>2017/9/1</td>
                    <td>無</td>
                    <td></td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
                    </td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>コース変更</td>
                    <td>保留</td>
                    <td>2017/9/1</td>
                    <td>発生</td>
                    <td>済</td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
                    </td>
                  </tr>
                  <tr>
                    <th>12345</th>
                    <td>玉葱　太郎</td>
                    <td>2017/9/1</td>
                    <td>バス変更</td>
                    <td>処理済み</td>
                    <td>2017/9/1</td>
                    <td>
                      <span class="text-red">免除</span>
                    </td>
                    <td>済</td>
                    <td>
                      <a href="#0" class="btn btn-success btn-sm btn-block">確認</a>
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

<script>
    //format datetime
    $(function () {
        var month = (new Date()).getMonth() + 1;
        var year  = (new Date()).getFullYear();
        $('input[type=eu-date]').w2field('date',  { format: 'd.m.yyyy' });
        $('input[type=eu-dateA]').w2field('date', { format: 'd.m.yyyy', start:  '5.' + month + '.' + year, end: '25.' + month + '.' + year });
        $('input[type=jp-date1]').w2field('date', { format: 'yyyy/mm/dd', end: $('input[type=jp-date2]') });
        $('input[type=jp-date2]').w2field('date', { format: 'yyyy/mm/dd', start: $('input[type=jp-date1]') });
        $('input[type=eu-time]').w2field('time',  { format: 'h24' });
        $('input[type=eu-timeA]').w2field('time', { format: 'h24', start: '8:00 am', end: '4:30 pm' });});

    // load data reschedule
    function load_request_data(page)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/request/ajax_load_list/"+page,
            method:"POST",
            dataType:"json",
            data:$('#reschedule').serialize(),
            success:function(data)
            {
                // if (!$('#verify_submit').val()) {
                //     $('#course_id').html('');
                //     $('#course_id').html(data.course_list);
                // }
                // $('#reschedule_search').html('');
                // $('#reschedule_search').html(data.list);
                // $('#pagination').html('');
                // $('#pagination').html(data.pagination);
            }
        });
    }

    load_request_data(0);
</script>