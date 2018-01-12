$('#logout_admin').click(function() {
     $.ajax({
         url: url_logout,
         data:'null',
         method: 'POST',
         dataType: 'JSON',
         success:function (relsult) {
             window.location.href = url_index; 
         },error: function (XMLHttpRequest, textStatus, errorThrown) {
             console.log('error!');
         }
     })
})