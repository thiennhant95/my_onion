
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
                            // console.log(data);
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
    $("#grade_form").validate({
        rules: {
            grade_code: "required",
            grade_name: {
                required: true,
            },
        },
        messages: {
            grade_code: "この項目は必須です",
            grade_name: {
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
    $('#grade_form input').on('keyup blur', function () {
        if ($('#grade_form').valid()) {
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//create data
$("#create").click(function(e) {
    if ($('#grade_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#grade_form').serialize(),
            url: url,
            dataType:'json',
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>級を追加しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/grade';
                        });
                    }, 900);
                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この級コードは既存しています。他の級コードを入力してください。 </b>");
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

//update data
$("#update").click(function(e) {
    if ($('#grade_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#grade_form').serialize(),
            url: url,
            dataType:'json',
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/grade';
                        });
                    }, 900);
                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この級コードは既存しています。他の級コードを入力してください。</b>");
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

