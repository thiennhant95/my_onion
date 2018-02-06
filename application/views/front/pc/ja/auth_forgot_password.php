<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_login.php"); ?>

  <main id="page_init" class="content">
    <div class="container">
      <div class="login">
        <h1 class="login-title">パスワード再発行</h1>
        <p class="block-15 text-break">
          <span>入会時、</span>
          <span>もしくはマイページで登録された</span>
          <span>あなたのメールアドレスへ</span>
          <span>ログインのための仮パスワードを発行します。</span>
        </p>
        <form action="" method="" id="forgot_pass_form" autocomplete=off>
          <div class="form-group login-icon login-mail">
            <label>メールアドレス</label>
            <input type="email" name="email_forgot_pass" id = "email_forgot_pass" class="form-control" placeholder="">
          </div>
          <div class="err_msg"></div>
          <p class="login-btn-wrapper">
            <button type="button" id = "send_mail_fgp" disabled class="btn btn-primary btn-lg">送信</button>
          </p>
        </form>
      </div>
      <p class="text-center">
        <small>
          <span>※メールアドレスが無い場合は、</span>
          <span>身分証明書をご持参の上、</span>
          <span>クラブ受付までお問い合わせください。</span>
        </small>
      </p>
    </div>
  </main>

  <main id="page_complete" class="content">
    <div class="container">
      <div class="login">
        <h1 class="login-title">パスワード再発行</h1>
        <p class="block-15 text-break">
          <span>入力いただいたメールアドレス宛てに</span>
          <span>ログインの為の仮パスワードを送りました。</span>
          <span>メールをご確認ください。</span>
        </p>
        <p class="text-center">
          <a href="<?php echo base_url()?>" class="btn btn-default">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            <span class="margin-left">トップへ戻る</span>
          </a>
        </p>
      </div>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<script>
  $(document).ready(function(){

    $('#page_complete').hide();

    function msg_login_alert(text){ 
      $('.err_msg').text(text);
      setTimeout(() => {
        $('.err_msg').text('');
      }, 2000);
    }

    $("#forgot_pass_form").validate({
      rules: {
        email_forgot_pass: {
          required: true,
          email: true
        }
      },
      errorPlacement: function (error, element) {
          error.appendTo(".err_msg");
      },
    });

    $('#forgot_pass_form input').on('keyup blur', function () {
        if ($('#forgot_pass_form').valid()) {
            $('button#send_mail_fgp').prop('disabled', false);
        } else {
            $('button#send_mail_fgp').prop('disabled', 'disabled');
        }
    });

    $('#email_forgot_pass').keydown(function(e) {
      if(e.keyCode == 13){
        e.preventDefault();
      }
    })

    $('#send_mail_fgp').click(function () {
      let email_input = $('#email_forgot_pass').val(); 
      $.ajax({
        url: "https:" + "<?php echo base_url('auth/forgot_password')?>",
        method : "POST",
        data: {
          email : email_input
        },
        dataType: "JSON",
        success: function(result) {
          if(result.status == 'OK'){
            send_pass_success();
          }else{
            msg_login_alert('Email not exits!');
          }
        },error(XMLHttpRequest, textStatus, errorThrown){
          msg_login_alert('Change password fail!');
        }
      })
    });
    
    function send_pass_success() {
      $('#page_init').css('display','none');
      $('#page_complete').css('display','block');
    }

  })

  
</script>
