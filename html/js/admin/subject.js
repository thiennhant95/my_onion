//comfirm delete
$( document ).ready( function( )
{
    $( '.delete-user-row-with-ajax-button' ).bootstrap_confirm_delete(
        {
            callback: function( event )
            {
                var url = $(this).attr("href");
                $.ajax(
                    {
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        success: function(data)
                        {
                            console.log(data);
                            if(data.status==1)
                            {
                                var button = event.data.originalObject;
                                button.closest( 'tr' ).remove();
                                $("#alert-delete").css("display", "block");
                            }

                        }
                    } );
            }
        }
    );
} );

//validate form
$(document).ready(function() {
    $("#subject_form").validate({
        rules: {
            subject_code: "required",
            subject_name: {
                required: true,
            },
        },
        messages: {
            subject_code: "この項目は必須です",
            subject_name: {
                required: "この項目は必須です",
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
    $('#subject_form input').on('keyup blur', function () {
        if ($('#subject_form').valid()) {
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//create data
$("#create").click(function(e) {
    if ($('#subject_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#subject_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>科目を追加しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/subject';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この科目コードは既存しています。他の科目コードを入力してください。 </b>");
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

//update data
$("#update").click(function(e) {
    if ($('#subject_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#subject_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/subject';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この科目コードは既存しています。他の科目コードを入力してください。</b>");
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
