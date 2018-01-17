// confirm delete
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
    $("#item_form").validate({
        rules: {
            item_name: "required",
            item_code: "required",
            sell_price: {
                required: true,
                number: true
            },
            buy_price: {
                required: true,
                number: true
            },
            left_num: {
                required: true,
                number: true
            },
            type:"required"
        },
        messages: {
            item_name: "必須",
            item_code: "必須",
            sell_price: {
                required: "必須",
                number: "数字形式"
            },
            buy_price: {
                required: "必須",
                number: "数字形式"
            },
            left_num: {
                required: "必須",
                number: "数字形式"
            },
            type:"必須"
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        }
    });
    $('#item_form input').on('keyup blur', function () {
        if ($('#item_form').valid()) {
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });

});

//update data
$("#update").click(function(e) {
    if ($('#item_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        var item_code = $("#item_code").val();
        var item_name = $("#item_name").val();
        var subject_id = $("#subject_id").val();
        var sell_price = $("#sell_price").val();
        var buy_price = $("#buy_price").val();
        var tax = $('input[name=tax]:checked', '#item_form').val();
        var manage = $("#manage").is(":checked") ? 1 : 0;
        var left_num = $("#left_num").val();
        var type = $("#type").val();
        var disp_flg = $("#disp_flg").is(":checked") ? 1 : 0;
        var dataString = 'item_code=' + item_code + '&item_name=' + item_name + '&subject_id=' + subject_id + '&sell_price=' + sell_price + '&buy_price=' + buy_price
            + '&tax_flg=' + tax + '&manage_flg=' + manage + '&left_num=' + left_num + '&type=' + type + '&disp_flg=' + disp_flg;
        $.ajax({
            type: 'POST',
            data: $('#item_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>Updated!</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/item';
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

//create data
$("#create").click(function(e) {
    if ($('#item_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        var item_code = $("#item_code").val();
        var item_name = $("#item_name").val();
        var subject_id = $("#subject_id").val();
        var sell_price = $("#sell_price").val();
        var buy_price = $("#buy_price").val();
        var tax = $('#tax').is(":checked") ? 1 : 0;


        var manage = $("#manage").is(":checked") ? 1 : 0;
        var left_num = $("#left_num").val();
        var type = $("#type").val();
        var disp_flg = $("#disp_flg").is(":checked") ? 1 : 0;
        var dataString = 'item_code=' + item_code + '&item_name=' + item_name + '&subject_id=' + subject_id + '&sell_price=' + sell_price + '&buy_price=' + buy_price
            + '&tax_flg=' + tax + '&manage_flg=' + manage + '&left_num=' + left_num + '&type=' + type + '&disp_flg=' + disp_flg;
        $.ajax({
            type: 'POST',
            data: $('#item_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>Inserted!</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/item';
                        });
                    }, 1000);

                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>Insert fail! Item code already exists</b>");
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

