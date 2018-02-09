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
            <form class="form-horizontal" id="reschedule" method="post" action="<?php echo site_url('admin/reschedule/export_csv')?>">
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
                  <select class="form-control" name="type">
                      <option value="<?php echo DATA_ON?>">申請内容</option>
                      <option value="<?php echo ABSENCE ?>"><?php echo ABSENCE ?></option>
                      <option value="<?php echo TRANSFER ?>"><?php echo TRANSFER ?></option>
                      <option value="<?php echo ABSENCE_TRANSFER ?>"><?php echo ABSENCE_TRANSFER ?></option>
                      <option value="<?php echo ABSENCE_CANCELED ?>"><?php echo ABSENCE_CANCELED ?></option>
                      <option value="<?php echo TRANSFER_CANCELLATION ?>"><?php echo TRANSFER_CANCELLATION ?></option>
                      <option value="<?php echo ABSENCE_TRANSFER_CANCELLATION ?>"><?php echo ABSENCE_TRANSFER_CANCELLATION ?></option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1">
                  <input type="text" class="form-control" name="content" value="" placeholder="フリーワード">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">練習コース</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="course[]" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="course[]" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15" id="course_id">
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">クラス</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="class[]" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="class[]" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15">
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="M"> M
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="A"> A
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="B"> B
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="C"> C
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="D"> D
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="E"> E
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value="F"> F
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-dotted panel-red">
                    <div class="panel-heading">級</div>
                    <div class="panel-body">
                      <div class="text-right">
                        <div class="btn-group" role="group">
                          <button class="btn btn-success btn-sm" data-check-name="rank[]" data-check="true">全てチェック</button>
                          <button class="btn btn-default btn-sm" data-check-name="rank[]" data-check="false">全て外す</button>
                        </div>
                      </div>
                      <div class="checkbox-inline-left block-15">
                          <?php
                          foreach ($this->configVar['school_grades'] as $row_grade):
                          ?>
                              <label class="checkbox-inline">
                                  <input type="checkbox" name="rank[]" value="<?php echo $row_grade?>"> <?php echo $row_grade?>
                              </label>
                          <?php
                          endforeach;
                          ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                  <input type="hidden" name="verify_submit" id="verify_submit">
                  <input type="submit" id="display_list" name="list_view" class="btn btn-warning btn-long" value="リスト表示"/>
              </div>
              <div class="block-30 text-center">
                  <a id="export_csv" onclick="document.getElementById('reschedule').submit();" class="btn btn-primary btn-long btn-lg">CSV出力</a>
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
                <tbody id="reschedule_search">
                </tbody>
              </table>
            </div>
          </section>
        </div>
      </div>
        <div class="block-15 text-center" id="pagination">
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

    // search- get list search
    $(document).ready(function(){
        $("#display_list").click(function (e) {
            e.preventDefault();
                $('html,body').animate({
                        scrollTop: $(".table-responsive").offset().top},
                    'slow');
            $('#verify_submit').val('verify_submit');
            load_reschedule_data(0);
        });
    });

    // load data reschedule
    function load_reschedule_data(page)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>admin/reschedule/ajax_loader/"+page,
            method:"POST",
            dataType:"json",
            data:$('#reschedule').serialize(),
            success:function(data)
            {
                if (!$('#verify_submit').val()) {
                    $('#course_id').html('');
                    $('#course_id').html(data.course_list);
                }
                $('#reschedule_search').html('');
                $('#reschedule_search').html(data.list);
                $('#pagination').html('');
                $('#pagination').html(data.pagination);
            }
        });
    }

    load_reschedule_data(0);

    $(document).ready(function(){

        $(document).on("click", ".pagination-main li a", function(event){
            event.preventDefault();
            var href = $(this).attr("href");
            var page =$(this).attr("href").match(/\d+$/);
            if (page==null)
            {
                page=0;
            }
            load_reschedule_data(page);
        });
    });
</script>