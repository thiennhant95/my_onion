
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
}
function check_date_of_birth (){
    var birthday = $('input[name = student_birthday] ').val().replace(/\s/g, '');
    var date = birthday + " 00:00:00";
    dob = new Date(date);
    var today = new Date();
    var age = (today-dob) / (365.25 * 24 * 60 * 60 * 1000)  ;
    if( age < 20 ) return true;
    return false;
}
function changeBuscoure(selectObject){
  $bus_course_id = $(selectObject).val();
  $name = $(selectObject).attr('name');
  $this = $(selectObject);
  $namebusstop = $name.replace("course","stop");
  $.ajax({
     url: url_top + '/member/get_data_bus_stop/' ,
     type: 'POST',
     data:{ bus_course_id : $bus_course_id },
      beforeSend : function(){
        $this.prop('disabled',true);
      },
     success : function(result){
      $("select[name='"+ $namebusstop +"']").html('');
      $option = "<option>データがありません</option>" ;
      $data = JSON.parse( result ) ;
      if( $data.length > 0)
      {
        $option = "";
        jQuery.each( JSON.parse(result) , function() {
          $option += "<option value='" + this.bus_stop_id+"'>【"+this.bus_stop_code+"】" + this.bus_stop_name  +'</option>';
        });
      }
      $("select[name='"+$namebusstop+"']").append($option);
     },
     complete:function(){
      $this.removeAttr('disabled',true); 
     }
  });
}
  var check_choose = false ;
function choose_class(chooseOject){
  if ( check_choose ) return ;
  check_choose = true ;
  var row =  $(chooseOject).parent().index();
  var class_id = ( $(chooseOject).data('id')!= typeof undefined ) ? $(chooseOject).data('id') : '';
  var base = ( $(chooseOject).data('base')!= typeof undefined ) ? $(chooseOject).data('base') : '';
  var base_class_sign = ( base!='' ) ? ( base.split('-') )[0]:'';
  var week_num = ( base!='' ) ? ( base.split('-') )[1]:'';
  var practice_max = $('select[name=course_main]').find(':selected').attr('data-pratice');
  var check = false;
  $this = $(chooseOject);
  if( $(chooseOject).hasClass('bg-plae-lemmon') )
  {
     $('#table_member_schedule>tbody>tr>td').each(function(){
      var row_2 =  $(this).parent().index();
      if( row_2 == row && $(this).hasClass('bg-rouge') )
      {
        var arr_week = ['火','水','木','金','土','日','月'];
        alert( arr_week[ row_2 ] + "曜日にクラスを追加できません" );
        check = true ; 
      }
    });
    if( check == true ){
      check_choose = false;
       return ;
    }
    $class_have_join =  $('label.sub_class_join').length  ;
    
    if( practice_max > $class_have_join )
    {
        if( class_id != '' && week_num != '' )
        {
            $.ajax({
              async: false,
              url:url_top + '/member/add_click_view/',
              type: 'POST',
              dataType:'json',
              data :{ class_id:class_id  , week_num:week_num },
              beforeSend : function(xhr){
              },
              success : function( result , status , xhr){
                $data = jQuery.parseJSON( JSON.stringify(result) );  
                  if( $data != '')
                  {
                    $this.removeAttr('class');
                    $this.addClass('bg-rouge');
                    $this.html('選択');
                    $('#class_member_Join').append( $data.html_label_class_join ) ;
                    
                    $bus_couse_join = $('div.element_bus_course').length ;
                    if( $bus_couse_join == 1 && $('#set_same').length == 0 )
                    {
                        $set_same  = '<div class="checkbox ml-1" id="set_same"><label  style="margin: 0px auto 10px 142px;padding-top: 0px;" onclick ="check_set_same()">';
                        $set_same += '<input type="checkbox" id="check_set_same" >'; 
                        $set_same += '<small>上記と同じ設定をする</small></label></div>';
                        $('div.select_bus_route').append( $set_same );
                    }

                    $('div#select_bus_route').append( $data.html_bus_course );

                  }
                  if( $("input[name=bus_use_flg]:checked").val() == '0' ) {
                      $("select.bus_course").prop('disabled',true);
                      $("select.bus_stop").prop('disabled',true);
                  }
              },
              complete : function( xhr,status ){
                
              }
            });
        }
    }
    else{
      alert(" Maximun choose class is " + practice_max);
    }
  }
  else if( $(chooseOject).hasClass('bg-rouge')  )
  {
    $class_sign = base_class_sign +'-'+ week_num;
    $(chooseOject).removeAttr('class');
    $(chooseOject).addClass('bg-plae-lemmon');
    $(chooseOject).html('');
    if( $('label.sub_class_join').length == 1 )
    {
      $('#set_same').remove();
    }
    $('label.sub_class_join').each(function(){
      if( $(this).data('class') === $class_sign){
          $(this).remove();
      }
    });
    $('div.element_bus_course').each( function(index){
      if( $(this).data('sign') === $class_sign){
          $(this).remove();
          if( index == 0 && $('div.element_bus_course').length > 1)
          {
            $('#set_same').detach().insertAfter("div.element_bus_course:first");
          }
          else if( $('div.element_bus_course').length == 1 ){
            $('#set_same').remove();
          }
          
      }
    });
  }
 check_choose = false ; 
}
function check_set_same(){
  $("#check_set_same").change(function() {
    if(this.checked) {
        $fisrt_bus_route =  $('div.element_bus_course').first();
        $class_id = $fisrt_bus_route.data('id');
        $bus_course_go = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_course_go']").val();
        $bus_stop_go = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_stop_go']").val();
        $bus_course_ret = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_course_ret']").val();
        $bus_stop_ret = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_stop_ret']").val();

        $html_bus_course_go = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_course_go']").html();
        $html_bus_course_ret = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_course_ret']").html();
        $html_bus_stop_go = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_stop_go']").html();
        $html_bus_stop_ret = $fisrt_bus_route.children('div').children('div').children("select[name*='bus_stop_ret']").html();


        $('div.element_bus_course').each( function(index , element ){
          $class_id_2 = $(this).data('id');
            if(index != 0 && $class_id_2 == $class_id)
            {
              $("div.id_100 select").val("val2");
              $(this).children('div').children('div').children("select[name*='bus_course_go']").html( $html_bus_course_go );
              $(this).children('div').children('div').children("select[name*='bus_course_ret']").html( $html_bus_course_ret );
              $(this).children('div').children('div').children("select[name*='bus_stop_go']").html( $html_bus_stop_go );
              $(this).children('div').children('div').children("select[name*='bus_stop_ret']").html( $html_bus_stop_ret );
              $(this).children('div').children('div').children("select[name*='bus_course_go']").val($bus_course_go);
              $(this).children('div').children('div').children("select[name*='bus_course_ret']").val( $bus_course_ret );
              $(this).children('div').children('div').children("select[name*='bus_stop_go']").val( $bus_stop_go );
              $(this).children('div').children('div').children("select[name*='bus_stop_ret']").val( $bus_stop_ret );
            }
      });
    }
  });
}

$(document).ready(function() {

  $("input:checkbox[name=student_status]").on('change', function() {
      $("input:checkbox[name='student_status']").not(chooseOject).prop('checked', false);  
  });

  $("input:checkbox[name=student_rest]").on('change', function() {
      $("input:checkbox[name='student_rest']").not(chooseOject).prop('checked', false);  
  });

  $("input[name=bus_use_flg]").on('change', function() {
      if( $("input[name=bus_use_flg]:checked").val() == '0') {
        $("select.bus_course").prop('disabled',true);
        $("select.bus_stop").prop('disabled',true);

      }
      else{
        $("select.bus_course").removeAttr('disabled',true);
        $("select.bus_stop").removeAttr('disabled',true);
      } 
  });

  $('select[name=course_main]').on('change',function(){
      var course_id = $('select[name=course_main]').val();
      var student_id = $('input[name=student_id]').val();
      $this = $(this);
      $x='';
      $y='';
      $.ajax({
        url: url_top + '/member/switch_course_view/',
        type: 'POST',
        dataType:'json',
        data :{ course_id : course_id, student_id : student_id },
        beforeSend:function(){
           $this.prop('disabled',true);
        },
        success :function(result){
          $data =   jQuery.parseJSON(JSON.stringify(result));
          if($data)
          {
            $('#class_member_Join').html('');
            $('#class_member_Join').html($data.label_class_join);
            $('table#table_member_schedule > tbody').html('');
            $('table#table_member_schedule > tbody').html($data.body_table);
            $('div.select_bus_route').html('');
            $('div.select_bus_route').html($data.bus_couse_join);
          }
        },
        complete:function(){
          $this.removeAttr('disabled',true); 
        }
      });
  });

  $.validator.addMethod(
      "regex",
      function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
      }, " メールアドレスが無効です  "   
  );

  jQuery.validator.addMethod("greaterThan", function(value, element, params) {
      if($("input[name=" + params[0]+"]").val() != '')
      {
        $start_date = $("input[name="+params[0]+"]").val().replace(/\s/g, '');
        if((new Date( $start_date ) ) >= ( new Date( value.replace(/\s/g, '') )) )
        {
          return false;
        }
        
      }
       return true;
  },'休会終了は休会開始以降で入力してください。');

  jQuery.validator.addMethod("lessThan", function(value, element, params) {
      if($("input[name="+params[0]+"]").val()!='')
      {
        $end_date = $("input[name="+params[0]+"]").val().replace(/\s/g, '');
        if( (new Date($end_date) ) < ( new Date(value.replace(/\s/g, '')) ) )
        {
          return false;
        }
        
      }
       return true;
  },'休会開始は休会終了の値以下で入力してください');

  $('form#form_edit_member').validate({
      rules:{
        student_id : "required",
        student_name : "required",
        student_name_kana : "required",
        sex : "required",
        student_address : "required",
        first_postalcode : {
          required : true ,
          digits: true 
        },
        second_postalcode : {
          required : true ,
          digits: true 
        },
        student_mail : {
          required : true,
          email : true
        },
        student_school_name : {
          required : check_date_of_birth, 
        },
        student_parent_name : {
          required : check_date_of_birth, 
        },
        student_phone : {
            required : true,
            // regex : "^[0-9]{11}$",
            number: true ,
            digits: true 
        },
        student_emergency_tel : {
            required : true ,
            // regex : "^[0-9]{11}$",
            number: true ,
            digits: true 
        },
        rest_start_date :{
          lessThan:["rest_end_date"]
        },
        rest_end_date :{
          greaterThan:["rest_start_date"]
        },
        memo_to_coach : {
          maxlength : 100
        },
      },
      messages:{
        student_id : " この項目は必須です ",
        student_name : " この項目は必須です ",
        student_name_kana : " この項目は必須です ",
        sex : " この項目は必須です ",
        student_address : " この項目は必須です",
        first_postalcode : {
          required : " この項目は必須です ",
          digits: " 数字のみ入力して下さい。",
        },
        second_postalcode : {
          required : " この項目は必須です ",
          digits: " 数字のみ入力して下さい。",
        },
        student_phone : {
          required : " この項目は必須です ",
          number: "有効な数値を入力してください。",
          digits: "数字のみ入力して下さい。",
        },
        student_school_name : {
          required : " この項目は必須です ",
        },
        student_parent_name : {
          required : " この項目は必須です ",
        },
        student_mail : {
          required : " この項目は必須です ",
          email : " メールアドレスが無効です "
        },
        student_emergency_tel : {
            required : " この項目は必須です",
            number: " 有効な数値を入力してください ",
            digits: " 数字のみ入力して下さい。",
        },
        memo_to_coach : {
            maxlength : " 100文字以下で入力してください。"
        }
      },
      errorClass : "label label-danger",
      highlight : function (element, errorClass, validClass) {
          return false;
      },
      unhighlight : function ( element, errorClass, validClass) {
          return false;
      }
    });


  $('input[name=edit_save]').on('click', function(){
    if($('form#form_edit_member').valid() == false) return;
    
      $meta = {};
      $student_id = $('input[name=student_id]').val();
      $student_name = $('input[name=student_name]').val();
      $student_name_kana = $('input[name=student_name_kana]').val();
      $student_birthday = $('input[name=student_birthday]').val().replace(/\s/g, '');
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
      $year_month_club = $('input[name=date_leave_club]').val();
      $year_month_club = ($year_month_club.replace(/\s/g, '')).split('-');
      $experience_year =  $year_month_club[0];
      $experience_month = $year_month_club[1];
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
      $bus_use_flg = $('input:radio[name=bus_use_flg]:checked').val();
      //course join
      $course_join = [];
      $course_id = $('select[name=course_main]').val() !='' ? $('select[name=course_main]').val() : '';
      $course_join = {'student_id':$student_id,'course_id' : $course_id};
      //class join

      if( $('label.sub_class_join').size() == 0 )
      {
        $('.modal-body').addClass('alert alert-warning');
        $('#status_update').html(" レイヤーが選択されていません。 ");
        $('.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
        $('#modal-notice').modal('show');
        return ;
      }

      $course_class_join = {};
      $course_class_join['base'] = {'student_id':$student_id , 'course_id':$course_id};
      $temp = {};
      $('label.sub_class_join').each(function(index,element){
                $class_id = $(this).data('id').toString();
                $class_week_num  = $(this).data('class');
                $week_num =  ($class_week_num.split('-'))[1];
                $temp[index]={'class_id' : $class_id,'week_num':$week_num};
      });
      $course_class_join['arr'] = $temp;

      //bus route join
      $bus_route_join = {};
      $bus_route_join['base'] = {'student_id' : $student_id , 'course_id' : $course_id};
      if($bus_use_flg == 1)
      {
        $temp_2 = {};
        $('div.element_bus_course').each(function(index,element){
         $temp_3 = {};
                  $class_id = $(this).data('id');
                  $class_week_num  = $(this).data('sign');
                  $week_num = ($class_week_num.split('-'))[1];
                  $bus_course_go = $(this).children('div').children('div').children("select[name*='bus_course_go']").val();
                  $bus_stop_go = $(this).children('div').children('div').children("select[name*='bus_stop_go']").val();
                  $bus_course_ret = $(this).children('div').children('div').children("select[name*='bus_course_ret']").val();
                  $bus_stop_ret = $(this).children('div').children('div').children("select[name*='bus_stop_ret']").val();
                  if(  parseInt( $bus_course_go ) > 0 &&  parseInt($bus_course_ret) && parseInt($bus_stop_go) && parseInt($bus_stop_ret)) 
                  $temp_2[index]={ 
                              'class_id' : $class_id ,
                              'week_num' : $week_num ,
                              'bus_course_go' : $bus_course_go ,
                              'bus_stop_go' : $bus_stop_go ,
                              'bus_course_ret' : $bus_course_ret,
                              'bus_stop_ret' : $bus_stop_ret
                               };
        });
        $bus_route_join['arr'] =  $temp_2 ;
      }
      
      $iccard = $('input[name=iccard]').val();
      $life_check_flg = $('input[name=chb_lifecheck]:checked').is(':checked')?'1':'0';
      $life_check_date = $('input[name=life_check_date]').val().replace(/\s/g, '');
      $first_lesson_date = $('input[name=first_lesson_date]').val().replace(/\s/g, '');   
      $rest_start_date = $('input[name=rest_start_date]').val().replace(/\s/g, '');
      $rest_end_date = $('input[name=rest_end_date]').val().replace(/\s/g, '');
      $quit_date = $('input[name=quit_date]').val().replace(/\s/g, '');
      $memo_special = $('textarea[name=memo_special]').val();

      $a_status = {};
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
      $data = {};
      $data['metadata'] = $meta;
      $data['infodata'] = $a_status;
      $data['course_join'] = $course_join;
      $data['course_class_join'] = $course_class_join;
      $data['bus_route_join'] = $bus_route_join;
      $.ajax({
          url: url_top + '/member/Update_data_Member/' + $student_id,
          type: 'POST',
          data: $data,
          success :function(result){
            if(result=='Successfully')
            {
                $('.modal-body').addClass('alert alert-success');
                $('#status_update').html("<b>練習コースを追加しました。</b>");
                $('.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                $('#modal-notice').modal('show');
                window.setTimeout(function () {
                    $('#modal-notice').fadeToggle(300, function () {
                        $('#modal-notice').modal('hide');
                        window.location = url_top+'/member/detail/'+$student_id ;
                    });
                }, 1000);
            }
            else
            {
                $('.modal-body').addClass('alert alert-danger');
                $('#status_update').html("<b>このコースコードは既存しています。再度してください。</b>");
                $('.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                $('#modal-notice').modal('show');
                window.setTimeout(function () {
                    $('#modal-notice').fadeToggle(300, function () {
                        $('#modal-notice').modal('hide');
                    });
                }, 1000);
            }
          }
      });
  }); 
    
});