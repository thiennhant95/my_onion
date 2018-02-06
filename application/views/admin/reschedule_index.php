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
                    <input type="jp-date1" name="date_start" class="form-control">
                </div>
                <div class="col-xs-1 sub-label">
                  <p class="text-center">〜</p>
                </div>
                <div class="col-xs-4 col-sm-3">
                    <input type="jp-date2" name="date_start" class="form-control">
                </div>
                <div class="col-xs-9 col-sm-3">
                  <select class="form-control" name="status_change">
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
                      <div class="checkbox-inline-left block-15">
                          <?php
                          foreach ($course_list as $value_course):
                          ?>
                              <label class="checkbox-inline">
                                  <input type="checkbox" name="course[]" value="<?php echo $value_course['id']?>"><?php echo $value_course['course_name']?>
                              </label>
                          <?php
                          endforeach;
                          ?>
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
                          <input type="checkbox" name="class[]" value=""> M
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> A
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> B
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> C
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> D
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> E
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" name="class[]" value=""> F
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
                          foreach ($grade_list as $row_grade):
                          ?>
                              <label class="checkbox-inline">
                                  <input type="checkbox" name="rank[]" value="<?php echo $row_grade['grade_name']?>"> <?php echo $row_grade['grade_name']?>
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
                <?php
                foreach ($student_reserve_list as $row_reserve):
                    ?>
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
                <?php
                endforeach;
                ?>
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


<!--      <div class="block-15 text-center">-->
<!--        <nav>-->
<!--          <ul class="pagination pagination-main">-->
<!--            <li class="disabled">-->
<!--              <a href="#" aria-label="Previous">-->
<!--                <span aria-hidden="true">«</span>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li class="active">-->
<!--              <a href="#0">1-->
<!--                <span class="sr-only">(current)</span>-->
<!--              </a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a href="#0">2</a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a href="#0">3</a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a href="#0">4</a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a href="#0">5</a>-->
<!--            </li>-->
<!--            <li>-->
<!--              <a href="#" aria-label="Next">-->
<!--                <span aria-hidden="true">»</span>-->
<!--              </a>-->
<!--            </li>-->
<!--          </ul>-->
<!--        </nav>-->
<!--      </div>-->
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<script>
    $(function () {
        var month = (new Date()).getMonth() + 1;
        var year  = (new Date()).getFullYear();
        // EU Common Format
        $('input[type=eu-date]').w2field('date',  { format: 'd.m.yyyy' });
        $('input[type=eu-dateA]').w2field('date', { format: 'd.m.yyyy', start:  '5.' + month + '.' + year, end: '25.' + month + '.' + year });
        $('input[type=jp-date1]').w2field('date', { format: 'yyyy/mm/dd', end: $('input[type=jp-date2]') });
        $('input[type=jp-date2]').w2field('date', { format: 'yyyy/mm/dd', start: $('input[type=jp-date1]') });
        $('input[type=eu-time]').w2field('time',  { format: 'h24' });
        $('input[type=eu-timeA]').w2field('time', { format: 'h24', start: '8:00 am', end: '4:30 pm' });});
</script>