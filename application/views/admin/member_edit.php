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
                <input type="text" class="form-control" value="<?php echo $info['id'] ?>" name="student_id" readonly >
              </div>
            </div>

            <div class="form-group">
              <label for="student_name" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset($meta['name'])?$meta['name']:''?>" name="student_name"  >
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">フリガナ</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="<?php echo isset($meta['name_kana'])?$meta['name_kana']:'' ?>" name="student_name_kana"  >
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">生年月日</label>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="year_of_student_birthday" onchange="daysInMonth('day_of_student_birthday','month_of_student_birthday','year_of_student_birthday')">
                 <!--  <option value="">2000年</option> -->
                  <?php 
                      $birthday = date_create($meta['birthday']);
                      echo '<option class="form-control" value='.date_format($birthday,'Y').'>'.date_format($birthday,'Y年').'</option>';
                  ?>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="month_of_student_birthday" onchange="daysInMonth('day_of_student_birthday','month_of_student_birthday','year_of_student_birthday')">
                  <?php 
                      $birthday = date_create($meta['birthday']);
                      $month  = date_format($birthday,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                  ?>
                </select>
              </div>
              <div class="col-xs-3 col-sm-2">
                <select class="form-control" name="day_of_student_birthday" onchange="daysInMonth('day_of_student_birthday','month_of_student_birthday','year_of_student_birthday')">
                  <?php 
                      $birthday = date_create($meta['birthday']);
                      $day = date_format($birthday,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($birthday,'m'), date_format($birthday,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">性別</label>
              <div class="col-sm-10" >
                <label class="radio-inline">
                  <input type="radio" name="sex" value="0" <?php if($meta['sex']=='0') echo "checked" ?> > 男性
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" value="1" <?php if($meta['sex']=='1') echo "checked" ?> > 女性
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">郵便番号</label>
              <div class="col-xs-3 col-sm-2 col-md-1 postal-code-line" id="first_postalcode">
                <input type="number" class="form-control"  name="first_postalcode" value="<?php echo (isset($meta['zip'])&&$meta['zip']!='')?(explode('-',$meta['zip']))[0]:''; ?>">
              </div>
              <div class="col-xs-3 col-sm-2 col-md-1" id="second_postalcode">
                <input type="number" class="form-control"  name="second_postalcode" value="<?php echo (isset($meta['zip'])&&$meta['zip']!='')?(explode('-',$meta['zip']))[1]:''; ?>" />
              </div>
              <div class="col-xs-3 ">
                <input type="button" class="btn btn-main" value="&#12306; 住所に反映" id="btn_postalcode"  onclick="AjaxZip3.zip2addr('first_postalcode','second_postalcode','student_address','student_address');" />
              </div>
            </div>

            <div class="form-group">
              <label for="student_address" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo isset($meta['address'])?$meta['address']:'' ?>" name="student_address" >
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="<?php echo isset($meta['tel'])?$meta['tel']:''; ?>" name="student_phone" >
              </div>
            </div>

            <div class="form-group">
              <label for="student_mail" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" name="student_mail" value="<?php  echo isset($info['email'])?$info['email']:"" ?>" >
              </div>
              <div class="col-sm-5">
                <label class="checkbox-inline">
                  <input type="checkbox" value="0" name="student_mail_flg" <?php if(isset($meta['email_flg'])&&$meta['email_flg']=='0')  echo 'checked'?> >
                  <small>メールアドレスなし</small>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="student_emergency_tel" class="col-sm-2 control-label">緊急連絡先</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="<?php  echo isset($meta['emergency_tel'])?$meta['emergency_tel']:"" ?>" name="student_emergency_tel"  >
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
                        <input type="text" class="form-control" name="student_school_name" value="<?php  echo isset($meta['school_name'])?$meta['school_name']:"" ?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="student_parent_name" class="col-sm-2 control-label">保護者氏名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php  echo isset($meta['parent_name'])?$meta['parent_name']:'' ?>" placeholder="" name="student_parent_name" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="student_school_grade" class="col-sm-2 control-label">学年</label>
                      <div class="col-sm-10">
                          <select class="form-control" name="student_school_grade" >
                         <?php 
                            $grade=['幼稚園','小学1年～6年生','中学1年～3年生','高校1年～3年生','専門学校・高専','大学生'];
                            $student_grade = isset($meta['school_grade'])?$meta['school_grade']:'';
                            foreach ($grade as $value) {
                              $selected = ($student_grade==$value)?'selected':'';
                              echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
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
                    echo isset($course['nearest'])?('<option value="'.$course['nearest']['course_id'].'" >'.$course['nearest']['course_code'].' '.$course['nearest']['course_name'].'</option>'):'';
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group" >
              <label class="col-sm-2 control-label">クラスコード</label>
              <label class="col-sm-2 control-label">選択クラスコード <span class="fa fa-arrow-right"></span></label>
              <div class="col-sm-8 " id="class_member_Join">
                <?php

                  if(isset($course['nearest']['classjoin'])&&count($course['nearest']['classjoin'])>0)
                  {
                    $x='0';
                    $y='0';
                    foreach ($course['nearest']['classjoin'] as $key => $value) {
                         $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
                         $html_1 = '';
                         $html_2= '</label>';

                         $html_1 = 'data-class="'.$value['base_class_sign'].'-'.$value['week_num'].'" >'.$value['class_code'].'';
                          echo $html_0.$html_1.$html_2;     
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
                                  $week_num = ($this->config->item('my_config'))['week_num'];
                                if(isset($course['nearest']['class']))
                                {
                                  foreach ($course['nearest']['class'] as $key => $value) {
                                    $base_class_sign = $value['base_class_sign'];
                                    $split_week = explode(",",$value['week']);
                                    foreach ($split_week as $subkey => $subvalue) {
                                      if(!in_array(array($base_class_sign=>$subvalue),$arr_class))
                                      $arr_class[][$base_class_sign]= $subvalue;
                                    }
                                  }
                                  if(isset($course['nearest']['classjoin']))
                                  {
                                    foreach ($course['nearest']['classjoin'] as $index => $value) {
                                      $base_class_sign = $value['base_class_sign'];
                                      $arr_class_join[][$base_class_sign]= $value['week_num'];
                                    }
                                  }
                                  
                                }
                                
                                for( $i=0 ; $i<7 ; $i++){
                                  echo '<tr>';
                                  foreach($array_base_class as $key=>$value){
                                    $choose='';
                                    $class ='bg-gainsboro';
                                    $x = ($i+2 >= count($week_num))?($i-5):($i+2);
                                    if($key==0)
                                    {
                                      echo '<th>'.$week_num[$x].'</th>';
                                    }
                                    elseif(in_array(array($value=>$x),$arr_class_join))
                                    {
                                      $class = 'bg-rouge';
                                      $choose = '選択';
                                      echo '<td class="'.$class.'">'.$choose.'</td>';
                                    }
                                    elseif(in_array(array($value=>$x),$arr_class)){
                                      $class ='bg-plae-lemmon';
                                      echo '<td class="'.$class.'">'.$choose.'</td>';
                                    }
                                    else{
                                      echo '<td class="'.$class.'">'.$choose.'</td>';
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
                      <input type="checkbox"  name="chx_face_into_water" value="1" <?php if(isset(json_decode($meta['enquete'])->face_into_water)&&json_decode($meta['enquete'])->face_into_water=='1') echo 'checked'?> > 水に顔をつけることができない 
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label>
                      <input type="checkbox" name="chx_not_face_into_water" value="1" <?php if(isset(json_decode($meta['enquete'])->not_face_into_water)&&json_decode($meta['enquete'])->not_face_into_water=='1') echo 'checked'?> > 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox" >
                    <label>
                      <input type="checkbox" value="1" name="chx_dive" <?php if(isset(json_decode($meta['enquete'])->dive)&&json_decode($meta['enquete'])->dive=='1') echo 'checked'?> > 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"  name="chx_float" value="1" <?php if(isset(json_decode($meta['enquete'])->float)&&json_decode($meta['enquete'])->float=='1') echo 'checked'?> > 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select class="form-control" name="flutter_kick">
                        <?php 
                        if(count($distance)>0){
                          $abl = isset(json_decode($meta['enquete'])->style->flutter_kick)?json_decode($meta['enquete'])->style->flutter_kick:'';
                            foreach ($distance as $value) {
                              $selected = ($abl==$value['distance_name'])?'selected':'';
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
                            if(count($distance)>0){
                              $abl = isset(json_decode($meta['enquete'])->style->board_kick)?json_decode($meta['enquete'])->style->board_kick:'';
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
                              $abl = isset(json_decode($meta['enquete'])->style->backstroke)?json_decode($meta['enquete'])->style->backstroke:'';
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
                              $abl = isset(json_decode($meta['enquete'])->style->crawl)?json_decode($meta['enquete'])->style->crawl:'';
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
                              $abl = isset(json_decode($meta['enquete'])->style->breast_stroke)?json_decode($meta['enquete'])->style->breast_stroke:'';
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
                            if(count($distance)>0){
                              $abl = isset(json_decode($meta['enquete'])->style->butterfly)?json_decode($meta['enquete'])->style->butterfly:'';
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
                      <input type="text" name="note" class="form-control" value="<?php echo isset(json_decode($meta['enquete'])->style->note)?json_decode($meta['enquete'])->style->note:''; ?>" >
                    </div>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="free_lesson" <?php if(isset(json_decode($meta['enquete'])->free_lesson)&&json_decode($meta['enquete'])->free_lesson=='1') echo 'checked'?> > 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="short_lesson" <?php if(isset(json_decode($meta['enquete'])->short_lesson)&&json_decode($meta['enquete'])->short_lesson=='1') echo 'checked'?> > 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value="1" name="status" <?php if(isset(json_decode($meta['enquete'])->experience->status)&&json_decode($meta['enquete'])->experience->status=='1') echo 'checked'?> > 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>

                  <div class="row block-15">
                    <div class="col-sm-6">
                      <label for="club_name" class="control-label">クラブ名</label>
                      <input type="text" name="club_name" class="form-control" value="<?php echo isset(json_decode($meta['enquete'])->experience->club_name)?json_decode($meta['enquete'])->experience->club_name:''; ?>">
                    </div>
                    <div class="col-sm-6">
                      <label for="" class="control-label">退会</label>
                      <div class="row">
                        <div class="col-xs-6">
                          <select class="form-control" name="experience_year">
                            <option value="<?php echo isset(json_decode($meta['enquete'])->experience->year)?json_decode($meta['enquete'])->experience->year:date('Y') ?>"><?php echo isset(json_decode($meta['enquete'])->experience->year)?json_decode($meta['enquete'])->experience->year:date('Y') ?> 年</option>
                          </select>
                        </div>
                        <div class="col-xs-6">
                          <select class="form-control" name="experience_month">
                            <?php 
                                $experience = isset(json_decode($meta['enquete'])->experience->month)?json_decode($meta['enquete'])->experience->month:'';
                                for($i = 1; $i<=12 ; $i++)
                                {
                                  $selected=($experience==$i)?'selected':'';
                                  echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                                }
                            ?>
                          </select>
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
                  <input type="radio" name="bus_use_flg" value="1" <?php if(isset($meta['bus_use_flg'])&&$meta['bus_use_flg']=='1') echo 'checked'?> > 利用する
                </label>
                <label class="radio-inline">
                  <input type="radio" name="bus_use_flg" value="0" <?php if(isset($meta['bus_use_flg'])&&$meta['bus_use_flg']=='0') echo 'checked'?> > 利用しない
                </label>
              </div>
            </div>
  
            <div class="row">
              <div class="col-sm-10 col-sm-offset-2">
                <?php 
                  if(count($bus_route['valid'])>0){
                    $my_config = $this->config->item('my_config');
                    $html_2 ='';
                    foreach ($bus_route['valid'] as $key => $value) {
                      $data_course = $value['bus_course'];
                      foreach ($data_course as $keycourse => $valuebus_course) {
                         $html_2 .= '<option value="'.$valuebus_course['id'].'" select_'.$key.' >'.$valuebus_course['bus_course_name'].'</option>';
                      }                       
                    }
                    foreach ($bus_route['valid'] as $key => $value) {

                      $disabled = (isset($meta['bus_use_flg'])&&$meta['bus_use_flg']=='0')?'disabled':'';
                      $classname = isset($value['classinfo'][0]['class_name'])?$value['classinfo'][0]['class_name']:'';
                      $week_num = isset($value['classinfo'][0]['week_num'])?$value['classinfo'][0]['week_num']:'0';
                      $day = '';
                        foreach ($my_config['week_num'] as $_key => $week_day) {
                          if($_key==$week_num) $day = $week_day;
                        }
                      $html_0 =  '<div for="" class"col-sm-2 control-label" id="classnameforbus">'.$day.'<br>('.$classname.')</div>';
                      $html_1 ='<div class="form-group">
                              <label for="" class="col-sm-2 control-label">行き</label>
                              <div class="col-sm-5">
                              <select class="form-control bus_route" name="bus_route_go_'.$key.'" '.''.$disabled .' >';
                      // $html_2 ='';
                      $html_3 ='</select>
                                </div>';
                      $html_4 ='<div class="col-sm-5">
                                <select class="form-control bus_stop" name="bus_stop_go_'.$key.'" '.$disabled.'>';
                      $html_5= '';
                      $html_6 ='</select>
                                </div>
                                </div>';
                      $html_7 = '<div class="form-group">
                              <label for="" class="col-sm-2 control-label">帰り</label>
                              <div class="col-sm-5">
                              <select class="form-control bus_route" name="bus_route_ret_'.$key.'" '.''.$disabled .' >';
                      // $html_8 = '';
                      $html_9 = '</select>
                                 </div>';
                      $html_10 = '<div class="col-sm-5">
                              <select class="form-control bus_stop" name="bus_stop_ret_'.$key.'" '.$disabled .'>';
                      $html_11 ='';
                      $html_12 = '</select>
                                </div>
                                </div>';
                         
                        $bus_route_go_id = ($value['bus_route_go_id']!='')?$value['bus_route_go_id']:'';

                       if(isset($value['bus_course']))
                       {
                          $data_course = $value['bus_course'];
                          foreach ($data_course as $keycourse => $valuebus_course) {
                            $count = 1;
                            $html_2=str_replace(" select_".$key," selected",$html_2,$count);
                            if(isset($valuebus_course['bus_stop']))
                            {
                              $data_stop = $valuebus_course['bus_stop'];
                              foreach($data_stop as $keybusstop => $valuebusstop){
                                  $selected = '';
                                  if($bus_route_go_id == $valuebusstop['bus_route_id']) $selected= "selected";
                                 $html_5.='<option value='.$valuebusstop['bus_route_id'].' '.$selected.' >【'.$valuebusstop['bus_stop_code'].'】'.$valuebusstop['bus_stop_name'].'</option>';
                              }
                            }
                            
                          }

                          $data_course = $value['bus_course'];
                          $bus_route_ret_id = $value['bus_route_ret_id'];
                          foreach ($data_course as $keycourse => $valuebus_course) {
                              if(isset($valuebus_course['bus_stop']))
                              {
                                $data_stop = $valuebus_course['bus_stop'];
                                foreach($data_stop as $keybusstop => $valuebusstop){
                                    $selected = '';
                                    if($bus_route_ret_id == $valuebusstop['bus_route_id']) $selected= "selected";
                                   $html_11.='<option value='.$valuebusstop['bus_route_id'].' '.$selected.' >【'.$valuebusstop['bus_stop_code'].'】'.$valuebusstop['bus_stop_name'].'</option>';
                                }
                              }
                              
                          }
                          echo $html_0.$html_1.$html_2.$html_3.$html_4.$html_5.$html_6.$html_7.$html_2.$html_9.$html_10.$html_11.$html_12;
                          $html_2=str_replace("selected","",$html_2,$count);
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
                    <input type="checkbox" value="" <?php if(isset($meta['life_check_flg'])&&$meta['life_check_flg']=='1') echo 'checked'?> name="chb_lifecheck">
                  </label>
                </div>
                <select class="form-control" name="chb_year_lifecheck">
                  <?php 
                    $life_check_date = isset($meta['life_check_date'])?$meta['life_check_date']:'';
                    $life_check_date = date_create($life_check_date);
                      echo '<option class="form-control" value='.date_format($life_check_date,'Y').'>'.date_format($life_check_date,'Y年').'</option>';
                  ?>
                </select>
                <select class="form-control" name="chb_month_lifecheck" onchange="daysInMonth('chb_day_lifecheck','chb_month_lifecheck','chb_year_lifecheck')">
                  <?php 
                      $life_check_date = date_create(isset($meta['life_check_date'])?$meta['life_check_date']:'');
                      $month  = date_format($life_check_date,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                  ?>
                </select>
                <select class="form-control" name="chb_day_lifecheck">
                  <?php 
                      $life_check_date = date_create(isset($meta['life_check_date'])?$meta['life_check_date']:'');
                      $day = date_format($life_check_date,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($life_check_date,'m'), date_format($life_check_date,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                  ?>
                </select>
              </div>

            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">初回レッスン</label>
              <div class="col-sm-10 form-inline">
                <select class="form-control" name="year_first_lesson_date">
                  <?php 
                      $first_lesson_date = date_create(isset($meta['first_lesson_date'])?$meta['first_lesson_date']:'');
                      echo '<option class="form-control"  value='.date_format($first_lesson_date,'Y').'>'.date_format($first_lesson_date,'Y年').'</option>';
                  ?>
                </select>
                <select class="form-control" name="month_first_lesson_date" onchange="daysInMonth('day_first_lesson_date','month_first_lesson_date','year_first_lesson_date')">
                 <?php 
                      $first_lesson_date = date_create(isset($meta['first_lesson_date'])?$meta['first_lesson_date']:'');
                      $month  = date_format($first_lesson_date,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                  ?>
                </select>
                <select class="form-control" name="day_first_lesson_date">
                  <?php 
                      $first_lesson_date = date_create(isset($meta['first_lesson_date'])?$meta['first_lesson_date']:'');
                      $day = date_format($first_lesson_date,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($first_lesson_date,'m'), date_format($first_lesson_date,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                  ?>
                </select>
              </div>
            </div>

            <div class="block-15 bg-green">
              <div class="form-group form-color-block mb-0">
                <label for="" class="col-xs-12 col-sm-2 control-label">休会</label>
                <div class="col-sm-10 form-inline">
                  <div class="checkbox mr-1">
                    <label>
                      <input type="checkbox" name="student_rest" value="2"  <?php if($info['rest_flg']=='2') echo 'checked'?> >
                    </label>
                  </div>
                  <select class="form-control" name="year_rest_start_date">
                    <?php 
                      $rest_start_date = date_create(isset($meta['rest_start_date'])?$meta['rest_start_date']:'');
                      echo '<option class="form-control"  value='.date_format($rest_start_date,'Y').'>'.date_format($rest_start_date,'Y年').'</option>';
                   ?>
                  </select>
                  <select class="form-control" name="month_rest_start_date" onchange="daysInMonth('day_rest_start_date','month_rest_start_date','year_rest_start_date')">
                    <?php 
                      $rest_start_date = date_create(isset($meta['rest_start_date'])?$meta['rest_start_date']:'');
                      $month  = date_format($rest_start_date,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                   ?>
                  </select>
                  <select class="form-control" name="day_rest_start_date">
                  <?php 
                      $rest_start_date = date_create(isset($meta['rest_start_date'])?$meta['rest_start_date']:'');
                      $day = date_format($rest_start_date,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($rest_start_date,'m'), date_format($rest_start_date,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                  ?>
                  </select>
                  <span class="form-fromto-split">〜</span>
                  <select class="form-control" name="year_rest_end_date">
                    <?php 
                      $rest_end_date = date_create(isset($meta['rest_end_date'])?$meta['rest_end_date']:'');
                      echo '<option class="form-control"  value='.date_format($rest_start_date,'Y').'>'.date_format($rest_end_date,'Y年').'</option>';
                   ?>
                  </select>
                  <select class="form-control" name="month_rest_end_date" onchange="daysInMonth('day_rest_end_date','month_rest_end_date','year_rest_end_date')">
                    <?php 
                      $rest_end_date = date_create(isset($meta['rest_end_date'])?$meta['rest_end_date']:'');
                      $month  = date_format($rest_end_date,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                   ?>
                  </select>
                  <select class="form-control" name="day_rest_end_date">
                    <?php 
                      $rest_end_date = date_create(isset($meta['rest_end_date'])?$meta['rest_end_date']:'');
                      $day = date_format($rest_start_date,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($rest_end_date,'m'), date_format($rest_end_date,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                   ?>
                  </select>
                  <div class="checkbox ml-1">
                    <label>
                      <input type="checkbox"  name="student_rest" value="1"  <?php if($info['rest_flg']=='1') echo 'checked'?> > 
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
                      <input type="checkbox" value="3"  name="student_status" <?php if($info['status']=='3') echo 'checked';?> >
                    </label>
                  </div>
                  <select class="form-control" name="year_quit_date">
                    <?php 
                      $quit_date = date_create(isset($meta['quit_date'])?$meta['quit_date']:'');
                      echo '<option class="form-control"  value='.date_format($quit_date,'Y').'>'.date_format($quit_date,'Y年').'</option>';
                   ?>
                  </select>
                  <select class="form-control" name="month_quit_date" onchange="daysInMonth('day_quit_date','month_quit_date','year_quit_date')">
                    <?php 
                      $quit_date = date_create(isset($meta['quit_date'])?$meta['quit_date']:'');
                      $month  = date_format($quit_date,'m');
                      for($i = 1; $i<=12 ; $i++)
                      {
                        $selected=($month==$i)?'selected':'';
                        echo '<option value="'.$i.'" '. $selected .'>'.$i.'月</option>';
                      }
                   ?>
                  </select>
                  <select class="form-control" name="day_quit_date">
                    <?php 
                      $quit_date = date_create(isset($meta['quit_date'])?$meta['quit_date']:'');
                      $day = date_format($quit_date,'d');
                      $days = cal_days_in_month(CAL_GREGORIAN,date_format($quit_date,'m'), date_format($quit_date,'Y'));
                      for($i = 1 ; $i <= $days ; $i++)
                      {
                        $selected = $day==$i?'selected':'';
                        echo '<option value="'.$i.'" '.$selected.' >'.$i.'日</option>';
                      } 
                   ?>
                  </select>
                  <div class="checkbox ml-1">
                    <label>
                      <input type="checkbox" name="student_status" value="2" <?php if($info['status']=='2') echo 'checked';?> > 
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
                      <input type="checkbox" name="student_lock" value="1" <?php if($info['lock_flg']=='1') echo 'checked';?> >
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
                      <input type="checkbox" value="1" name="medley" <?php echo isset($meta['medley'])&&($meta['medley']=='1')?'checked':'' ?> >
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="block-15">
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">メモ・特記事項</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="memo_special"><?php echo isset($meta['memo_special'])?$meta['memo_special']:'' ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="block-30 text-center">
          <input type="button" name="save" value="更新" class="btn btn-warning btn-long">
        </div>
      </form>
      <div class="modal fade" id="modal-notice" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Message</h4>
              </div>
              <div class="modal-body">
                
              </div>
            </div>
          </div>
      </div>


    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#table_member_schedule>tbody>tr>td').on('click',function(){
      var row_index = $(this).parent().index();
      var col_index = $(this).index();
      $base_class = '';
      switch (col_index) {
            case 1:$base_class = 'M';break;
            case 2:$base_class = 'A';break;
            case 3:$base_class = 'B';break;
            case 4:$base_class = 'C';break;
            case 5:$base_class = 'D';break;
            case 6:$base_class = 'E';break;
            case 7:$base_class = 'F';break;
            default: $base_class = '';break;
        }
        if(row_index+2 < 7) $x = row_index+2 ;
        else if(row_index+2 == 7) $x = 0 ;
        else if(row_index+2 == 8) $x = 1 ;
      if($(this).hasClass('bg-plae-lemmon'))
      {
             
        var classes=  '<?php echo json_encode($course["nearest"]["class"]); ?>';
            classes = JSON.parse(classes);    
        
        $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
        $html_1 = '';
        $html_2= ' </label>';
        $ishas =false;
        jQuery.each(classes,function(){
          $array_week = this.week.split(',');
          
          if($base_class==this.base_class_sign && $.inArray($x,$array_week))
          {
               $html_1 = 'data-class="'+$base_class+'-'+$x+'" >'+this.class_code;
               $ishas = true;
               return true;
          }

        });
        if($ishas) 
        {
          $(this).removeAttr('class');
          $(this).addClass('bg-rouge');
          $(this).html('選択');
          $("#class_member_Join").append($html_0+$html_1+$html_2);
        }
       

      }
      else if($(this).hasClass('bg-rouge')) 
      {
        $class_sign = $base_class+'-'+$x;
        
        $('label.sub_class_join').each(function(){
          $data_class = $(this).data('class');
          if( $(this).data('class')===$class_sign){
              $(this).remove();
          }
        });
        $(this).removeAttr('class');
        $(this).addClass('bg-plae-lemmon');
        $(this).html('');
      }
    });
  });
  
</script>