<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-note bg-violet h3">基本情報変更</h1>
      <form class="form-horizontal" id="change-base-info">
        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">氏名・性別・生年月日</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">氏名</label>
                <div class="col-sm-5 control-text">
                  <span><?php if ( isset( $s_info['meta']['name'] ) ) echo $s_info['meta']['name']; ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">性別</label>
                <div class="col-sm-5 control-text">
                  <span>
                    <?php
                      if ( isset( $s_info['meta']['sex'] ) ) {
                        if ( $s_info['meta']['sex'] == 'male' ) echo '男性';
                        else echo '女性';
                      }
                    ?>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">生年月日</label>
                <div class="col-sm-5 control-text">
                  <span>
                    <?php
                      if ( isset( $s_info['meta']['birthday'] ) ) {
                        $date = date_create( $s_info['meta']['birthday'] );
                        echo date_format( $date, 'Y年m月d日' );
                        $today = date('Y-m-d');
                        $diff = date_diff(date_create($s_info['meta']['birthday']), date_create($today));
                        echo '（' . $diff->format('%y') . '歳）';
                      }
                    ?>
                  </span>
                  <input type="hidden" name="hidden_birthday" value="<?php if ( isset( $s_info['meta']['birthday'] ) ) echo $s_info['meta']['birthday']; ?>" />
                </div>
              </div>
              <?php
                if ( isset( $s_info['meta']['parent_name'] ) ) { ?>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">保護者</label>
                    <div class="col-sm-5 control-text">
                      <span><?php echo $s_info['meta']['parent_name']; ?></span>
                    </div>
                  </div>
                <?php } ?>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">住所</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">&#12306;</label>
                <div class="col-sm-3">
                  <input type="text" name="postal_code" maxlength="8" onkeyup="AjaxZip3.zip2addr(this,'','address','address');" class="form-control" value="<?php if( isset( $s_info['meta']['zip'] ) ) echo $s_info['meta']['zip']; ?>" placeholder="">
                </div>
                <div class="col-sm-7">
                  <input type="text" name="address" maxlength="128" class="form-control" value="<?php if( isset( $s_info['meta']['address'] ) ) echo $s_info['meta']['address']; ?>" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">連絡先</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">電話番号</label>
                <div class="col-sm-10">
                  <input type="tel" name="phone_number" maxlength="11" class="form-control" value="<?php if( isset( $s_info['info']['tel_normalize'] ) ) echo $s_info['info']['tel_normalize']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">緊急連絡先</label>
                <div class="col-sm-10">
                  <input type="tel" name="emergency_tel" maxlength="11" class="form-control" value="<?php if( isset( $s_info['meta']['emergency_tel'] ) ) echo $s_info['meta']['emergency_tel']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メールアドレス</label>
                <div class="col-sm-10">
                  <input type="mail" name="email_address" maxlength="64" class="form-control" value="<?php if( isset( $s_info['info']['email'] ) ) echo $s_info['info']['email']; ?>" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <section id="birthday-check">
          <div class="panel panel-dotted">
            <div class="panel-heading">学校</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">学校名</label>
                <div class="col-sm-10">
                  <input type="text" name="school_name" class="form-control" value="<?php if( isset( $s_info['meta']['school_name'] ) ) echo $s_info['meta']['school_name']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">学年</label>
                <div class="col-sm-3">
                    <?php
                      if ( isset( $s_info['meta']['school_grade'] ) ) {
                        $school_grade = $s_info['meta']['school_grade'];

                    ?>
                    <select class="form-control" name="school_grade">
                      <?php
                        foreach ( $school_grades as $k => $v ) {
                          echo '<option value="' . $v . '" '; if ( $school_grade == $v ) echo 'selected'; echo '>' .  $v . '</option>';
                        }
                      ?>
                    </select>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">コーチへの伝達事項</div>
            <div class="panel-body">
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                  <textarea name="memo_to_coach" maxlength="256" class="form-control" rows="4"><?php if( isset( $s_info['meta']['memo_to_coach'] ) ) echo $s_info['meta']['memo_to_coach']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section>
          <div class="panel panel-dotted">
            <div class="panel-heading">ホエールくん ログインパスワード</div>
            <div class="panel-body">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">新パスワード</label>
                <div class="col-sm-10">
                  <input type="password" name="newpass" maxlength="64" class="form-control" value="" placeholder="">
                </div>
              </div>
            </div>
          </div>
        </section>

        <div class="block-30 text-center">
          <button type="button" class="btn btn-success btn-lg btn-long" data-toggle="modal" data-target="#modal-confirm" id="btn-popup">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            <span>変更する</span>
          </button>
        </div>

        <div class="modal fade" id="modal-confirm" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change info confirm</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure to change?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="change-base-info-btn">Change</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-success" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change result</h4>
              </div>
              <div class="modal-body">
                <p>Changed successfully</p>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-error" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error</h4>
              </div>
              <div class="modal-body">
                <p>Đã xảy ra lỗi, vui lòng thử lại</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-default" data-toggle="confirmation">Confirmation</button>

      </form>

    </div>
  </main>


  <?php require_once("contents_footer.php"); ?>
</body>
</html>
<script>
  $(document).ready(function() {
    var check_birthday = moment().diff(moment($('input[name=hidden_birthday]').val(), 'YYYYMMDD'), 'years');
    if ( check_birthday >= 18 ) $('#birthday-check').css('display', 'none');
    jQuery.validator.addMethod("onebyte", function(value, element) {
      return this.optional(element) || !/[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
    }, "Must be 1 byte character");

    $('#change-base-info input').on('click', function () {
      if ($('#change-base-info').valid()) {
        $('#btn-popup').prop('disabled', false);
      } else {
        $('#btn-popup').prop('disabled', 'disabled');
      }
    });

    $('#change-base-info input').on('keyup blur', function () {
      if ($('#change-base-info').valid()) {
        $('#btn-popup').prop('disabled', false);
      } else {
        $('#btn-popup').prop('disabled', 'disabled');
      }
    });

    $('#change-base-info textarea').on('keyup blur', function () {
      if ($('#change-base-info').valid()) {
        $('#btn-popup').prop('disabled', false);
      } else {
        $('#btn-popup').prop('disabled', 'disabled');
      }
    });

    $('#change-base-info textarea').on('click', function () {
      if ($('#change-base-info').valid()) {
        $('#btn-popup').prop('disabled', false);
      } else {
        $('#btn-popup').prop('disabled', 'disabled');
      }
    });

    $("#change-base-info").validate({
      rules: {
        postal_code: { 
          required: true,
          onebyte: true
        },
        address: { required: true },
        phone_number: { 
          required: true,
          onebyte: true,
          maxlength: 11,
          number: true
        },
        emergency_tel: { 
          onebyte: true,
          maxlength: 11,
          number: true
        },
        email_address: {
          required: true,
          email: true
        },
        school_name: {
          required: function(element) {
            var school_name_check = $('input[name=hidden_birthday]').val();
            var school_name_return = moment().diff(moment(school_name_check, 'YYYYMMDD'), 'years');
            return  school_name_return < 18;
          }
        },
        school_grade: {
          required: function(element) {
            var school_grade_check = $('input[name=hidden_birthday]').val();
            var school_grade_return = moment().diff(moment(school_grade_check, 'YYYYMMDD'), 'years');
            return  school_grade_return < 18;
          }
        },
        newpass: {
          minlength: 8,
          onebyte: true
        }
      },
      errorPlacement: function (error, element) {
        if ( element.attr('name') == 'sex' )
          error.appendTo('.msg_sex');
        else
          error.insertAfter(element);
      },
      messages: {
        postal_code: { 
          required: "Postal code is required",
          onebyte: "Postal code must be 1 byte"
        },
        address: { required: "Address is required" },
        phone_number: { 
          required: "Phone number is required",
          onebyte: "Phone number must be 1 byte",
          maxlength: "Phone number length max = 11",
          number: "Phone number must be number"
        },
        emergency_tel: {
          onebyte: "Emergency tel must be one byte",
          maxlength: "Emergency tel max length = 11",
          number: "Emergency tel must be number"
        },
        email_address: {
          required: "Email address is required",
          email: "Email invalid"
        },
        school_name: {
          required: "School name is required"
        },
        school_grade: {
          required: "School grade is required"
        },
        newpass: {
          minlength: "Min length password is 8",
          onebyte: "Password must be 1 byte"
        }
      },
      errorClass: "label label-danger",
      highlight: function (element, errorClass, validClass) {
        return false;
      },
      unhighlight: function (element, errorClass, validClass) {
        return false;
      }
    });
    $('#change-base-info-btn').click(function() {
      var postal_code = $('input[name=postal_code]').val();
      var address = $('input[name=address]').val();
      var phone_number = $('input[name=phone_number]').val();
      var emergency_tel = $('input[name=emergency_tel]').val();
      var email_address = $('input[name=email_address]').val();
      var school_name = $('input[name=school_name]').val();
      var school_grade = $('select[name=school_grade] option:selected').val();
      var memo_to_coach = $('textarea[name=memo_to_coach]').val();
      var newpass = $('input[name=newpass]').val();
      var data = { 
        postal_code : postal_code,
        address : address,
        phone_number : phone_number,
        emergency_tel : emergency_tel,
        email_address : email_address,
        school_name : school_name,
        school_grade : school_grade,
        memo_to_coach : memo_to_coach,
        newpass : newpass
      }
      console.log( data );
      if ( postal_code != '' && address != '' && phone_number != '' && email_address != '' ) {
        $.ajax({
          url: 'https:' + "<?php echo base_url().'request/change_base_info'; ?>",
          data: { 
            postal_code : postal_code,
            address : address,
            phone_number : phone_number,
            emergency_tel : emergency_tel,
            email_address : email_address,
            school_name : school_name,
            school_grade : school_grade,
            memo_to_coach : memo_to_coach,
            newpass : newpass
          },
          method: "POST",
          dataType: "json",
          success: function(result) {
            $('#modal-success').modal('show');
            setTimeout(function(){ window.location.href = "<?php echo base_url().'request'; ?>"; }, 3000);
          }, error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('error');
          }
        });
      } else {
        $('#modal-error').modal('show');
      }
    });
  });
</script>
