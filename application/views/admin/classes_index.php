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
        <a href="<?php echo site_url('admin/classes/export')?>" class="btn btn-default btn-sm pull-right">
          <strong>CSV出力</strong>
        </a>
      </h1>

        <nav class="master-nav">
            <ul class="nav nav-pills" role="group">
                <li role="presentation">
                    <a href="<?php echo site_url('admin/course')?>">練習コース</a>
                </li>
                <li role="presentation" class="active">
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
                <th>クラスレコード</th>
                <th>クラス名</th>
                <th>級管理</th>
                <th>授業曜日</th>
                <th>定員</th>
                <th>バス利用</th>
                <th>有効・無効</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
            <?php
            foreach ($class_list as $row_class):
                        ?>
                        <tr <?php if($row_class['invalid_flg']==DATA_ON) echo 'class="disabled"' ?>>
                            <td><?php echo $row_class['class_code']?></td>
                            <td><?php echo $row_class['class_name'] ?></td>
                            <td><?php if ($row_class['grade_manage_flg']==DATA_ON)
                                {
                                    echo "する";
                                }
                                else
                                    echo "しない​";
                                ?></td>
                            <td><?php
                                $row_class['week']=explode(',',$row_class['week']);
                                if (in_array(SUNDAY,$row_class['week']))
                                    $day[]="日";
                                if (in_array(MONDAY,$row_class['week']))
                                    $day[]= "月";
                                if (in_array(TUESDAY,$row_class['week']))
                                    $day[]= "火";
                                if (in_array(WEDNESDAY,$row_class['week']))
                                    $day[]="水";
                                if (in_array(THURSDAY,$row_class['week']))
                                    $day[]= "木";
                                if (in_array(FRIDAY,$row_class['week']))
                                    $day[]= "金";
                                if (in_array(SATURDAY,$row_class['week']))
                                    $day[]="土";
                                $day_implode=implode('、',$day);
                                echo $day_implode;
                                unset($day);
                                ?></td>
                            <td><?php echo $row_class['max_count']?></td>
                            <td><?php if ($row_class['use_bus_flg']==DATA_ON)
                                {
                                    echo "あり";
                                }
                                else
                                    echo "なし";
                                ?></td>
                            <td><?php if($row_class['invalid_flg']==DATA_ON)
                                {
                                echo "無効";
                                }
                                else
                                {
                                echo "";
                                }
                                ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/classes/edit/'.$row_class['id'])?>" class="btn btn-outline-blue btn-block btn-sm">編集</a>
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
          <a class="btn btn-info btn-block" href="<?php echo site_url('admin/classes/create') ?>">
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
