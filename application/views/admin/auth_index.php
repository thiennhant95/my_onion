<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin_simple.php"); ?>

  <main class="content content-dark">
    <div class="container">
      <div class="login-400">
        <h1 class="login-title">
          <img src="/images/hanamigawasw/logo_hanamigawaswim.svg" style="width: 125px">
        </h1>
        <div class="form-wrapper">
          <form action="" method="" id = "admin_log">
            <div class="form-group login-icon login-user">
              <label>会員番号</label>
              <input type="text" maxlength = "80" id="username" name = "username"  class="form-control" placeholder="">
              
              <?php echo form_error('username'); ?>
            </div>
            <div class="err_msg_id"></div>
            <div class="form-group login-icon login-password">
              <label>パスワード</label>
              <input type="password" id="pwd" name="pwd"  class="form-control" placeholder="">
              <?php echo form_error('pwd'); ?>
            </div>
            <div class="err_msg_pass">
            </div>
            <div class = "err_msg" ></div>
            <p class="login-btn-wrapper">
              <button type="button" id = "login_btn" disable class="btn btn-main btn-lg">ログイン</button>
            </p>
          </form><!-- .form-wrapper -->
        </div>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
