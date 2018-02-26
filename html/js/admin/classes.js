//validate form class
var isSuccess;
var message;
$(document).ready(function() {
    // jQuery.validator.addMethod("math", function(value, element, params) {
    //     return this.optional(element) ||/^[M|A|B|C|D,E|F].*/.test(value);
    // }, jQuery.validator.format("ký tự đầu là 1 trong M,A,B,C,D,E,F"));
    $.validator.addMethod(
        "max_class",
        function(value, element) {
            var course_id=$('#short_course_name').val();
            $.ajax({
                dataType: 'json',
                type: 'POST',
                data: $('#class_form').serialize(),
                url: url_top + '/classes/check_max_count/' +course_id,
                success: function (data) {
                    if (data.status==1)
                    {
                        isSuccess=1;
                        message=data.total;
                    }
                    if (data.status==0)
                    {
                        isSuccess=0;
                    }
                }
            });
            if (isSuccess==1) {
                return false;
            }
            return true;
        },
        "sỉ số tổng các lớp của khóa học phải nhỏ hơn hoặc bằng sỉ số khóa học"
    );
    $("#class_form").validate({
        rules: {
            class_code: {
                // math:true,
                required:true
            },
            class_name: "required",
            "week[]": { required: true, minlength: 1 },
            max_count:
                {
                    required: true,
                    number: true,
                    digits: true,
                    min:1,
                    max_class:true,
                }
        },
        messages: {
            class_code:
                {
                    required: "この項目は必須です",
                },
            class_name: "この項目は必須です",
            "week[]":"一個以上のチェックボックスにチェックを入れてください",
            max_count:
                {
                    required: "この項目は必須です",
                    number: "有効な数値を入力してください。",
                    digits: "有効な数値を入力してください。 ",
                    min: "1以上の値を入力してください",
                }
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        }
    });
    $('#class_form input').on('keyup blur', function () {
        if ($('#class_form').valid()) {
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });

});

//update data
$("#update").click(function(e) {
    if ($('#class_form').valid()) {
        e.preventDefault();
        var id = $(this).attr("data_id");
        $.ajax({
            dataType : "json",
            type: 'POST',
            data: $('#class_form').serialize(),
            url: url_top + '/classes/edit/' + id,
            success: function (data) {
                if (data.success == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/classes';
                        });
                    }, 900);
                }
                else if (data.fail == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>エラーが発生しました。 後でもう一度お試しください。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                        });
                    }, 10000);
                }
            }
        });
    }
});

//Insert data
$("#create").click(function(e) {
    if ($('#class_form').valid()) {
        e.preventDefault();
        $.ajax({
            dataType : "json",
            type: 'POST',
            data: $('#class_form').serialize(),
            url: url_top + '/classes/create/',
            success: function (data) {
                if (data.success == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>クラスを追加しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/classes';
                        });
                    }, 900);
                }
                else if (data.fail == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>エラーが発生しました。 後でもう一度お試しください。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                        });
                    }, 10000);
                }
            }
        });
    }
});
function ValidateInput(ctrl) {
    if (event.keyCode == 8 ||event.keyCode == 46 ||event.keyCode==65) {
        var short_course = $('#short_course_name').val();
        var class_sign = $('#base_class_sign').val();
        var class_code =short_course+class_sign;
        //check whether the user is trying to delete the fixed text
        if (ctrl.selectionStart <=class_code.length) return false;
    }
    return true;
}
// onchange short code name
$(document).ready(function(){
    $("#short_course_name").change(function () {
        var value = $('#short_course_name').val();
        // var code=$('#class_code').val();
        // var lastChar = code.substr(code.length - 1);
        var base = $('#base_class_sign').val();
        $.ajax({
            dataType : "json",
            type: 'GET',
            url: url_top + '/classes/get_short_course_name/'+value,
            success: function (data) {
                console.log(data.short_course_name);
                $('input#class_code').val(data.short_course_name+base);
            }
        })
    })
});

//onchange base_class_sign
$(document).ready(function(){
    $("#base_class_sign").change(function () {
        var short_name = $('#short_course_name').val();
        $.ajax({
            dataType : "json",
            type: 'GET',
            url: url_top + '/classes/get_short_course_name/'+short_name,
            success: function (data) {
                console.log(data.short_course_name);
                var value = $('#base_class_sign').val();
                var class_code=data.short_course_name+value;
                $('input#class_code').val(class_code);
            }
        })
    })
})

//check week
$("input[type=checkbox]").change( function() {
    if($(this).is(":checked")){
        var week= $(this).val();
        var short_course=$('#short_course_name').val();
        var class_id=$('#class_id').val();
        var class_sign=$('#base_class_sign').val();
        $.ajax({
            dataType : "json",
            type: 'GET',
            url: url_top + '/classes/check_week/'+short_course+'/'+class_sign+'/'+week+'/'+class_id,
            success: function (data) {
                console.log(data);
                if (data.status==1)
                {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>Bạn không thể chọn</b>");
                    // window.setTimeout(function () {
                    //     $('#myModal').fadeToggle(300, function () {
                    //         $('#myModal').modal('hide');
                    //     });
                    // }, 5000);
                    $("input[value="+week+"]:checked").removeAttr('checked');
                }
            }
        });
    }
});



