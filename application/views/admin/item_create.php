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
            <span>品目登録</span>
        </h1>

        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-horizontal" id="item_form" method="post">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">品名コード</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="item_code" id="item_code" required placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">科目</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="subject_id" id="subject_id">
                                <?php
                                foreach ($subject_list as $row_subject):
                                    ?>
                                    <option value="<?php echo $row_subject['id']?>"><?php echo $row_subject['subject_name']?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">品名</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="item_name" name="item_name" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">売り単価</label>
                        <div class="col-sm-3">
                            <input type="text" name="sell_price" id="sell_price" class="form-control" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">仕入単価</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="buy_price" id="buy_price" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">税計算</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="tax" id="tax" value="1" checked> する
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tax" value="0"> しない
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">在庫管理</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="stock" id="manage" value="1" checked> する
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="stock" id="manage" value="0"> しない
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">在庫数</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control"name="left_num"  id="left_num" required placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">分類</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control"  name="type" id="type" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">画面表示</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="display" id="disp_flg" value="1" checked="checked"> する
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="display" id="disp_flg" value="0"> しない
                            </label>
                        </div>
                    </div>
            </div>
        </div>
        <div class="block-15 text-center row">
            <div class="col-sm-4 col-sm-offset-2">
                <p>
                    <a class="btn btn-default btn-block" id="return" href="<?php echo site_url('admin/item')?>">
                        <span>戻る</span>
                    </a>
                </p>
            </div>
            <div class="col-sm-4">
                <p>
                    <button id="create" class="btn btn-success btn-block" href="<?php echo site_url('admin/item/create')?>" disabled="disabled" >
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
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid}
</style>