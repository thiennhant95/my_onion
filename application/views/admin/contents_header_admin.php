<header class="header-admin">
  <div class="container">
    <div class="header-body">
      <div class="header-cell header-logo">
        <a href="#0">
          <img class="img-responsive center-block" src="/images/hanamigawasw/logo_hanamigawaswim.svg">
        </a>
      </div>
      <div class="header-cell header-admin-title">
        <span class="">運営管理画面</span>
      </div>
      <div class="header-cell header-admin-name">
        <span>運用管理者</span>
      </div>
      <div class="header-cell header-admin-logout">
        <a class="btn btn-default btn-block btn-small" href="#0" id = "logout_admin">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          <span class="hidden-xs">ログアウト</span>
        </a>
      </div>
    </div>
  </div>
  <script>
    $('#logout_admin').click(function() {
      $.ajax({
        url: "https:" + "<?php echo base_url('api/logout/logout_admin');?>",
        method: "POST",
        data: {flag_logout: 1},
        dataType: "JSON",
        success:function(result) {
          window.location.href = "<?php echo base_url('admin/auth');?>"; 
        },error(XMLHttpRequest, textStatus ,errorThrown){
          console.log('err');
        }
      })
    });
  </script>
</header>
