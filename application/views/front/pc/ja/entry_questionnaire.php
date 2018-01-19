<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_user_registration.php"); ?>

  <main id="page_init" class="content content-dark">
    <?php
        if ( $check_error == 'error' ) { ?>
          <div class="container">
            <p class="text-center">Đã có lỗi xảy ra, vui lòng thử lại</p>
          </div>
        <?php } else { ?>
    <div class="container">
      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted">
        <div class="panel-heading"></div>
        <div class="panel-body">

          <form class="form-horizontal" id="questionnaire">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <span class="form-send-confirm-display text-light"><?php echo $entry_questionnaire['name']; ?></span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-5">
                <input type="text" name="name_kana" maxlength="64" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group"  style="margin-bottom:0px;">
              <label for="" class="col-xs-12 col-sm-2 control-label">生年月日</label>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="year_of_birth">
                  <option value="1997">1997年</option>
                  <option value="1998">1998年</option>
                  <option value="1999">1999年</option>
                  <option value="2000">2000年</option>
                  <option value="2001">2001年</option>
                  <option value="2002">2002年</option>
                  <option value="2003">2003年</option>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="month_of_birth">
                  <option value="01">1月</option>
                  <option value="02">2月</option>
                  <option value="03">3月</option>
                  <option value="04">4月</option>
                  <option value="05">5月</option>
                  <option value="06">6月</option>
                  <option value="07">7月</option>
                  <option value="08">8月</option>
                  <option value="09">9月</option>
                  <option value="10">10月</option>
                  <option value="11">11月</option>
                  <option value="12">12月</option>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="day_of_birth">
                  <option value="01">1日</option>
                  <option value="02">2日</option>
                  <option value="03">3日</option>
                  <option value="04">4日</option>
                  <option value="05">5日</option>
                  <option value="06">6日</option>
                  <option value="07">7日</option>
                  <option value="08">8日</option>
                  <option value="09">9日</option>
                  <option value="10">10日</option>
                  <option value="11">11日</option>
                  <option value="12">12日</option>
                  <option value="13">13日</option>
                  <option value="14">14日</option>
                  <option value="15">15日</option>
                  <option value="16">16日</option>
                  <option value="17">17日</option>
                  <option value="18">18日</option>
                  <option value="19">19日</option>
                  <option value="20">20日</option>
                  <option value="21">21日</option>
                  <option value="22">22日</option>
                  <option value="23">23日</option>
                  <option value="24">24日</option>
                  <option value="25">25日</option>
                  <option value="26">26日</option>
                  <option value="27">27日</option>
                  <option value="28">28日</option>
                  <option value="29">29日</option>
                  <option value="30">30日</option>
                  <option value="31">31日</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label"></label>
              <div class="msg_birthday col-sm-3"></div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="sex" value="male"> 男性
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value="female"> 女性
                </label>
                <div class="msg_sex"></div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo '〒' . $entry_questionnaire['zip'] . '　' . $entry_questionnaire['address']; ?></strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo $entry_questionnaire['tel']; ?></strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo $entry_questionnaire['email_address']; ?></strong>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">緊急連絡先</label>
              <div class="col-sm-5">
                <input type="text" name="emergency_tel" maxlength="11" class="form-control" value="" placeholder="">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9 col-sm-offset-2">
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <strong class="text-small">入会者が未成年の場合のみ記入</strong>
                  </div>
                  <div class="panel-body text-light">
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">学校名</label>
                      <div class="col-sm-10">
                        <input type="text" name="school_name" maxlength="64" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" name="parent_name" class="col-sm-2 control-label">保護者氏名</label>
                      <div class="col-sm-10">
                        <input type="text" name="parent_name" maxlength="64" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">学年</label>
                      <div class="col-sm-10">
                        <input type="text" name="school_grade" class="form-control" value="" placeholder="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスの利用</label>
              <div class="col-sm-5">
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="0"> 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="1"> 利用しない
                </label>
              </div>
              <div class="col-sm-4">
                <div class="block-15">
                  <a href="#0" class="btn btn-outline-blue btn-small btn-block" target="_blank">
                    <i class="fa fa-external-link-square" aria-hidden="true"></i>
                    <span>送迎バスのご案内</span>
                    <br>
                    <small>(別ウィンドウで開きます)</small>
                  </a>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">申込時の泳力</label>
              <div class="col-sm-10">
                <div class="block-15">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_1" value=""> 水に顔をつけることができない
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_2" value=""> 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_3" value=""> 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_4" value=""> 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select name="swim_skill_5" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select name="swim_skill_6" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select name="swim_skill_7" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select name="swim_skill_8" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select name="swim_skill_9" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select name="swim_skill_10" class="form-control">
                        <option value="0">0m</option>
                        <option value="10">10m</option>
                        <option value="25">25m</option>
                        <option value="50">50m</option>
                        <option value="100">100m</option>
                        <option value="200">200m</option>
                        <option value="300">300m以上</option>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <label for="" class="control-label">備考</label>
                      <input type="text" name="swim_skill_11" maxlength="256" class="form-control" value="" placeholder="">
                    </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_12" value=""> 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_13" value=""> 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="swim_skill_14" value=""> 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>

                  <div class="row block-15">
                    <div class="col-sm-6">
                      <label for="" class="control-label">クラブ名</label>
                      <input type="text" name="swim_skill_15" maxlength="64" class="form-control" value="" placeholder="">
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="control-label">退会</label>
                      <div class="row">
                        <div class="col-xs-6">
                          <select name="swim_skill_16" class="form-control">
                            <option value="2000">2000年</option>
                          </select>
                        </div>
                        <div class="col-xs-6">
                          <select name="swim_skill_17" class="form-control">
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8">8月</option>
                            <option value="9">9月</option>
                            <option value="10">10月</option>
                            <option value="11">11月</option>
                            <option value="12">12月</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">お申込みコース</label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="course_type" value="0"> 新規入会
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">ジュニア</option>
                        </select>
                      </div>
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">週2回</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="course_type" value="1"> 短期水泳教室
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-10 col-sm-8">
                        <select class="form-control">
                          <option value="">春の短期水泳教室(3/25～29)</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" name="course_type" value="2"> 無料体験
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control">
                          <option value="">ジュニア　</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                  <div class="col-sm-12 msg_course_type"></div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コーチへの伝達事項</label>
              <div class="col-sm-10">
                <textarea name="memo_to_coach" maxlength="256" class="form-control" rows="3"></textarea>
              </div>
            </div>

          </form>

        </div>
        <div class="panel-footer text-center">
          <div class="block-30">
            <button class="btn btn-success btn-lg btn-long" id="questionnaire-btn">
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              <span id="confirm">送信内容を確認</span>
            </button>
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
    <?php } ?>
  </main>


  <main id="page_complete" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li class="visited">
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted text-center">
        <div class="panel-heading">
          <div class="block-30 text-break">
            <i class="fa fa-check-circle form-send-confirm-icon" aria-hidden="true"></i>
            <strong>
              <span>このたびは当クラブへの</span>
              <span>お申込みありがとうございました。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">
          <div class="text-light">
            <h5>
              <strong>お申込み番号</strong>
            </h5>
            <p class="form-send-confirm-display">
              <strong></strong>
            </p>
          </div>
          <div class="block-30 text-break">
            <strong>
              <span>当クラブの営業時間内にご来館いただき、</span>
              <span>受付までお申し出ください。</span>
            </strong>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="http://hanamigawa-swim.jp/">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>
      <input type="hidden" name="student_id" value="<?php echo $entry_questionnaire['student_id']; ?>" />
    </div>
  </main>


  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script>
  $(document).ready(function() {
    jQuery.validator.addMethod("katakana", function(value, element) {
      return this.optional(element) || /[\u30A0-\u30FF]|\u203B/.test(value);
    }, "Katakana string");

    jQuery.validator.addMethod("onebyte", function(value, element) {
      return this.optional(element) || !/[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
    }, "Must be 1 byte character");

    jQuery.validator.addMethod("twobyte", function(value, element) {
      return this.optional(element) || /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
    }, "Must be 2 byte character");

    $('#page_complete').css('display','none');
    $('#questionnaire-btn').prop('disabled', 'disabled');
    $('#questionnaire select').on('change', function () {
        if ($('#questionnaire').valid()) {
          $('#questionnaire-btn').prop('disabled', false);
        } else {
          $('#questionnaire-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire input').on('click', function () {
        if ($('#questionnaire').valid()) {
          $('#questionnaire-btn').prop('disabled', false);
        } else {
          $('#questionnaire-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire input').on('keyup blur', function () {
        if ($('#questionnaire').valid()) {
          $('#questionnaire-btn').prop('disabled', false);
        } else {
          $('#questionnaire-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire textarea').on('click', function () {
        if ($('#questionnaire').valid()) {
          $('#questionnaire-btn').prop('disabled', false);
        } else {
          $('#questionnaire-btn').prop('disabled', 'disabled');
        }
    });
    $("#questionnaire").validate({
      rules: {
          name_kana: { 
            required: true,
            katakana: true
          },
          year_of_birth: { required: true },
          month_of_birth: { required: true },
          day_of_birth: { required: true },
          sex: { required: true },
          emergency_tel: { 
            onebyte: true,
            maxlength: 11
          },
          school_name: {
            required: function(element) {
              var school_name_check = $('select[name=year_of_birth]').val() + $('select[name=month_of_birth]').val() + $('select[name=day_of_birth]').val();
              var school_name_return = moment().diff(moment(school_name_check, 'YYYYMMDD'), 'years');
              return  school_name_return < 18;
            },
            twobyte: true
          },
          parent_name: { 
            required: function(element) {
              var parent_name_check = $('select[name=year_of_birth]').val() + $('select[name=month_of_birth]').val() + $('select[name=day_of_birth]').val();
              var parent_name_return = moment().diff(moment(parent_name_check, 'YYYYMMDD'), 'years');
              return  parent_name_return < 18;
            },
            twobyte: true
          },
          school_grade: { 
            required: function(element) {
              var school_grade_check = $('select[name=year_of_birth]').val() + $('select[name=month_of_birth]').val() + $('select[name=day_of_birth]').val();
              var school_grade_return = moment().diff(moment(school_grade_check, 'YYYYMMDD'), 'years');
              return  school_grade_return < 18;
            }
          },
          course_type: { required: true }
      },
      groups: {
        birthday: "year_of_birth month_of_birth day_of_birth"
      },
      errorPlacement: function (error, element) {
        if ( element.attr('name') == 'sex' )
          error.appendTo('.msg_sex');
        else if ( element.attr('name') == 'year_of_birth' || element.attr('name') == 'month_of_birth' || element.attr('name') == 'day_of_birth' )
          error.appendTo('.msg_birthday');
        else if ( element.attr('name') == 'course_type' )
          error.appendTo('.msg_course_type');
        else
          error.insertAfter(element);
      },
      messages: {
          name_kana: { 
            required: "Name kana is required",
            katakana: "Name must be katakana"
          },
          year_of_birth: { required: "Birthday is required" },
          month_of_birth: { required: "Birthday is required" },
          day_of_birth: { required: "Birthday is required" },
          sex: { required: "Sex is required" },
          emergency_tel: { 
            onebyte: "Emergency tel must be 1 byte",
            maxlength: "Maxlength is 11 character"
          },
          school_name: { 
            required: "School name is required",
            twobyte: "School name must be two byte"
          },
          parent_name: { 
            required: "Parent name is required",
            twobyte: "Parent name must be 2 byte"
          },
          school_grade: { required: "School grade is required" },
          course_type: { required: "Course type is required" }
      },
      errorClass: "label label-danger",
      highlight: function (element, errorClass, validClass) {
          return false;
      },
      unhighlight: function (element, errorClass, validClass) {
          return false;
      }
    });

    $('#questionnaire-btn').click(function() {
      var name_kana = $('input[name=name_kana]').val();
      var birthday = $('select[name=year_of_birth]').val() + $('select[name=month_of_birth]').val() + $('select[name=day_of_birth]').val();
      var sex = $('input[name=sex]').val();
      var emergency_tel = $('input[name=emergency_tel]').val();
      var school_name = $('input[name=school_name]').val();
      var parent_name = $('input[name=parent_name]').val();
      var school_grade = $('input[name=school_grade]').val();
      var bus_use_flg = "";
      if( $('input[name=bus_use_flg]').is(':checked') ) bus_use_flg = $('input[name=bus_use_flg]:checked').val();
      var face_into_water = 0;
      var not_face_into_water = 0;
      var dive = 0;
      var float = 0;
      if ( $('input[name=swim_skill_1]').is(":checked") ) face_into_water = 1;
      if ( $('input[name=swim_skill_2]').is(":checked") ) not_face_into_water = 1;
      if ( $('input[name=swim_skill_3]').is(":checked") ) dive = 1;
      if ( $('input[name=swim_skill_4]').is(":checked") ) float = 1;
      var free_lesson = 0;
      var short_lesson = 0;
      var status = 0;
      if ( $('input[name=swim_skill_12]').is(":checked") ) free_lesson = 1;
      if ( $('input[name=swim_skill_13]').is(":checked") ) short_lesson = 1;
      if ( $('input[name=swim_skill_14]').is(":checked") ) status = 1;

      var enquete = {
        "face_into_water": face_into_water,
        "not_face_into_water": not_face_into_water,
        "dive": dive,
        "float": float,
        "style": {
          "flutter_kick": $('select[name=swim_skill_5]').val(),
          "board_kick": $('select[name=swim_skill_6]').val(),
          "backstroke": $('select[name=swim_skill_7]').val(),
          "crawl": $('select[name=swim_skill_8]').val(),
          "breast_stroke": $('select[name=swim_skill_9]').val(),
          "butterfly": $('select[name=swim_skill_10]').val(),
          "note": $('input[name=swim_skill_11]').val()
        },
        "free_lesson": free_lesson,
        "short_lesson": short_lesson,
        "experience": {
          "status": status,
          "club_name": $('input[name=swim_skill_15]').val(),
          "year": $('select[name=swim_skill_16]').val(),
          "month": $('select[name=swim_skill_17]').val(),
        }
      }
      var course_type = $( 'input[name=course_type]:checked' ).val();
      var memo_to_coach = $( 'textarea[name=memo_to_coach]' ).val();
      var student_id = $( 'input[name=student_id]' ).val();
      $.ajax({
        url: 'https:' + "<?php echo base_url().'entry/questionnaire'?>",
        data: { 
          name_kana : name_kana,
          birthday : birthday,
          sex : sex,
          emergency_tel : emergency_tel,
          school_name : school_name,
          parent_name : parent_name,
          school_grade : school_grade,
          bus_use_flg : bus_use_flg,
          enquete : enquete,
          course_type : course_type,
          memo_to_coach : memo_to_coach,
          student_id : student_id
        },
        method: "POST",
        dataType: "json",
        success: function(result) {
          $('.form-send-confirm-display strong').text(result['create_id']);
          $('#page_init').css('display','none');
          $('#page_complete').css('display','block');
        }, error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log('error');
        }
      });
    });
  });
</script>