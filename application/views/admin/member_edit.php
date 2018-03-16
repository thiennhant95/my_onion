<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading bg-blue-green h3">
        <span>会員基本契約情報編集</span>
      </h1>

      <form class="form-horizontal" id="form_edit_member">

        <div class="panel panel-dotted">
          <div class="panel-heading">基本契約情報</div>
          <div class="panel-body">

            <div class="form-group">
              <label for="student_id" class="col-sm-2 control-label">会員番号</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset( $info['id'] ) ? $info['id'] : '' ?>" name="student_id" disabled >
              </div>
            </div>

            <div class="form-group">
              <label for="student_name" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset( $meta['name'] )? $meta['name'] :''?>" name="student_name"  >
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset($meta['name_kana'])?$meta['name_kana']:'' ?>" name="student_name_kana"  >
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12 col-sm-2 control-label">生年月日</label>
                <div class="col-sm-3">
                  <input class="form-control datepicker_Y_M_D" type="text" name="student_birthday" placeholder="YYYY - MM - DD" readonly value="<?php  if( isset($meta['birthday']) && $meta['birthday'] != INVALID_DATE && $meta['birthday'] !='' ) echo date_format(date_create( $meta['birthday'] ) , 'Y - m - d' ) ?>" >
                </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10" >
                <label class="radio-inline">
                  <input type="radio" name="sex" value="0" <?php if( isset($meta['sex']) && $meta['sex']=='0') echo "checked" ?> > 男性
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value="1" <?php if( isset($meta['sex']) && $meta['sex']=='1') echo "checked" ?> > 女性
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">郵便番号</label>
              <div class="col-xs-3 col-sm-2 col-md-1 postal-code-line" id="first_postalcode">
                <input type="text" class="form-control"  name="first_postalcode" value="<?php  if( isset($meta['zip']) && strpos($meta['zip'], '-')) { $postalcode = explode('-',$meta['zip']) ; echo $postalcode[0];  } ?>">
              </div>
              <div class="col-xs-3 col-sm-2 col-md-1" id="second_postalcode">
                <input type="text" class="form-control"  name="second_postalcode" value="<?php  if( isset($meta['zip']) && strpos($meta['zip'], '-')) { $postalcode = explode('-',$meta['zip']) ; echo $postalcode[1];  } ?>" />
              </div>
              <div class="col-xs-3 ">
                <input type="button" class="btn btn-main" value="&#12306; 住所に反映" id="btn_postalcode"  onclick="AjaxZip3.zip2addr('first_postalcode','second_postalcode','student_address','student_address');" />
              </div>
            </div>

            <div class="form-group">
              <label for="student_address" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo isset( $meta['address'] )? $meta['address'] : '' ?>" name="student_address" >
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="<?php echo isset( $meta['tel'] )? $meta['tel'] : '' ; ?>" name="student_phone" >
              </div>
            </div>

            <div class="form-group">
              <label for="student_mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" name="student_mail" value="<?php  echo isset( $info['email'] )? $info['email'] :"" ?>" >
              </div>
              <div class="col-sm-5">
                <label class="checkbox-inline">
                  <input type="checkbox" value="0" name="student_mail_flg" <?php if( isset( $meta['email_flg'] ) && $meta['email_flg']=='0')  echo 'checked'?> >
                  <small>メールアドレスなし</small>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="student_emergency_tel" class="col-sm-2 control-label">緊急連絡先</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="<?php  echo isset( $meta['emergency_tel'] )? $meta['emergency_tel'] :'' ?>" name="student_emergency_tel"  >
              </div>
            </div>

            <div class="row" id="juvenile">
              <div class="col-sm-9 col-sm-offset-2">
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <strong class="text-small">入会者が未成年の場合のみ記入</strong>
                  </div>
                  <div class="panel-body text-light">
                    <div class="form-group">
                      <label for="student_school_name" class="col-sm-2 control-label">学校名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="student_school_name" value="<?php  echo isset( $meta['school_name'] )? $meta['school_name'] :'' ?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="student_parent_name" class="col-sm-2 control-label">保護者氏名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php  echo isset( $meta['parent_name'] )? $meta['parent_name'] :'' ?>" placeholder="" name="student_parent_name" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="student_school_grade" class="col-sm-2 control-label">学年</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="student_school_grade" >
                         <?php 
                            $config = $this->configVar;
                            $grades = $config['school_grades'];
                            $student_grade = isset( $meta['school_grade'] )? $meta['school_grade'] :'';
                            foreach ($grades as $key => $value) {
                              $selected = ( $student_grade == $key ) ? 'selected' : '';
                              echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                            }
                         ?>
                      </select>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <hr class="hr-dashed">

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コースコード</label>
              <div class="col-sm-10">
                <select class="form-control" name="course_main" style="padding-left:25em">
                  <?php 
                  if( $course['all'] )
                  {
                    $currentcourse_id = isset( $course['valid'][0]['course_id'] )? $course['valid'][0]['course_id'] : $course['valid']['id'];
                      foreach($course['all'] as $item)
                      {
                        $selected = '';
                        if($item['id'] === $currentcourse_id)
                          $selected = 'selected';
                        echo ('<option data-pratice = "'.$item['practice_max'].'" value="'.$item['id'].'" '.$selected.' >'.$item['course_code'].' '.$item['course_name'].'</option>');
                      }
                  }
                  else{
                    echo '<option  > データがありません。 !</option>';
                  }
                  
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group" >
              <label class="col-sm-2 control-label">クラスコード</label>
              <label class="col-sm-2 control-label">選択クラスコード <span class="fa fa-arrow-right"></span></label>
              <div class="col-sm-8 " id="class_member_Join">
                <?php
                  if( isset( $course['valid']['classjoin'] ) && count( $course['valid']['classjoin'] ) > 0)
                  {
                    foreach ($course['valid']['classjoin'] as $key => $value) {
                         $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
                         $html_1 = 'data-class="'.$value['base_class_sign'].'-'.$value['week_num'].'" data-id='.$value['class_id'].'>'.$value['class_code'].' </label>';
                        echo $html_0.$html_1;     
                    }
                   }         
                ?> 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">クラス早見表</label>
              <div class="col-sm-8">
                <div class="table-responsive">
                            <table class="table table-bordered table-hover table-lg table-center" id="table_member_schedule">
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
                              <tbody>
                                <?php
                                  $array_base_class = ['','M','A','B','C','D','E','F'];
                                  $arr_class_join = array();
                                  $arr_class = array();
                                  $config = $this->configVar;
                                  $week_num = $config['week_num'];
                                  $count_week = count( $week_num );
                                  if( isset($course['valid']['class']) )
                                  {
                                    $arr_class = $course['valid']['class'] ; 
                                  }
                                  if(isset($course['valid']['classjoin']))
                                  {
                                    $arr_class_join = $course['valid']['classjoin'] ;
                                  }
                                  
                                for( $i=0 ; $i < 7 ; $i++){

                                  $x = ( $i+2 >= $count_week ) ? ($i-5) : ($i+2);
                                  echo '<tr>';
                                  foreach( $array_base_class as $key => $value ){

                                    $choose = '';
                                    $class_id = '';
                                    $class = 'bg-gainsboro';
                                    
                                    if($key == 0)
                                    {
                                      echo '<th>'.$week_num[$x].'</th>';
                                    }
                                    elseif( $key != 0 ){

                                      $ishas = FALSE;
                                      foreach ( $arr_class_join as $subkey_1 => $subvalue_1 ) { 

                                        if( $value == $subvalue_1['base_class_sign'] && $subvalue_1['week_num'] == strval($x)  )
                                        {
                                          $class_id = $subvalue_1['class_id'];
                                          $choose = '選択';
                                          $class = 'bg-rouge';
                                          $ishas = TRUE ;
                                          break;
                                        }
                                      }
                                      if($ishas === FALSE)
                                      {
                                        foreach ($arr_class as $subkey_2 => $subvalue_2 ) {
                                          if( $value == $subvalue_2['base_class_sign'] &&  strpos( $subvalue_2['week'] , strval($x) ) !== false )
                                          {
                                            $class_id = $subvalue_2['class_id']; 
                                            $class = 'bg-plae-lemmon';
                                            $week_full = $subvalue_2['week_full'];
                                            if( strpos( $week_full , strval($x) ) !== false ) $class = 'bg-red';
                                            break;
                                          }
                                        }
                                      }

                                      $data_id = $class_id != '' ? 'data-id = "'.$class_id.'" ' : '';
                                      $data_base = 'data-base = "'.$value.'-'. $x .'"  ' ;
                                      $data_class = 'class = "'.$class.'" ' ;

                                      echo '<td '.$data_class. $data_base.$data_id. ' onclick=" choose_class(this) " >'.$choose.'</td>';
                                    }                          
                                  }
                                  echo '</tr>';
                                }

                                ?>
                              </tbody>
                            </table>
                          </div>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">申込時の泳力</label>
              <div class="col-sm-10">
                <div class="block-15">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  name="chx_face_into_water" value="1" <?php if(isset($meta['enquete']) && isset(json_decode( $meta['enquete'] )->face_into_water ) && json_decode( $meta['enquete'] )->face_into_water == '1') echo 'checked'?> > 水に顔をつけることができない 
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label>
                      <input type="checkbox" name="chx_not_face_into_water" value="1" <?php if(isset($meta['enquete']) && isset(json_decode($meta['enquete'])->not_face_into_water) && json_decode($meta['enquete'])->not_face_into_water=='1') echo 'checked'?> > 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label>
                      <input type="checkbox" value="1" name="chx_dive" <?php if(isset($meta['enquete']) && isset(json_decode($meta['enquete'])->dive) && json_decode($meta['enquete'])->dive=='1') echo 'checked'?> > 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  name="chx_float" value="1" <?php if(isset($meta['enquete']) && isset(json_decode($meta['enquete'])->float)&& json_decode($meta['enquete'])->float == '1') echo 'checked'?> > 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select class="form-control" name="flutter_kick">
                        <?php 
                        if( count($distance)>0 ){
                          $abl = isset($meta['enquete']) && isset( json_decode( $meta['enquete'] )->style->flutter_kick ) ? json_decode( $meta['enquete'] )->style->flutter_kick : '';
                            foreach ( $distance as $value) {
                              $selected = ( $abl == $value['distance_name'] ) ? 'selected' : '';
                              echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                            }
                        }  
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select class="form-control" name="board_kick">
                         <?php 
                            if( count( $distance )>0){
                              $abl =isset($meta['enquete']) && isset( json_decode( $meta['enquete'] )->style->board_kick ) ? json_decode( $meta['enquete'] )->style->board_kick:'';
                              foreach ($distance as $value) {
                                $selected = ($abl==$value['distance_name'])?'selected':'';
                                echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                              }
                            }
                            
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select class="form-control" name="backstroke">
                         <?php 
                            if(count($distance)>0){
                              $abl = isset($meta['enquete']) && isset(json_decode( $meta['enquete'] )->style->backstroke ) ? json_decode( $meta['enquete'] )->style->backstroke:'';
                              foreach ($distance as $value) {
                                $selected = ($abl==$value['distance_name'])?'selected':'';
                                echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                              }
                            }
                           
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select class="form-control" name="crawl">
                         <?php 
                             if(count($distance)>0){
                              $abl = isset($meta['enquete']) && isset( json_decode( $meta['enquete'] )->style->crawl ) ? json_decode( $meta['enquete'] )->style->crawl:'';
                              foreach ($distance as $value) {
                                $selected = ($abl==$value['distance_name'])?'selected':'';
                                echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                              }
                             }
                            
                        ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select class="form-control" name="breast_stroke">
                         <?php 
                            if(count($distance)>0){
                              $abl = isset($meta['enquete']) && isset( json_decode( $meta['enquete'] )->style->breast_stroke ) ? json_decode( $meta['enquete'] )->style->breast_stroke:'';
                              foreach ($distance as $value) {
                                $selected = ($abl==$value['distance_name'])?'selected':'';
                                echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                              }
                            }
                            
                         ?>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select class="form-control" name="butterfly">
                         <?php 
                            if( count($distance )>0){
                              $abl = isset($meta['enquete']) && isset( json_decode( $meta['enquete'] )->style->butterfly ) ? json_decode( $meta['enquete'] )->style->butterfly:'';
                              foreach ($distance as $value) {
                                $selected = ($abl ==$value['distance_name'])?'selected':'';
                                echo '<option value="'.$value['distance_name'].'" '.$selected.'>'.$value['distance_name'].'M</option>';
                              }
                            }
                         ?>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <label for="note" class="control-label">備考</label>
                      <input type="text" name="note" class="form-control" value="<?php echo isset($meta['enquete']) && isset( json_decode( $meta['enquete'])->style->note ) ? json_decode( $meta['enquete'] )->style->note : ''; ?>" >
                    </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="free_lesson" <?php if( isset($meta['enquete']) && isset( json_decode($meta['enquete'])->free_lesson ) && json_decode($meta['enquete'])->free_lesson=='1' ) echo 'checked'?> > 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="short_lesson" <?php if(isset($meta['enquete']) && isset( json_decode($meta['enquete'] )->short_lesson ) && json_decode($meta['enquete'])->short_lesson=='1') echo 'checked'?> > 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="status" <?php if( isset($meta['enquete'] ) && isset( json_decode( $meta['enquete'] )->experience->status) &&json_decode( $meta['enquete'] )->experience->status=='1') echo 'checked'?> > 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>

                  <div class="row block-15">
                    <div class="col-sm-6">
                      <label for="club_name" class="control-label">クラブ名</label>
                      <input type="text" name="club_name" class="form-control" value="<?php echo isset( $meta['enquete'] ) && isset( json_decode($meta['enquete'] )->experience->club_name) ? json_decode( $meta['enquete'] )->experience->club_name:  ''; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="control-label">退会</label>
                      <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control datepicker_Y_M" type="text" id="datepicker_Y_M" name="date_leave_club" placeholder=" YYYY - MM " readonly  value="<?php 
                             $year_leave_club = isset($meta['enquete']) && isset( json_decode($meta['enquete'])->experience->club_name ) ? json_decode($meta['enquete'])->experience->year : date_format (date_create (START_DATE_DEFAULT) , 'Y');
                             $month_leave_club = isset($meta['enquete']) && isset( json_decode($meta['enquete'])->experience->club_name) ? json_decode($meta['enquete'])->experience->month : date_format (date_create (START_DATE_DEFAULT) , 'm');
                             $date = $year_leave_club .'-'.$month_leave_club ;
                              echo date_format( date_create($date) , ' Y - m ' ) ?> ">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コーチへの伝達事項</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="memo_to_coach"><?php echo isset($meta['memo_to_coach'])?$meta['memo_to_coach']:''?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">バスの利用</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="1" checked > 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="0" <?php if(isset($meta['bus_use_flg'] )&& $meta['bus_use_flg'] == '0') echo 'checked'?> > 利用しない
                </label>
              </div>
            </div>
  
            <div class="row">
              <div class="col-sm-10 col-sm-offset-2 select_bus_route"  id="select_bus_route">
                <?php 
                  if(count( $bus_course['all']) > 0){
                    foreach ( $bus_course['all'] as $key => $value) {
                      $class = $value['vaible'][0]['class_name'];
                      $base_class_sign =  $value['vaible'][0]['base_class_sign'];
                      $class_id =  $value['vaible'][0]['class_id'];
                      $config = $this->configVar;
                      $week_num = $config['week_num']; 
                      if( isset( $value['student_join'][0] ) )
                      {
                        $week = isset($value['student_join'][0]['week_num'])?$value['student_join'][0]['week_num']:'';
                        $index= random_string('alnum', RANDOM_STRING_LENGTH );
                        $disable = ( isset( $meta['bus_use_flg'] ) && $meta['bus_use_flg'] == '0') ? "disabled" :'';

                        $html_0 ='<div class="element_bus_course" data-sign="'.$base_class_sign.'-'.$week.'" data-id="'.$class_id.'"><div for="" class"col-sm-2 control-label " id="classnameforbus">'.$week_num[$week].'<br>('.$class.')</div>';
                        $html_0 .='<div class="form-group">
                                <label for="" class="col-sm-2 control-label">行き</label>
                                <div class="col-sm-5">
                                <select class="form-control bus_course" name="bus_course_go_'.$index.'" '.''.$disable .' onchange="changeBuscoure(this)">';
                        $html_2 = '';
                        $html_3 ='</select>
                                  </div>';
                        $html_3 .='<div class="col-sm-5">
                                  <select class="form-control bus_stop" name="bus_stop_go_'.$index.'" '.$disable.'>';
                        $html_5 = '';
                        $html_6 ='</select>
                                  </div>
                                  </div>';
                        $html_6 .= '<div class="form-group">
                                <label for="" class="col-sm-2 control-label">帰り</label>
                                <div class="col-sm-5">
                                <select class="form-control bus_course" name="bus_course_ret_'.$index.'" '.''.$disable .' onchange="changeBuscoure(this)">';
                        $html_8 ='';
                        $html_9 = '</select>
                                   </div>';
                        $html_9 .= '<div class="col-sm-5">
                                <select class="form-control bus_stop" name="bus_stop_ret_'.$index.'" '.$disable.'>';
                        $html_11 ='';
                        $html_12 = '</select></div></div></div>';

                        $id_go = isset($value['student_join'][0]['bus_go'][0]['bus_course_id'])?$value['student_join'][0]['bus_go'][0]['bus_course_id']:'';
                        $id_ret = isset($value['student_join'][0]['bus_ret'][0]['bus_course_id'])?$value['student_join'][0]['bus_ret'][0]['bus_course_id']:'';
                        $id_stop_go = isset($value['student_join'][0]['bus_go'][0]['bus_stop_id'])?$value['student_join'][0]['bus_go'][0]['bus_stop_id']:'';
                        $id_stop_ret = isset($value['student_join'][0]['bus_ret'][0]['bus_stop_id'])?$value['student_join'][0]['bus_ret'][0]['bus_stop_id']:'';


                        foreach ($value['vaible'] as $subkey => $subvalue) {
                          $selected_go = '';
                          $selected_ret = '';
                          $selected_stop_go='';
                          $selected_stop_ret = '';

                          if($subvalue['id']===$id_go)
                          {
                            $selected_go = "selected";
                            if($subvalue['bus_stop'])
                            {
                              foreach ($subvalue['bus_stop'] as $sub_key_stop => $sub_value_stop) {
                                if($sub_value_stop['bus_stop_id']===$id_stop_go) $selected_stop_go = "selected";
                                $html_5.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_go.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                $selected_stop_go ='';
                              }
                            }  
                          } 
                          $html_2.= '<option value='.$subvalue['id'].' '.$selected_go.'>'.$subvalue['bus_course_name'].'</option>';
                          
                          if( $subvalue['id'] == $id_ret ) 
                          {
                            $selected_ret = "selected";
                            if( $subvalue['bus_stop'] )
                            {
                              foreach ( $subvalue['bus_stop'] as $sub_key_stop => $sub_value_stop) {
                                if( $sub_value_stop['bus_stop_id'] == $id_stop_ret ) $selected_stop_ret = "selected";
                                $html_11.= '<option value='.$sub_value_stop['bus_stop_id'].' '.$selected_stop_ret.'>【'.$sub_value_stop['bus_stop_code'].'】'.$sub_value_stop['bus_stop_name'].'</option>';
                                $selected_stop_ret='';
                              }
                            }
                          }
                          $html_8.= '<option value='.$subvalue['id'].' '.$selected_ret.'>'.$subvalue['bus_course_name'].'</option>';
                        }
                          echo $html_0.$html_2.$html_3.$html_5.$html_6.$html_8.$html_9.$html_11.$html_12;

                          if( $key == 0)
                          {
                            $set_same  = '<div class="checkbox ml-1" id="set_same" ><label id="set_same_lable" style="margin: 0px auto 10px 142px;padding-top: 0px;" onclick ="check_set_same()">';
                            $set_same .= '<input type="checkbox" id="check_set_same">'; 
                            $set_same .= '<small>上記と同じ設定をする</small></label></div>';
                            echo  $set_same;
                          }
                      }
                    }
                  }    
                ?>
              </div>
            </div>

            <div class="form-group">
              <label for="iccard" class="col-sm-2 control-label">ICカード番号</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" name="iccard" value="<?php echo isset($meta['iccard'])?$meta['iccard']:''; ?>">
              </div>
              <div class="col-sm-5">
                <a  class="btn btn-main">最新読込カードIDを反映</a>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">ライフチェック</label>
              <div class="col-sm-10 form-inline">
                <div class="checkbox mr-1">
                  <label>
                    <input type="checkbox" value="" <?php if(isset($meta['life_check_flg']) && $meta['life_check_flg']=='1') echo 'checked'?> name="chb_lifecheck">
                  </label>
                </div>
                &nbsp;<input class="form-control datepicker_Y_M_D" type="text"  name="life_check_date" placeholder=" YYYY - MM - DD " readonly value="<?php  
                    $life_check_date = isset( $meta['life_check_date'] ) && $meta['life_check_date'] != INVALID_DATE && $meta['life_check_date'] != '' ? $meta['life_check_date'] : '';
                    echo date_format( date_create($life_check_date) ,'Y - m - d') ;
                ?>" >
              </div>

            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">初回レッスン</label>
              <div class="col-sm-10 form-inline">
                <input class="form-control datepicker_Y_M_D" type="text" id="first_lesson_date" name="first_lesson_date" placeholder=" YYYY - MM " readonly value="<?php 
                    $first_lesson_date = isset( $meta['first_lesson_date'] ) && $meta['first_lesson_date'] != INVALID_DATE && $meta['first_lesson_date'] != '' ?$meta['first_lesson_date']:'';
                    echo date_format( date_create( $first_lesson_date ),'Y - m - d') ;
                ?>" >
              </div>
            </div>

            <div class="block-15 bg-green">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">休会</label>
                <div class="col-sm-10 form-inline">

                  <div class="checkbox form-group col-sm-1">
                    <label >
                      <input  type="checkbox" name="student_rest" value="2"  <?php if( isset( $info['rest_flg'] ) && $info['rest_flg']=='2') echo 'checked'?> >
                    </label>
                  </div>

                  <div class="form-group col-sm-4">
                    <input class="form-control datepicker_Y_M_D" type="text"  name="rest_start_date" placeholder=" YYYY - MM - DD " readonly value="<?php 
                      $rest_start_date = isset( $meta['rest_start_date']) && $meta['rest_start_date'] != INVALID_DATE && $meta['rest_start_date'] != '' ? $meta['rest_start_date'] : '';
                      echo date_format(date_create($rest_start_date),'Y - m - d') ;
                    ?>" style="margin-left: -12px">
                  </div>

                  <div class="form-group col-sm-1" ><span style="margin-left: -5px">〜</span></div>

                  <div class="form-group col-sm-4">
                    <input class="form-control datepicker_Y_M_D" type="text"  name="rest_end_date" placeholder=" YYYY - MM - DD " readonly
                    value="<?php 
                        $rest_end_date = isset( $meta['rest_end_date'] ) && $meta['rest_end_date'] != INVALID_DATE && $meta['rest_end_date'] != '' ? $meta['rest_end_date'] : '';
                        echo date_format( date_create( $rest_end_date ) ,'Y - m - d') ;
                    ?>">
                  </div>

                  <div class="checkbox form-group col-sm-1">
                    <label>
                      <input type="checkbox"  name="student_rest" value="1"  <?php if( isset( $info['rest_flg'] ) && $info['rest_flg']=='1')  echo 'checked'?> > 
                      <small>保留</small>
                    </label>
                  </div>

                </div>
              </div>
            </div>

            <div class="block-15 bg-gray">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">退会</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="3"  name="student_status" <?php if( isset($info['status']) && $info['status'] == '3') echo 'checked';?> >
                    </label>
                  </div>
                  <input class="form-control datepicker_Y_M_D" type="text"  name="quit_date" placeholder=" YYYY - MM - DD" readonly value="<?php 
                      $quit_date = isset( $meta['quit_date'] )  && $meta['quit_date'] != INVALID_DATE && $meta['quit_date'] != '' ? $meta['quit_date'] : '';
                      echo date_format( date_create( $quit_date ) , 'Y - m - d') ;
                  ?>">
                  <div class="checkbox ml-1">
                    <label>
                      <input type="checkbox" name="student_status" value="2" <?php if( isset($info['status']) && $info['status'] == '2') echo 'checked';?> > 
                      <small>保留</small>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15 bg-danger">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">会員ロック</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" name="student_lock" value="1" <?php if( isset($info['lock_flg']) && $info['lock_flg'] == '1') echo 'checked';?> >
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15 bg-info">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">MEDLEY</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" value="1" name="medley" <?php echo isset( $meta['medley'] ) && ( $meta['medley'] == '1') ? 'checked' : '' ?> >
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メモ・特記事項</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="memo_special"><?php echo isset($meta['memo_special']) ? $meta['memo_special'] : '' ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="block-30 text-center">
          <input type="button" name="edit_save" value="更新" class="btn btn-warning btn-long">
        </div>
      </form>
      <div class="modal fade" id="modal-notice" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"> お知らせ </h4>
              </div>
              <div class="modal-body">
                 <p id="status_update"></p>
              </div>
            </div>
          </div>
      </div>

<style>
    .alert-success {border-radius: 0px;border: 0px solid }
    .alert-danger {border-radius: 0px;border: 0px solid }
    .alert-warning {border-radius: 0px;border: 0px solid }
</style>
    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script type="text/javascript">

  $(document).ready(function(){

    $.fn.datepicker.dates['jp'] = {
        days: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysShort: ["日", "月", "火", "水", "木", "金", "土", "日"],
        daysMin: ["日", "月", "火", "水", "木", "金", "土", "日"],
        months:  ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
        monthsShort:  ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],
        today: "今日",
        clear: "クリア",
        weekStart: 0
    };
    var options_Y_M_D={
        isRTL: false,
        format: 'yyyy - mm - dd',
        minViewMode: 'days',
        todayHighlight: true,
        autoclose: true,
        language:'jp',
        orientation: "auto right",
    };
    var options_Y_M={
        isRTL: false,
        format: 'yyyy - mm',
        minViewMode: 'months',
        todayHighlight: true,
        autoclose: true,
        language:'jp',
        orientation: "auto right",
    };
    $('.datepicker_Y_M_D').click(function(){
      $(this).datepicker(options_Y_M_D);
      $(this).datepicker("show");
    });
    $('.datepicker_Y_M').click(function(){
      $(this).datepicker(options_Y_M);
      $(this).datepicker("show");
    });

    $('input[name=student_birthday] , input[name=rest_start_date] , input[name=rest_end_date]').change(function(){
      if($('form#form_edit_member').valid())
      {
        $('input[name=edit_save]').prop('disabled', false);
      }
      else {
        $('input[name=edit_save]').prop('disabled', 'disabled');
      }
    });

    $('input').on('keyup blur', function () {
      if ($('#form_edit_member').valid()) {
        $('input[name=edit_save]').prop('disabled', false);
      } else {
        $('input[name=edit_save]').prop('disabled', 'disabled');
      }
    });

    
});
  
</script>