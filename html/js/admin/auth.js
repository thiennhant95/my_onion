$(document).ready(function(){
//   var csrf_test_name = $("input[name=csrf_test_name]").val();

  function msg_login_alert(text){
    $('.err_msg').text(text);
      setTimeout(function(){
        $('.err_msg').text('');
      }, 2000);
  }

  $("#admin_log").validate({
    rules: {
      username: {
        required : true,
        email: true
      },
      pwd: {
        required: true,
        minlength: 8
      }
    },
    errorPlacement: function (error, element) {
      if (element.attr("name") == "username")
        error.appendTo(".err_msg_id");
      else
        error.appendTo(".err_msg_pass");
    },
    messages: {
      username: {
          required: "必須です。ご入力ください。",
          email: '正しいメールアドレスを入力してください。'
      },
      pwd: { 
        required: "必須です。ご入力ください。",
        minlength: "8半角文字以上で入力してください。"
      }     
    },
  });

  $('#admin_log input').on('keyup blur', function () {
    if ($('#admin_log').valid()) {
        $('button#login_btn').prop('disabled', false);
    } else {
        $('button#login_btn').prop('disabled', 'disabled');
    }
  });

  $('#login_btn').click(function(){
    let val_username = $('#username').val();
    let val_pwd = $('#pwd').val();
    let msg_show = '';
    $.ajax({
      url : url_index,
      data:{
        user : val_username,
        pass : val_pwd,
        // csrf_test_name: csrf_test_name
      },
      dataType:'json',
      method:'POST',
      success:function(result){
        if(result.status == 'OK'){
          window.location.href = "/admin"; 
        }
        else{
          msg_show = 'メールアドレスは正しくありません。';
          msg_login_alert(msg_show);
        }
      },error: function (XMLHttpRequest, textStatus, errorThrown) {
        console.log('error!');
      }
    })
  });

  $(document).keypress(function (e) {
    if (e.which == 13) {
        $('#login_btn').trigger('click');
    }
  });
 

})