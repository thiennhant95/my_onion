<header class="header-mypage">
  <div class="container">
    <div class="header-body">
      <div class="header-cell header-logo">
        <a href="#0">
          <img class="img-responsive center-block" src="/images/hanamigawasw/logo_hanamigawaswim.svg">
        </a>
      </div>
      <div class="header-cell text-break">
        <?php 
          $data_familly = $this->session->userdata("list_family");
          $user_current = $this->session->userdata('user_account');
        ?>
        <select class="form-control header-mypage-select" id="change_id_family">
          <?php if(!empty($data_familly)){?>
            <?php foreach ($data_familly as $key => $value) {?>
              <option <?php if($user_current['id'] == $value['student_id']){ echo "selected";}?> value="<?php echo $value['student_id']?>"><?php echo $value['value']?></option>
            <?php }?>
          <?php }?> 
        </select>
        <span>さんのマイページ</span>
      </div>
      <div class="header-cell btn-menu-wrapper">
        <button class="btn-menu menu-toggler">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </div>
  <nav class="nav-sp">
    <button class="nav-sp-close menu-toggler"></button>
    <h3 class="nav-sp-title">MENU</h3>
    <ul class="nav-sp-list">
      <li>
        <a href="<?php echo base_url('/');?>">マイページTOP</a>
      </li>
      <li>
        <a href="<?php echo base_url('/request/change_course');?>">練習コース振替申請</a>
      </li>
      <li>
        <a href="#0">練習コース出席記録</a>
      </li>
      <li>
        <a href="#0">指導状況・泳力認定書</a>
      </li>
      <li>
        <a href="<?php echo base_url('/request/change_base_info');?>">会員情報変更申請</a>
      </li>
    </ul>
    <div class="nav-sp-logout">
      <a class="btn btn-default center-block" id = "btn_logout_user" href="#">ログアウト</a>
    </div>
  </nav>
  <script>
    $(document).on('ready', function () {
        $('#btn_logout_user').click(function() {
        $.ajax({
          url: "https:" + "<?php echo base_url('api/logout/logout_user');?>",
          method: "POST",
          data: {flag_logout: 1},
          dataType: "JSON",
          success:function(result) {
            window.location.href = "/"; 
          },error:function(XMLHttpRequest, textStatus ,errorThrown){
            console.log('err');
          }
        })
      });

      $('#change_id_family').on('change', function() {
        var id_current = $('#change_id_family').val();
        $.ajax({
          url: "https:" + "<?php echo base_url('api/change_account_user/set_session_user');?>",
          dataType: "JSON",
          method: "POST",
          data:{
            id_post : id_current
          },
          success:function(result) {
            location.reload();
          },error:function(XMLHttpRequest, textStatus ,errorThrown){
            console.log('err');
          }
        })
      })
    })
    
  </script>
</header>
  
