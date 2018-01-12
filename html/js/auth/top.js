$('#btn_logout_user').click(function() {
  $.ajax({
    url: 'auth/logout',
    method: "POST",
    data: {flag: 1},
    dataType: "JSON",
    success:function(result) {
      window.location.href = url_logout_auth; 
    },error(XMLHttpRequest, textStatus ,errorThrown){
    }
  })
});