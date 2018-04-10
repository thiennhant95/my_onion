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
            <p class="text-center">エラーが発生されます。再度してください。</p>
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
                <span class="form-send-confirm-display text-light"><?php echo $s_info['meta']['name']; ?></span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-5">
                <input type="text" name="name_kana" maxlength="64" class="form-control" value="" placeholder="" autofocus>
              </div>
            </div>
            <div class="form-group"  style="margin-bottom:0px;">
              <label for="" class="col-xs-12 col-sm-2 control-label">生年月日</label>
              <div class="col-sm-2">
                <input name="birthday" class="form-control year_month" value=""/>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="sex" value="0"> 男性
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value="1"> 女性
                </label>
                <div class="msg_sex"></div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo '〒' . $s_info['meta']['zip'] . '　' . $s_info['meta']['address']; ?></strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo $s_info['meta']['tel']; ?></strong>
                </p>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <p class="form-send-confirm-text text-light">
                  <strong><?php echo $s_info['info']['email']; ?></strong>
                </p>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">緊急連絡先</label>
              <div class="col-sm-5">
                <input type="tel" name="emergency_tel" maxlength="11" class="form-control" value="" placeholder="">
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
                      <div class="col-sm-3">
                        <select class="form-control" name="school_grade">
                          <?php
                            foreach ( $school_grades as $k => $v ) {
                              echo '<option value="' . $v . '">' .  $v . '</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group" style="float:right;padding-right:15px;">
                      <div style="margin: 0 20px 0 20px;" >
                        <p>上記の者は、良好な健康状態にあり、水泳練習への参加に支障がないものと認め健康状態についての一切とクラブ規則を遵守することを保護責任者のもと申込いたします。同意の場合、チェック入れてくください。</p>
                        <div style="float:right;">
                          <input type="checkbox" name="check_parent" value="" />
                          <label>同意の場合、チェック入れてくください↑</label><br />
                          <label class="msg_check_parent"></label>
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
                  <input type="radio" name="bus_use_flg" value="1"> 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="0"> 利用しない
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
                      <input type="checkbox" name="face_into_water" value=""> 水に顔をつけることができない
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="not_face_into_water" value=""> 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="dive" value=""> 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="float" value=""> 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select name="flutter_kick" class="form-control">
                      <?php 
                        if ( isset( $distance ) && count( $distance ) > 0 ) {
                          foreach ( $distance as $k => $v ) {
                            echo '<option value="' . $v . '">' . $v . 'M</option>';
                          }
                        }
                      ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select name="board_kick" class="form-control">
                        <?php 
                          if ( isset( $distance ) && count( $distance ) > 0 ) {
                            foreach ( $distance as $k => $v ) {
                              echo '<option value="' . $v . '">' . $v . 'M</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select name="backstroke" class="form-control">
                        <?php 
                          if ( isset( $distance ) && count( $distance ) > 0 ) {
                            foreach ( $distance as $k => $v ) {
                              echo '<option value="' . $v . '">' . $v . 'M</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select name="crawl" class="form-control">
                        <?php 
                          if ( isset( $distance ) && count( $distance ) > 0 ) {
                            foreach ( $distance as $k => $v ) {
                              echo '<option value="' . $v . '">' . $v . 'M</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select name="breast_stroke" class="form-control">
                        <?php 
                          if ( isset( $distance ) && count( $distance ) > 0 ) {
                            foreach ( $distance as $k => $v ) {
                              echo '<option value="' . $v . '">' . $v . 'M</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select name="butterfly" class="form-control">
                        <?php 
                          if ( isset( $distance ) && count( $distance ) > 0 ) {
                            foreach ( $distance as $k => $v ) {
                              echo '<option value="' . $v . '">' . $v . 'M</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <label for="" class="control-label">備考</label>
                      <input type="text" name="note" maxlength="256" class="form-control" value="" placeholder="">
                    </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="free_lesson" value=""> 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="short_lesson" value=""> 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="status" value=""> 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>

                  <div class="row block-15">
                    <div class="col-sm-6">
                      <label for="" class="control-label">クラブ名</label>
                      <input type="text" name="club_name" maxlength="64" class="form-control" value="" placeholder="">
                    </div>
                    <div class="col-sm-3">
                      <label for="" class="control-label">退会年月</label>
                      <div class="row">
                        <input name="year_month" class="form-control year_month" value=""/>
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
                  <?php $disabled = ( count( $course_type_0 ) > 0 ) ? '' : 'disabled'; ?>
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" <?php echo $disabled; ?> name="course_type" onclick="select_course(this.value)" value="0"> 新規入会
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-10 col-sm-8">
                        <select class="form-control" name="course_type_0" <?php echo $disabled; ?>>
                        <?php
                          foreach ( $course_type_0 as $key => $value ) {
                            $start_date = $value['start_date'];
                            if ( $start_date == '0000-00-00' ) $start_date = date( 'm/d' );
                            echo '<option value="' . $value['course_id'] . '">' . $value['course_name'] . '(' . $start_date . '～' . date_format( date_create( $value['end_date'] ), 'm/d' ) . ')</option>';
                          }
                        ?>
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
                  <?php $disabled = ( count( $course_type_1 ) > 0 ) ? '' : 'disabled'; ?>
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" <?php echo $disabled; ?> name="course_type" onclick="select_course(this.value)" value="1"> 短期水泳教室
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-10 col-sm-8">
                        <select class="form-control" name="course_type_1" <?php echo $disabled; ?>>
                          <?php
                            foreach ( $course_type_1 as $key => $value ) {
                              $start_date = $value['start_date'];
                              if ( $start_date == '0000-00-00' ) $start_date = date( 'm/d' );
                              echo '<option value="' . $value['course_id'] . '">' . $value['course_name'] . '(' . $start_date . '～' . date_format( date_create( $value['end_date'] ), 'm/d' ) . ')</option>';
                            }
                          ?>
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
                  <?php $disabled = ( count( $course_type_2 ) > 0 ) ? '' : 'disabled'; ?>
                  <div class="col-sm-3 col-md-2">
                    <div class="radio">
                      <label>
                        <input type="radio" <?php echo $disabled; ?> name="course_type" onclick="select_course(this.value)" value="2"> 無料体験
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-xs-5 col-sm-4">
                        <select class="form-control" name="course_type_2" <?php echo $disabled; ?>>
                          <?php
                            foreach ( $course_type_2 as $key => $value ) {
                              echo '<option value="' . $value['course_id'] . '">' . $value['course_name'] . '</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
            <div class="col-sm-2"></div>
              <div class="col-sm-10">
                 <div class="row">
                      <div class="col-xs-5 col-sm-10">
                      <label>
                      無料体験希望日<input type="text" class="form-control" name="join_date" value="" disabled readonly>
                      </label>
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
                <h4 class="modal-title">申込み</h4>
              </div>
              <div class="modal-body">
                <p>申込みます。よろしいでしょうか？</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="questionnaire-btn">申込み</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
              </div>
            </div>
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


  <main id="page_complete" class="content content-dark" style="display:block !important;">
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
          <div class="text-left parent-text" style="padding: 0 25% 0 25%;display:none;">
            <strong>
              <span>■重要■　成人のご入会者様にご案内</span><br />
              <span>①ご来館前に、本人以外のご家族様に<a href="#">誓約書(要ｸﾘｯｸ)</a> の内容をご確認・同意をお願いします。</span><br />
                <span>②<a href="#">ライフチェックシート(要ｸﾘｯｸ)</a>を印刷、ご記入いただき、ご来館時にご持参ください。(印刷できない場合は、窓口にてご記入頂けますが、必ず事前にご確認下さい)</span>
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
      <input type="hidden" name="student_id" value="<?php echo $s_info['info']['id']; ?>" />
    </div>
  </main>


  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script>
  function select_course( value ) {
    if ( value == 2 ) $('input[name=join_date]').removeAttr('disabled');
    else {
      $('input[name=join_date]').attr('disabled', 'disabled');
      $('input[name=join_date]').val('');
    }
  }
  $(document).ready(function() {
    var options = {
      format: 'yyyy-mm-dd',
      todayBtn: "linked",
      todayHighlight: true,
      autoclose: true,
      language:'jp'
    };

    $.fn.datepicker.dates['jp'] = {
        days: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
        months:  ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
        monthsShort:  ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
        today: "今日",
        clear: "クリア",
        weekStart: 0
    };
    var options_year_month={
        isRTL: false,
        format: 'yyyy-mm',
        minViewMode: 'months',
        todayHighlight: true,
        autoclose: true,
        language:'jp',
        orientation: "auto right",
    };

    $('input[name=year_month]').datepicker(options_year_month);

    $('input[name=birthday]').datepicker(options);
    $('input[name=join_date]').datepicker(options);

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
    $('#confirm-btn').prop('disabled', 'disabled');
    $('#questionnaire select').on('change', function () {
        if ($('#questionnaire').valid()) {
          $('#confirm-btn').prop('disabled', false);
        } else {
          $('#confirm-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire input:not(.year_month)').on('click', function () {
        if ($('#questionnaire').valid()) {
          $('#confirm-btn').prop('disabled', false);
        } else {
          $('#confirm-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire input:not(.year_month)').on('keyup blur', function () {
        if ($('#questionnaire').valid()) {
          $('#confirm-btn').prop('disabled', false);
        } else {
          $('#confirm-btn').prop('disabled', 'disabled');
        }
    });
    $('#questionnaire textarea').on('click', function () {
        if ($('#questionnaire').valid()) {
          $('#confirm-btn').prop('disabled', false);
        } else {
          $('#confirm-btn').prop('disabled', 'disabled');
        }
    });
    $("#questionnaire").validate({
      rules: {
          name_kana: { 
            required: true,
            katakana: true
          },
          birthday: { required: true },
          sex: { required: true },
          emergency_tel: { 
            required: true,
            number: true,
            digits: true,
            maxlength: 11
          },
          school_name: {
            required: function(element) {
              var school_name_check = $('input[name=birthday]').val();
              var school_name_return = moment().diff(moment(school_name_check, 'YYYY-MM-DD'), 'years');
              return  school_name_return < 20;
            },
            twobyte: true
          },
          parent_name: { 
            required: function(element) {
              var parent_name_check = $('input[name=birthday]').val();
              var parent_name_return = moment().diff(moment(parent_name_check, 'YYYY-MM-DD'), 'years');
              return  parent_name_return < 20;
            },
            twobyte: true
          },
          school_grade: { 
            required: function(element) {
              var school_grade_check = $('input[name=birthday]').val();
              var school_grade_return = moment().diff(moment(school_grade_check, 'YYYY-MM-DD'), 'years');
              return  school_grade_return < 20;
            }
          },
          check_parent: { 
            required: function(element) {
              var school_check_parent = $('input[name=birthday]').val();
              var school_check_parent_return = moment().diff(moment(school_check_parent, 'YYYY-MM-DD'), 'years');
              return  school_check_parent_return < 20;
            }
          },
          course_type: { required: true }
      },
      errorPlacement: function (error, element) {
        if ( element.attr('name') == 'sex' )
          error.appendTo('.msg_sex');
        else if ( element.attr('name') == 'course_type' )
          error.appendTo('.msg_course_type');
        else if ( element.attr('name') == 'check_parent' )
          error.appendTo('.msg_check_parent');
        else
          error.insertAfter(element);
      },
      messages: {
          name_kana: { 
            required: "フリガナは必須です。ご入力ください。",
            katakana: "フリガナは全角カナのみを入力してください。"
          },
          birthday: { required: "生年月日は必須です。ご入力ください。" },
          sex: { required: "性別は必須です。ご入力ください。" },
          emergency_tel: { 
            required: "緊急連絡先は必須です。ご入力ください。",
            number: "緊急連絡先は半角英数字のみを入力してください。",
            digits: "緊急連絡先は半角英数字のみを入力してください。",
            maxlength: "11文字以内で入力してください。"
          },
          school_name: { 
            required: "学校名は必須です。ご入力ください。",
            twobyte: "学校名は全角文字のみを入力してください。"
          },
          parent_name: { 
            required: "保護者氏名は必須です。ご入力ください。",
            twobyte: "保護者氏名は全角文字のみを入力してください。"
          },
          school_grade: { required: "学年は必須です。ご入力ください。" },
          check_parent: { required: "同意の場合、チェック入れてくください↑は必須です。ご入力ください。" },
          course_type: { required: "お申込みコースは必須です。ご入力ください。" }
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
      var birthday = $('input[name=birthday]').val();
      var sex = $('input[name=sex]').val();
      var emergency_tel = $('input[name=emergency_tel]').val();
      var school_name = $('input[name=school_name]').val();
      var parent_name = $('input[name=parent_name]').val();
      var school_grade = $('select[name=school_grade] option:selected').val();
      var bus_use_flg = "";
      if( $('input[name=bus_use_flg]').is(':checked') ) bus_use_flg = $('input[name=bus_use_flg]:checked').val();
      var face_into_water = 0;
      var not_face_into_water = 0;
      var dive = 0;
      var float = 0;
      if ( $('input[name=face_into_water]').is(":checked") ) face_into_water = 1;
      if ( $('input[name=not_face_into_water]').is(":checked") ) not_face_into_water = 1;
      if ( $('input[name=dive]').is(":checked") ) dive = 1;
      if ( $('input[name=float]').is(":checked") ) float = 1;
      var free_lesson = 0;
      var short_lesson = 0;
      var status = 0;
      if ( $('input[name=free_lesson]').is(":checked") ) free_lesson = 1;
      if ( $('input[name=short_lesson]').is(":checked") ) short_lesson = 1;
      if ( $('input[name=status]').is(":checked") ) status = 1;
      var year_month = '';
      if ( $('input[name=year_month]').val() != '' ) {
        year_month = $('input[name=year_month]').val();
        year_month = year_month.split('-');
      } else {
        year_month = ['', ''];
      }
      var enquete = {
        "face_into_water": face_into_water,
        "not_face_into_water": not_face_into_water,
        "dive": dive,
        "float": float,
        "style": {
          "flutter_kick": $('select[name=flutter_kick]').val(),
          "board_kick": $('select[name=board_kick]').val(),
          "backstroke": $('select[name=backstroke]').val(),
          "crawl": $('select[name=crawl]').val(),
          "breast_stroke": $('select[name=breast_stroke]').val(),
          "butterfly": $('select[name=butterfly]').val(),
          "note": $('input[name=note]').val()
        },
        "free_lesson": free_lesson,
        "short_lesson": short_lesson,
        "experience": {
          "status": status,
          "club_name": $('input[name=club_name]').val(),
          "year": year_month[0],
          "month": year_month[1],
        }
      }
      var course_type = $( 'input[name=course_type]:checked' ).val();
      var course_lesson = '';
      if ( course_type == 0 ) course_lesson = $( 'select[name=course_type_0] option:selected' ).val();
      if ( course_type == 1 ) course_lesson = $( 'select[name=course_type_1] option:selected' ).val();
      if ( course_type == 2 ) course_lesson = $( 'select[name=course_type_2] option:selected' ).val();
      var memo_to_coach = $( 'textarea[name=memo_to_coach]' ).val();
      var student_id = $( 'input[name=student_id]' ).val();
      var join_date = $( 'input[name=join_date]').val();
      var birthday_check = moment().diff(moment(birthday, 'YYYYMMDD'), 'years');
      if ( name_kana != '' && birthday != '' && course_type != '' ) {
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
            course_lesson : course_lesson,
            memo_to_coach : memo_to_coach,
            student_id : student_id,
            join_date : join_date
          },
          method: "POST",
          dataType: "json",
          success: function(result) {
            $('.form-send-confirm-display strong').text(result['student_id']);
            $('#page_init').css('display','none');
            $('#page_complete').css('display','block');
            if ( birthday_check >= 20 ) $('.parent-text').css('display', 'block');
          }, error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log( errorThrown );
          }
        });
      } else {
        $('#modal-error').modal( 'show' );
      }
    });
  });
</script>