<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
  <style>
    div.error { color: red; font-weight: bold; }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0; 
    }
    .msg_email_address {
      background: #d9534f;
      display: inline;
      padding: .2em .6em .3em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: .25em;
    }
  </style>
</head>

<body>
  <?php require_once("contents_header_user_registration.php"); ?>

  <main id="page_init" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

<div class="panel panel-doted">
        <div class="panel-heading">
          <div class="h4 block-30 text-break text-center">
            <strong>
              <span>無料体験・短期水泳教室・入会をご希望される方は、</span>
              <span>予めこちらからお申込みをいただきますと</span>
              <span>来館時のお手続きにかかる時間が短くなります。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">

          <form class="form-horizontal" id="register" method="post">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <input type="text" name="user_name" maxlength="64" class="form-control" value="" placeholder="">
                <div class="msg_user_name"></div>
                <small>
                  <sup>※</sup>お子様が受講される場合は、お子様ご本人のお名前をご記入ください。</small>
              </div>
            </div>

            <div class="form-group" style="margin-bottom:0px;">
              <label for="" class="col-xs-12 col-sm-2 control-label">郵便番号</label>
              <div class="col-xs-3 col-sm-2 col-md-1 postal-code-line">
                <input type="text" name="postal_code1" class="form-control" maxlength="3" value="" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 col-md-1">
                <input type="text" name="postal_code2" class="form-control" maxlength="4" value="" placeholder="">
              </div>
              <div class="col-xs-3">
                <button type="button" onclick="AjaxZip3.zip2addr('postal_code1','postal_code2','address', 'address');" class="btn btn-main">&#12306; 住所に反映</button>
              </div><br />
            </div>
            <div class="form-group">
              <div class="col-sm-2"></div>
              <div class="col-sm-3 msg_postal_code"></div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <input type="text" name="address" maxlength="128" class="form-control" value="" placeholder="">
                <div class="msg_address"></div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <input type="tel" name="phone_number" maxlength="11" class="form-control" value="" placeholder="">
                <div class="msg_phone_number"></div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <input type="email" name="email_address" onkeyup="remove_error()" maxlength="64" class="form-control" value="" placeholder="">
                <label class="msg_email_address"></label>
                <div>
                  <sup>※</sup>フィルタリング設定等で「xxx.xx.xx」からのメールを受信できるようになっているかご確認ください。
                </div>
              </div>
            </div>
            <div class="panel-footer text-center">
              <div class="block-30">
                <button type="button" class="btn btn-success btn-lg btn-long" id="confirm-btn" data-toggle="modal" data-target="#modal-confirm">
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                  <span id="confirm">送信内容を確認</span>
                </button>
              </div>
            </div>

            <div class="modal fade" id="modal-confirm" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm register</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to register?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="register-btn">Register</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <p>There was an error, please try again</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="err_msg"><!-- message --></div>
          </form>

        </div>
        
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="http://hanamigawa-swim.jp/">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>

  <main id="page_complete" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted text-center">
        <div class="panel-heading">
          <div class="block-30 text-break">
            <i class="fa fa-envelope-o form-send-confirm-icon" aria-hidden="true"></i>
            <strong>
              <span>ご記入いただきましたメールアドレス宛てに</span>
              <span>ご案内のメールを送信いたしました。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">
          <p class="form-send-confirm-display text-light">
            <strong></strong>
          </p>
          <div class="block-30 text-break">
            <strong>
              <span>引き続きメール内に記載のURLより、</span>
              <span>お申込みアンケートをご記入ください。</span>
            </strong>
          </div>
        </div>
      </div>

      <div class="block-15">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 text-light">
            <p>
              <strong class="text-small">
                <sup>※</sup>もしメールが届いていない場合は、上記メールアドレスが正しいか、念のため迷惑メールフォルダの中に入っていないか、フィルタリング設定等で「xxx.xx.xx」からのメールを受信できるようになっているかご確認ください。
              </strong>
            </p>
            <p>
              <strong class="text-small">
                <sup>※</sup>メールソフトの設定や使い方等についてのご質問にはお答えいたしかねますので、ご利用されております携帯電話キャリアやインターネットプロバイダーへご確認ください
              </strong>
            </p>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="http://hanamigawa-swim.jp/">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>
  <?php require_once("contents_footer.php"); ?>
</body>
</html>
<script>
    function remove_error() {
        $('.msg_email_address').css('display', 'none');
    }
    $(document).ready(function() {

        jQuery.validator.addMethod("onebyte", function(value, element) {
            return this.optional(element) || !/[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
        }, "Must be 1 byte character");

        jQuery.validator.addMethod("twobyte", function(value, element) {
            return this.optional(element) || /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
        }, "Must be 2 byte character");

        $('#confirm-btn').prop('disabled', 'disabled');
        $('.msg_email_address').css('display', 'none');
        $("#register").validate({
            rules: {
                user_name: {
                    required: true,
                    twobyte: true
                },
                postal_code1: {
                    required: true,
                    number: true
                },
                postal_code2: {
                    required: true,
                    number: true
                },
                address: { required: true },
                phone_number: {
                    required: true,
                    number: true
                },
                email_address: {
                    required: true,
                    email: true
                }
            },
            groups: {
                postal_code: "postal_code1 postal_code2"
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "postal_code1" || element.attr("name") == "postal_code2")
                    error.appendTo(".msg_postal_code");
                else
                    error.insertAfter(element);
            },
            messages: {
                user_name: {
                    required: "Username is required",
                    twobyte: "Username must be 2 byte"
                },
                postal_code1: {
                    required: "Postal code is required",
                    number: "Postal code must be number 1 byte"
                },
                postal_code2: {
                    required: "Postal code is required",
                    number: "Postal code must be number 1 byte"
                },
                address: { required: "Address is required" },
                phone_number: {
                    required: "Phone number is required",
                    number: "Phone number must be number"
                },
                email_address: {
                    required: "Email address is required",
                    email: "Email is invalid"
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

        $('#register input').on('keyup blur', function () {
            if ($('#register').valid()) {
                $('#confirm-btn').prop('disabled', false);
            } else {
                $('#confirm-btn').prop('disabled', 'disabled');
            }
        });

        $('#register input').on('click', function () {
            if ($('#register').valid()) {
                $('#confirm-btn').prop('disabled', false);
            } else {
                $('#confirm-btn').prop('disabled', 'disabled');
            }
        });

        $('#page_complete').css('display','none');
        $('#register-btn').click(function() {
            var user_name = $('input[name=user_name]').val();
            var postal_code1 = $('input[name=postal_code1]').val();
            var postal_code2 = $('input[name=postal_code2]').val();
            var address = $('input[name=address]').val();
            var phone_number = $('input[name=phone_number]').val();
            var email_address = $('input[name=email_address]').val();
            var data = {
                user_name : user_name,
                postal_code :  postal_code1 + '-' + postal_code2,
                address : address,
                phone_number : phone_number,
                email_address : email_address
            }
            if ( user_name != '' && postal_code1 != '' && postal_code2 != '' && address != '' && phone_number != '' && email_address != '' ) {
              $.ajax({
                  url: 'https:' + "<?php echo base_url().'entry'?>",
                  data: data,
                  method: "POST",
                  dataType: "json",
                  success: function(result) {
                      console.log('success ok');
                      if (result['insert'] == 'email_exists') {
                          console.log('email exit');
                          $('.msg_email_address').text('This email already exists');
                          $('.msg_email_address').css('display', 'inline');
                      } else {
                          console.log( 'hien thi' );
                          $('.form-send-confirm-display strong').text(email_address);
                          $('#page_init').css('display','none');
                          $('#page_complete').css('display','block');
                      }
                  }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                      console.log('error');
                  }
              });
            } else {
              $('#modal-error').modal( 'show' );
            }
        });
    });
</script>
