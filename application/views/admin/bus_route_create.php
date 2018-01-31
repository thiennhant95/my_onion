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
                            <input type="text" class="form-control" id="bus_course_code" name="bus_course_code" required placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">バスコース名</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="bus_course_name" name="bus_course_name" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">クラス</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="class_id" id="class_id">
                                <?php
                                foreach ($class_list as $row_class) {
                                    ?>
                                    <option value="<?php echo $row_class['id'] ?>"><?php echo $row_class['class_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">定員</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="max" name="max" required placeholder="">
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
                                    <tr>
                                        <td>
                                            <input type="text" id="route_oder" class="form-control route-order"name="route_order[]" required placeholder="">
                                        </td>
                                        <td>
                                            <select class="form-control bus_stop_id" name="bus_stop_id[]" required>
<!--                                                <option selected disabled>Choose one</option>-->
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
                                            <input type="asia-time" id="go_time" class="form-control go-time" value="00:00" name="go_time[]" placeholder="00:00" required>
                                        </td>
                                        <td>
                                            <input type="asia-time" id="ret_time" class="form-control ret-time" value="00:00" name="ret_time[]" placeholder="00:00" required>
                                        </td>
                                        <td>
                                            <input type="button" href="" url_edit="<?php echo site_url('admin/bus_route/create') ?>" class="btn btn-default btn-block btn-sm btnDelete" value="削除">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="block-15 text-center row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <a class="btn btn-info btn-block insert-more" id="insert-more" url_edit="<?php echo site_url('admin/bus_route/create') ?>">
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
                    <button id="create" data_id="" class="btn btn-success btn-block">
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