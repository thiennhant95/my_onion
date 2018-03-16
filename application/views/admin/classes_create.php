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
            <span>クラス編集</span>
        </h1>

        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-horizontal"id="class_form" method="post">
                    <input type="hidden" class="form-control" name="class_id" id="class_id" value="0">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">コース記号</label>
                        <div class="col-sm-5">
                            <select id="short_course_name" class="form-control" name="short_course_name" required>
                                <?php
                                foreach ($course_list as $row_course):
                                    ?>
                                    <option value="<?php echo $row_course['id']?>"><?php echo $row_course['short_course_name'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">クラスコード</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="base_class_sign" id="base_class_sign" required>
                               <option value="M">M</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <?php
//                        $short_course_name=reset($course_list);
                        foreach ($course_list as $k=>$v)
                        {
                            $short_course_name=$v['short_course_name'];
                            break;
                        }
                        $base_class_sign="M";
                        $class_code=$short_course_name.$base_class_sign;
                        ?>
                        <div class="col-sm-5">
                            <input type="text" onkeydown="return ValidateInput(this);" id="class_code" class="form-control class_code" name="class_code" value="<?php echo $class_code?>" required placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">クラス名</label>
                        <div class="col-sm-10">

                            <input type="text" class="form-control" name="class_name" required placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">級管理</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="level-manage" checked value=<?php echo DATA_ON?>> する
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="level-manage" value="<?php echo DATA_OFF?>"> しない
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">バス利用</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="use-bus" checked value="<?php echo DATA_ON?>"> あり
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="use-bus" value="<?php echo  DATA_OFF?>"> なし
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">授業曜日</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo MONDAY?>"> 月
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo TUESDAY?>"> 火
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo WEDNESDAY?>"> 水
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo THURSDAY?>"> 木
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo FRIDAY?>"> 金
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo SATURDAY?>"> 土
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="week[]" id="week" value="<?php echo SUNDAY?>"> 日
                            </label>
                            <label id="week[]-error"class="label label-danger" for="week[]" style=" display: none">一個以上のチェックボックスにチェックを入れてください</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">定員</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" id="max_count" name="max_count" required placeholder="">
                            <strong style="display: none" id="amount"></strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">有効/無効</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="enable" checked value=<?php echo DATA_OFF?>> 有効
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="enable" value=<?php echo DATA_ON?>> 無効
                            </label>
                        </div>
                    </div>
            </div>
        </div>
        <div class="block-15 text-center row">
            <div class="col-sm-4 col-sm-offset-2">
                <p>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('admin/classes')?>">
                        <span>戻る</span>
                    </a>
                </p>
            </div>
            <div class="col-sm-4">
                <p>
                    <button class="btn btn-success btn-block" id="create">
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
    .alert-danger {border-radius: 0px ;border: 0px solid}
</style>