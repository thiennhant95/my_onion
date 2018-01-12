<div class="page-top">
  <button class="page-top-btn"></button>
</div>

<footer class="footer">
  <div class="container">
    <p class="footer-copy">&copy; Hanamigawa Swimming Club. All Rights Reserved.</p>
  </div>
</footer>
<script>
  //url ajax
  var url_login_auth = 'https:' + "<?php echo base_url().'login'?>";
  var url_logout_auth = 'https:' + "<?php echo base_url().'auth'?>"; 
  var url_forgot_pass = 'https:' + "<?php echo base_url().'auth/forgot-password'?>"; 

</script>
<?php
    
    $segment = $this->uri->segment(1);
    $arr_name_file_js = explode ("_", $js_view); 
    $name_file_js = isset($arr_name_file_js[0]) ? $arr_name_file_js[0] : '';
    $segment = ($segment == '') ? 'auth' : $segment;
    print_r($segment);
    print_r($name_file_js);
    //link file js = segment[1] + / + file_name_view[0].js
    if(file_exists(FCPATH."js/".$segment."/".$name_file_js.".js"))
    {
?>
      <script src="<?php echo base_url("js/".$segment."/".$name_file_js.".js")?>"></script>
<?php
    }
?>