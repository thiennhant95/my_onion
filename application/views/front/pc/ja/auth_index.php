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
            <input type="" name="users" id = "users" class="form-control" placeholder="">
          </div>
          <div class=" err_user"><!-- message -->
          </div>
          <div class="form-group login-icon login-password">
            <label>パスワード</label>
            <input type="password" name="pass" value="" id = "pass" class="form-control" placeholder="">
          </div>
          <div class=" err_pass"><!-- message -->
          </div>
          <div class="checkbox text-center">
            <label>
              <input type="checkbox" name="checkbox_save" value="" id = "checkbox_save">
              <strong>会員番号を記録する</strong>
            </label>
          </div>
          <div class="err_msg"></div>
          <p class="login-btn-wrapper">
            <button type="button" disabled id = "login_btn" class="btn btn-main btn-lg">ログイン</button>
          </p>
          <p>
            <a class="btn btn-link btn-underline" href="<?php echo base_url('auth/forgot_password')?>">パスワードを忘れたら？</a>
          </p>
        </form>
      </div>
    </div>
  </main>
  <?php require_once("contents_footer.php"); ?>
  
<script>
  
  $(document).ready(function() {

    $("#login_customer").validate({
      rules: {
        users: "required",
        pass: {
          required: true,
          minlength: 8
        }
      },
      errorPlacement: function (error, element) {
        if (element.attr("name") == "users")
          error.appendTo(".err_user");
        else
          error.appendTo(".err_pass");
      },
    });

    $('#login_customer input').on('keyup blur', function () {
        if ($('#login_customer').valid()) {
            $('button#login_btn').prop('disabled', false);
        } else {
            $('button#login_btn').prop('disabled', 'disabled');
        }
    });

    $('#login_btn').click(function() {

      var user_name = $('#users').val();
      var pass = $('#pass').val();
      var check_save = $("input[name='checkbox_save']").is(':checked');

      $.ajax({
        url: "https:" + "<?php echo base_url('/auth/login');?>",
        data: { 
          user : user_name,
          pass :  pass,
          check_save: check_save
        },
        method: "POST",
        dataType: "json",
        success: function(result) {
          if(result.status == 'OK'){
            if(result.lock_flag == 1){
              window.location.href = "https:" + "<?php echo base_url('/auth/lock');?>"; 
            }else{
              window.location.href = "https:" + "<?php echo base_url('/');?>"; 
            }
          }
          else{
            msg_show = 'Email or Password incorrect!';
            msg_login_alert(msg_show);
          }
        },error: function (XMLHttpRequest, textStatus, errorThrown) {
          msg_show = 'ERROR!';
          msg_login_alert(msg_show);
        }
      })
    });
    
    function msg_login_alert(text){
      $('.err_msg').text(text);
      setTimeout(() => {
        $('.err_msg').text('');
      }, 2000);
    }

    $(document).keypress(function (e) {
        if (e.which == 13) {
            $('#login_btn').trigger('click');
        }
    });
    
  });
</script>
</body>

</html>
