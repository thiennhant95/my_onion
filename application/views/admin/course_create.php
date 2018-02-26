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
                            <input type="text" class="form-control" name="course_code" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">練習コース名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="course_name" required placeholder="">
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
                            <select name="cost_item_id" class="form-control" id="cost_item_id" required>
                                <option selected disabled>選択する</option>
                                <?php
                                foreach ($item_list as $row_item)
                                {
                                    ?>
                                    <option value="<?php echo $row_item['id']?>"><?php echo $row_item['item_name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-2 sub-label">
                <span id="cost_item">

                </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">休会費</label>
                        <div class="col-xs-4 col-sm-2 sub-label">
                            <span>品目コード</span>
                        </div>
                        <div class="col-xs-4">
                            <!--                <input type="text" class="form-control" placeholder="">-->
                            <select name="rest_item_id" class="form-control" id="rest_item_id" required>
                                <option selected disabled>選択する</option>
                                <?php
                                foreach ($item_list as $row_item)
                                {
                                    ?>
                                    <option value="<?php echo $row_item['id']?>"><?php echo $row_item['item_name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-2 sub-label">
                <span id="rest_item">
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
                            <select name="bus_item_id" class="form-control" id="bus_item_id" required>
                                <option selected disabled>選択する</option>
                                <?php
                                foreach ($item_list as $row_item)
                                {
                                    ?>
                                    <option value="<?php echo $row_item['id']?>"><?php echo $row_item['item_name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-2 sub-label">
                <span id="bus_item">
                </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">記号</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="short_course_name" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">回数</label>
                        <div class="col-sm-10">
                            <div class="form-inline">
                                <label class="radio-inline">
                                    <input type="radio" name="number" value="<?php echo DATA_ON?>" checked> 週
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="number" value="<?php echo DATA_OFF?>"> 月
                                </label>
                                <select class="form-control mr-1 ml-1" name="number_practice_select" id="number_practice_select">
                                    <option value="0" disabled>選択する</option>
                                    <option value="<?php echo ONE?>"><?php echo ONE?></option>
                                    <option value="<?php echo TWO?>"><?php echo TWO?></option>
                                    <option value="<?php echo THREE?>"><?php echo THREE?></option>
                                    <option value="<?php echo FOUR?>"><?php echo FOUR?></option>
                                    <option value="<?php echo FIVE?>"><?php echo FIVE?></option>
                                    <option value="<?php echo SIX?>"><?php echo SIX?></option>
                                    <option value="<?php echo SEVEN?>"><?php echo SEVEN?></option>
                                    <option value="<?php echo EIGHT?>"><?php echo EIGHT?></option>
                                </select>
                                <label class="radio-inline">
                                    <input type="radio" id="free_practice_radio" onclick="test(this)" name="free_practice_radio" value="<?php echo DATA_OFF ?>"> フリー
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">振替機能</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="transfer" value="<?php echo DATA_ON?>" checked> あり
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="transfer" value="<?php echo DATA_OFF?>"> なし
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">コース種別</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="course-type" id="course_type" value="<?php echo DATA_OFF?>" checked> 通常
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="course-type" value="<?php echo DATA_ON?>"> 短期
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="course-type" value="<?php echo THREE?>">無料
                            </label>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $config= $this->configVar;
                    $year_curent=date("Y");
                    $year[]= $year_curent-1;
                    for ($i=0;$i<=20;$i++)
                    {
                        $year[]=$year_curent++;
                    }
                    ?>
                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">開催開始</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="start[]" id="year_start">
                                <?php
                                foreach ($year as $row_year):
                                    ?>
                                    <option value="<?php echo $row_year ?>" <?php if ($row_year==date('Y')) echo "selected"?>><?php echo $row_year?>年</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="start[]" id="month_start">
                                <?php
                                foreach ($config['month'] as $row_month):
                                    ?>
                                    <option value="<?php echo $row_month?>" <?php if ($row_month==date('m')) echo "selected"?>><?php echo $row_month?>月</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="start[]" id="day_start">
                                <?php
                                foreach ($config['day'] as $row_day):
                                    ?>
                                    <option value="<?php echo $row_day?>" <?php if ($row_day==date('d')) echo "selected"?>><?php echo $row_day?>日</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">開催終了</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="end[0]" id="year_end">
                                <?php
                                foreach ($year as $row_year):
                                    ?>
                                    <option value="<?php echo $row_year ?>" <?php if ($row_year==date('Y')) echo "selected"?>><?php echo $row_year?>年</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="end[1]" id="month_end">
                                <?php
                                foreach ($config['month'] as $row_month):
                                    ?>
                                    <option value="<?php echo $row_month?>" <?php if ($row_month==date('m')) echo "selected"?>><?php echo $row_month?>月</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="end[2]" id="day_end">
                                <?php
                                foreach ($config['day'] as $row_day):
                                    ?>
                                    <option value="<?php echo $row_day?>" <?php if ($row_day==date('d')) echo "selected"?>><?php echo $row_day?>日</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">定員​</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="max_count"required placeholder="">
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">申込開始</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="start_regist[0]" id="year_regist_start">
                                <?php
                                foreach ($year as $row_year):
                                    ?>
                                    <option value="<?php echo $row_year ?>" <?php if ($row_year==date('Y')) echo "selected"?>><?php echo $row_year?>年</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="start_regist[1]" id="month_regist_start">
                                <?php
                                foreach ($config['month'] as $row_month):
                                    ?>
                                    <option value="<?php echo $row_month?>" <?php if ($row_month==date('m')) echo "selected"?>><?php echo $row_month?>月</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="start_regist[2]" id="day_regist_start">
                                <?php
                                foreach ($config['day'] as $row_day):
                                    ?>
                                    <option value="<?php echo $row_day?>"  <?php if ($row_day==date('d')) echo "selected"?>><?php echo $row_day?>日</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">申込終了</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="end_regist[0]" id="year_regist_end">
                                <?php
                                foreach ($year as $row_year):
                                    ?>
                                    <option value="<?php echo $row_year ?>" <?php if ($row_year==date('Y')) echo "selected"?>><?php echo $row_year?>年</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="end_regist[1]" id="month_regist_end">
                                <?php
                                foreach ($config['month'] as $row_month):
                                    ?>
                                    <option value="<?php echo $row_month?>" <?php if ($row_month==date('m')) echo "selected"?>><?php echo $row_month?>月</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="end_regist[2]" id="day_regist_end">
                                <?php
                                foreach ($config['day'] as $row_day):
                                    ?>
                                    <option value="<?php echo $row_day?>" <?php if ($row_day==date('d')) echo "selected"?>><?php echo $row_day?>日</option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <?php
                    $age[]=3;
                    for ($i=4;$i<=100;$i++)
                    {
                        $age[]=$i;
                    }
                    ?>
                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                            <small>（年齢）</small>
                        </label>
                        <div class="col-xs-3">
                            <select class="form-control" name="condition_age[]" id="condition_age_from">
                                <?php
                                $age_condition=explode('~',$join_condition['age']);
                                foreach ($age as $row_age):
                                    ?>
                                    <option value="<?php echo $row_age?>"><?php echo $row_age?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1 sub-label">
                            <p class="text-center">〜</p>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="condition_age[]" id="condition_age_to">
                                <option value="制限無し​">制限無し​</option>
                                <?php
                                foreach ($age as $row_age):
                                    ?>
                                    <option value="<?php echo $row_age?>"><?php echo $row_age?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                            <small>（級）</small>
                        </label>
                        <div class="col-xs-3">
                            <select class="form-control" name="condition_grade[]" id="condition_grade_from" >
                                <option value="制限無し">制限無し​</option>
                                <?php
                                foreach ($config['school_grades'] as $row_grade):
                                    ?>
                                    <option value="<?php echo $row_grade ?>"><?php echo $row_grade?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-1 sub-label">
                            <p class="text-center">〜</p>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="condition_grade[]" id="condition_grade_to">
                                <option value="制限無し">制限無し​</option>
                                <?php
                                foreach ($config['school_grades'] as $row_grade1):
                                    ?>
                                    <option value="<?php echo $row_grade1 ?>"><?php echo $row_grade1?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">参加条件
                            <small>（泳力）</small>
                        </label>
                        <div class="col-sm-10">
                            <div class="block-15">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[face_into_water]" value="<?php echo DATA_ON?>"> 水に顔をつけることができない
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[not_face_into_water]" value="<?php echo  DATA_ON?>"> 水に顔をつけることができる
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[dive]" value="<?php echo DATA_ON?>"> 潜れる
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[float]" value="<?php echo DATA_ON?>"> 浮かべる
                                    </label>
                                </div>
                                <div class="row block-15">
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">バタ足</label>
                                        <select class="form-control" name="swimming_ability[style][flutter_kick]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name']?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">板キック</label>
                                        <select class="form-control" name="swimming_ability[style][board_kick]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name']?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">背泳ぎ</label>
                                        <select class="form-control" name="swimming_ability[style][backstroke]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name'].'m'?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">クロール</label>
                                        <select class="form-control" name="swimming_ability[style][crawl]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name']?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">平泳ぎ</label>
                                        <select class="form-control" name="swimming_ability[style][breast_stroke]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name']?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <label for="" class=" control-label">バタフライ</label>
                                        <select class="form-control" name="swimming_ability[style][butterfly]">
                                            <?php
                                            foreach ($distance_list as $row_distance):
                                                ?>
                                                <option value="<?php echo $row_distance['distance_name']?>"><?php echo $row_distance['distance_name'].'m'?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[free_lesson]" value="<?php echo DATA_ON ?>"> 無料体験に参加をしたことがある
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[short_lesson]" value="<?php echo DATA_ON?>"> 短期水泳教室に参加をしたことがある
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="swimming_ability[experience][status]" value="<?php echo DATA_ON?>"> 当クラブまたは他クラブに通っていたことがある
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
                                <input type="radio" name="enable" value="<?php echo DATA_OFF?>" checked> 有効
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="enable" value="<?php echo DATA_ON?>"> 無効
                            </label>
                        </div>
                    </div>
            </div>
        </div>
        <div class="block-15 text-center row">
            <div class="col-sm-4 col-sm-offset-2">
                <p>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('admin/course')?>">
                        <span>戻る</span>
                    </a>
                </p>
            </div>
            <div class="col-sm-4">
                <p>
                    <button id="create" class="btn btn-success btn-block">
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
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid }
</style>
