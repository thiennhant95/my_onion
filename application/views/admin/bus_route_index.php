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
        <a href="#0" class="btn btn-default btn-sm pull-right">
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
                    <a href="<?php echo site_url('admin/item')?>">品名</a>
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

      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-lg table-center">

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
            foreach ($class_list as $row_class) :
            if ($row['class_id'] == $row_class['id']) {
                ?>
                <tr>
                    <td class=""><?php echo $row['bus_course_code'] ?></td>
                    <td class=""><?php echo $row['bus_course_name'] ?></td>
                    <td class=""><?php echo $row_class['class_name'] ?></td>
                    <td class=""><?php echo $row['max'] ?></td>
                    <td>
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="<?php echo site_url('admin/bus_route/edit/'.$row['id'])?>" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="<?php echo site_url('admin/bus_route/delete/'.$row['id'])?>" class="btn btn-default btn-block btn-sm delete-user-row-with-ajax-button" data-type="Bus Course">削除</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="<?php echo site_url('admin/bus_route')?>" class="btn btn-default btn-block btn-sm">コピー作成</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            endforeach;
            endforeach;
            ?>
            </tbody>
          </table>
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
