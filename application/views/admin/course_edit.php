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
        <span>練習コース編集</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal" id="course_form" method="post">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コースコード</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="course_code" value="<?php echo $get_course['course_code']?>" required placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">練習コース名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php echo $get_course['course_name']?>" required placeholder="">
              </div>
            </div>

              <?php

              ?>
            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">会費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
<!--                <input type="text" class="form-control"  placeholder="">-->
                  <select name="cost_item_id" class="form-control" id="cost_item_id">
                      <?php
                        foreach ($item_list as $row_item)
                        {
                            ?>
                            <option value="<?php echo $row_item['id']?>" <?php if ($get_course['cost_item_id']==$row_item['id']) echo "selected" ?>><?php echo $row_item['item_code']?></option>
                      <?php
                        }
                      ?>
                  </select>
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span id="cost_item"><?php
                    foreach ($item_list as $row_item)
                    {
                       if ($get_course['cost_item_id']==$row_item['id'])
                       {
                           echo $row_item['sell_price'].' 円';
                       }
                    }
                    ?></span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">休会費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
<!--                <input type="text" class="form-control" placeholder="">-->
                  <select name="rest_item_id" class="form-control" id="rest_item_id">
                      <?php
                      foreach ($item_list as $row_item)
                      {
                          ?>
                          <option value="<?php echo $row_item['id']?>" <?php if ($get_course['rest_item_id']==$row_item['id']) echo "selected" ?>><?php echo $row_item['item_code']?></option>
                          <?php
                      }
                      ?>
                  </select>
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span id="rest_item">
                    <?php
                    foreach ($item_list as $row_item)
                    {
                        if ($get_course['rest_item_id']==$row_item['id'])
                        {
                            echo $row_item['sell_price'].' 円';
                        }
                    }
                    ?>
                </span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">バス管理費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
<!--                <input type="text" class="form-control" placeholder="">-->
                  <select name="bus_item_id" class="form-control" id="bus_item_id">
                      <?php
                      foreach ($item_list as $row_item)
                      {
                          ?>
                          <option value="<?php echo $row_item['id']?>" <?php if ($get_course['bus_item_id']==$row_item['id']) echo "selected" ?>><?php echo $row_item['item_code']?></option>
                          <?php
                      }
                      ?>
                  </select>
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span id="bus_item">
                      <?php
                      foreach ($item_list as $row_item)
                      {
                          if ($get_course['bus_item_id']==$row_item['id'])
                          {
                              echo $row_item['sell_price'].' 円';
                          }
                      }
                      ?>
                </span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">記号</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="short_course_name" value="<?php echo $get_course['short_course_name']?>" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">回数</label>
              <div class="col-sm-10">
                <div class="form-inline">
                  <label class="radio-inline">
                    <input type="radio" name="number" value="<?php echo DATA_ON?>" <?php if ($get_course['practice_type']==DATA_ON) echo "checked"?>> 週
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="number" value="<?php echo DATA_OFF?>" <?php if ($get_course['practice_type']==DATA_OFF) echo "checked"?>> 月
                  </label>
                  <select class="form-control mr-1 ml-1" name="number_practice">
                    <option value="<?php echo ONE?>" <?php if ($get_course['practice_max']==ONE) echo 'selected'?>><?php echo ONE?></option>
                    <option value="<?php echo TWO?>" <?php if ($get_course['practice_max']==TWO) echo 'selected'?>><?php echo TWO?></option>
                    <option value="<?php echo THREE?>"<?php if ($get_course['practice_max']==THREE) echo 'selected'?>><?php echo THREE?></option>
                    <option value="<?php echo FOUR?>" <?php if ($get_course['practice_max']==FOUR) echo 'selected'?>><?php echo FOUR?></option>
                    <option value="<?php echo FIVE?>" <?php if ($get_course['practice_max']==FIVE) echo 'selected'?>><?php echo FIVE?></option>
                    <option value="<?php echo SIX?>" <?php if ($get_course['practice_max']==SIX) echo 'selected'?>><?php echo SIX?></option>
                    <option value="<?php echo SEVEN?>" <?php if ($get_course['practice_max']==SEVEN) echo 'selected'?>><?php echo SEVEN?></option>
                    <option value="<?php echo EIGHT?>" <?php if ($get_course['practice_max']==EIGHT) echo 'selected'?>><?php echo EIGHT?></option>
                  </select>
                  <label class="radio-inline">
                    <input type="radio" name="free_practice" value="<?php echo DATA_OFF ?>" <?php if ($get_course['practice_max']==DATA_OFF) echo "checked"?> ?>> フリー
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">振替機能</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="transfer" value="<?php echo DATA_ON?>" <?php if ($get_course['change_flg']==DATA_ON) echo "checked"?>> あり
                </label>
                <label class="radio-inline">
                  <input type="radio" name="transfer" value="<?php echo DATA_OFF?>" <?php if ($get_course['change_flg']==DATA_OFF) echo "checked"?>> なし
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コース種別</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="course-type" value="<?php echo DATA_OFF?>" <?php if ($get_course['type']==DATA_OFF) echo "checked"?>> 通常
                </label>
                <label class="radio-inline">
                  <input type="radio" name="course-type" value="<?php echo DATA_ON?>" <?php if ($get_course['type']==DATA_ON) echo "checked"?>> 短期
                </label>
              </div>
            </div>

            <hr>
              <?php
              $config= $this->configVar;
              $get_start_day=explode('-',$get_course['start_date']);
              $year_curent=date("Y");
              $year[]= $year_curent;
              for ($i=1;$i<=20;$i++)
              {
                  $year[]=$year_curent++;
              }
              ?>
            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">開催開始</label>
              <div class="col-xs-3">
                <select class="form-control">
                    <?php
                    foreach ($year as $row_year):
                    ?>
                  <option value="<?php echo $row_year ?>" <?php if ($row_year==$get_start_day[0]) echo "selected"?>><?php echo $row_year?>年</option>
                    <?php
                    endforeach;
                    ?>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                    <?php
                    foreach ($config['month'] as $row_month):
                        ?>
                        <option value="<?php echo $row_month?>" <?php if ($row_month==$get_start_day[1]) echo "selected"?>><?php echo $row_month?>月</option>
                    <?php
                    endforeach;
                    ?>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                    <?php
                    foreach ($config['day'] as $row_day):
                    ?>
                    <option value="<?php echo $row_day?>" <?php if ($row_day==$get_start_day[2]) echo "selected"?>><?php echo $row_day?>日</option>
                    <?php
                    endforeach;
                    ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">開催終了</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">申込開始</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">申込終了</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                <small>（年齢）</small>
              </label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
              <div class="col-xs-1 sub-label">
                <p class="text-center">〜</p>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                <small>（級）</small>
              </label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
              <div class="col-xs-1 sub-label">
                <p class="text-center">〜</p>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">参加条件
                <small>（級）</small>
              </label>
              <div class="col-sm-10">
                <div class="block-15">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができない
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">有効/無効</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 有効
                </label>
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 無効
                </label>
              </div>
            </div>
          </form>

        </div>
      </div>
      <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="#0">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <a class="btn btn-success btn-block" href="#0">
              <span>更新</span>
            </a>
          </p>
        </div>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
