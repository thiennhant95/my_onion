<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main id="page_init" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          
          <div class="rounded-corners-1 mb-50">
            <h2 class="title-1 mb-20">新規お申込み</h2>
            <form class="form-horizontal" id="entry-edit">
              <section>
                <div class="panel panel-card">
                  <div class="panel-heading bg-midnight-Blue align-left pl-30">本日の初日会員一覧（2名）</div>
                  <div class="panel-body-2 bg-albatre table-responsive">
                    <table class="table table-style-1">
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">氏名</th>
                        <td class="bg-white table-border-none">
                          <input name="user_name" class="form-control w-sm-50per w-xl-60per" value="<?php echo $s_info['meta']['name']; ?>" placeholder="" type="text">
                          <input type="hidden" name="student_id" value="<?php echo $s_info['info']['id']; ?>" />
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">フリガナ</th>
                        <td class="bg-white table-border-none">
                          <input name="name_kana" class="form-control w-sm-50per w-xl-60per" value="<?php echo $s_info['meta']['name_kana']; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">生年月日</th>
                        <td class="bg-white table-border-none">
                          <input name="birthday" class="form-control w-xs-100per w-md-30per" value="<?php echo date_format(date_create($s_info['meta']['birthday']), 'Y-m-d'); ?>" readonly />
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">性別</th>
                        <td class="bg-white table-border-none">
                          <div class="col-sm-10 text-gray">
                            <label class="radio-inline">
                              <input name="sex" value="male" <?php if( $s_info['meta']['sex'] == 'male' ) echo 'checked'; ?> type="radio"> 男性
                            </label>
                            <label class="radio-inline">
                              <input name="sex" value="female" <?php if( $s_info['meta']['sex'] == 'female' ) echo 'checked'; ?> type="radio"> 女性
                            </label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">郵便番号</th>
                        <td class="bg-white table-border-none">
                          <div class="row post-input">
                            <?php
                              $postal_code = explode('-', $s_info['meta']['zip']);
                            ?>
                            <div class="col-xs-6 col-md-3 postal-code-line postal-code-line-gray">
                              <input name="postal_code1" class="form-control post-input-main" value="<?php echo $postal_code[0]; ?>" placeholder="" type="number">
                            </div>
                            <div class="col-xs-6 col-md-3">
                              <input name="postal_code2" class="form-control post-input-main" value="<?php echo $postal_code[1]; ?>" placeholder="" type="number">
                            </div>
                            <div class="col-xs-12 col-md-3">
                              <button type="button" onclick="AjaxZip3.zip2addr('postal_code1','postal_code2','address', 'address');" class="btn btn-main">〒 住所に反映</button>
                            </div>
                          </div>
                          <div class="msg_postal_code"></div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">住所</th>
                        <td class="bg-white table-border-none">
                          <input name="address" class="form-control w-xs-100per" value="<?php echo $s_info['meta']['address']; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">メールアドレス</th>
                        <td class="bg-white table-border-none">
                          <div class="row">
                            <div class="col-sm-6">
                              <input name="email_address" class="form-control w-xs-100per" value="<?php echo $s_info['info']['email']; ?>" placeholder="" type="text">
                            </div>
                            <div class="col-sm-6 text-gray">
                              <label><input name="email_flg" value="" type="checkbox"> メールアドレスなし</label>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none vertical-align-middle">電話番号</th>
                        <td class="bg-white table-border-none">
                          <input name="phone_number" class="form-control w-sm-50per w-xl-60per" value="<?php echo $s_info['meta']['tel']; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">緊急連絡先</th>
                        <td class="bg-white table-border-none">
                          <input name="emergency_tel" class="form-control w-sm-50per w-xl-60per" value="<?php echo isset( $s_info['meta']['emergency_tel'] ) ? $s_info['meta']['emergency_tel'] : ''; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </section>


              <section class="mb-30">
                <div class="panel panel-card">
                  <div class="panel-heading bg-rouge align-left pl-30">【入会者が未成年の場合】</div>
                  <div class="panel-body-2 pt-10 bg-milky-pink table-responsive">
                    <h2 class="title-1 mb-20" style="text-decoration: underline;">※入会者が未成年の場合のみ記入</h2>
                    <table class="table table-style-1" width="100%" class="text-gray">
                      <tr>
                        <th class="align-right table-border-none">保護者氏名</th>
                        <td class="bg-white table-border-none">
                          <input name="parent_name" class="form-control w-sm-50per w-xl-60per" value="<?php echo isset( $s_info['meta']['parent_name'] ) ? $s_info['meta']['parent_name'] : ''; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">学校名</th>
                        <td class="bg-white table-border-none">
                          <input name="school_name" class="form-control w-sm-50per w-xl-60per" value="<?php echo isset( $s_info['meta']['school_name'] ) ? $s_info['meta']['school_name'] : ''; ?>" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">学年</th>
                        <td class="bg-white table-border-none">
                          <select name="school_grade" class="form-control w-xs-100per w-md-40per">
                            <?php
                              foreach ( $school_grades as $key => $value ) {
                                echo '<option value="' . $value . '" '; if ( $value == $s_info['meta']['school_grade'] ) echo 'selected'; echo '>' . $value . '</option>';
                              }
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </section>

              <section class="mb-30">
                <div class="panel panel-card">
                  <div class="panel-heading bg-rouge align-left pl-30">※誓約書連名ご家族（入会者が成人の場合のみ記入）</div>
                  <div class="panel-body-2 pt-10 bg-milky-pink table-responsive">
                    <table class="table table-style-1" width="100%" class="text-gray">
                      <tr>
                        <th class="align-right table-border-none">家族氏名</th>
                        <td class="bg-white table-border-none">
                          <input name="family" class="form-control w-sm-50per w-xl-60per" value="" placeholder="" type="text">
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">続柄</th>
                        <td class="bg-white table-border-none">
                          <select name="relationship" class="form-control w-xs-100per w-md-40per">
                            <option>---</option>
                            <option value="父">父</option>
                            <option value="母">母</option>
                            <option value="夫・妻">夫・妻</option>
                            <option value="兄弟">兄弟</option>
                            <option value="子">子</option>
                            <option value="祖父母">祖父母</option>
                            <option value="その他">その他</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </section>


              <section>

                <div class="panel panel-card">
                  <div class="panel-heading g-green bg-deep-green align-left pl-30">【希望練習コース・泳力アンケートなど】</div>
                  <div class="panel-body-2 pt-10 bg-ice-green table-responsive">
                    <h2 class="title-1 mb-20" style="text-decoration: underline;">※入会者が未成年の場合のみ記入</h2>
                    <input type="hidden" value="<?php echo isset( $s_info['course']['nearest'][0]['practice_max'] ) ? $s_info['course']['nearest'][0]['practice_max'] : ''; ?>" name="practice_max" />
                    <table class="table table-style-1" width="100%" class="text-gray">
                      <tr>
                        <th class="align-right table-border-none">希望練習コース</th>
                        <td class="bg-white text-gray table-border-none"><?php echo isset( $s_info['course']['nearest'][0]['course_name'] ) ? $s_info['course']['nearest'][0]['course_name'] : ''; ?></td>
                      </tr>
                      <tr>
                        <th class="align-right bg-plae-lemmon text-gray table-border-none">コースコード<br><span style="font-size:11px">（スタッフ入力欄）</span></th>
                        <td class="bg-white table-border-none">
                          <select class="form-control w-xs-100per" id="change-course" onchange="change_course(this.value, <?php echo $s_info['info']['id']; ?>)">
                          <?php
                            foreach ( $course_valid as $k => $v ) {
                              $selected = ( $v['id'] == $s_info['course']['nearest'][0]['course_id'] ) ? 'selected' : '';
                              echo '<option value="' . $v['id'] . '" ' . $selected . '>' . $v['course_name'] . '</option>';
                            }
                          ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th></th>
                        <td style="display:inline;">
                          <div class="form-inline display_class">
                            
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none ">クラス早見表</th>
                        <td class="bg-white table-border-none">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover table-lg table-center" id="table-schedule">
                              <thead>
                                <tr>
                                  <th>　</th>
                                  <th>M<br>11:00～</th>
                                  <th>A<br>13:30～</th>
                                  <th>B<br>14:40～</th>
                                  <th>C<br>15:55～</th>
                                  <th>D<br>17:05～</th>
                                  <th>E<br>18:05～</th>
                                  <th>F<br>19:20～</th>
                                </tr>
                              </thead>
                              <tbody class="html_display">
                                  <?php echo $html; ?>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="align-right table-border-none">申請時の泳力</th>
                        <td class="bg-white table-border-none pl-30">
                          <div class="row text-gray mb-15">
                          <?php $arr_enquete = json_decode( $s_info['meta']['enquete'], true ); ?>
                            <div class="checkbox">
                              <label class="radio-inline">
                                <input name="face_into_water" value="" type="checkbox" <?php if ( $arr_enquete['face_into_water'] == '1' ) echo 'checked'; ?>> 水に顔をつけることができ
                              </label><br>
                              <label class="radio-inline">
                                <input name="not_face_into_water" value="" type="checkbox" <?php if ( $arr_enquete['not_face_into_water'] == '1' ) echo 'checked'; ?>> 水に顔をつけることができない
                              </label><br>
                              <label class="radio-inline">
                                <input name="dive" value="" type="checkbox" <?php if ( $arr_enquete['dive'] == '1' ) echo 'checked'; ?>> 潜れる
                              </label><br>
                              <label class="radio-inline">
                                <input name="float" value="" type="checkbox" <?php if ( $arr_enquete['float'] == '1' ) echo 'checked'; ?>> 浮かべる
                              </label>
                            </div>
                          </div>
                         
                          <div class="row mb-15">
                            <table>
                              <tr>
                                <td>バタ足</td>
                                <td>
                                  <select name="flutter_kick" class="form-control w-xs-100per">
                                    <?php 
                                      $arr_m = array('0', '10', '25', '50', '100', '200', '300');
                                      $selected = '';
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['flutter_kick'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                                <td class="pl-30">板キック</td>
                                <td>
                                  <select name="board_kick" class="form-control w-xs-100per">
                                    <?php 
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['board_kick'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>背泳ぎ</td>
                                <td>
                                  <select name="backstroke" class="form-control w-xs-100per">
                                    <?php
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['backstroke'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                                <td class="pl-30">クロール</td>
                                <td>
                                  <select name="crawl" class="form-control w-xs-100per">
                                    <?php
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['crawl'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                              <tr>
                                <td>平泳ぎ</td>
                                <td>
                                  <select name="breast_stroke" class="form-control w-xs-100per">
                                    <?php 
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['breast_stroke'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                                <td class="pl-30">バタフライ</td>
                                <td>
                                  <select name="butterfly" class="form-control w-xs-100per">
                                    <?php
                                      foreach ( $arr_m as $key => $value ) {
                                        $selected = ( $arr_enquete['style']['butterfly'] == $value ) ?  'selected' : '';
                                        if ( $value != end( $arr_m ) ) echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M</option>';
                                        else echo '<option value="' . $value . '" ' . $selected . '>' . $value . 'M以上</option>';
                                      }
                                    ?>
                                  </select>
                                </td>
                              </tr>
                            </table>
                          </div>
                          
                          <div class="row text-gray mb-15">
                            備考　<input name="note" value="<?php echo $arr_enquete['style']['note'] ?>" class="form-control w-xs-75per" type="text">
                          </div>

                          <div class="row text-gray mb-15">
                            <div class="checkbox">
                              <label>
                                <input name="free_lesson" value="" type="checkbox" <?php if ( $arr_enquete['free_lesson'] == '1' ) echo 'checked'; ?>> 無料体験に参加したことがある
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input name="short_lesson" value="" type="checkbox" <?php if ( $arr_enquete['short_lesson'] == '1' ) echo 'checked'; ?>> 短期水泳教室に参加したことがある
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input name="status" value="" type="checkbox" <?php if ( $arr_enquete['experience']['status'] == '1' ) echo 'checked'; ?>> 当クラブまたは他クラブに通っていたことがある
                              </label>
                            </div>
                          </div>

                          <div class="text-gray mb-15">
                            <div class="form-group row">
                              クラブ名　<input name="club_name" value="<?php echo $arr_enquete['experience']['club_name']; ?>" class="form-control select-type-1 w-xs-20per" type="text">　
                              <input type="text" class="form-control select-type-1 w-xs-20per" name="year_month" value="<?php if ( $arr_enquete['experience']['year'] != '' && $arr_enquete['experience']['month'] != '' ) echo $arr_enquete['experience']['year']. '-' . $arr_enquete['experience']['month']; ?>" readonly/>
                            </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none">コーチへの<br>伝達事項</th>
                        <td class="bg-white table-border-none text-gray">
                          <textarea name="memo_to_coach" class="form-control w-xs-100per" rows="1"><?php echo isset( $s_info['meta']['memo_to_coach'] ) ? $s_info['meta']['memo_to_coach'] : ''; ?></textarea>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none">バスの利用</th>
                        <td class="bg-white table-border-none text-gray">
                          <div class="text-gray">
                            <label class="radio-inline"><input name="bus_use_flg" onclick="disabled_bus(this.value)" value="1" <?php if ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == '1' ) echo 'checked'; ?> type="radio"> する</label>　
                            <label class="radio-inline"><input name="bus_use_flg" onclick="disabled_bus(this.value)" value="0" <?php if ( isset( $s_info['meta']['bus_use_flg'] ) && $s_info['meta']['bus_use_flg'] == '0' ) echo 'checked'; ?> type="radio"> しない</label>
                          </div>
                          <div class="mb-15 display_bus">
                            
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">IC カード番号</th>
                        <td class="bg-white table-border-none text-gray">
                          <input name="iccard" class="form-control select-type-1 w-xs-50per" value="<?php echo isset( $s_info['meta']['iccard'] ) ? $s_info['meta']['iccard'] : ''; ?>" type="text">　
                          <a class="button-link-1 bg-deep-green" href="">最新読込カードIDを反映</a>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">ライフチェック</th>
                        <td class="bg-white table-border-none text-gray">
                            <div class="checkbox">
                              <label>
                                <input name="life_check_flg" value="" type="checkbox" <?php if ( isset( $s_info['meta']['life_check_flg'] ) && $s_info['meta']['life_check_flg'] == '1' ) echo 'checked'; ?>>
                              </label>
                            </div>
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right text-gray table-border-none vertical-align-middle">初回レッスン日</th>
                        <td class="bg-white table-border-none">
                        <input name="first_lesson_date" class="form-control w-xs-30per" value="<?php echo isset( $s_info['meta']['first_lesson_date'] ) ? $s_info['meta']['first_lesson_date'] : ''; ?>" readonly />
                        </td>
                      </tr>

                      <tr>
                        <th class="align-right bg-plae-lemmon text-gray table-border-none">メモ・特記事項<br>
                        <span style="font-size:11px">（スタッフ用）</span></th>
                        <td class="bg-white table-border-none text-gray">
                          <textarea name="memo_special" class="form-control w-xs-100per" rows="1"></textarea>
                        </td>
                      </tr>

                    </table>
                  </div>
                </div>
              </section>

              <div class="block-30 align-center">
                <button type="button" class="btn bg-light-blue btn-lg btn-long" id="btn-entry-next">
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                  <span id="button_entry_explain">誓約書へ</span>
                </button>
              </div>
            </form>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_explain" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3 mb-50">
            <h2 class="title-3 mb-20">新入会員の皆様へ</h2>
            <div class="pdf-area">
              <object data="/images/hanamigawasw/test.pdf" type="application/pdf" width="100%" height="100%">
                <iframe src="test.pdf" width="100%" height="100%">
                  <p><b>表示されない時の表示</b>: <a href="test.pdf">PDF をダウンロード</a>.</p>
                </iframe>
              </object>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_entry_contract">誓約書へ</span>
              </a>
            </div>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>


  <main id="entry_minority" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <div class="box-style-2">
              <h2 class="title-2 mb-30">誓約書</h2>
              <p class="mb-50">
                入会者は、健康状態にあり、水泳練習への参加に支障がないものと認め健康状態についての一切とクラブ規則を遵守することを保護者の責任として誓約します。
              </p>
              <p class="mb-50"><?php echo date('Y年m月d日'); ?></p>
              <div class="align-center">
                <dl class="dl-style-1">
                  <dt>入会者名</dt>
                  <dd><?php echo isset( $s_info['meta']['name'] ) ? $s_info['meta']['name'] : ''; ?></dd>
                  <dt>保護者氏名</dt>
                  <dd><?php echo isset( $s_info['meta']['parent_name'] ) ? $s_info['meta']['parent_name'] : ''; ?></dd>
                </dl>
              </div>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long" id="btn-entry-edit">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_entry_minority">誓約書します</span>
              </a>
            </div>

          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_majority" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <div class="box-style-2">
              <h2 class="title-2 mb-30">誓約書</h2>
              <p class="mb-20">
                花見川スイミングクラブへの入会にあたり、下記のとおり誓約します。
              </p>
              <p class="align-center mb-20">記</p>
              <ol class="mb-50 ol-style-1">
                <li>入会者は水泳練習にあたって健康上の支障はありませ。</li>
                <li>水泳練習にあたっての入会者の健康状態は、入会者本人及び家族の責任で管理します。</li>
                <li>別紙「プール利用にあたってのお願い」を読みましたので、確認注意事項及びスタッフの指示に従い、事故の無いように留意します。</li>
                <li>プール施設内において、入会者の健康状態が原因で事故が発生した場合は、入会者及び家族の責任で一切を処理し、クラブには何らご迷惑をおかけしません。</li>
                <li>水泳練習に差し支えない場合でも、身体的理由で定期的に通院している場合にはお知らせします。</li>
              </ol>
              <p class="mb-50"><?php echo date('Y年m月d日'); ?></p>
              <div class="align-center">
                <dl class="dl-style-1">
                  <dt>入会者名</dt>
                  <dd><?php echo isset( $s_info['meta']['name'] ) ? $s_info['meta']['name'] : ''; ?></dd>
                  <dt>家族名</dt>
                  <dd id="family"></dd>
                  <dt>続柄</dt>
                  <dd id="relationship"></dd>
                </dl>
              </div>
            </div>
            <div class="block-30 align-center">
              <a href="#0" class="btn bg-rouge btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span id="button_button_entry_majority">誓約書します</span>
              </a>
            </div>
          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

  <main id="entry_complete" class="content content-dark">
    <div class="container">
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <div class="rounded-corners-3">
            <h2 class="title-2 mb-30 mt-30">新規入会登録完了</h2>

            <div class="box-style-1 mb-30 bg-lightpink">
              <h3 class="box-style-1-title text-deep-red">初回お支払い金額</h3>
              <p class="box-style-1-text text-gray">XX,XXXX 円</p>
            </div>

            <div class="box-style-1 text-lightpink bg-aquatint">
              <h3 class="box-style-1-title text-konjyou">マイページ仮パスワード</h3>
              <p class="box-style-1-text text-gray" id="temporary_pw"></p>
            </div>

            <div class="block-30 align-center">
              <a href="#0" class="btn bg-light-blue btn-lg btn-long">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <span>完了</span>
              </a>
            </div>

          </div><!-- .rounded-corners-1 -->
        </div>
      </div>
    </div>
  </main>

    

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

  <div class="modal fade" id="modal-empty-class" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Empty class!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-max-class" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p>Max class is: <span id="max_class"><?php echo isset( $s_info['course']['nearest'][0]['practice_max'] ) ? $s_info['course']['nearest'][0]['practice_max'] : ''; ?></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<script>

  function disabled_bus( value ) {
    if ( value == 0 ) $('.disabled_bus').attr('disabled', 'disabled');
    else $('.disabled_bus').removeAttr('disabled');
  }

  var practice_max = $('input[name=practice_max]').val();
  var practice_max_change = 0;

  function change_course( course_id, student_id ) {
    $.ajax({
      url: 'https:' + "<?php echo base_url().'admin/entry/edit/'?>"+student_id,
      data: {
          course_id : course_id,
          change_course : 'change_course'
      },
      method: "POST",
      dataType: "json",
      beforeSend: function() {
        $('#change-course').prop('disabled', 'disabled');
      },
      success: function(result) {
        // console.log( result );
        practice_max = result['practice_max'];
        practice_max_change = 0;
        $('.display_class').empty();
        $('.display_bus').empty();
        $('.html_display').empty();
        $('.html_display').append( result['html'] );
        $('input[name=practice_max]').val( result['practice_max'] );
        $('#max_class').html( result['practice_max'] );
        $('.bg-gainsboro').css('border', '1px solid #9e9e9e3d');
        $('.bg-gainsboro').css('cursor', 'default');
        $('.bg-lightpink').css('cursor', 'default');
      }, error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
      },
      complete: function() {
        $('#change-course').prop('disabled', '');
      }
    });
  }

  function change_bus_course( bus_course_id, bus_route_id ) {
    $.ajax({
      url: 'https:' + "<?php echo base_url().'admin/entry/edit/'?>"+$('input[name=student_id]').val(),
      data: {
          bus_course_id : bus_course_id
      },
      method: "POST",
      dataType: "json",
      beforeSend: function() {
        $('.change_bus_course').prop('disabled', 'disabled');
      },
      success: function(result) {
        console.log( result );
        $('#'+bus_route_id).empty();
        $('#'+bus_route_id).append( result );
      }, error: function (XMLHttpRequest, textStatus, errorThrown) {
          console.log(errorThrown);
      },
      complete: function() {
        $('.change_bus_course').prop('disabled', '');
      }
    });
  }

  $(function() {
    $('.bg-gainsboro').css('border', '1px solid #9e9e9e3d');
    $('.bg-gainsboro').css('cursor', 'default');
    $('.bg-lightpink').css('cursor', 'default');
    $(document).on ("click", "#table-schedule tr td", function () {
      if ( $(this).hasClass( 'bg-plae-lemmon' ) ) {
        var _class = $(this).attr('data-class');
        var _id = $(this).attr('data-id');
        var _class_split = _class.split( '_week_' );
        var _class_name = _class.split('_');
        if ( $(this).hasClass( 'bg-rouge' ) ) {
          practice_max_change--;
          $(this).removeClass( 'bg-rouge' );
          $(this).text(_class_split[0]+'('+_class_name[3]+'/'+_class_name[4]+')');
          $(this).css('color', 'black');
          $(".display_class").find('.each_class').each(function(){
              if ( $(this).attr('data-class') == _class ) {
                $(this).remove();
              }
          });
          // remove bus
          $( '#' + _class ).remove();
        } else {
          if ( practice_max_change < practice_max ) {
            practice_max_change++;
            $(this).addClass('bg-rouge');
            $(this).text('選択');
            $(this).css('color', 'white');
            $('.display_class').append('<input type="text" data-id="' + _id + '" data-class="' + _class + '" value="' + _class_split[0] + '" class="form-control w-xs-19per each_class" readonly>');
            // add bus
            var student_id = $('input[name=student_id]').val();
            var course_id = $('#change-course option:selected').val();
            $.ajax({
              url: 'https:' + "<?php echo base_url().'admin/entry/edit/'?>"+student_id,
              data: {
                  data_class : _class,
                  class_id : _id,
                  course_id : course_id
              },
              method: "POST",
              dataType: "json",
              beforeSend: function() {
                $('td[data-class='+_class+']').removeClass('bg-plae-lemmon');
              },
              success: function(result) {
                $('.display_bus').append( result );
              }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                  console.log(errorThrown);
              },
              complete: function() {
                $('td[data-class='+_class+']').addClass('bg-plae-lemmon');
              }
            });
          } else {
            $('#modal-max-class').modal( 'show' );
          }
        }
      }
    });
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
    $('input[name=first_lesson_date]').datepicker(options);
    $('#entry-edit input').on('keyup blur', function () {
      if ($('#entry-edit').valid()) {
        $('#btn-entry-next').prop('disabled', false);
        $('#button_entry_explain').prop('disabled', false);
      } else {
        $('#btn-entry-next').prop('disabled', 'disabled');
        $('#button_entry_explain').prop('disabled', 'disabled');
      }
    });
    $('#entry-edit input').on('click', function () {
      if ($('#entry-edit').valid()) {
        $('#btn-entry-next').prop('disabled', false);
        $('#button_entry_explain').prop('disabled', false);
      } else {
        $('#btn-entry-next').prop('disabled', 'disabled');
        $('#button_entry_explain').prop('disabled', 'disabled');
      }
    });
    jQuery.validator.addMethod("onebyte", function(value, element) {
      return this.optional(element) || !/[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
    }, "Must be 1 byte character");
    jQuery.validator.addMethod("twobyte", function(value, element) {
      return this.optional(element) || /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
    }, "Must be 2 byte character");
    jQuery.validator.addMethod("katakana", function(value, element) {
      return this.optional(element) || /[\u30A0-\u30FF]|\u203B/.test(value);
    }, "Katakana string");
    $("#entry-edit").validate({
      rules: {
        user_name: {
          required: true,
          twobyte: true
        },
        name_kana: { 
          required: true,
          katakana: true
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
          number: true,
          maxlength: 11,
          onebyte: true
        },
        email_address: {
          required: true,
          email: true
        },
        school_name: {
          required: function(element) {
            var school_name_check = $('input[name=birthday]').val();
            var school_name_return = moment().diff(moment(school_name_check, 'YYYYMMDD'), 'years');
            return  school_name_return < 18;
          },
          twobyte: true
        },
        parent_name: { 
          required: function(element) {
            var parent_name_check = $('input[name=birthday]').val();
            var parent_name_return = moment().diff(moment(parent_name_check, 'YYYYMMDD'), 'years');
            return  parent_name_return < 18;
          },
          twobyte: true
        },
        school_grade: { 
          required: function(element) {
            var school_grade_check = $('input[name=birthday]').val();
            var school_grade_return = moment().diff(moment(school_grade_check, 'YYYYMMDD'), 'years');
            return  school_grade_return < 18;
          }
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
        name_kana: { 
          required: "Name kana is required",
          katakana: "Name must be katakana"
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
            number: "Phone number must be number",
            maxlength: "Phone number length is 11",
            onebyte: "Phone number is 1 byte"
        },
        email_address: {
            required: "Email address is required",
            email: "Email is invalid"
        },
        school_name: { 
          required: "School name is required",
          twobyte: "School name must be two byte"
        },
        parent_name: { 
          required: "Parent name is required",
          twobyte: "Parent name must be 2 byte"
        },
        school_grade: { required: "School grade is required" }
      },
      errorClass: "label label-danger",
      highlight: function (element, errorClass, validClass) {
          return false;
      },
      unhighlight: function (element, errorClass, validClass) {
          return false;
      }
  });
  // $('#btn-entry-edit').click(function() {
  $('#btn-entry-next').click(function() {
    
    var user_name = $('input[name=user_name]').val();
    var postal_code1 = $('input[name=postal_code1').val();
    var postal_code2 = $('input[name=postal_code2]').val();
    var address = $('input[name=address]').val();
    var email_address = $('input[name=email_address]').val();
    var email_flg = 0;
    if ( $('input[name=email_flg]').is(':checked') ) email_flg = 1;
    var phone_number = $('input[name=phone_number]').val();
    var name_kana = $('input[name=name_kana]').val();
    var birthday = $('input[name=birthday]').val();
    var sex = $('input[name=sex]').val();
    var emergency_tel = $('input[name=emergency_tel]').val();
    var school_name = $('input[name=school_name]').val();
    var parent_name = $('input[name=parent_name]').val();
    var school_grade = $('select[name=school_grade] option:selected').val();
    var bus_use_flg = "";
    if( $('input[name=bus_use_flg]').is(':checked') ) bus_use_flg = $('input[name=bus_use_flg]:checked').val();
    var life_check_flg = 0;
    if ( $('input[name=life_check_flg]').is(':checked') ) life_check_flg = 1;
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
    if ( $('input[name=year_month]') != '' ) {
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
    var memo_to_coach = $( 'textarea[name=memo_to_coach]' ).val();
    var iccard = $( 'input[name=iccard]' ).val();
    var first_lesson_date = $( 'input[name=first_lesson_date]' ).val();
    var memo_special = $( 'textarea[name=memo_special]' ).val();
    var student_id = $( 'input[name=student_id]' ).val();
    var course_id = $('#change-course option:selected').val();
    var class_choose = [];
    $('.display_class').find('.each_class').each( function(){
      class_choose.push( $(this).attr('data-id') + '_' + $(this).attr('data-class') );
    });
    var class_route_1 = [];
    var class_route_2 = [];
    $('.display_bus').find('.data_route').each( function() {
      // if ( $( this ).attr( 'data-route' ) != 'no' ) {
        class_route_1.push( $( this ).attr( 'data-route' ) );
        class_route_2.push( $( this ).attr( 'data-route' ) );
      // }
    });
    $('.display_bus').find('.main_bus_route').each( function() {
      $( this ).find( '.each_route' ).each( function() {
        // if ( $( this ).attr('data-check') != 'no' ) {
          for ( var i = 0; i < class_route_1.length; i++ ) {
            if ( class_route_1[i] == $( this ).attr( 'data-route' ) ) {
              class_route_2[i] = class_route_2[i] + '_' + $( this ).val();
            }
          }
        // }
      });
    });
    console.log( class_route_1 );
    console.log( class_route_2 );

    // var family = $('input[name=family]').val();
    // var relationship = $('select[name=relationship] option:selected').val();
    // var data = {
    //   user_name : user_name,
    //   postal_code : postal_code1 +'-'+ postal_code2,
    //   address : address,
    //   email_address : email_address,
    //   email_flg : email_flg,
    //   phone_number : phone_number,
    //   name_kana : name_kana,
    //   birthday : birthday,
    //   sex : sex,
    //   emergency_tel : emergency_tel,
    //   school_name : school_name,
    //   parent_name : parent_name,
    //   school_grade : school_grade,
    //   bus_use_flg : bus_use_flg,
    //   enquete : enquete,
    //   memo_to_coach : memo_to_coach,
    //   iccard : iccard,
    //   first_lesson_date : first_lesson_date,
    //   memo_special : memo_special,
    //   student_id : student_id,
    //   course_id : course_id,
    //   class_choose : class_choose,
    //   class_route : class_route_2,
    //   family : family,
    //   relationship : relationship
    // }

    // console.log( data );

    // if ( user_name != '' && name_kana != '' && birthday != '' && sex != '' && postal_code1 != '' && postal_code2 != '' && address != '' && email_address != '' && phone_number != '' ) {
    //   $.ajax({
    //     url: 'https:' + "<?php echo base_url().'admin/entry/edit/1'; ?>",
    //     data: data,
    //     method: "POST",
    //     dataType: "json",
    //     success: function(result) {
    //       if ( result['update'] == 'success' ) {
    //         $('#temporary_pw').text( result['temporary_pw'] );
    //         entry_disp_view('#entry_complete');
    //       }
    //     }, error: function (XMLHttpRequest, textStatus, errorThrown) {
    //       console.log(errorThrown);
    //     }
    //   });
    // } else {
    //   $('#modal-error').modal( 'show' );
    // }
  });

  entry_disp_view('#page_init');

  // $('main#page_init').on('click', '#btn-entry-next', function(event) {
  //     // event.preventDefault();
  //     var class_choose = [];
  //     $('.display_class').find('.each_class').each( function(){
  //       class_choose.push( $(this).attr('data-id') + '_' + $(this).attr('data-class') );
  //     });
  //     if ( class_choose.length == 0 ) $('#modal-empty-class').modal( 'show' );
  //     else entry_disp_view('#entry_explain');
  // });

  $('main#entry_explain').on('click', 'span#button_entry_contract', function(event) {
      // event.preventDefault();

      var check_year = $('input[name=birthday]').val();
      check_year = moment().diff(moment(check_year, 'YYYYMMDD'), 'years');

      // 申込者の年齢チェックによって、どちらを表示するか表示を振り分ける
      if ( check_year < 18 ) {
          // 未成年者用 誓約書表示
          entry_disp_view('#entry_minority');
      } else {
          // 成年用 誓約書表示
          $('#family').html( $('input[name=family]').val() );
          $('#relationship').html( $('select[name=relationship] option:selected').val() );
          entry_disp_view('#entry_majority');
      }
  });

  // $('main#entry_minority').on('click', 'span#button_entry_minority', function(event) {
  //     event.preventDefault();
  //     entry_disp_view('#entry_complete');
  // });

  // $('main#entry_majority').on('click', 'span#button_entry_majority', function(event) {
  //     event.preventDefault();
  //     entry_disp_view('#entry_complete');
  // });

  })

  function entry_disp_view(id) {
    $('#page_init').css('display','none');
    $('#entry_explain').css('display','none');
    $('#entry_minority').css('display','none');
    $('#entry_majority').css('display','none');
    $('#entry_complete').css('display','none');
    $(id).css('display','block');
  }
</script>
