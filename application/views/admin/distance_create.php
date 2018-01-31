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
            <span>距離登録</span>
        </h1>
        <p class="box-msg">
            <?php
            if($this->session->flashdata('message')){
                echo $this->session->flashdata('message');
            }
            ?>
        </p>
        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-horizontal" action="<?php echo site_url('admin/distance/create')?>" method="post" id="distance_form">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">距離コード</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="distance_code" required placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">距離名</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="distance_name" required placeholder="">
                        </div>
                    </div>
            </div>
        </div>
        <div class="block-15 text-center row">
            <div class="col-sm-4 col-sm-offset-2">
                <p>
                    <a class="btn btn-default btn-block" href="<?php echo site_url('admin/distance')?>">
                        <span>戻る</span>
                    </a>
                </p>
            </div>
            <div class="col-sm-4">
                <p>
                    <button id="create" class="btn btn-success btn-block" href="<?php echo site_url('admin/distance/create')?>">
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
    .alert-danger {border-radius: 0px;border: 0px solid  }
</style>
