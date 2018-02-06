function daysInMonth(elementday,elementmonth,elementyear) {
      $month = $('select[name='+elementmonth+']').val();
      $year = $('select[name='+elementyear+']').val();
      $days = new Date($year,$month, 0).getDate();
      $('select[name='+elementday+']').html('');
      for($i=1 ; $i<=$days ; $i++)
      {
        $option = '<option value="'+$i+'">'+$i+'日</option>';
        $('select[name='+elementday+']').append($option);
      }
      return 0;
      // $year = $('select[name='+elementyear+']').val();
      // $month = $('select[name='+elementmonth+']').val();
      // $day = $('select[name='+elementday+']').val();
      // $days_2 = new Date($year,$month, $day).getTime();
      // $now = new Date().getTime();
      // $age = Math.floor(($now-$days_2)/(1000 * 60 * 60 * 24 * 365.25));
      // if($age < 18)
      // {

      // }
}



$(document).ready(function() {
  
    $("input:checkbox[name=student_status]").on('change', function() {
        $("input:checkbox[name='student_status']").not(this).prop('checked', false);  
    });
    $("input:checkbox[name=student_rest]").on('change', function() {
        $("input:checkbox[name='student_rest']").not(this).prop('checked', false);  
    });
    $("input[name=bus_use_flg]").on('change', function() {
        if( $("input[name=bus_use_flg]:checked").val()=='0') {
          $("select.bus_route").prop('disabled',true);
          $("select.bus_stop").prop('disabled',true);

        }
        else{
          $("select.bus_route").removeAttr('disabled',true);
          $("select.bus_stop").removeAttr('disabled',true);

        } 
    });
    $("select.bus_route").on('change', function() {
         $id = $(this).val();
         $name = $(this).attr('name');
         $namebusstop = $name.replace("route","stop");
          $.ajax({
             url: url_top + '/member/get_data_bus_stop/' + $id,
             type: 'POST',
             dataType:'json',
             success : function(result){
              $data =   jQuery.parseJSON(JSON.stringify(result));
                  if($data)
                  {
                    $("select[name='"+$namebusstop+"']").html('');
                    jQuery.each( $data, function() {
                      $option = "<option value='"+this.bus_route_id+"'>【"+this.bus_stop_code+"】"+this.bus_stop_name +'</option>';
                       $("select[name='"+$namebusstop+"']").append($option);
                    });
                  }
                  
             }
          });
    });
    // $('select[name=course_main]').on('change',function(){
    //     var course_id = $('select[name=course_main]').val();
    //     var student_id = $('input[name=student_id]').val();
    //     $x='';
    //     $y='';
    //     $.ajax({
    //       url: url_top + '/member/switch_course_view/' + student_id,
    //       type: 'POST',
    //       dataType:'json',
    //       data :{course_id:course_id},
    //       success :function(result){
    //         $data =   jQuery.parseJSON(JSON.stringify(result));
    //         if($data)
    //         {
                
    //             $("#class_member_Join").children().remove();
    //             $classes = [];
    //             $classjoin = [];
                
    //             jQuery.each( $data.select.classjoin, function() {
    //               $class_id = this.class_id;
    //               $x = this.week_num;
    //               $y ='';
                  
    //                   switch (this.base_class_sign) {
    //                     case 'M':$y = '1';break;
    //                     case 'A':$y = '2';break;
    //                     case 'B':$y = '3';break;
    //                     case 'C':$y = '4';break;
    //                     case 'D':$y = '5';break;
    //                     case 'E':$y = '6';break;
    //                     case 'F':$y = '7';break;
    //                     default: $y = '0';break;
    //                  }
    //               $classjoin.push([$y,$x]) ;
    //               $newX=($x-2<0)?(parseInt($x)+5):($x-2);
    //               $html_0='<div class="col-sm-6"><select class="form-control sub_class_join"  '+" data-x='"+$newX+"' data-y='"+$y+"'>";
    //               $html_1='';
    //               $html_2='</select></div>';
    //                  jQuery.each($data.select.class, function(){
    //                       $selected = '';
    //                       if($class_id==this.class_id ) $selected = "selected";
    //                       $html_1 += "<option value='"+this.class_id+"' "+$selected+" >"+this.class_name +'</option>';
    //                  });
    //               $("#class_member_Join").append($html_0+$html_1+$html_2);
    //             });

    //             jQuery.each($data.select.class, function(){
    //                 $yy='0';
    //                 $i=0;
    //                 switch (this.base_class_sign) {
    //                     case 'M':$yy = '1';break;
    //                     case 'A':$yy = '2';break;
    //                     case 'B':$yy = '3';break;
    //                     case 'C':$yy = '4';break;
    //                     case 'D':$yy = '5';break;
    //                     case 'E':$yy = '6';break;
    //                     case 'F':$yy = '7';break;
    //                     default: $yy = '0';break;
    //                 }
    //                 $array_week = this.week.split(',');
    //                 jQuery.each( $array_week,function(key,value){
    //                   $classes.push([$yy,value]);
    //                 });
                    
    //             });

    //             $('#table_member_schedule>tbody>tr>td').each(function(){
    //               $(this).removeAttr('class');
    //               $(this).addClass('bg-gainsboro');
    //               $(this).html('');

    //             });
    //             $.each($classes,function(index,value){
    //               $week = (value[1]-2)<0?(parseInt(value[1])+5):(value[1]-2);
    //               $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+(value[0]-1)+')').removeAttr('class');
    //               $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+(value[0]-1)+')').addClass('bg-plae-lemmon');
    //             });
    //             $.each($classjoin,function(index,value){
    //               $week = (value[1]-2)<0?(parseInt(value[1])+5):(value[1]-2);
    //               $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+(value[0]-1)+')').removeAttr('class');
    //               $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+(value[0]-1)+')').addClass('bg-rouge');
    //               $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+(value[0]-1)+')').html('đã chọn');
    //             });
    //         }
    //       }
    //     });
    // });

    // $('#table_member_schedule>tbody>tr>td').on('click',function(){
    //   var row_index = $(this).parent().index();
    //   var col_index = $(this).index();
    //   var course_id = $('select[name=course_main]').val();
    //   if($(this).hasClass('bg-plae-lemmon'))
    //   {
    //     $(this).removeAttr('class');
    //     $(this).addClass('bg-rouge');
    //     $(this).html('Đã chọn');
        
    //     // $.ajax({
    //     //   url: url_top + '/member/getData_class_by_id_course/' + course_id,
    //     //   type: 'POST',
    //     //   dataType:'json',
    //     //   success :function(result){
    //     //     $data =   jQuery.parseJSON(JSON.stringify(result));
    //     //     if($data)
    //     //     {

    //     //         $html_0='<div class="col-sm-6"><select class="form-control sub_class_join"  '+" data-x='"+row_index+"' data-y='"+col_index+"'>";
    //     //         $html_1='';
    //     //         $html_2='</select></div>';
    //     //         jQuery.each( $data, function() {
    //     //           $y ='';
    //     //           $x = this.week_num;
    //     //           $array_week = this.week.split(',');
    //     //           $selected = '';
    //     //               switch (this.base_class_sign) {
    //     //                 case 'M':$y = '1';break;
    //     //                 case 'A':$y = '2';break;
    //     //                 case 'B':$y = '3';break;
    //     //                 case 'C':$y = '4';break;
    //     //                 case 'D':$y = '5';break;
    //     //                 case 'E':$y = '6';break;
    //     //                 case 'F':$y = '7';break;
    //     //                 default: $y = '0';break;
    //     //              }
    //     //           if($y==col_index && $.inArray(row_index,$array_week) ) $selected = "selected";
    //     //           $html_1 += "<option value='"+this.class_id+"' "+$selected+" >"+this.class_name +'</option>';
    //     //         });
    //     //         $("#class_member_Join").append($html_0+$html_1+$html_2);
    //     //     }
    //     //   }
    //     // });
    //     switch (col_index) {
    //         case '1':$bass_class = 'M';break;
    //         case '2':$bass_class = 'A';break;
    //         case '3':$bass_class = 'B';break;
    //         case '4':$bass_class = 'C';break;
    //         case '5':$bass_class = 'D';break;
    //         case '6':$bass_class = 'E';break;
    //         case '7':$bass_class = 'F';break;
    //         default: $bass_class = '';break;
    //     }
    //     $x = (row_index+2>7)?row_index+2:7-row_index;
    //     $html_0 = '<label  class="col-sm-2 control-label" ';
    //     $html_1 = '';
    //     $html_2= '</label>';
    //     // $.each($class,function(key,value){
    //     //   if(value[''])
    //     //   {

    //     //   }
    //     // });
    //     // $html_1 = 'data-class="'+bass_class+'-'.$x.'" >'.$value['class_code'].'';

    //   }
    //   else if($(this).hasClass('bg-rouge')) 
    //   {
    //     $(this).removeAttr('class');
    //     $(this).addClass('bg-plae-lemmon');
    //     $(this).html('');

    //     $('select.sub_class_join').each(function(){
    //       if( $(this).data('x')==row_index && $(this).data('y')==col_index){
    //           $(this).parent('div').remove();
    //       }
    //     });
    //   }
    // });
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Invalid !."
    );
    $('form#form_edit_member').validate({
        rules:{
          student_id:"required",
          student_name:"required",
          student_name_kana:"required",
          sex:"required",
          student_address:"required",
          first_postalcode:"required",
          second_postalcode:"required",
          student_phone:{
              required:true,
              regex:"^[0-9]{11}$"
          },
          student_mail:{
            required:true,
            email:true
          },
          student_emergency_tel:{
              required:true,
              regex:"^[0-9]{11}$"
          },
          memo_to_coach:{
            maxlength:100
          },
        },
        messages:{
          student_id:"required !",
          student_name:"required !",
          student_name_kana:"required !",
          sex:"required !",
          student_address:"required!",
          first_postalcode:"required !",
          second_postalcode:"required !",
          student_phone:{
            required:"required !",
            regex:"Invalid!"
          },
          student_mail:{
            required:"required !",
            email:"Invalid !"
          },
          student_emergency_tel:{
              required:"required!",
              regex:"Invalid!"
          },
          memo_to_coach:{
              maxlength:"Max 100 character !"
          }
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function ( element, errorClass, validClass) {
            return false;
        },
      })
    $('input').on('keyup blur', function () {
      if ($('#form_edit_member').valid()) {
        $('input[name=save]').prop('disabled', false);
      } else {
        $('input[name=save]').prop('disabled', 'disabled');
      }
    });
    $('input[name=save]').on('click', function(){
      if($('form#form_edit_member').valid())
      {
        $meta = {};
        $student_name = $('input[name=student_name]').val();
        $student_name_kana = $('input[name=student_name_kana]').val();
        $student_birthday = $('select[name=year_of_student_birthday]').val()+'-'+
                    $('select[name=month_of_student_birthday]').val()+'-'+
                    $('select[name=day_of_student_birthday]').val();
        $student_sex = $('input[name=sex]:checked').val();
        $first_postalcode = ($('input[name=first_postalcode]').val()!='')?$('input[name=first_postalcode]').val():'';
        $second_postalcode= ($('input[name=second_postalcode]').val()!='')?$('input[name=second_postalcode]').val():'';
        $zipcode = ($first_postalcode.length>0 && $second_postalcode.length>0)?($first_postalcode+'-'+$second_postalcode):'';
        $student_address = $('input[name=student_address]').val();
        $student_phone = $('input[name=student_phone]').val();
        $student_mail_flg = $('input[name=student_mail_flg]:checked').is(':checked')?'0':'1';
        $student_mail = $('input[name=student_mail]').val();
        $student_emergency_tel = $('input[name=student_emergency_tel]').val();
        $student_parent_name = $('input[name=student_parent_name]').val();
        $student_school_name = $('input[name=student_school_name]').val();
        $student_school_grade = $('select[name=student_school_grade]').val();
        // Khóa hoc

        // 
        $face_into_water = $('input[name=chx_face_into_water]:checked').is(':checked')?'1':'0';
        $chx_not_face_into_water = $('input[name=chx_not_face_into_water]:checked').is(':checked')?'1':'0';
        $chx_dive = $('input[name=chx_dive]:checked').is(':checked')?'1':'0';
        $chx_float = $('input[name=chx_float]:checked').is(':checked')?'1':'0';
        $flutter_kick = $('select[name=flutter_kick]').val();
        $board_kick = $('select[name=board_kick]').val();
        $backstroke = $('select[name=backstroke]').val();
        $crawl = $('select[name=crawl]').val();
        $breast_stroke = $('select[name=breast_stroke]').val();
        $butterfly = $('select[name=butterfly]').val();
        $note = $('input[name=note]').val();
        $free_lesson = $('input:checkbox[name=free_lesson]:checked').is(':checked')?'1':'0';
        $short_lesson = $('input:checkbox[name=short_lesson]:checked').is(':checked')?'1':'0';
        $status = $('input:checkbox[name=status]:checked').is(':checked')?'1':'0';
        $club_name = $('input[name=club_name]').val();
        $experience_year = $('select[name=experience_year]').val();
        $experience_month = $('select[name=experience_month]').val();
        $enquete = {
          'face_into_water':$face_into_water,
          'not_face_into_water':$chx_not_face_into_water,
          'dive':$chx_dive,
          'float':$chx_float,
          'style':{
            'flutter_kick':$flutter_kick,
            'board_kick':$board_kick,
            'backstroke':$backstroke ,
            'crawl':$crawl,
            'breast_stroke':$breast_stroke,
            'butterfly':$butterfly,
            'note':$note
          },
          'free_lesson':$free_lesson,
          'short_lesson':$short_lesson,
          'experience':{
            'status':$status,
            'club_name':$club_name,
            'year':$experience_year,
            'month':$experience_month
          }
        };
        $memo_to_coach = $('textarea[name=memo_to_coach]').val();
        $bus_use_flg = $('input:checkbox[name=bus_use_flg]:checked').is(':checked')?'1':'0';
        // xe buyt

        // 
        $iccard = $('input[name=iccard]').val();
        $life_check_flg = $('input[name=chb_lifecheck]:checked').is(':checked')?'1':'0';
        $life_check_date = $('select[name=chb_year_lifecheck]').val()+'-'+
                    $('select[name=chb_month_lifecheck]').val()+'-'+
                    $('select[name=chb_day_lifecheck]').val();
        $first_lesson_date = $('select[name=year_first_lesson_date]').val()+'-'+
                    $('select[name=month_first_lesson_date]').val()+'-'+
                    $('select[name=day_first_lesson_date]').val();
        $rest_start_date = $('select[name=year_rest_start_date]').val()+'-'+
                    $('select[name=month_rest_start_date]').val()+'-'+
                    $('select[name=day_rest_start_date]').val();
        $rest_end_date = $('select[name=year_rest_end_date]').val()+'-'+
                    $('select[name=month_rest_end_date]').val()+'-'+
                    $('select[name=day_rest_end_date]').val();
        $quit_date = $('select[name=year_quit_date]').val()+'-'+
                    $('select[name=month_quit_date]').val()+'-'+
                    $('select[name=day_quit_date]').val();
        $memo_special = $('textarea[name=memo_special]').val();

        $a_status = {};
        $student_id = $('input[name=student_id]').val();
        $a_status['email']= $student_mail;
        $flag_status = $("input[name='student_status']:checked").is(':checked')?$("input[name='student_status']:checked").val():'1';
        $a_status['status']= $flag_status;
        $flag_rest = $("input[name='student_rest']:checked").is(':checked')?$("input[name='student_rest']:checked").val():'0';
        $a_status['rest_flg']= $flag_rest;
        $flag_lock = $("input[name='student_lock']:checked").is(':checked')?$("input[name='student_lock']:checked").val():'0';
        $a_status['lock_flg']= $flag_lock;

        $flag_medley = $("input[name='medley']:checked").is(':checked')?$("input[name='medley']:checked").val():'0';
        

        $meta['name'] = $student_name;
        $meta['name_kana'] = $student_name_kana;
        $meta['birthday'] = $student_birthday;
        $meta['sex'] = $student_sex;
        $meta['zip'] = $zipcode;
        $meta['address'] = $student_address;
        $meta['tel'] = $student_phone;
        $meta['iccard'] = $iccard;
        $meta['email_flg'] = $student_mail_flg;
        $meta['emergency_tel'] = $student_emergency_tel;
        $meta['parent_name'] = $student_parent_name;
        $meta['school_name'] = $student_school_name;
        $meta['school_grade'] = $student_school_grade;
        $meta['bus_use_flg'] = $bus_use_flg;
        $meta['life_check_flg'] = $life_check_flg;
        $meta['life_check_date'] = $life_check_date;
        $meta['enquete'] = $enquete;
        $meta['memo_to_coach'] = $memo_to_coach;
        $meta['memo_special'] = $memo_special;
        $meta['first_lesson_date'] = $first_lesson_date;
        $meta['quit_date'] = $quit_date;
        $meta['rest_start_date'] = $rest_start_date;
        $meta['rest_end_date'] = $rest_end_date;
        $meta['medley']= $flag_medley;
        $data={};
        $data['metadata'] = $meta;
        $data['infodata'] = $a_status;
        $.ajax({
            url: url_top + '/member/UpdateInfoMember/' + $student_id,
            type: 'POST',
            data: $data,
            success :function(result){
              if(result=='Successfully')
              {
                  $('#modal-notice>.modal-dialog>.modal-content>.modal-body').html("Update Successfully !");
                  $('#modal-notice>.modal-dialog>.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                  $('#modal-notice').modal('show');
                  setTimeout(function() {
                   window.location.href = url_top+'/member/detail/'+$student_id;
                  }, 1500);
              }
              else
              {
                  $('#modal-notice>.modal-dialog>.modal-content>.modal-body').html("Update UnSuccessfully !");
                  $('#modal-notice>.modal-dialog>.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                  $('#modal-notice').modal('show');
              }
            }
        });
      }
      
    }); 
        
  });