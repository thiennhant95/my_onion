<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-memo bg-green h3">各種変更申請</h1>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">新規入会時ご案内の再確認</div>
          <div class="panel-body">
            <ul class="btn-list-inline">
              <li>
                <a class="btn-icon btn-icon-bus" href="<?php echo base_url('/request/change_bus');?>">
                  <span class="btn-icon-inner" data-mh="btn-inner">バスコース変更</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-change bg-light-blue" href="<?php echo base_url('/request/change_course');?>">
                  <span class="btn-icon-inner" data-mh="btn-inner">練習コース変更</span>
                </a>
              </li>
              <li>
                <a class="btn-icon btn-icon-school bg-yellow" href="<?php echo base_url('request/event');?>">
                  <span class="btn-icon-inner" data-mh="btn-inner">イベント・短期教室参加申請</span>
                </a>
              </li>
              <!--
              <li>
                <a class="btn-icon btn-icon-mail-config bg-blue" href="#0">
                  <span class="btn-icon-inner" data-mh="btn-inner">通知メール設定</span>
                </a>
              </li>
              -->
              <li>
                <a class="btn-icon btn-icon-note bg-violet" href="<?php echo base_url('/request/change_base_info');?>">
                  <span class="btn-icon-inner" data-mh="btn-inner">基本情報変更</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">申請履歴</div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-lg table-history mb-0">
                <thead>
                  <tr>
                    <th>申請番号</th>
                    <th>申請日時</th>
                    <th>申請内容</th>
                    <th>申請状況</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if(!empty($list_request)){?>
                    <?php foreach ($list_request as $key => $value) {?>
  
                      <tr class ="<?php if($value['status'] == 1){ echo "complete ";} if($key > 9){ echo "hidden_tr";}?>">
                        <th><?php echo $value['id'];?></th>
                        <td><?php echo $value['create_date'];?></td>
                        <?php 
                          $type_name = '';
                          switch ($value['type']) {
                            case 'bus_change_once':
                              $type_name = 'バス乗降連絡';
                              break;
                            case 'bus_change_eternal':
                              $type_name = 'バスコース変更';
                              break;
                            case 'course_change':
                              $type_name = '練習コース変更';
                              break;
                            case 'recess':
                              $type_name = '休会届';
                              break;
                            case 'quit':
                              $type_name = '退会届';
                              break;
                            case 'event_entry':
                              $type_name = 'イベント・短期教室参加申請';
                              break;
                            default:
                              $type_name = '住所変更申請';
                              break;
                          }
                          $status = '';
                          switch ($value['status']) {
                            case 0:
                              $status = '未処理/未確認';
                              break;
                            case 1:
                              $status = '承認';
                              break;
                            default:
                              $status = '保留';
                              break;
                          }
                        ?>
                        <td><?php echo $type_name;?></td>
                        <td><?php echo $status;?></td>
                      </tr>
                    <?php }?>
                  <?php }else{?>
                    <tr>
                      <td colspan = 4><center>No Data!</center></td>
                    </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
            <?php if(!empty($list_request)){?>
              <?php if(count($list_request) > 10){?>
                <div class="row">
                  <center>
                    <button type="button" class="btn-success fix_css_btn_action" id="btn_show_list">開 <span class="glyphicon glyphicon-folder-open"></span></button>
                  </center>
                </div>
                
              <?php }?>
            <?php }?>
          </div>

        </div>
      </section>

    </div>
  </main>
  <script>
    $(document).on('ready', function() {

      $(document).on ("click", "#btn_show_list", function () {
        $('.table-history tbody').find('tr').each (function() {
          if($(this).hasClass('hidden_tr')){
            $(this).removeClass('hidden_tr');
            $(this).addClass('show_tr');
          }
        })
        $(this).html('閉 <span class="glyphicon glyphicon-folder-close"></span>');
        $(this).attr('id', '');
        $(this).attr('id', 'btn_hidden_list');
      })

      $(document).on ("click", "#btn_hidden_list", function () {
        $('.table-history tbody').find('tr').each (function() {
          if($(this).hasClass('show_tr')){
            $(this).removeClass('show_tr');
            $(this).addClass('hidden_tr');
          }
        })
        $(this).attr('id', '');
        $(this).html('開 <span class="glyphicon glyphicon-folder-open"></span>');
        $(this).attr('id', 'btn_show_list');
      })

    })
  </script>
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
