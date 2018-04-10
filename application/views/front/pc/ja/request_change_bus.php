<!DOCTYPE html>
<html lang="ja">
<head>
  <?php require_once("head.php"); ?>
</head>
<body>
  <?php require_once("contents_header_mypage.php"); ?>
  <main class="content content-dark">
  <input type="hidden" value="<?php echo $s_info['info']['id']; ?>" name="student_id" />
    <div class="container">
      <h1 class="lead-heading lead-heading-icon-bus-user bg-red h3">バス乗降連絡</h1>
      <form class="form-horizontal">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">バス乗降連絡</div>
            <div class="panel-body">
              <section>
                <div class="row block-15">
                  <div class="col-sm-10 col-sm-offset-1">
                    <p>
                      <span>「この日は行きだけ乗らない。帰りいつも通り帰る。」</span>
                      <span>「この日、行きだけ他のバス停から乗りたい。」</span>
                      <span>など、特定の日に限ったバスの乗降予定変更を承ります。</span>
                      <span>
                        今後ずっと変更の場合は、
                        <a href="#0" target="_blank">こちらからコース変更申請
                          <i class="fa fa-external-link-square" aria-hidden="true"></i>
                        </a>
                        をしてください。
                      </span>
                    </p>
                  </div>
                </div>
              </section>
              <hr class="hr-dashed">
              <section>
                <?php 
                  $weeks = array('2' => '火', '3' => '水', '4' => '木', '5' => '金', '6' => '土', '0' => '日', '1' => '月');
                  if ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == '0' ) { ?>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">基本バスコース</label>
                    <div class="col-sm-5 control-text">
                      <span>バス利用無し</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">乗車場所</label>
                    <div class="col-sm-5 control-text">
                      <span>__</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">降車場所</label>
                    <div class="col-sm-5 control-text">
                      <span>__</span>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">基本バスコース:</label>
                  </div>
                  <?php
                    foreach ( $s_class as $k => $v ) { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-5 control-text">
                          <?php if( isset( $v['bus_course_go'] ) ) { echo $weeks[$v['week_num']]; ?>曜日（<?php echo $v['class_name'] . '）'; } ?>
                        </div>
                      </div>
                      <?php if ( isset( $v['bus_course_go'] ) ) {?>
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">行きの乗車場所</label>
                          <div class="col-sm-5 control-text">
                            <span><?php echo $v['bus_course_go']['bus_course_name'] . '【' . $v['bus_course_go']['bus_stop_code'] . '】' . $v['bus_course_go']['bus_stop_name']; ?></span>
                          </div>
                        </div>
                      <?php }
                      if ( isset( $v['bus_course_ret'] ) ) { ?>
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">帰りの降車場所</label>
                          <div class="col-sm-5 control-text">
                            <span><?php echo $v['bus_course_ret']['bus_course_name'] . '【' . $v['bus_course_ret']['bus_stop_code'] . '】' . $v['bus_course_ret']['bus_stop_name']; ?></span>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>
                <?php } ?>
              </section>
              <hr class="hr-dashed">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">送迎バスを</label>
                <div class="col-sm-5">
                  <label class="radio-inline">
                    <input type="radio" name="bus_use_flg" onclick="disabled_bus(1)" value="1" <?php if ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == '1' ) echo 'checked'; ?>> 利用する
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="bus_use_flg" onclick="disabled_bus(0)" value="0" <?php if ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == '0' ) echo 'checked'; ?>> 利用しない
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label"></label>
                <div class="col-sm-5"><a href="#">送迎バスのご案内（別ウィンドウで開く）</a></div>
              </div>
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">変更日</label>
                <div class="col-sm-2">
                  <input name="change_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <span>から</span>
              </div>
              <section>
                <?php
                  $disabled = ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == 1 ) ? '' : 'disabled';
                  $check_checkbox = 0;
                  foreach( $s_class as $k => $v ) {
                    if ( $v['use_bus_flg'] == 0 ) {
                      $id_bus_stop_1 = random_string( 'alnum', RANDOM_STRING_LENGTH );
                      $id_bus_stop_2 = random_string( 'alnum', RANDOM_STRING_LENGTH );
                      $class_course_go = random_string( 'alpha', RANDOM_STRING_LENGTH );
                      $class_course_ret = random_string( 'alpha', RANDOM_STRING_LENGTH );
                      $class_route_go = random_string( 'alpha', RANDOM_STRING_LENGTH );
                      $class_route_ret = random_string( 'alpha', RANDOM_STRING_LENGTH );
                    ?>
                      <div class="each_bus_course">
                      <?php if ( isset( $v['list_bus_course'] ) && count( $v['list_bus_course'] ) > 0 ) { 
                        $check_checkbox++;
                        ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-5 control-text">
                            <?php echo $weeks[$v['week_num']]; ?>曜日（<?php echo $v['class_name'] . '）'; ?>
                          </div>
                        </div>
                        <div class="form-group">  
                          <label for="" class="col-xs-12 col-sm-2 control-label">行きの乗車場所</label>
                            <div class="col-sm-3">
                              <select class="form-control change_bus_course disabled_bus <?php echo $class_course_go; ?> <?php echo $id_bus_stop_1; ?>" <?php echo $disabled; ?> data-bus="bus_course" onchange="change_bus_course(this.value, <?php echo "'" . $id_bus_stop_1 . "'"; ?>)">
                                <?php
                                  foreach ( $v['list_bus_course'] as $k1 => $v1 ) {
                                    if ( isset($v['bus_course_go']['bus_course_id']) && $v['bus_course_go']['bus_course_id'] == $v1['id'] ) $selected = 'selected';
                                    else $selected = '';
                                    echo '<option value="' . $v1['id'] . '" ' . $selected . '>' . $v1['bus_course_name'] . '</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          <?php } ?>
                          <?php if ( isset( $v['list_route_go'] ) && count( $v['list_route_go'] ) > 0 ) { ?>
                            <div class="col-sm-3">
                              <select class="form-control change_bus_route disabled_bus <?php echo $class_route_go; ?>" <?php echo $disabled; ?> data-bus="bus_route" data-go-ret="go" data-class-id="<?php echo $v['class_id']; ?>_<?php echo $v['week_num']; ?>" data-old-route="<?php echo $v['bus_course_go']['bus_route_go_id']; ?>" id="<?php echo $id_bus_stop_1; ?>">
                                <?php
                                  foreach ( $v['list_route_go'] as $k2 => $v2 ) {
                                    if ( $v['bus_course_go']['bus_route_go_id'] == $v2['id'] ) $selected = 'selected';
                                    else $selected = '';
                                    echo '<option value="' . $v2['id'] . '" ' . $selected . '>【' . $v2['bus_stop_code'] . '】' . $v2['bus_stop_name'] . '</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          <?php } ?>
                        </div>
                        <div class="form-group">
                        <?php if ( isset( $v['list_bus_course'] ) && count( $v['list_bus_course'] ) > 0 ) { ?>
                          <label for="" class="col-xs-12 col-sm-2 control-label">帰りの降車場所</label>
                            <div class="col-sm-3">
                              <select class="form-control change_bus_course disabled_bus <?php echo $class_course_ret; ?> <?php echo $id_bus_stop_2; ?>" <?php echo $disabled; ?> data-bus="bus_course" onchange="change_bus_course(this.value, <?php echo "'" . $id_bus_stop_2 . "'"; ?>)">
                                <?php
                                  foreach ( $v['list_bus_course'] as $k1 => $v1 ) {
                                    if ( isset($v['bus_course_ret']['bus_course_id']) && $v['bus_course_ret']['bus_course_id'] == $v1['id'] ) $selected = 'selected';
                                    else $selected = '';
                                    echo '<option value="' . $v1['id'] . '" ' . $selected . '>' . $v1['bus_course_name'] . '</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          <?php } ?>
                          <?php if ( isset( $v['list_route_ret'] ) && count( $v['list_route_ret'] ) > 0) { ?>
                            <div class="col-sm-3">
                              <select class="form-control change_bus_route disabled_bus <?php echo $class_route_ret; ?>" <?php echo $disabled; ?> data-bus="bus_route" data-go-ret="ret" data-class-id="<?php echo $v['class_id']; ?>_<?php echo $v['week_num']; ?>" data-old-route="<?php echo $v['bus_course_ret']['bus_route_ret_id']; ?>" id="<?php echo $id_bus_stop_2; ?>">
                                <?php
                                  foreach ( $v['list_route_ret'] as $k2 => $v2 ) {
                                    if ( $v['bus_course_ret']['bus_route_ret_id'] == $v2['id'] ) $selected = 'selected';
                                    else $selected = '';
                                    echo '<option value="' . $v2['id'] . '" ' . $selected . '>【' . $v2['bus_stop_code'] . '】' . $v2['bus_stop_name'] . '</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          <?php } ?>
                        </div>
                        <?php if ( $check_checkbox == 1 && count( $v['list_bus_course'] ) > 0 ) {?>
                          <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                              <label><input type="checkbox" value="" name="check_bus_checked" onclick="duplicate_bus('<?php echo $class_course_go; ?>', '<?php echo $class_course_ret; ?>', '<?php echo $class_route_go; ?>', '<?php echo $class_route_ret; ?>', '<?php echo $v['class_id']; ?>')">上記と同じ設定をする</label>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                  <?php } } ?>
                  <input type="hidden" name="check_bus" value="<?php echo $check_bus; ?>" />
              </section>
            </div>
          </div>
        </section>
        <div class="block-30 text-center">
          <button type="button" class="btn btn-success btn-lg btn-long" data-toggle="modal" data-target="#modal-confirm" id="btn-popup">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>連絡する</span>
          </button>
        </div>
      </form>
    </div>

    <div class="modal fade" id="modal-error" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">エラー</h4>
          </div>
          <div class="modal-body">
            <p>エラーが発生されます。再度してください。</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-confirm" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">バス乗降連絡</h4>
          </div>
          <div class="modal-body">
            <p>バス乗降情報を変更します。よろしいでしょうか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-change-bus">変更</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>
    
  </main>
  <?php require_once("contents_footer.php"); ?>
</body>
</html>
<script>
  function duplicate_bus( class_course_go, class_course_ret, class_route_go, class_route_ret, class_id ) {
    if ( $('input[name=check_bus_checked]').is(":checked") ) {
      var bus_course_go_default = $('.'+class_course_go).val();
      var bus_course_ret_default = $('.'+class_course_ret).val();
      var bus_route_go_default = [];
      var bus_route_ret_default = [];
      var bus_route_go_default_html = [];
      var bus_route_ret_default_html = [];
      var bus_route_go_selected = $('.'+class_route_go).val();
      var bus_route_ret_selected = $('.'+class_route_ret).val();
      $('.'+class_route_go+' option').each(function() {
          bus_route_go_default.push($(this).val());
      });
      $('.'+class_route_ret+' option').each(function() {
          bus_route_ret_default.push($(this).val());
      });

      $('.'+class_route_go+' option').each(function() {
          bus_route_go_default_html.push($(this).html());
      });
      $('.'+class_route_ret+' option').each(function() {
          bus_route_ret_default_html.push($(this).html());
      });
     
      var id_route = '';
      $('.each_bus_course').find('.change_bus_route').each( function() {
        if ( $(this).attr('data-class-id').split('_')[0] == class_id ) {
          if ( $(this).attr('data-go-ret') == 'go' ) {
            id_route = $(this).attr('id');
            $(this).empty();
            var html_route_go = '';
            for ( var i = 0; i < bus_route_go_default.length; i++ ) {
              if ( bus_route_go_default[i] == bus_route_go_selected ) selected = 'selected';
              else selected = '';
              html_route_go += '<option value="'+bus_route_go_default[i]+'" '+selected+'>'+bus_route_go_default_html[i]+'</option>';
            }
            $(this).append( html_route_go );
            $('.'+id_route).val( bus_course_go_default );
          } else {
            id_route = $(this).attr('id');
            $(this).empty();
            var html_route_ret = '';
            for ( var i = 0; i < bus_route_ret_default.length; i++ ) {
              if ( bus_route_ret_default[i] == bus_route_ret_selected ) selected = 'selected';
              else selected = '';
              html_route_ret += '<option value="'+bus_route_ret_default[i]+'" '+selected+'>'+bus_route_ret_default_html[i]+'</option>';
            }
            $(this).append( html_route_ret );
            $('.'+id_route).val( bus_course_ret_default );
          }
        }
      });
    }
  }
  function disabled_bus( value ) {
    if ( value == 1 ) $('.disabled_bus').removeAttr('disabled');
    else $('.disabled_bus').attr('disabled', 'disabled');
  }
  function change_bus_course( bus_course_id, bus_route_id ) {
    $.ajax({
      url: 'https:' + "<?php echo base_url().'request/change_bus'?>",
      data: {
          bus_course_id : bus_course_id
      },
      method: "POST",
      dataType: "json",
      beforeSend: function() {
        $('.change_bus_course').prop('disabled', 'disabled');
      },
      success: function(result) {
        if ( result == '' ) {
          $('#'+bus_route_id).empty();
          $('#'+bus_route_id).append( '<option>データがありません</option>' );
          $('#'+bus_route_id).attr('disabled', 'disabled');
        } else {
          $('#'+bus_route_id).empty();
          $('#'+bus_route_id).append( result );
          $('#'+bus_route_id).removeAttr('disabled');
        }
        
      }, error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
      },
      complete: function() {
        $('.change_bus_course').prop('disabled', '');
      }
    });
  }
  $(document).ready(function() {
    var options = {
      format: 'yyyy-mm-dd',
      todayBtn: "linked",
      todayHighlight: true,
      autoclose: true,
      language:'jp',
      startDate: '+0d'
    };
    $('input[name=change_date]').datepicker(options);
    $('#btn-change-bus').click(function() {
      var bus_use_flg = "";
      if( $('input[name=bus_use_flg]').is(':checked') ) bus_use_flg = $('input[name=bus_use_flg]:checked').val();
      var change_date = $('input[name=change_date]').val();
      var change_bus = new Object();
      var check_bus = $('input[name=check_bus]').val();
      if ( check_bus == 0 ) change_bus.first_time_change = 1
      else change_bus.first_time_change = 0;
      change_bus.bus_use_flg = bus_use_flg;
      change_bus.change_date = change_date;
      var arr_route = [];
      var check = 0;
      $('.each_bus_course').find('.change_bus_route').each( function() {
        check++;
        if ( $(this).attr('data-bus') == 'bus_route' ) {
          if ( $(this).attr('data-go-ret') == 'go' ) {
            if ( $(this).val() != 'データがありません' ) {
              arr_route.push({
                'bus_route_go_id_before' : $(this).attr('data-old-route'),
                'bus_route_go_id_after' : $(this).val()
              });
            }
          } 
          if ( $(this).attr('data-go-ret') == 'ret' ) {
            if ( $(this).val() != 'データがありません' ) {
              arr_route.push({
                'bus_route_ret_id_before' : $(this).attr('data-old-route'),
                'bus_route_ret_id_after' : $(this).val()
              });
            }
          }
        }
        if ( check == 2 ) {
          change_bus[$(this).attr('data-class-id')] = arr_route;
          arr_route = [];
          check = 0;
        }
      });

      for (var key in change_bus) {
        if (change_bus.hasOwnProperty(key)) {
          if (change_bus[key].length == 0) delete change_bus[key];
        }
      }

      var data = {
        change_bus : change_bus,
        student_id : $('input[name=student_id]').val()
      };

      $.ajax({
        url: 'https:' + "<?php echo base_url().'request/change_bus'; ?>",
        data: data,
        method: "POST",
        dataType: "json",
        success: function(result) {
          if ( result['change_bus'] == 'success' ) window.location.href = "<?php echo base_url().'request/complete'; ?>";
          else $('#modal-error').modal( 'show' );
        }, error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
        }
      });
    });
  });
</script>
