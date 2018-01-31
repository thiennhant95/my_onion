<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading h3">
        <span>クラス編集</span>
      </h1>
      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal"id="class_form" method="post">
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">コース記号</label>
                  <div class="col-sm-5">
                      <select class="form-control" name="short_course_name" required>
                          <?php
                          foreach ($course_list as $row_course):
                              ?>
                              <option value="<?php echo $row_course['id']?>" <?php if ($row_course['id']==$get_class['course_id']) echo "selected"?>><?php echo $row_course['short_course_name']?></option>
                          <?php
                          endforeach;
                          ?>
                      </select>
                  </div>
              </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラスコード</label>
              <div class="col-sm-5">
                  <select class="form-control" name="base_class_sign" required>
                      <option value="M" <?php if ($get_class['base_class_sign']=="M") echo "selected"?>>M</option>
                      <option value="A" <?php if ($get_class['base_class_sign']=="A") echo "selected"?>>A</option>
                      <option value="B" <?php if ($get_class['base_class_sign']=="B") echo "selected"?>>B</option>
                      <option value="C" <?php if ($get_class['base_class_sign']=="C") echo "selected"?>>C</option>
                      <option value="D" <?php if ($get_class['base_class_sign']=="D") echo "selected"?>>D</option>
                      <option value="E" <?php if ($get_class['base_class_sign']=="E") echo "selected"?>>E</option>
                      <option value="F" <?php if ($get_class['base_class_sign']=="F") echo "selected"?>>F</option>
                  </select>
              </div>
              <div class="col-sm-5">
                  <?php
//                  $class_code = substr_replace($get_class['class_code'], '', 0, 1);
                  ?>
                <input type="text" class="form-control" name="class_code" value="<?php echo $get_class['class_code'];?>" required placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラス名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="class_name" value="<?php echo $get_class['class_name']?>" required placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">級管理</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="level-manage" value=<?php echo DATA_ON?> <?php if ($get_class['grade_manage_flg']==DATA_ON) echo "checked"?>> する
                  </label>
                <label class="radio-inline">
                  <input type="radio" name="level-manage" value="<?php echo DATA_OFF?>" <?php if ($get_class['grade_manage_flg']==DATA_OFF) echo "checked"?>> しない
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バス利用</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="use-bus" value="<?php echo DATA_ON?>" <?php if ($get_class['use_bus_flg']==DATA_ON) echo "checked"?>> あり
                </label>
                <label class="radio-inline">
                  <input type="radio" name="use-bus" value="<?php echo  DATA_OFF?>" <?php if ($get_class['use_bus_flg']==DATA_OFF) echo "checked"?>> なし
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">授業曜日</label>
              <div class="col-sm-10">
                  <?php
                  $get_class['week']=explode(',',$get_class['week']);
                  ?>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo MONDAY?>" <?php if (in_array(MONDAY,$get_class['week'])) {echo "checked";}?>> 月
                  </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo TUESDAY?>"  <?php if (in_array(TUESDAY,$get_class['week'])) {echo "checked";}?>> 火
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo WEDNESDAY?>"  <?php if (in_array(WEDNESDAY,$get_class['week'])) {echo "checked";}?>> 水
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo THURSDAY?>"  <?php if (in_array(THURSDAY,$get_class['week'])) {echo "checked";}?>> 木
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo FRIDAY?>"  <?php if (in_array(FRIDAY,$get_class['week'])) {echo "checked";}?>> 金
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo SATURDAY?>"  <?php if (in_array(SATURDAY,$get_class['week'])) {echo "checked";}?>> 土
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="week[]" value="<?php echo SUNDAY?>"  <?php if (in_array(SUNDAY,$get_class['week'])) {echo "checked";}?>> 日
                </label>
                  <label id="week[]-error"class="label label-danger" for="week[]" style=" display: none">一個以上のチェックボックスにチェックを入れてください</label>
              </div>
            </div>
              <div class="form-group">
                  <label for="" class="col-sm-2 control-label">定員</label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="max_count" value="<?php echo $get_class['max_count']?>" required placeholder="">
                  </div>
              </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">有効/無効</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="enable" value=<?php echo DATA_OFF?> <?php if ($get_class['invalid_flg']==DATA_OFF) echo "checked"?>> 有効
                </label>
                <label class="radio-inline">
                  <input type="radio" name="enable" value=<?php echo DATA_ON?> <?php if ($get_class['invalid_flg']==DATA_ON) echo "checked"?>> 無効
                </label>
              </div>
            </div>
        </div>
      </div>
      <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="<?php echo site_url('admin/classes')?>">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <button class="btn btn-success btn-block" id="update" data_id="<?php echo $get_class['id'] ?>">
              <span>更新</span>
            </button>
          </p>
        </div>
      </div>
    </div>
      </form>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<button style=" visibility: hidden;" type="button" id="popup" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
</button>

<div id="myModal"  class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p id="status_update"></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    .alert-success {border-radius: 0px }
    .alert-danger {border-radius: 0px }
</style>