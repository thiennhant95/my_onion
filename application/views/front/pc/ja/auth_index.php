<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_login.php"); ?>

  <main class="content">
    <div class="container">
      <div class="login">
        <h1 class="login-title">Login</h1>
        <form action="" method="" id = "login_customer" >
          <div class="form-group login-icon login-user">
            <label>会員番号またはメールアドレス</label>
            <input type="email" name="users" id = "users" class="form-control" placeholder="">
          </div>
          <div class="form-group login-icon login-password">
            <label>パスワード</label>
            <input type="password" name="pass" value="" id = "pass" class="form-control" placeholder="">
          </div>
          <div class="checkbox text-center">
            <label>
              <input type="checkbox" name="checkbox_save" value="" id = "checkbox_save">
              <strong>会員番号を記録する</strong>
            </label>
          </div>
          <div class="err_msg"><!-- message -->
          </div>
          <p class="login-btn-wrapper">
            <button type="button" id = "login_btn" class="btn btn-main btn-lg">ログイン</button>
          </p>
          <p>
            <a class="btn btn-link btn-underline" href="<?php echo base_url('auth/forgot-password')?>">パスワードを忘れたら？</a>
          </p>
        </form>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
