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
                  <input type="text" name="postal_code" maxlength="8" onkeyup="AjaxZip3.zip2addr(this,'','address','address');" class="form-control" data-old="<?php if( isset( $s_info['meta']['zip'] ) ) echo $s_info['meta']['zip']; ?>" value="<?php if( isset( $s_info['meta']['zip'] ) ) echo $s_info['meta']['zip']; ?>" placeholder="">
                </div>
                <div class="col-sm-7">
                  <input type="text" name="address" maxlength="128" class="form-control" data-old="<?php if( isset( $s_info['meta']['address'] ) ) echo $s_info['meta']['address']; ?>" value="<?php if( isset( $s_info['meta']['address'] ) ) echo $s_info['meta']['address']; ?>" placeholder="">
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
                  <input type="tel" name="phone_number" maxlength="11" class="form-control" data-old="<?php if( isset( $s_info['info']['tel_normalize'] ) ) echo $s_info['info']['tel_normalize']; ?>" value="<?php if( isset( $s_info['info']['tel_normalize'] ) ) echo $s_info['info']['tel_normalize']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">緊急連絡先</label>
                <div class="col-sm-10">
                  <input type="tel" name="emergency_tel" maxlength="11" class="form-control" data-old="<?php if( isset( $s_info['meta']['emergency_tel'] ) ) echo $s_info['meta']['emergency_tel']; ?>" value="<?php if( isset( $s_info['meta']['emergency_tel'] ) ) echo $s_info['meta']['emergency_tel']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メールアドレス</label>
                <div class="col-sm-10">
                  <input type="mail" name="email_address" maxlength="64" class="form-control" data-old="<?php if( isset( $s_info['info']['email'] ) ) echo $s_info['info']['email']; ?>" value="<?php if( isset( $s_info['info']['email'] ) ) echo $s_info['info']['email']; ?>" placeholder="">
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
                  <input type="text" name="school_name" class="form-control" data-old="<?php if( isset( $s_info['meta']['school_name'] ) ) echo $s_info['meta']['school_name']; ?>" value="<?php if( isset( $s_info['meta']['school_name'] ) ) echo $s_info['meta']['school_name']; ?>" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-xs-12 col-sm-2 control-label">学年</label>
                <div class="col-sm-3">
                    <?php
                      if ( isset( $s_info['meta']['school_grade'] ) ) {
                        $school_grade = $s_info['meta']['school_grade'];
                    ?>
                    <select class="form-control" name="school_grade" data-old="<?php echo $school_grade; ?>">
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
                  <textarea name="memo_to_coach" maxlength="256" class="form-control" rows="4" data-old="<?php if( isset( $s_info['meta']['memo_to_coach'] ) ) echo $s_info['meta']['memo_to_coach']; ?>"><?php if( isset( $s_info['meta']['memo_to_coach'] ) ) echo $s_info['meta']['memo_to_coach']; ?></textarea>
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
                <h4 class="modal-title">基本情報変更</h4>
              </div>
              <div class="modal-body">
                <p>基本情報を変更します。よろしいでしょうか？</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="change-base-info-btn">変更</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-success" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">基本情報変更</h4>
              </div>
              <div class="modal-body">
                <p>基本情報の変更申請を送信しました。</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-error" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>エラー</b></h4>
              </div>
              <div class="modal-body">
                <p>エラーが発生されます。再度してください。</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal-empty" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>警告</b></h4>
              </div>
              <div class="modal-body">
                <p>基本情報は何も変更されていません。変更したい場合は編集して変更ボタンをクリックしてください。</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
  <?php require_once("contents_footer.php"); ?>
</body>
</html>
<script>
  $(document).ready(function() {
    var check_birthday = moment().diff(moment($('input[name=hidden_birthday]').val(), 'YYYYMMDD'), 'years');
    if ( check_birthday >= 20 ) $('#birthday-check').css('display', 'none');
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
            return  school_name_return < 20;
          }
        },
        school_grade: {
          required: function(element) {
            var school_grade_check = $('input[name=hidden_birthday]').val();
            var school_grade_return = moment().diff(moment(school_grade_check, 'YYYYMMDD'), 'years');
            return  school_grade_return < 20;
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
          required: "郵便番号は必須です。ご入力ください。",
          onebyte: "郵便番号は半角英数字のみを入力してください。"
        },
        address: { required: "住所は必須です。ご入力ください。" },
        phone_number: { 
          required: "電話番号は必須です。ご入力ください。",
          onebyte: "電話番号は半角英数字のみを入力してください。",
          maxlength: "11文字以内で入力してください。",
          number: "電話番号は半角英数字のみを入力してください。"
        },
        emergency_tel: {
          onebyte: "緊急連絡先は半角英数字のみを入力してください。",
          maxlength: "11文字以内で入力してください。",
          number: "電話番号は半角英数字のみを入力してください。"
        },
        email_address: {
          required: "メールアドレスは必須です。ご入力ください。",
          email: "正しいメールアドレスを入力してください。"
        },
        school_name: {
          required: "学校名は必須です。ご入力ください。"
        },
        school_grade: {
          required: "学年は必須です。ご入力ください。"
        },
        newpass: {
          minlength: "8半角文字以上で入力してください。",
          onebyte: "パスワードは半角英数字のみを入力してください。"
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
      if ( check_birthday < 20 ) {
        var change_base_info = {
          "postal_code": {
            "before": $('input[name=postal_code]').attr('data-old'),
            "after": postal_code
          },
          "address": {
            "before": $('input[name=address]').attr('data-old'),
            "after": address
          },
          "phone_number": {
            "before": $('input[name=phone_number]').attr('data-old'),
            "after": phone_number
          },
          "emergency_tel": {
            "before": $('input[name=emergency_tel]').attr('data-old'),
            "after": emergency_tel
          },
          "email_address": {
            "before": $('input[name=email_address]').attr('data-old'),
            "after": email_address 
          },
          "school_name": {
            "before": $('input[name=school_name]').attr('data-old'),
            "after": school_name
          },
          "school_grade": {
            "before": $('select[name=school_grade]').attr('data-old'),
            "after": school_grade
          },
          "memo_to_coach": {
            "before": $('textarea[name=memo_to_coach]').attr('data-old'),
            "after": memo_to_coach
          },
          "password": {
            "before": "",
            "after": newpass
          }
        }
      } else {
        var change_base_info = {
          "postal_code": {
            "before": $('input[name=postal_code]').attr('data-old'),
            "after": postal_code
          },
          "address": {
            "before": $('input[name=address]').attr('data-old'),
            "after": address
          },
          "phone_number": {
            "before": $('input[name=phone_number]').attr('data-old'),
            "after": phone_number
          },
          "emergency_tel": {
            "before": $('input[name=emergency_tel]').attr('data-old'),
            "after": emergency_tel
          },
          "email_address": {
            "before": $('input[name=email_address]').attr('data-old'),
            "after": email_address
          },
          "memo_to_coach": {
            "before": $('textarea[name=memo_to_coach]').attr('data-old'),
            "after": memo_to_coach
          },
          "password": {
            "before": "",
            "after": newpass
          }
        }
      }
      var arr_change_info = [];
      if ( check_birthday < 20 ) arr_change_info = ['postal_code', 'address', 'phone_number', 'emergency_tel', 'email_address', 'school_name', 'school_grade', 'memo_to_coach', 'password'];
      else arr_change_info = ['postal_code', 'address', 'phone_number', 'emergency_tel', 'email_address', 'memo_to_coach', 'password'];
      for ( var i = 0; i < arr_change_info.length; i++ ) {
        if ( change_base_info[arr_change_info[i]].before == change_base_info[arr_change_info[i]].after ) delete change_base_info[arr_change_info[i]];
      }
      if ($.isEmptyObject(change_base_info)) $('#modal-empty').modal('show');
      else {
        if ( postal_code != '' && address != '' && phone_number != '' && email_address != '' ) {
          $.ajax({
            url: 'https:' + "<?php echo base_url().'request/change_base_info'; ?>",
            data: { 
              change_base_info : change_base_info
            },
            method: "POST",
            dataType: "json",
            success: function(result) {
              if ( result['update'] == 'success' ) {
                $('#modal-success').modal('show');
                setTimeout(function(){ window.location.href = "<?php echo base_url().'request'; ?>"; }, 2000);
              } else $('#modal-error').modal('show');
            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
              console.log(errorThrown);
            }
          });
        } else {
          $('#modal-error').modal('show');
        }
      }
    });
  });
</script>