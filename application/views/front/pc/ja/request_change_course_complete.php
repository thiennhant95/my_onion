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
          </h4>
          <hr class="hr-dashed">
          <h2 class="h3">
            <strong>送迎バスについても変更しますか？</strong>
          </h2>
          <p class="text-danger block-15">
            <small>続けて変更する場合、バスの利用変更についての手数料はかかりません。</small>
          </p>
        </div>
      </div>
      <div class="block-30 text-center">
        <a href="#0" class="btn btn-success btn-lg btn-long">
          <i class="fa fa-angle-double-right" aria-hidden="true"></i>
          <span>バスも変更する</span>
        </a>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
