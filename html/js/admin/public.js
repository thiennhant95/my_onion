
$(document).ready(function () {
     $('#logout_admin').click(function() {
          $.ajax({
          url: url_index,
          data:{
               flag_logout: 1
          },
          method: 'POST',
          dataType: 'JSON',
          success:function (relsult) {
               window.location.href = url_index; 
          },error: function (XMLHttpRequest, textStatus, errorThrown) {
               console.log('error!');
          }
          })
     })
})