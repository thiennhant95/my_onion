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
        <span>マスター設定</span>
        <a href="<?php echo site_url('admin/grade/export')?>" class="btn btn-default btn-sm pull-right">
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
                <li role="presentation">
                    <a href="<?php echo site_url('admin/bus_route')?>">バスコース</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/item')?>">品目</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/subject')?>">科目</a>
                </li>
                <li role="presentation" class="active">
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
        <div style="display:none;" id="alert-delete" class='alert alert-success'>正常に削除されました。 </div>
        </p>

      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-lg table-center">
            <thead>
              <tr>
                <th>級コード</th>
                <th>級名</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($grade_list as $row):
            ?>
              <tr>
                <td><?php echo $row['grade_code']?></td>
                <td><?php echo $row['grade_name']?></td>
                <td>
                  <div class="row">
                    <div class="col-xs-6">
                      <a href="<?php echo site_url('admin/grade/edit/'.$row['id'])?>" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="<?php echo site_url('admin/grade/delete/'.$row['id'])?>" class="btn btn-default btn-block btn-sm delete-user-row-with-ajax-button" data-type="級">削除</a>
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
          <a class="btn btn-info btn-block" href="<?php echo site_url('admin/grade/create')?>">
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
