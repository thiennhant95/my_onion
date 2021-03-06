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
    // $.validator.addMethod("regex", function(value, element) {
    //     return this.optional(element) ||/^(\d?[1-9]+\d*)(,\s*\d?[1-9]+\d*\s*)*$/.test(value);
    // }, "有効な数値を入力してください.");
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
            item_name: "この項目は必須です",
            item_code: "この項目は必須です",
            sell_price: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。"
            },
            buy_price: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。"
            },
            left_num: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。"
            },
            type:"この項目は必須です"
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
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
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
            dataType:'json',
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').removeClass('alert alert-danger');
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/item';
                        });
                    }, 900);
                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この品名コードは既存しています。他の品名コードを入力してください。 </b>");
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
            dataType:'json',
            success: function (data) {
                if (data.status  == 1) {
                    $('#popup').click();
                    $('.modal-body').removeClass('alert alert-danger');
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>品目を追加しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/item';
                        });
                    }, 900);

                }
                else if (data.status  == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この品名コードは既存しています。他の品名コードを入力してください。</b>");
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

String.prototype.reverse = function () {
    return this.split("").reverse().join("");
}
function reformatText(input) {
    var x = input.value;
    x = x.replace(/,/g, ""); // Strip out all commas
    x = x.reverse();
    x = x.replace(/.../g, function (e) {
        return e + ",";
    }); // Insert new commas
    x = x.reverse();
    x = x.replace(/^,/, ""); // Remove leading comma
    input.value = x;
}

