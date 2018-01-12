$(document).ready(function(){
//   var csrf_test_name = $("input[name=csrf_test_name]").val();

  function msg_login_alert(text){
    $('.err_msg').text(text);
      setTimeout(() => {
        $('.err_msg').text('');
      }, 2000);
  }

  function check_input_log(val_user, val_pass){
    let status = '';

    if((val_user === "" && (val_pass === ""))){
      return status =  'null';
    } 
    else{
      
      if(val_user){

        let rexgular = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!(rexgular.test(val_user))){
          return status = 'email_invalid';
        }

        let rexgula_type_2byte = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g; 
        if(rexgula_type_2byte.test(val_user)){
          return status = 'email_2byte';
        }
      }else{
        return status =  'mail_null';
      }

      if(val_pass){
        let pass_valid = /^[0-9a-zA-Z]{8,}$/;
        if(!(pass_valid.test(val_pass))){
          return status = 'pass_invalid';
        }
      }
      else{
        return status =  'pass_null';
      }
    }
  }

  $('#login_btn').click(function(){
    let val_username = $('#username').val();
    let val_pwd = $('#pwd').val();
    let status_check = check_input_log(val_username, val_pwd);
    let msg_show = '';

    switch (status_check) {
      case 'null':

        msg_show = 'Please enter key!';
        msg_login_alert(msg_show);
        break;

      case 'pass_null':

        msg_show = 'Please enter password!';
        msg_login_alert(msg_show);
        break;

      case 'mail_null':

        msg_show = 'Please enter user!';
        msg_login_alert(msg_show);
        break;

      case 'email_invalid':

        msg_show = 'Users invalid!';
        msg_login_alert(msg_show);
        break;

      case 'email_2byte':

        msg_show = 'Input value should be Single byte alphanumeric characters';
        msg_login_alert(msg_show);
        break;

      case 'pass_invalid':

        msg_show = 'Password invalid!';
        msg_login_alert(msg_show);
        break;

      default:
        $.ajax({
          url : url_login,
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
        break;
    }
  });
 

})