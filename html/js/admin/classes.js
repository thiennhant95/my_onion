//validate form class
$(document).ready(function() {
    jQuery.validator.addMethod("math", function(value, element, params) {
        return this.optional(element) ||/^[M|A|B|C|D,E|F].*/.test(value);
    }, jQuery.validator.format("ký tự đầu là 1 trong M,A,B,C,D,E,F"));
    $("#class_form").validate({
        rules: {
            class_code: {
                math:true,
                required:true
            },
            name_class: "required",
        },
        messages: {
            class_code:
                {
                    required: "必須",
                },
            name_class: "必須",
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
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });

});

//update data
$("#update").click(function(e) {
    if ($('#class_form').valid()) {
        e.preventDefault();
        var id = $(this).attr("data_id");
        $.ajax({
            type: 'POST',
            data: $('#class_form').serialize(),
            url: url_top + '/classes/edit/' + id,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>Updated!</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/classes';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>Update fail! Item code already exists</b>");
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