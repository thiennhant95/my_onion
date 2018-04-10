<!DOCTYPE html>
<html lang="ja">
  <head>
      <?php require_once("head.php"); ?>
  </head>

  <body>
      <?php require_once("contents_header_mypage.php"); ?>

    <main class="content content-dark">
      <div class="container">
        <h1 class="lead-heading lead-heading-icon-calender bg-main h3">予約入力ツール</h1>
        <section>
          <div class="panel panel-dotted">
            <div class="block-15">
              ・デバッグ用<br>
              ・l_student_classテーブルを参照し出席曜日をインサート<br>
              ・仕様未確認の為、とりあえず本日よ30日先まで入力<br>
            </div>
            <div class="text-center">
              <p class="block-15">
                <a href="/admin/tool/register_schedule_save"><span class="label label-danger label-lg">30日分予約入力</span></a>
                
                <br>
                <span style="color: red"><?php echo $flash_msg ?></span><br>
              </p>
            </div>
          </div>
      </div>
    </section>


  </div>
</main>

<?php require_once("contents_footer.php"); ?>

</body>

</html>
