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
    $("#course_form").validate({
        rules: {
            course_code: "required",
            course_name: "required",
            short_course_name: {
                required: true,
            },
            max_count: {
                required: true,
                number: true,
                digits: true,
                min:1,
            },
            left_num: {
                required: true,
                number: true
            },
            type:"required"
        },
        messages: {
            course_code:"この項目は必須です",
            course_name:"この項目は必須です",
            short_course_name:"この項目は必須です",
            max_count:{
                required:true,
            },
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
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });

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
                        console.log(data);
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
    $("#number_practice_select").val(practice_select);
}

//onchange number practice select

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

//check dd/mm/yy end > dd/mm/yy start
    $(document).ready(function () {
        $("#day_end").change(function () {
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
            if (date_end < date_start) {
                $('#popup').click();
                $('.modal-body').addClass('alert alert-danger');
                $("#status_update").html("<b>Ngày kết thúc phải lớn hơn ngày bắt đầu </b>");
                window.setTimeout(function () {
                    $('#myModal').fadeToggle(300, function () {
                        $('#myModal').modal('hide');
                    });
                }, 1500);
                var next_year = parseInt(year_end) + parseInt(1);
                $("#year_end").val(next_year);
                return false;
            }
            return true;
        })
    });

//check dd/mm/yy end > dd/mm/yy regist start

$(document).ready(function () {
    $("#day_regist_start").change(function () {
        var year_start = $('#year_start').val();
        var month_start = $('#month_start').val();
        var day_start = $('#day_start').val();
        var year_regist_start = $('#year_regist_start').val();
        var month_regist_start = $('#month_regist_start').val();
        var day_regist_start = $('#day_regist_start').val();
        var start = year_start + '-' + month_start + '-' + day_start;
        var end = year_regist_start + '-' + month_regist_start+ '-' + day_regist_start;
        var date_start = new Date(start);
        var date_end = new Date(end);
        if (date_end > date_start) {
            $('#popup').click();
            $('.modal-body').addClass('alert alert-danger');
            $("#status_update").html("<b>Ngày kết thúc phải lớn hơn ngày bắt đầu </b>");
            window.setTimeout(function () {
                $('#myModal').fadeToggle(300, function () {
                    $('#myModal').modal('hide');
                });
            }, 1500);
            var next_year = parseInt(year_start) - parseInt(1);
            $("#year_regist_start").val(next_year);
            return false;
        }
        return true;
    })
});


//check dd/mm/yy end > dd/mm/yy regist end

$(document).ready(function () {
    $("#day_regist_end").change(function () {
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
        if (date_end < date_start) {
            $('#popup').click();
            $('.modal-body').addClass('alert alert-danger');
            $("#status_update").html("<b>Ngày kết thúc phải lớn hơn ngày bắt đầu </b>");
            window.setTimeout(function () {
                $('#myModal').fadeToggle(300, function () {
                    $('#myModal').modal('hide');
                });
            }, 1500);
            var next_year = parseInt(year_regist_end) + parseInt(1);
            $("#year_regist_end").val(next_year);
            return false;
        }
        return true;
    })
});

//onchange check age
$(document).ready(function(){
    $("#condition_age_from").change(function () {
        // $('#condition_age_to').removeAttr('disabled');
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
       if (condition_age_to<condition_age_from)
       {
           var age_from = parseInt(condition_age_to) - parseInt(1);
            $('#condition_age_from').val(age_from);
       }
    })
});

////onchange check age
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
