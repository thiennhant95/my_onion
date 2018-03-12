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

function check_date_of_birth ()
{
    var birthday = $('input[name = student_birthday] ').val().replace(/\s/g, '');
    var date = birthday + " 00:00:00";
    dob = new Date(date);
    var today = new Date();
    var age = (today-dob) / (365.25 * 24 * 60 * 60 * 1000)  ;
    if( age < 20 ) return true;
    return false;
}
function changeBuscoure(selectObject)
{
$course_id = $(selectObject).val();
$name = $(selectObject).attr('name');
$this = $(selectObject);
$namebusstop = $name.replace("course","stop");
$.ajax({
   url: url_top + '/member/get_data_bus_stop/' ,
   type: 'GET',
   data:{course_id:$course_id},
    beforeSend : function(){
      $this.prop('disabled',true);
    },
   success : function(result){
    if(result)
    {
      $("select[name='"+$namebusstop+"']").html('');
      jQuery.each(JSON.parse(result), function() {
        $option = "<option value='"+this.bus_stop_id+"'>【"+this.bus_stop_code+"】"+this.bus_stop_name +'</option>';
         $("select[name='"+$namebusstop+"']").append($option);
      });
    }    
   },
   complete:function(){
    $this.removeAttr('disabled',true); 
   }
});
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
      $("select.bus_course").prop('disabled',true);
      $("select.bus_stop").prop('disabled',true);

    }
    else{
      $("select.bus_course").removeAttr('disabled',true);
      $("select.bus_stop").removeAttr('disabled',true);
    } 
});


$('#table_member_schedule>tbody>tr>td').on('click',function(){

  var student_id = $('input[name=student_id]').val();
  var class_id = ($(this).data('id')!='undefined')?$(this).data('id'):'';
  var class_code = ($(this).data('classcode')!='undefined')?$(this).data('classcode'):'';
  var class_name= ($(this).data('classname')!='undefined')?$(this).data('classname'):'';
  var max_count= ($(this).data('maxcount')!='undefined')?$(this).data('maxcount'):'0';
  var number_student_join= ($(this).data('numberstudentjoin')!='undefined')?$(this).data('numberstudentjoin'):'0';
  var base=($(this).data('base')!='undefined')?$(this).data('base'):'';
  var base_class_sign = (base!='')?(base.split('-'))[0]:'';
  var week_num = (base!='')?(base.split('-'))[1]:'';
  var practice_max = $('select[name=course_main]').find(':selected').attr('data-pratice');
  
  if($(this).hasClass('bg-plae-lemmon'))
  {

    $class_have_join =  $('label.sub_class_join').length ++ ;

    if(practice_max > $class_have_join)
    {

      $('#table_member_schedule>tbody>tr>td').each(function(index,element){
        var subclass_id_1 = ( $(this).data('id') != 'undefined' ) ? $(this).data('id') : '';
        var numberstudentjoin_1 = ( $(this).data('numberstudentjoin') != 'undefined' ) ? $(this).data('numberstudentjoin') : 0 ;

        if( subclass_id_1 == class_id )
        {
          numberstudentjoin_1 ++;
          $(this).removeAttr('data-numberstudentjoin');
          $(this).data('numberstudentjoin', numberstudentjoin_1 );
          if( $(this).hasClass('bg-plae-lemmon') )
          {
            if(numberstudentjoin_1 == max_count )
            {
              $(this).removeAttr('class');
              $(this).addClass('bg-red');
            }
            $(this).html(numberstudentjoin_1 + '/' + max_count);
          }
        }
      });    

      $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
      $html_1 = '';
      $html_2= ' </label>';
      $html_1 = 'data-class="' + base_class_sign + '-' + week_num + '" data-id=' + class_id + '>' + class_code;

        $(this).removeAttr('class');
        $(this).addClass('bg-rouge');
        $(this).html('選択');
        $("#class_member_Join").append($html_0+$html_1+$html_2);
        //change bus course
        if( class_id != '' && class_name != '' && week_num != '' && base_class_sign != '')
        {

            $.ajax({
              url:url_top + '/member/add_bus_course_view/',
              type: 'POST',
              dataType:'json',
              data :{class_id:class_id,class_name:class_name,base_class_sign:base_class_sign,week_num:week_num},
              beforeSend : function(){
                $('table#table_member_schedule').prop('disabled',true);
              },
              complete : function(result){
                $data = result.responseText;
                  if($data != '')
                  {
                    $('div#select_bus_route').append($data);
                  }
                  $('table#table_member_schedule').removeAttr('disabled',true);
                  
                  if( $("input[name=bus_use_flg]:checked").val()=='0') {
                    $("select.bus_course").prop('disabled',true);
                    $("select.bus_stop").prop('disabled',true);
                  }
              }
            });
        }
    }
    else{
      alert(" Maximun choose class is " + practice_max);
    }

  }
  else if($(this).hasClass('bg-rouge')) 
  {
    $('#table_member_schedule>tbody>tr>td').each(function(index,element){
      var subclass_id_2 = ( $(this).data('id') != 'undefined' ) ? $(this).data('id') : '';
      var numberstudentjoin_2 = ( $(this).data('numberstudentjoin') != 'undefined' ) ? $(this).data('numberstudentjoin') : '';
      if( subclass_id_2 == class_id )
      {
        numberstudentjoin_2 --;
        $(this).removeAttr('data-numberstudentjoin');
        $(this).data('numberstudentjoin', numberstudentjoin_2 );
        if( $(this).hasClass('bg-red') )
        {
          $(this).removeAttr('class');
          $(this).addClass('bg-plae-lemmon');
          $(this).html(numberstudentjoin_2 + '/' + max_count);
        }
        else if( $(this).hasClass('bg-plae-lemmon') )
        $(this).html(numberstudentjoin_2 + '/' + max_count);
      }
    });     

    $class_sign = base_class_sign +'-'+ week_num;
    
    $('label.sub_class_join').each(function(){
      if( $(this).data('class') === $class_sign){
          $(this).remove();
      }
    });
    $('div.element_bus_course').each(function(){
      if( $(this).data('sign') === $class_sign){
          $(this).remove();
      }
    });
    $(this).removeAttr('class');
    $(this).addClass('bg-plae-lemmon');
    var numberstudentjoin_3 = $(this).data('numberstudentjoin') ;
    $(this).html(numberstudentjoin_3 + '/' + max_count);
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
      data :{course_id:course_id,student_id:student_id},
      beforeSend:function(){
         $this.prop('disabled',true);
      },
      success :function(result){
        $data =   jQuery.parseJSON(JSON.stringify(result));
        if($data)
        {
            
            $("#class_member_Join").children().remove();
            $classes = [];
            $classjoin = [];
            
            if($data.hasOwnProperty('classjoin'))
            {
              jQuery.each( $data.classjoin, function() {
                $class_id = this.class_id;
                $class_code = this.class_code;
                $class_name = this.class_name;
                $base_class_sign = this.base_class_sign;
                $week_num = this.week_num;
                
                $classjoin.push([$class_id , $class_code , $class_name , $base_class_sign , $week_num]) ;
                $html_0 = '<label  class="col-sm-2 control-label sub_class_join" ';
                $html_1 = '';
                $html_2= ' </label>';
                $html_1 = 'data-class="'+this.base_class_sign+'-'+$x+'" data-id="'+this.class_id+'">'+this.class_code;
                $("#class_member_Join").append($html_0+$html_1+$html_2);

              });
            }

            if($data.hasOwnProperty('classes'))
            {
              jQuery.each($data.classes, function(){
                $class_id = this.class_id;
                $class_code = this.class_code;
                $class_name = this.class_name;
                $base_class_sign = this.base_class_sign;
                $max_count = this.max_count;
                $number_student_join = this.number_student_join;
                $array_week = this.week.split(',');
                jQuery.each( $array_week,function(key,value){
                  $classes.push([ $class_id , $class_code , $class_name , $base_class_sign , value , $max_count , $number_student_join ]);
                });
              });
            }


            $('#table_member_schedule>tbody>tr>td').each(function(){
              $(this).removeAttr('class');
              $(this).addClass('bg-gainsboro');
              $(this).removeAttr('data-base');
              $(this).removeAttr('data-id');
              $(this).removeAttr('data-classcode');
              $(this).removeAttr('data-classname');
              $(this).removeAttr('data-numberstudentjoin');
              $(this).removeAttr('data-maxcount');
              $(this).html('');
            });
            
            $.each($classes,function(index,value){
              $base_class_index = '';
              $base_class = value[3];
              switch ($base_class) {
                              case "M": $base_class_index = 0; break;
                              case "A": $base_class_index = 1; break;
                              case "B": $base_class_index = 2; break;
                              case "C": $base_class_index = 3; break;
                              case "D": $base_class_index = 4; break;
                              case "E": $base_class_index = 5; break;
                              case "F": $base_class_index = 6; break;
                              default: 
              }
              $week = (value[4]-2)<0?(parseInt(value[4])+5):(value[4]-2);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').removeAttr('class');
              ( parseInt(value[6]) != parseInt(value[5]) ) ?
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').addClass('bg-plae-lemmon') :
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').addClass('bg-red');

              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('base',value[3]+'-'+value[4]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('id',value[0]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('classcode',value[1]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('classname',value[2]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('numberstudentjoin',value[6]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('maxcount',value[5]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').html(value[6]+'/'+value[5]);
            });

            $.each($classjoin,function(index,value){
              $base_class_index = '';
              $base_class = value[3];
              switch ($base_class) {
                              case "M": $base_class_index = 0; break;
                              case "A": $base_class_index = 1; break;
                              case "B": $base_class_index = 2; break;
                              case "C": $base_class_index = 3; break;
                              case "D": $base_class_index = 4; break;
                              case "E": $base_class_index = 5; break;
                              case "F": $base_class_index = 6; break;
                              default: 
              }
              $week = (value[4]-2)<0?(parseInt(value[4])+5):(value[4]-2);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').removeAttr('class');
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').addClass('bg-rouge');

              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('base',value[3]+'-'+value[4]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('id',value[0]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('classcode',value[1]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('classname',value[2]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('numberstudentjoin',value[6]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').data('maxcount',value[5]);
              $('#table_member_schedule tbody tr:eq('+$week+') td:eq('+$base_class_index+')').html('選択');
            });

            $('div.select_bus_route').html('');
            if($data.hasOwnProperty('bus_course') && $data.bus_course.hasOwnProperty('html_select_bus_course'))
            {
              $.each($data.bus_course.html_select_bus_course,function(index,value){
                $('div.select_bus_route').append(value);
              });   
            }
            
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
    }, " Invalid !. "   
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
},'Must be greater than rest start date');

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
},'Must be less than rest end date');

$('form#form_edit_member').validate({
    rules:{
      student_id : "required",
      student_name : "required",
      student_name_kana : "required",
      sex : "required",
      student_address : "required",
      first_postalcode : "required",
      second_postalcode : "required",
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
          regex : "^[0-9]{11}$"
      },
      student_emergency_tel : {
          required : true,
          regex : "^[0-9]{11}$"
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
      student_id : " required !",
      student_name : " required !",
      student_name_kana : " required !",
      sex : " required !",
      student_address : " required!",
      first_postalcode : " required !",
      second_postalcode : " required !",
      student_phone : {
        required : " required !",
      },
      student_school_name : {
        required : " required !",
      },
      student_parent_name : {
        required : " required !",
      },
      student_mail : {
        required : " required !",
        email : " Invalid !"
      },
      student_emergency_tel : {
          required : " required!",
      },
      memo_to_coach : {
          maxlength : " Max 100 character !"
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

$('input[name=student_birthday] , input[name=rest_start_date] , input[name=rest_end_date]').change(function(){
  if($('form#form_edit_member').valid())
  {
    $('input[name=save]').prop('disabled', false);
  }
  else {
    $('input[name=save]').prop('disabled', 'disabled');
  }
});

$('input').on('keyup blur', function () {
  if ($('#form_edit_member').valid()) {
    $('input[name=save]').prop('disabled', false);
  } else {
    $('input[name=save]').prop('disabled', 'disabled');
  }
});

$('input[name=save]').on('click', function(){
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
    if($student_mail_flg== '0')
    {
        $student_mail = '';
    }
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
    $course_id = $('select[name=course_main]').val();
    $course_join = {'student_id':$student_id,'course_id':$course_id};

    //class join

    if( $('label.sub_class_join').size() == 0 )
    {
      $('#modal-notice>.modal-dialog>.modal-content>.modal-body').html(" Please choose  least one class  join  !");
      $('#modal-notice>.modal-dialog>.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
      $('#modal-notice').modal('show');
      return ;
    }

    $course_class_join = {};
    $course_class_join['base'] = {'student_id':$student_id,'course_id':$course_id};
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
              }, 1200);
          }
          else
          {
              $('#modal-notice>.modal-dialog>.modal-content>.modal-body').html("Update UnSuccessfully !");
              $('#modal-notice>.modal-dialog>.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
              $('#modal-notice').modal('show');
          }
        }
    });
}); 
    
});