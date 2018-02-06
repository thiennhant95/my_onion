<div class="page-top">
  <button class="page-top-btn"></button>
</div>

<footer class="footer">
  <div class="container">
    <p class="footer-copy">&copy; Hanamigawa Swimming Club. All Rights Reserved.</p>
  </div>
</footer>
<script>
    //Biến global url ajax lưu tại đây:
    var url_index = 'https:' + "<?php echo base_url().'admin/auth'?>"; 
    var url_top = 'https:' + "<?php echo base_url().'admin'?>";
    //end global
</script>
<script src="<?php echo base_url('js/admin/public.js') ?>"></script>
<?php
    $segment = $this->uri->segment(1);
    $arr_name_file_js = explode ("_", $js_view); 
    $name_file_js = isset($arr_name_file_js[0]) ? $arr_name_file_js[0] : '';
    $segment = ($segment == '') ? 'admin' : $segment;
    if(file_exists(FCPATH."js/".$segment."/".$name_file_js.".js"))
    {
?>
      <script src="<?php echo base_url() ?><?php echo"js/".$segment."/".$name_file_js.".js"; ?>"></script>
      
<?php
    }
?>
