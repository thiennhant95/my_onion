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


//format 24h time
$("#route-table").on('click', 'input[type="asia-time"]', function () {
    $('input[type=asia-time]').w2field('time', {format: 'h24'});
});

//delete row bus_route
$(document).ready(function(){
    $("#route-table").on('click','.btnDelete',function(e){
        $this  = $(this);
        e.preventDefault();
        var url_edit=$(this).attr("url_edit")+' #route-table';

        var url = $(this).attr("href");
        $.get(url, function(r){
            if ($('#route-table tr').length > 2) {
                $this.closest('tr').remove();
            }
            else if ($('#route-table tr').length = 2)
            {
                $("#route-table").load(url_edit);
            }
        })
    });
});

//append row table bus_route
    $("body").on("click", ".insert-more", function () {
        $this = $(this);
        var url_edit = $(this).attr("url_edit") + ' #route-table';
        $("#route-table").each(function () {

            var tds = '<tr>';
            jQuery.each($('tr:last td', this), function () {
                tds += '<td>' + $(this).html() + '</td>';
            });
            tds += '</tr>';
            if ($('tbody', this).length > 0) {
                $('tbody', this).append(tds);
                $('tr:last td input').removeAttr("href");
                $('tr:last td #route_id').val('');
            } else {
                $(this).append(tds);
            }
        });
    });


//  validate edit/ create bus course-route
$(document).ready(function() {
    $("#bus_couse").validate({
        rules: {
            bus_course_code: "required",
            bus_course_name: "required",
            max: {
                required: true,
                number: true
            },
            // 'route_order[]': {
            //     required: true,
            //     number: true
            // },
            'go_time[]': "required",
            'ret_time[]': "required",
        },
        messages: {
            bus_course_code: "必須",
            bus_course_name: "必須",
            max: {
                required: "必須",
                number: "数字形式"
            },
            // 'route_order[]': {
            //     required: "必須",
            //     number: "数字形式"
            // },
            go_time: "必須",
            ret_time: "必須",
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        }
    });
    $("input.route-order").each(function(){
        $(this).rules("add", {
            required:true,
            number:true
        });
    });
    $('#bus_couse input').on('keyup blur', function () {
        if ($('#bus_couse').valid()) {
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//update bus course - bus route
$("#update").click(function(e) {
    // if ($('#bus_couse').valid()) {
        e.preventDefault();
        var data_id = $(this).attr("data_id");
        var bus_course_code = $("#bus_course_code").val();
        var bus_course_name = $("#bus_course_name").val();
        var class_id = $("#class_id").val();
        var max = $("#max").val();
        var dataString = 'bus_course_code=' + bus_course_code + '&bus_course_name=' + bus_course_name + '&class_id=' + class_id + '&max=' + max;
        $.ajax({
            type: 'POST',
            data: $('#bus_couse').serialize(),
            url: url_top + '/bus_route/edit/' + data_id,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>Updated!</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/bus_route';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>Update fail! Bus course code already exists</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                        });
                    }, 2000);
                }
            }
        });
    // }
});

//create bus course - bus route
$("#create").click(function(e) {
    if ($('#bus_couse').valid()) {
        e.preventDefault();
        var data_id = $(this).attr("data_id");
        var bus_course_code = $("#bus_course_code").val();
        var bus_course_name = $("#bus_course_name").val();
        var class_id = $("#class_id").val();
        var max = $("#max").val();
        var dataString = 'bus_course_code=' + bus_course_code + '&bus_course_name=' + bus_course_name + '&class_id=' + class_id + '&max=' + max;
        $.ajax({
            type: 'POST',
            data: $('#bus_couse').serialize(),
            url: url_top + '/bus_route/create/',
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>Updated!</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/bus_route';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>Update fail! Bus course code already exists</b>");
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

//validate bus stop
//validate form
$(document).ready(function() {
    $("#bus_stop_form").validate({
        rules: {
            bus_stop_code: "required",
            bus_stop_name: {
                required: true,
            },
        },
        messages: {
            bus_stop_code: "この項目は必須です",
            bus_stop_name: {
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
    $('#bus_stop_form input').on('keyup blur', function () {
        if ($('#bus_stop_form').valid()) {
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//create data bus stop
$("#create_bus_stop").click(function(e) {
    if ($('#bus_stop_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#bus_stop_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>バス停を追加しました。 </b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/bus_stop';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この乗車場所コードは既存しています。他の乗車場所コードを入力してください。 </b>");
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

//update data bus stop
$("#update_bus_stop").click(function(e) {
    if ($('#bus_stop_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: 'POST',
            data: $('#bus_stop_form').serialize(),
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
                            window.location = url_top + '/bus_stop';
                        });
                    }, 1000);
                }
                else if (data == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>この乗車場所コードは既存しています。他の乗車場所コードを入力してください。</b>");
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