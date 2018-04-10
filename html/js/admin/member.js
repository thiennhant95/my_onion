
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
          $data = {};
          $data[0] = { class_id:class_id  , week_num:week_num };
            $.ajax({
              async: false,
              url:url_top + '/member/add_click_view/',
              type: 'POST',
              dataType:'json',
              data : {'classes' : $data } ,
              beforeSend : function(xhr){
              },
              success : function( result , status , xhr){
                $data = jQuery.parseJSON( JSON.stringify(result) );  
                  if( $data != '')
                  {

                    $this.attr('class','bg-rouge');
                  
                    $this.html('選択');
                    if( $data.hasOwnProperty('html_label_class_join') ){
                      $.each( $data.html_label_class_join , function( index , element ){
                        $('#class_member_Join').append( element );
                      });
                    }
                    
               
                    if( $data.hasOwnProperty('html_bus_course') ) {

                      if( $('div.element_bus_course').length == 1 && $('#set_same').length == 0  )
                      {
                          $set_same  = '<div class="checkbox ml-1" id="set_same"><label  style="margin: 0px auto 10px 142px;padding-top: 0px;" onclick ="check_set_same()">';
                          $set_same += '<input type="checkbox" id="check_set_same" >'; 
                          $set_same += '<small>上記と同じ設定をする</small></label></div>';
                          $('div.select_bus_route').append( $set_same );
                      }

                      $.each( $data.html_bus_course , function( index , element ){
                        $('div#select_bus_route').append( element );
                      });

                    }

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
      alert(" 最大登録数は"+practice_max+"です。"  );
    }
  }
  else if( $(chooseOject).hasClass('bg-rouge')  )
  {
    $class_sign = base_class_sign +'-'+ week_num;
    $week_full_text = $(chooseOject).data('week_full');
    $(chooseOject).attr('class','bg-plae-lemmon');
    $(chooseOject).html( $week_full_text);
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
      $("input:checkbox[name='student_status']").not(this).prop('checked', false);  
  });

  $("input:checkbox[name=student_rest]").on('change', function() {
      $("input:checkbox[name='student_rest']").not(this).prop('checked', false);  
  });

  $("input[name=bus_use_flg]").on('change', function() {
      if( $("input[name=bus_use_flg]:checked").val() == '0') {
        $("select.bus_course").prop('disabled',true);
        $("select.bus_stop").prop('disabled',true);

      }
      else{
        $("select.bus_course").removeAttr('disabled',true);
        $("select.bus_stop").removeAttr('disabled',true);

        if(  $('label.sub_class_join').size() > 0 ){

          var data = {};
          var _index = 0; 
          $('label.sub_class_join').each( function( index,element ){

            var class_id = $(this).data('id').toString();
            var class_week_num  = $(this).data('class');
            var week_num =  ( class_week_num.split('-') )[1];
            var check = false ;
            $('div.element_bus_course').each( function( ){
                var _class_week_num  = $(this).data('sign');
                if( class_week_num == _class_week_num ) 
                  check = true ;
            });
            if( !check ){

              data[_index] = { 'class_id' : class_id , 'week_num' : week_num };
              _index ++ ;
            }
          });

            $.ajax({
              url: url_top + '/member/swich_bus_flg_view' ,
              type : 'POST' ,
              dataType : 'json' ,
              data : { classes : data },
              beforeSend:function(){
                $('input[name=bus_use_flg]').find(':checked').prop('disabled',true);
              },
              success:function(result){
                var _data =   jQuery.parseJSON( JSON.stringify( result ) );
                if(_data.hasOwnProperty('html_bus_course') )
                {
                  if( _data.has_set_same == false )
                  {
                    $set_same  = '<div class="checkbox ml-1" id="set_same"><label  style="margin: 0px auto 10px 142px;padding-top: 0px;" onclick ="check_set_same()">';
                    $set_same += '<input type="checkbox" id="check_set_same" >'; 
                    $set_same += '<small>上記と同じ設定をする</small></label></div>';
                    $('div.select_bus_route').prepend( $set_same );
                  }
                  var html_bus_course = "";
                  $.each( _data.html_bus_course , function( index , element ){
                     html_bus_course += element ;
                  });
                  
                  $('div.select_bus_route').prepend( html_bus_course );
                  
                }
              },
              complete:function(){

              }
            });
        }
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
  jQuery.validator.addMethod("onebyte", function(value, element) {
            return this.optional(element) || !/[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
  }, "Must be 1 byte character");

  jQuery.validator.addMethod("twobyte", function(value, element) {
            return this.optional(element) || /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/.test(value);
  }, "氏名は全角文字のみを入力してください。");
  jQuery.validator.addMethod("katakana", function(value, element) {
      return this.optional(element) || /[\u30A0-\u30FF]|\u203B/.test(value);
  }, "フリガナは全角カナのみを入力してください。");

  $('form#form_edit_member').validate({
      rules:{
        student_id :{
          required : true,
        },
        student_name : {
          required : true ,
          twobyte: true
        },
        student_name_kana : {
          required : true ,
          katakana : true
        },
        sex : {
          required : true ,
        },
        student_address : {
          required : true ,
        },
        first_postalcode : {
          required : true ,
          digits: true ,
        },
        second_postalcode : {
          required : true ,
          digits: true ,
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
            number: true ,
            digits: true ,
            maxlength : 11 
        },
        student_emergency_tel : {
            required : true ,
            number: true ,
            digits: true ,
            maxlength : 11
        },
        memo_to_coach : {
          maxlength : 100
        },
      },
      groups: {
                postal_code: "first_postalcode second_postalcode"
            },
      messages:{
        student_id : " この項目は必須です ",
        student_name : { 
          required : " この項目は必須です " ,
        },
        student_name_kana :{ 
          required : " この項目は必須です " ,
        },
        sex : " この項目は必須です ",
        student_address : " この項目は必須です",
        first_postalcode : {
          required : " この項目は必須です ",
          digits: " 数字のみ入力して下さい。",
          maxlength : "4文字以下で入力してください"
        },
        second_postalcode : {
          required : " この項目は必須です ",
          digits: " 数字のみ入力して下さい。",
          maxlength : "4文字以下で入力してください"
        },
        student_phone : {
          required : " この項目は必須です ",
          number: "有効な数値を入力してください。",
          digits: "数字のみ入力して下さい。",
          maxlength : "11文字以下で入力してください"
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
            maxlength : "11文字以下で入力してください"
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
      $meta['name'] = $('input[name=student_name]').val();
      $meta['name_kana'] = $('input[name=student_name_kana]').val();
      $meta['birthday'] = $('input[name=student_birthday]').val().replace(/\s/g, '');
      $meta['sex'] = $('input[name=sex]:checked').val();
        $first_postalcode = ($('input[name=first_postalcode]').val()!='')?$('input[name=first_postalcode]').val():'';
        $second_postalcode= ($('input[name=second_postalcode]').val()!='')?$('input[name=second_postalcode]').val():'';
        $zipcode = ( $first_postalcode.length > 0 && $second_postalcode.length > 0)?( $first_postalcode +'-'+ $second_postalcode) : '';
      $meta['zip'] = $zipcode;     
      $meta['address'] = $('input[name=student_address]').val();
      $meta['tel'] = $('input[name=student_phone]').val();
      $meta['email_flg'] = $('input[name=student_mail_flg]:checked').is(':checked') ? '0' : '1';
     
      $meta['emergency_tel'] = $('input[name=student_emergency_tel]').val();
      $meta['parent_name'] = $('input[name=student_parent_name]').val();
      $meta['school_name'] = $('input[name=student_school_name]').val();
      $meta['school_grade'] = $('select[name=student_school_grade]').val();

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
      $meta['enquete'] = {
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
      $meta['memo_to_coach'] = $('textarea[name=memo_to_coach]').val();
        $bus_use_flg = $('input:radio[name=bus_use_flg]:checked').val();
      $meta['bus_use_flg'] = $bus_use_flg;
      $meta['iccard'] = $('input[name=iccard]').val();
      $meta['life_check_flg'] = $('input[name=chb_lifecheck]:checked').is(':checked')?'1':'0';
      $meta['life_check_date'] = $('input[name=life_check_date]').val().replace(/\s/g, '');
      $meta['first_lesson_date'] = $('input[name=first_lesson_date]').val().replace(/\s/g, '');   
      $meta['rest_start_date'] = $('input[name=rest_start_date]').val().replace(/\s/g, '');
      $meta['rest_end_date'] = $('input[name=rest_end_date]').val().replace(/\s/g, '');
      $meta['quit_date'] = $('input[name=quit_date]').val().replace(/\s/g, '');
      $meta['memo_special'] = $('textarea[name=memo_special]').val();
      $meta['medley'] = $("input[name='medley']:checked").is(':checked')?$("input[name='medley']:checked").val():'0';

      $a_status = {};
      $a_status['email']=  $('input[name=student_mail]').val();
      $a_status['status']= $("input[name='student_status']:checked").is(':checked') ? $("input[name='student_status']:checked").val() : '1';
      $a_status['rest_flg'] = $("input[name='student_rest']:checked").is(':checked')?$("input[name='student_rest']:checked").val():'0';
      $a_status['lock_flg'] = $("input[name='student_lock']:checked").is(':checked')?$("input[name='student_lock']:checked").val():'0';

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
      if( $bus_use_flg == '1')
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
            if(result == 'Success')
            {
                $('.modal-body').addClass('alert alert-success');
                $('#status_update').html("<b>基本契約情報を更新しました</b>");
                $('.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                $('#modal-notice').modal('show');
                window.setTimeout(function () {
                    $('#modal-notice').fadeToggle(500, function () {
                        $('#modal-notice').modal('hide');
                        window.location = url_top + '/member/detail/'+ $student_id ;
                    });
                }, 1000);
            }
            else
            {
                $('.modal-body').addClass('alert alert-danger');
                $('#status_update').html("<b>基本契約情報の更新に失敗しました</b>");
                $('.modal-content').css({'border-radius': '5px','height':'150px','text-align':'center'});
                $('#modal-notice').modal('show');
                window.setTimeout(function () {
                    $('#modal-notice').fadeToggle(500, function () {
                        $('#modal-notice').modal('hide');
                    });
                }, 1000);
            }
          }
      });
  }); 
    
});