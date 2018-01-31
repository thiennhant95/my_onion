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
                <li role="presentation" class="active">
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
                <li role="presentation">
                    <a href="<?php echo site_url('admin/grade')?>">級</a>
                </li>
                <li role="presentation">
                    <a href="<?php echo site_url('admin/style')?>">種目</a>
                </li>
                <li role="presentation" >
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
                <th>コースコード</th>
                <th>練習コース名</th>
                <th>会費</th>
                <th>休会費</th>
                <th>バス管理費</th>
                <th>記号</th>
                <th>回数</th>
                <th>振替</th>
                <th>短期</th>
                <th>開催日</th>
                <th>定員</th>
                <th>申込開始</th>
                <th>申込終了</th>
                <th>参加条件</th>
                <th>有効・無効</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($course_list as $row):
              ?>
                  <tr <?php if($row['invalid_flg']==DATA_ON) echo 'class="disabled"' ?>>
                      <td><?php echo $row['course_code']?></td>
                      <td><?php echo $row['course_name']?></td>
                      <td><?php
                          foreach ($item_list as $row_item)
                          {
                              if ($row_item['id']==$row['cost_item_id'])
                              {
                                  echo $row_item['sell_price'];
                              }
                          }
                          ?></td>
                      <td><?php
                          foreach ($item_list as $row_item)
                          {
                              if ($row['rest_item_id']==$row_item['id'])
                              {
                                  echo $row_item['sell_price'];
                              }
                          }
                          ?></td>
                      <td><?php
                          foreach ($item_list as $row_item)
                          {
                              if ($row_item['id']==$row['bus_item_id'])
                              {
                                  echo $row_item['sell_price'];
                              }
                          }
                          ?></td>
                      <td><?php echo $row['short_course_name']?></td>
                      <td><?php echo $row['practice_max']?></td>
                      <td><?php if ($row['change_flg']==DATA_ON)
                          {
                             echo "◯";
                          }
                          else
                          {
                              echo "";
                          }?>
                      </td>
                      <td><?php if ($row['type']==DATA_ON )
                          {
                              echo "◯";
                          }?></td>
                      <td><?php echo date("Y/m/d", strtotime($row['start_date'])).'～'.date("Y/m/d", strtotime($row['end_date']))?></td>
                      <td><?php echo $row['max_count']?></td>
                      <td><?php echo date("Y/m/d", strtotime($row['regist_start_date']))?></td>
                      <td>
                          <?php echo date("Y/m/d", strtotime($row['regist_end_date']))?>
                      </td>
                      <td><?php
                          $join_condition=json_decode($row['join_condition'],true);
                       foreach ( (array)$join_condition as $key_conditon=> $row_condition)
                       {
                           if (!is_array($row_condition))
                           {
                              if ($key_conditon=='age') {
                                  echo "<b>" . '「年齢」' . "</b>" . $row_condition . '<br>';
                              }
                              if ($key_conditon=='grade')
                              {
                                  if (strpos($row_condition,'~制限無し'))
                                  {
                                      echo "<b>" . '「級」' . "</b> 制限無し<br>";
                                  }
                                  else {
                                      echo "<b>" . '「級」' . "</b>" . $row_condition . '<br>';
                                  }
                              }
                           }
                           if (is_array($row_condition))
                           {
                               echo "<b>".'「泳力」'."</b>";
                               if ($row_condition['face_into_water']==1)
                               {
                                   $row_condition['face_into_water']="水に顔をつけることができない";
                               }
                               if ($row_condition['not_face_into_water']==1)
                               {
                                   $row_condition['not_face_into_water']="水に顔をつけることができる";
                               }
                               if ($row_condition['dive']==1)
                               {
                                   $row_condition['dive']="潜れる";
                               }
                               if ($row_condition['float']==1)
                               {
                                   $row_condition['float']="浮かべる";
                               }
                               if ($row_condition['free_lesson']==1)
                               {
                                   $row_condition['free_lesson']="短期水泳教室に参加をしたことがある";
                               }
                               if ($row_condition['short_lesson']==1)
                               {
                                   $row_condition['short_lesson']="無料体験に参加したことがある";
                               }
                               foreach ($row_condition as $key=>$row_key):
                                   if (!is_array($row_key))
                                   {
                                       if ($row_key!=null) {
                                           echo $row_key . '<br>';
                                       }
                                   }
                                   if (is_array($row_key))
                                   {
                                       if ($key=='style') {
                                           if (count($key) > 0) {
                                               echo "<br>" . "スイミングスタイル：";
                                               foreach ($row_key as $key_swin => $row_swin):
                                                   if ($row_swin != 0) {
                                                       if ($key_swin == 'flutter_kick') {
                                                           $key_swin = "<br>" . "バタ足 ";
                                                       }
                                                       if ($key_swin == 'board_kick') {
                                                           $key_swin = "<br>" . "板キック  ";
                                                       }
                                                       if ($key_swin == 'backstroke') {
                                                           $key_swin = "<br>" . "背泳ぎ  ";
                                                       }
                                                       if ($key_swin == 'crawl') {
                                                           $key_swin = "<br>" . "クロール";
                                                       }
                                                       if ($key_swin == 'breast_stroke') {
                                                           $key_swin = "<br>" . "平泳ぎ ";
                                                       }
                                                       if ($key_swin == 'butterfly') {
                                                           $key_swin = "<br>" . "バタフライ ";
                                                       }
                                                       echo $key_swin . '：' . $row_swin.'m';
                                                   }
                                               endforeach;
                                           }
                                       }
                                       else
                                       {
                                           if ($row_key['status']!='0')
                                           echo "経験" . '：'.'はい';
                                       }
                                   }
                               endforeach;
                           }
                       }
                        ?>
                      </td>
                      <td><?php  if ($row['invalid_flg']==DATA_ON) echo "無効"?></td>
                      <td>
                          <a href="<?php echo site_url('admin/course/edit/'.$row['id'])?>" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                      </td>
                  </tr>
              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="block-15 text-center row">
        <div class="col-sm-8 col-sm-offset-2">
          <a class="btn btn-info btn-block" href="<?php echo site_url('admin/course/create')?>">
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
