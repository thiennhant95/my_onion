<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">
      <h1 class="lead-heading lead-heading-icon-change bg-light-blue h3">練習コース変更</h1>
      <div class="panel panel-dotted">
        <div class="panel-heading">練習コース変更</div>
        <div class="panel-body text-center">
          <h4 class="text-block">
            <span>練習コースの変更を申請しました。</span>
            <span>スタッフが確認・受領するまでお待ちください。</span>
            <span><a href="<?php echo base_url('/')?>">各種申請TOPへ</a></span>
          </h4>
          <hr class="hr-dashed">
          <h2 class="h3">
            <strong>送迎バスについても変更しますか？</strong>
          </h2>
          <hr class="hr_edit">
          <div class="row list-bus-route">
            <table>
                <tr>
                  <td>現在のコース：</td>
                </tr>
              <?php foreach ($data_bus_list as $key_bus => $value_bus) {?>
                  <tr>
                    <td></td>
                    <td><?php 
                        $string_day = '';
                        switch ($value_bus['week_num']) {
                          case '2':
                            $string_day = '火';
                          break;
                          case '3':
                            $string_day = '水';
                            break;
                          case '4':
                            $string_day = '木';
                            break;
                          case '5':
                            $string_day = '金';
                            break;
                          case '6':
                            $string_day = '土';
                            break;
                          case '0':
                            $string_day = '日';
                            break;
                          case '1':
                            $string_day = '月';
                            break;
                        }
                      ?>
                      <?php echo  $string_day.'('.$value_bus['class_name'].')';?>曜日
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                  
                  <?php
                    switch ($value_bus['flag_type']) {
                      case 1:?>
                      <tr>
                        <td>乗車場所 :</td>
                        <td><?php echo $value_bus['course_name'];?></td>
                        <td><?php echo '【'.$value_bus['route_order'].'】';?></td>
                        <td><?php echo $value_bus['bus_name'];?></td>
                      </tr>
                  <?php
                        break;
                      case 2:?>
                      <tr>
                        <td>降車場所 :</td>
                        <td><?php echo $value_bus['course_name'];?></td>
                        <td><?php echo '【'.$value_bus['route_order'].'】';?></td>
                        <td><?php echo $value_bus['bus_name'];?></td>
                      </tr>
                    <?php
                        break;
                      case 3: ?>
                      <tr>
                        <td>乗車場所 :</td>
                        <td><?php echo $value_bus['course_name'];?></td>
                        <td><?php echo '【'.$value_bus['route_order'].'】';?></td>
                        <td><?php echo $value_bus['bus_name'];?></td>
                      </tr>
                      <tr>
                        <td>降車場所 :</td>
                        <td><?php echo $value_bus['course_name'];?></td>
                        <td><?php echo '【'.$value_bus['route_order'].'】';?></td>
                        <td><?php echo $value_bus['bus_name'];?></td>
                      </tr>
                    <?php
                        break;
                    }
                  ?>
                <?php }
              ?>
              
            </table>
          </div>
          <p class="text-danger block-15">
            <small>続けて変更する場合、バスの利用変更についての手数料はかかりません。</small>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 content-point-center" >
          <a href="<?php echo base_url('/request/change_bus');?>" class="btn btn-success btn-lg btn-long">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>バスも変更する</span>
          </a>
        </div>
        <div class="col-md-6 content-point-center">
          <a href="<?php echo base_url('/request');?>" class="btn btn-success btn-lg btn-long">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>バスは変更しない</span>
          </a>
        </div>
      </div>
      <!-- <div class="block-30 text-center">
        <a href="<?php echo base_url('/request/change_bus');?>" class="btn btn-success btn-lg btn-long">
          <i class="fa fa-angle-double-right" aria-hidden="true"></i>
          <span>バスも変更する</span>
        </a>
      </div> -->
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
