
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
    $("#distance_form").validate({
        rules: {
            distance_code: "required",
            distance_name: {
                required: true,
                number: true,
                // min:10,
                digits: true
            },
        },
        messages: {
            distance_code: "この項目は必須です",
            distance_name: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。",
                // min: "10以上の値を入力してください",
                digits: "数字のみ入力して下さい。",
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
    $('#distance_form input').on('keyup blur', function () {
        if ($('#distance_form').valid()) {
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//create data
$("#create").click(function(e) {
    if ($('#distance_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: $('#distance_form').serialize(),
            url: url,
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').removeClass('alert alert-danger');
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>距離を追加しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/distance';
                        });
                    }, 1000);
                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この距離コードは既存しています。他の距離コードを入力してください。 </b>");
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
    if ($('#distance_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: $('#distance_form').serialize(),
            url: url,
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').removeClass('alert alert-danger');
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/distance';
                        });
                    }, 1000);
                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この距離コードは既存しています。他の距離コードを入力してください。 </b>");
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
