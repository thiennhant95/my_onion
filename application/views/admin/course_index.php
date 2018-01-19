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
              <tr>
                <td>1041</td>
                <td>ベビー週１</td>
                <td>7020</td>
                <td>3240</td>
                <td>864</td>
                <td>B</td>
                <td>週1</td>
                <td>◯</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                </td>
              </tr>
              <tr>
                <td>1042</td>
                <td>ベビー週４</td>
                <td>8640</td>
                <td>3240</td>
                <td>864</td>
                <td>B</td>
                <td>週4</td>
                <td>◯</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                </td>
              </tr>
              <tr class="disabled">
                <td>1240</td>
                <td>幼稚園児週１</td>
                <td>7020</td>
                <td>3240</td>
                <td>864</td>
                <td>Y</td>
                <td>週1</td>
                <td>◯</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>無効</td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm disabled">編集</a>
                </td>
              </tr>
              <tr>
                <td>1241</td>
                <td>2017年春・はじめてのスイミングレッスン2日間</td>
                <td>3780</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>◯</td>
                <td>2017/3/28～2017/3/29</td>
                <td>25</td>
                <td>2017/2/11</td>
                <td>2017/3/27</td>
                <td>
                  【年齢】年中～小6
                  <br>【級】　制限無し
                  <br>【泳力】制限無し
                </td>
                <td></td>
                <td>
                  <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
                </td>
              </tr>
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
                       foreach ( (array)$join_condition as $row_condition)
                       {
                            echo $row_condition.'<br>';
                       }
                          ?>
                      </td>
                      <td><?php  if ($row['invalid_flg']==DATA_ON) echo "無効"?></td>
                      <td>
                          <a href="#0" class="btn btn-outline-blue btn-block btn-sm">編集</a>
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
          <a class="btn btn-info btn-block" href="#0">
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
