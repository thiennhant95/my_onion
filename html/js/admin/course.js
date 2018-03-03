// get item cost
$(document).ready(function(){
    $("#cost_item_id").change(function () {
    var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#cost_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#cost_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});
// get item rest
$(document).ready(function(){
    $("#rest_item_id").change(function () {
        var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#rest_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#rest_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});

// get item bus
$(document).ready(function(){
    $("#bus_item_id").change(function () {
        var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#bus_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#bus_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});

//validate form
$(document).ready(function() {
    $.validator.addMethod(
        "end_date",
        function(value, element) {
            var year_start = $('#year_start').val();
            var month_start = $('#month_start').val();
            var day_start = $('#day_start').val();
            var year_end = $('#year_end').val();
            var month_end = $('#month_end').val();
            var day_end = $('#day_end').val();
            var start = year_start + '-' + month_start + '-' + day_start;
            var end = year_end + '-' + month_end + '-' + day_end;
            var date_start = new Date(start);
            var date_end = new Date(end);
            if (date_end <= date_start) {
                if(!$("#nomal_type").is(':checked')) {
                    return false;
                }
            }
            return true;
        },
        "開催終了は開催開始の値以降で入力してください。"
    );
    $.validator.addMethod(
        "start_regist",
        function(value, element) {
            var year_end = $('#year_end').val();
            var month_end = $('#month_end').val();
            var day_end = $('#day_end').val();
            var year_regist_start = $('#year_regist_start').val();
            var month_regist_start = $('#month_regist_start').val();
            var day_regist_start = $('#day_regist_start').val();
            var start = year_end + '-' + month_end + '-' + day_end;
            var end = year_regist_start + '-' + month_regist_start+ '-' + day_regist_start;
            var date_start = new Date(start);
            var date_end = new Date(end);
            if (date_end >= date_start) {
                if(!$("#nomal_type").is(':checked')) {
                    return false;
                }
            }
            return true;
        },
        "Ngày đăng kí phải nhỏ hơn ngày kết thúc"
    );
    $.validator.addMethod(
        "end_regist",
        function(value, element) {
            var year_regist_start = $('#year_regist_start').val();
            var month_regist_start = $('#month_regist_start').val();
            var day_regist_start = $('#day_regist_start').val();
            var year_regist_end = $('#year_regist_end').val();
            var month_regist_end = $('#month_regist_end').val();
            var day_regist_end = $('#day_regist_end').val();
            var end = year_regist_end + '-' + month_regist_end+ '-' + day_regist_end ;
            var start = year_regist_start + '-' + month_regist_start+ '-' + day_regist_start;
            var date_start = new Date(start);
            var date_end = new Date(end);
            if (date_end <= date_start) {
                if(!$("#nomal_type").is(':checked')) {
                    return false;
                }
            }
            return true;
        },
        "申込終了は申込開始の値以降で入力してください。"
    );
    $("#course_form").validate({
        rules: {
            course_code: "required",
            course_name: "required",
            short_course_name: {
                required: true
            },
            max_count: {
                required: true,
                number: true,
                digits: true,
                min:1
            },
            left_num: {
                required: true,
                number: true
            },
            cost_item_id: "required",
            rest_item_id: "required",
            bus_item_id: "required",
            type:"required",
            "end[0]":{
                end_date:true
            },
            "end[1]":{
                end_date:true
            },
            "end[2]":{
                end_date:true
            },
            //
            // "start_regist[0]":{
            //     start_regist:true
            // },
            // "start_regist[1]":{
            //     start_regist:true
            // },
            // "start_regist[2]":{
            //     start_regist:true
            // },

            "end_regist[0]":{
                end_regist:true
            },
            "end_regist[1]":{
                end_regist:true
            },
            "end_regist[2]":{
                end_regist:true
            }
        },
        groups: {
            end_date: "end[0] end[1] end[2]",
            start_regist: "start_regist[0] start_regist[1] start_regist[2]",
            end_regist: "end_regist[0] end_regist[1] end_regist[2]"
        },

        messages: {
            course_code:"この項目は必須です",
            course_name:"この項目は必須です",
            short_course_name:"この項目は必須です",
            max_count:{
                required:"この項目は必須です",
                number: "有効な数値を入力してください。",
                digits: "数字のみ入力して下さい。",
                min: "1以上の値を入力してください"
            },
            cost_item_id: "この項目は必須です",
            rest_item_id: "この項目は必須です",
            bus_item_id: "この項目は必須です"
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        }
    });
    $('#course_form input').on('keyup blur', function () {
        if ($('#course_form').valid()) {
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });

});

$(document).ready(function() {
  $("#nomal_type").click(function (e) {
      if($("#year_end").val('2199'))
      {
          $("#year_end option[value=2199]").remove();
      }
      if($("#month_end").val('00'))
      {
          $("#month_end option[value=00]").remove();
      }
      if($("#day_end").val('2199'))
      {
          $("#year_end option[value=2199]").remove();
      }
      if($("#year_start").val('0000'))
      {
          $("#year_start option[value=0000]").remove();
      }
      if($("#month_start").val('00'))
      {
          $("#month_start option[value=00]").remove();
      }
      if($("#day_end").val('00'))
      {
          $("#year_end option[value=00]").remove();
      }

      $("#year_end").append("<option value='2199' selected>不要</option>");
      $("#month_end").append("<option value='12' selected>不要</option>");
      $("#day_end").append("<option value='31' selected>不要</option>");
      $("#year_start").append("<option value='0000' selected>不要</option>");
      $("#month_start").append("<option value='00' selected>不要</option>");
      $("#day_start").append("<option value='00' selected>不要</option>");
  })
});

$(document).ready(function() {
    $("#short_type").click(function (e) {
        $("#year_start option[value=0000]").remove();
        $("#month_start option[value=00]").remove();
        $("#day_start option[value=00]").remove();
        $("#year_end option[value=2199]").remove();
        $("#month_end option[value=12]").remove();
        $("#day_end option[value=31]").remove();
    })
});

$(document).ready(function() {
    $("#free_type").click(function (e) {
        $("#year_start option[value=0000]").remove();
        $("#month_start option[value=00]").remove();
        $("#day_start option[value=00]").remove();
        $("#year_end option[value=2199]").remove();
        $("#month_end option[value=12]").remove();
        $("#day_end option[value=31]").remove();
    })
});

//update course
$(document).ready(function() {
    $("#update").click(function (e) {
        if ($('#course_form').valid()) {
                e.preventDefault();
                var id = $(this).attr("data_id");
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    data: $('#course_form').serialize(),
                    url: url_top + '/course/edit/' + id,
                    success: function (data) {
                        if (data.status == 1) {
                            $('#popup').click();
                            $('.modal-body').addClass('alert alert-success');
                            $("#status_update").html("<b>情報を更新しました。 </b>");
                            window.setTimeout(function () {
                                $('#myModal').fadeToggle(300, function () {
                                    $('#myModal').modal('hide');
                                    window.location = url_top + '/course';
                                });
                            }, 1000);
                        }
                        else if (data.status == 0) {
                            $('#popup').click();
                            $('.modal-body').addClass('alert alert-danger');
                            $("#status_update").html("<b>このコースコードは既存しています。再度してください。</b>");
                            window.setTimeout(function () {
                                $('#myModal').fadeToggle(300, function () {
                                    $('#myModal').modal('hide');
                                });
                            }, 2000);
                        }
                    }
                });
            }
    });
});

//create course
$(document).ready(function() {
    $("#create").click(function (e) {
        if ($('#course_form').valid()) {
            e.preventDefault();
            $.ajax({
                dataType: 'json',
                type: 'POST',
                data: $('#course_form').serialize(),
                url: url_top+'/course/create/',
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-success');
                        $("#status_update").html("<b>練習コースを追加しました。</b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                                window.location = url_top + '/course';
                            });
                        }, 1000);
                    }
                    else if (data.status == 0) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-danger');
                        $("#status_update").html("<b>このコースコードは既存しています。再度してください。</b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                            });
                        }, 2000);
                    }
                }
            });
        }
    });
});

//check - uncheck radio button free_practic
var radioState = false;
var practice_select=$('#number_practice_select').val();
function test(element){
    if(radioState == false) {
        check();
        radioState = true;
    }else{
        uncheck();
        radioState = false;
    }
}
function check() {
    document.getElementById("free_practice_radio").checked = true;
    $("#number_practice_select").val(0);
}
function uncheck() {
    document.getElementById("free_practice_radio").checked = false;
    $("#number_practice_select").val(1);
}

//onchange number practice select
//     $("#number_practice_select").change(function () {
//         document.getElementById("free_practice_radio").checked = false;
//     });

//onchange select start
$(document).ready(function(){
    $("#month_start").change(function () {
        var month_start=$('#month_start').val();
        var year_start=$('#year_start').val();
        if(month_start==4 ||month_start==6 || month_start==9 ||month_start==11)
        {
            if (($('#day_start option').size()) == 31) {
                $("#day_start option[value=31]").remove();
            }
            if (($('#day_start option').size()) == 29) {
                $("#day_start").append("<option value='30'>30日</option>");
            }
            if (($('#day_start option').size()) == 28) {
                $("#day_start").append("<option value='29'>29日</option>");
                $("#day_start").append("<option value='30'>30日</option>");
            }
        }
        if (month_start==2)
        {
            if (year_start%4==0) {
                $("#day_start option[value=31]").remove();
                $("#day_start option[value=30]").remove();
            }
            else {
                $("#day_start option[value=31]").remove();
                $("#day_start option[value=30]").remove();
                $("#day_start option[value=29]").remove();
            }
        }
        if(month_start==1 ||month_start==3 || month_start==5 ||month_start==7||month_start==8 ||month_start==10 || month_start==12) {
            if (($('#day_start option').size()) == 30) {
                $("#day_start").append("<option value='31'>31日</option>");
            }
            if (($('#day_start option').size()) == 28) {
                $("#day_start").append("<option value='29'>29日</option>");
                $("#day_start").append("<option value='30'>30日</option>");
                $("#day_start").append("<option value='31'>31日</option>");
            }
            if (($('#day_start option').size()) == 29) {
                $("#day_start").append("<option value='30'>30日</option>");
                $("#day_start").append("<option value='31'>31日</option>");
            }
        }
    })
});

//onchange select end
$(document).ready(function(){
    $("#month_end").change(function () {
        var month_end=$('#month_end').val();
        var year_end=$('#year_end').val();
        if(month_end==4 ||month_end==6 || month_end==9 ||month_end==11)
        {
            if (($('#day_end option').size()) == 31) {
                $("#day_end option[value=31]").remove();
            }
            if (($('#day_end option').size()) == 29) {
                $("#day_end").append("<option value='30'>30日</option>");
            }
            if (($('#day_end option').size()) == 28) {
                $("#day_end").append("<option value='29'>29日</option>");
                $("#day_end").append("<option value='30'>30日</option>");
            }
        }
        if (month_end==2)
        {
            if (year_end%4==0) {
                $("#day_end option[value=31]").remove();
                $("#day_end option[value=30]").remove();
            }
            else {
                $("#day_end option[value=31]").remove();
                $("#day_end option[value=30]").remove();
                $("#day_end option[value=29]").remove();
            }
        }
        if(month_end==1 ||month_end==3 || month_end==5 ||month_end==7||month_end==8 ||month_end==10 || month_end==12) {
            if (($('#day_end option').size()) == 30) {
                $("#day_end").append("<option value='31'>31日</option>");
            }
            if (($('#day_end option').size()) == 28) {
                $("#day_end").append("<option value='29'>29日</option>");
                $("#day_end").append("<option value='30'>30日</option>");
                $("#day_end").append("<option value='31'>31日</option>");
            }
            if (($('#day_end option').size()) == 29) {
                $("#day_end").append("<option value='30'>30日</option>");
                $("#day_end").append("<option value='31'>31日</option>");
            }
        }
    })
});

//onchange regist start
$(document).ready(function(){
    $("#month_regist_start").change(function () {
        var month_regist_start=$('#month_regist_start').val();
        var year_regist_start=$('#year_regist_start').val();
        if(month_regist_start==4 ||month_regist_start==6 || month_regist_start==9 ||month_regist_start==11)
        {
            if (($('#day_regist_start option').size()) == 31) {
                $("#day_regist_start option[value=31]").remove();
            }
            if (($('#day_regist_start option').size()) == 29) {
                $("#day_regist_start").append("<option value='30'>30日</option>");
            }
            if (($('#day_regist_start option').size()) == 28) {
                $("#day_regist_start").append("<option value='29'>29日</option>");
                $("#day_regist_start").append("<option value='30'>30日</option>");
            }
        }
        if (month_regist_start==2)
        {
            if (year_regist_start%4==0) {
                $("#day_regist_start option[value=31]").remove();
                $("#day_regist_start option[value=30]").remove();
            }
            else {
                $("#day_regist_start option[value=31]").remove();
                $("#day_regist_start option[value=30]").remove();
                $("#day_regist_start option[value=29]").remove();
            }
        }
        if(month_regist_start==1 ||month_regist_start==3 || month_regist_start==5 ||month_regist_start==7||month_regist_start==8 ||month_regist_start==10 || month_regist_start==12) {
            if (($('#day_regist_start option').size()) == 30) {
                $("#day_regist_start").append("<option value='31'>31日</option>");
            }
            if (($('#day_regist_start option').size()) == 28) {
                $("#day_regist_start").append("<option value='29'>29日</option>");
                $("#day_regist_start").append("<option value='30'>30日</option>");
                $("#day_regist_start").append("<option value='31'>31日</option>");
            }
            if (($('#day_regist_start option').size()) == 29) {
                $("#day_regist_start").append("<option value='30'>30日</option>");
                $("#day_regist_start").append("<option value='31'>31日</option>");
            }
        }
    })
});

//onchange regist end
$(document).ready(function(){
    $("#month_regist_end").change(function () {
        var month_regist_end=$('#month_regist_end').val();
        var year_regist_end=$('#year_regist_end').val();
        if(month_regist_end==4 ||month_regist_end==6 || month_regist_end==9 ||month_regist_end==11)
        {
            if (($('#day_regist_end option').size()) == 31) {
                $("#day_regist_end option[value=31]").remove();
            }
            if (($('#day_regist_end option').size()) == 29) {
                $("#day_regist_end").append("<option value='30'>30日</option>");
            }
            if (($('#day_regist_end option').size()) == 28) {
                $("#day_regist_end").append("<option value='29'>29日</option>");
                $("#day_regist_end").append("<option value='30'>30日</option>");
            }
        }
        if (month_regist_end==2)
        {
            if (year_regist_end%4==0) {
                $("#day_regist_end option[value=31]").remove();
                $("#day_regist_end option[value=30]").remove();
            }
            else {
                $("#day_regist_end option[value=31]").remove();
                $("#day_regist_end option[value=30]").remove();
                $("#day_regist_end option[value=29]").remove();
            }
        }
        if(month_regist_end==1 ||month_regist_end==3 || month_regist_end==5 ||month_regist_end==7||month_regist_end==8 ||month_regist_end==10 || month_regist_end==12) {
            if (($('#day_regist_end option').size()) == 30) {
                $("#day_regist_end").append("<option value='31'>31日</option>");
            }
            if (($('#day_regist_end option').size()) == 28) {
                $("#day_regist_end").append("<option value='29'>29日</option>");
                $("#day_regist_end").append("<option value='30'>30日</option>");
                $("#day_regist_end").append("<option value='31'>31日</option>");
            }
            if (($('#day_regist_end option').size()) == 29) {
                $("#day_regist_end").append("<option value='30'>30日</option>");
                $("#day_regist_end").append("<option value='31'>31日</option>");
            }
        }
    })
});

//onchange check age
$(document).ready(function(){
    $("#condition_age_from").change(function () {
        var condition_age_from=$('#condition_age_from').val();
        var age_to = parseInt(condition_age_from) + parseInt(1);
        var condition_age_to=$('#condition_age_to').val(age_to);
        var a=$('#condition_age_to option').size();
        var i=parseInt(condition_age_from);
        var j = parseInt(condition_age_from) + parseInt(1);
        $('#condition_age_to option').each(function(index,element) {
            $("#condition_age_to option[value=" + i + "]").attr('disabled','disabled').css({"background-color": "#E6E6E6"});
            i--;
            $("#condition_age_to option[value=" + j + "]").removeAttr('disabled').css({"background-color": "white"});
            j++;
        });
    })
});

$(document).ready(function(){
    $("#condition_age_to").change(function () {
        var condition_age_from=$('#condition_age_from').val();
        var condition_age_to=$('#condition_age_to').val();
       if (parseInt(condition_age_to) <= parseInt(condition_age_from))
       {
           var age_from = parseInt(condition_age_to) - parseInt(1);
            $('#condition_age_from').val(age_from);
       }
    })
});

//onchange check grade
$(document).ready(function(){
    $("#condition_grade_from").change(function () {
        var condition_grade_from=$('#condition_grade_from').val();
        var condition_grade_to=$('#condition_grade_to').val();
        if(condition_grade_from=='制限無し')
        {
            $('#condition_grade_to').val('制限無し');
        }
    })
});
