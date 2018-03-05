$(document).ready(function(){
//   var csrf_test_name = $("input[name=csrf_test_name]").val();

  function msg_login_alert(text){
    $('.err_msg').text(text);
      setTimeout(() => {
        $('.err_msg').text('');
      }, 2000);
  }

  $("#admin_log").validate({
    rules: {
      username: "required",
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
          // if(admin){
          //   go to page my top
          // }
          // else{
          //   go to page bus manager
          // }
          window.location.href = "/admin"; 
        }
        else{
          msg_show = 'Email or Password incorrect!';
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