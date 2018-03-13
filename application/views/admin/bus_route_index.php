<!DOCTYPE html>
<html lang="ja" id="bus_course_index">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading h3">
        <span>マスター設定</span>
        <a href="<?php echo site_url('admin/bus_route/export')?>" class="btn btn-default btn-sm pull-right">
          <strong>CSV出力</strong>
        </a>
      </h1>

        <nav class="master-nav">
            <ul class="nav nav-pills" role="group">
                <li role="presentation">
                    <a href="<?php echo site_url('admin/course')?>">練習コース</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/classes')?>">クラス</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/bus_stop')?>">バス停</a>
                </li>
                <li role="presentation" class="active">
                    <a href="<?php echo site_url('admin/bus_route')?>">バスコース</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/item')?>">品目</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/subject')?>">科目</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/grade')?>">級</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/style')?>">種目</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/distance')?>">距離</a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#">銀行・支店</a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#">ゆうちょ銀行</a>
                </li>
            </ul>
        </nav>

      <hr>
        <p class="box-msg">
            <?php
            if($this->session->flashdata('message')){
                echo $this->session->flashdata('message');
            }
            ?>
        </p>
        <p class="box-msg">
        <div style="display:none;" id="alert-delete" class='alert alert-success'>科目を削除しました。 </div>
        </p>
        <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-lg table-center" id="mytable">

            <thead>
              <tr>
                <th>バスコースコード</th>
                <th>バスコース名</th>
                <th>クラス</th>
                <th>定員</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
            <?php
            foreach ($bus_course_list as $row) :
                ?>
                <tr>
                    <td class=""><?php echo $row['bus_course_code'] ?></td>
                    <td class=""><?php echo $row['bus_course_name'] ?></td>
                    <td class=""><?php echo $row['class_name'] ?></td>
                    <td class=""><?php echo $row['max'] ?></td>
                    <td>
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="<?php echo site_url('admin/bus_route/edit/'.$row['id'])?>" class="btn btn-outline-blue btn-block btn-sm" data_id="<?php echo $row['id']?>">編集</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="<?php echo site_url('admin/bus_route/delete/'.$row['id'])?>" class="btn btn-default btn-block btn-sm delete-user-row-with-ajax-button" data-type="マスター設定​">削除</a>
                            </div>
                            <div class="col-xs-4">
                                <a id="<?php echo $row['id']?>" href="<?php echo site_url('admin/bus_route/copy/'.$row['id'])?>" class="btn btn-default btn-block btn-sm copy">コピー作成</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
            </tbody>
          </table>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <?php echo $pagination; ?>
            </div>
        </div>
      <div class="block-15 text-center row">
        <div class="col-sm-8 col-sm-offset-2">
          <a class="btn btn-info btn-block" href="<?php echo site_url('admin/bus_route/create')?>">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span>新規登録</span>
          </a>
        </div>
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
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid}
</style>