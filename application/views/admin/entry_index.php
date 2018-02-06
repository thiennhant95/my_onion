<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <div class="panel panel-dotted">
        <div class="panel-heading">
          <span class="text-blue-green">新規ネット申し込み（未処理）一覧</span>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-lg table-blue-green table-outline mb-0">
              <thead>
                <th>会員番号</th>
                <th>申込日時</th>
                <th>氏名</th>
                <th>申込区分</th>
                <th>コース名</th>
                <th></th>
              </thead>
              <tbody>
              <?php if(!empty($result)){ ?>
                <?php foreach ($result as $key => $value) {?>
                  <tr>
                    <td><?php echo  $value['id']?></td>
                    <td><?php echo $value['date_register']?></td>
                    <td><?php echo $value['tag_name']?></td>
                    <td><?php echo $value['tag_type_course']?></td>
                    <td><?php echo $value['course_name']?></td>
                    <td>
                      <a href="<?php echo base_url('admin/entry/edit/'.$value['id'])?>" class="btn btn-success">
                        <span>処理</span>
                      </a>
                    </td>
                  </tr>
                <?php }?>
              <?php }else{?>
                <tr>
                  <td colspan = 6 center><center><?php echo 'データなし';?></center></td>
                </tr>
              <?php }?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="block-15 text-center">
        <nav>
          <ul class="pagination pagination-main">
            <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
          </ul>
        </nav>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
