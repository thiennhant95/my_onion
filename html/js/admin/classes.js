//validate form class
$(document).ready(function() {
    // jQuery.validator.addMethod("math", function(value, element, params) {
    //     return this.optional(element) ||/^[M|A|B|C|D,E|F].*/.test(value);
    // }, jQuery.validator.format("ký tự đầu là 1 trong M,A,B,C,D,E,F"));
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
                    min:1
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
                console.log(data);
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
                    }, 2000);
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
                console.log(data.success);
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
                    }, 2000);
                }
            }
        });
    }
});
