
$(document).ready(function() {
  $('#page_complete').css('display','none');
  $('#login_btn').click(function() {
    
    let user_name = $('#users').val();
    let pass = $('#pass').val();
    let check_save = $("input[name='checkbox_save']").is(':checked');
    let check_status =  check_input_log(user_name, pass);

    switch (check_status) {

      case 'null':
        msg_login_alert('User name and Password not null!');
        break;
      case  'email_2byte':
        msg_login_alert('Input value should be Single byte alphanumeric characters');
        break;
      case 'mail_null':
        msg_login_alert('User name not null');
        break;
      case 'pass_invalid':
        msg_login_alert('Password invalid');
        break;
      case 'pass_null':
        msg_login_alert('Password not null');
        break;
      default:
        $.ajax({
          url: url_login_auth,
          data: { 
            user : user_name,
            pass :  pass,
            check_save: check_save
          },
          method: "POST",
          dataType: "json",
          success: function(result) {
            // console.log(url_auth);
            if(result.status == 'OK'){
              window.location.href = '/'; 
            }
            else{
              msg_show = 'Email or Password incorrect!';
              msg_login_alert(msg_show);
            }
          },error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('error');
          }
        })
        break;
    }
  });
  
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
    }else{
      if(val_user){
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
      }else{
        return status =  'pass_null';
      }
    }
  }

  function check_valid_email(email) {
    if(email){
      let rexgula_type_2byte = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g; 
      let rexgular = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      
      if(rexgula_type_2byte.test(email)){
        return status = 'email_2byte';
      }
      if(!(rexgular.test(email))){
        return status = 'email_invalid';
      }
    }else{
      return status =  'mail_null';
    }
  }

  $('#send_mail_fgp').click(function () {
    alert(1);
    let email_input = $('#email_forgot_pass').val();
    let check_email = check_valid_email(email_input);   
    switch (check_email) {
      case 'email_2byte':
        msg_login_alert('Input value should be Single byte alphanumeric characters');
        break;
      case 'mail_null':
        msg_login_alert('Email not null');
        break;
      case 'email_invalid':
        msg_login_alert('Email invalid');
        break;
        
      default:
        $.ajax({
          url: url_forgot_pass,
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
        break;
    }
  });

  function send_pass_success() {

    $('#page_init').css('display','none');
    $('#page_complete').css('display','block');

  }
})
