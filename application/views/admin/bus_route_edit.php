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
        <span>バスコース登録 &frasl; ルート設定</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal" id="bus_couse" method="post">
            <div class="form-group" >
              <label for="" class="col-sm-2 control-label">バスコースコード</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="bus_course_code" value="<?php echo $get_bus_course['bus_course_code']?>" required placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスコース名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="bus_course_name" value="<?php echo $get_bus_course['bus_course_name']?>" required placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">クラス</label>
              <div class="col-sm-5">
                <select class="form-control" id="class_id">
                    <?php
                    foreach ($class_list as $row_class) {
                        ?>
                        <option value="<?php echo $row_class['id'] ?>" <?php if ($row_class['id'] == $get_bus_course['class_id']) echo "selected" ?>><?php echo $row_class['class_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">定員</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="max" value="<?php echo $get_bus_course['max']?>" required placeholder="">
              </div>
            </div>
            <hr>

            <div class="panel panel-default">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-lg table-center" id="route-table">
                  <thead>
                    <tr>
                      <th>巡回順</th>
                      <th>乗車場所名</th>
                      <th>行き（時間）</th>
                      <th>帰り（時間）</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if (count($bus_route_list)==0)
                  {
                      ?>
                      <tr>
                          <td>
                              <input type="text" class="form-control"name="route_order[]" required placeholder="">
                          </td>
                          <td>
                              <select class="form-control" name="bus_stop_id">
                                  <option selected disabled>Choose one</option>
                                  <?php
                                  foreach ($bus_stop_list as $row_stop) {
                                      ?>
                                      <option value="<?php echo $row_stop['id'] ?>"><?php echo $row_stop['bus_stop_name'] ?></option>
                                      <?php
                                  }
                                  ?>
                              </select>
                          </td>
                          <td>
                              <input type="asia-time" class="form-control" name="go_time" placeholder="00:00" required>
                          </td>
                          <td>
                              <input type="asia-time" class="form-control" name="ret_time" placeholder="00:00" required>
                          </td>
                          <td>
                              <input type="button" href="" url_edit="<?php echo site_url('admin/edit-bus-routes/' . $get_bus_course['id']) ?>" class="btn btn-default btn-block btn-sm btnDelete" value="削除">
                          </td>
                      </tr>
                      <?php
                  }
                  else if (count($bus_route_list) >0) {
                      ?>
                      <?php
                      foreach ($bus_route_list as $row_route) {
                          ?>
                          <tr>
                              <td>
                                  <input type="text" class="form-control" name="route_order[]"
                                         value="<?php echo $row_route['route_order'] ?>" required placeholder="">
                              </td>
                              <td>
                                  <select class="form-control" name="bus_stop_id">
                                      <?php
                                      foreach ($bus_stop_list as $row_stop) {
                                          ?>
                                          <option value="<?php echo $row_stop['id'] ?>" <?php if ($row_stop['id'] == $row_route['bus_stop_id']) echo "selected" ?>><?php echo $row_stop['bus_stop_name'] ?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                              </td>
                              <?php
                              // go_time
                              $duration = $row_route['go_time'];
                              $hours = floor($duration / 60);
                              $mins = $duration % 60;
                              $go_time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                              // ret_time
                              $duration = $row_route['ret_time'];
                              $hours = floor($duration / 60);
                              $mins = $duration % 60;
                              $ret_time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                              ?>
                              <td>
                                  <input type="asia-time" class="form-control" name="go_time"
                                         value="<?php echo $go_time ?>" placeholder="00:00" required>
                              </td>
                              <td>
                                  <input type="asia-time" class="form-control" name="ret_time"
                                         value="<?php echo $ret_time ?>" placeholder="00:00" required>
                              </td>
                              <td>
                                  <input type="button"
                                         href="<?php echo site_url('admin/bus_route/delete_bus_route/' . $row_route['id']) ?>"
                                         url_edit="<?php echo site_url('admin/bus_route/edit/' . $get_bus_course['id']) ?>"
                                         class="btn btn-default btn-block btn-sm btnDelete" value="削除">
                              </td>
                          </tr>
                          <?php
                      }
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="block-15 text-center row">
              <div class="col-sm-8 col-sm-offset-2">
                <a class="btn btn-info btn-block" id="insert-more">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  <span>乗車場所を追加</span>
                </a>
              </div>
            </div>
        </div>
      </div>
      <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="<?php echo site_url('admin/bus_route')?>">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <button class="btn btn-success btn-block" href="#0">
              <span>更新</span>
            </button>
          </p>
        </div>
          </form>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
