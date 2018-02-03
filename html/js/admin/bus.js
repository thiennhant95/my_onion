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
var i=$('tr:last td [id^=route_oder]').attr('data_i');
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
            $('tr:last td [id^=route_oder]').attr('name', 'route_oder[' + (i) + ']');
            $('tr:last td [id^=route_oder]').attr('id', 'route_oder[' + (i) + ']');

            ++i;
        } else {
            $(this).append(tds);
            $('tr:last td input').removeAttr("href");
            $('tr:last td #route_id').val('');
        }
    });
});



//  validate edit/ create bus course-route
$(document).ready(function() {
    $("#bus_couse").validate({
        focusInvalid: false,
        ignore: [],
        rules: {
            bus_course_code: "required",
            bus_course_name: "required",
            max: {
                required: true,
                number: true,
                digits: true,
                min:1
            },
            'route_oder[]': {
                required: true,
                number: true
            },
            'go_time[]': "required",
            'ret_time[]': "required",
        },
        messages: {
            bus_course_code: "この項目は必須です",
            bus_course_name: "この項目は必須です",
            max: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。",
                digits: "数字のみ入力して下さい。",
                min: "1以上の値を入力してください",
            },
            'route_oder[]': {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。"
            }
            // 'go_time[]': "この項目は必須です",
            // 'ret_time[]': "この項目は必須です",
        },
        errorClass: "label label-danger",
        highlight: function (element, errorClass, validClass) {
            return false;
        },
        unhighlight: function (element, errorClass, validClass) {
            return false;
        }
    });
    $('[name^="route_order"]').each(function() {
        $(this).rules('add', {
            required: true,
            number: true,
            messages: {
                required: "この項目は必須です",
                number: "有効な数値を入力してください。"
            }
        })
    });
    $('[name^="go_time"]').each(function() {
        $(this).rules('add', {
            required: true,
            messages: {
                required: "この項目は必須です",
            }
        })
    });
    $('[name^="ret_time"]').each(function() {
        $(this).rules('add', {
            required: true,
            messages: {
                required: "この項目は必須です",
            }
        })
    });
    $('#bus_couse input ').on('keyup blur', function () {
        if ($('#bus_couse').valid()) {
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//update bus course - bus route
var array=[];
$("#update").click(function(e) {
    if ($('#bus_couse').valid()) {
        e.preventDefault();
        var data_id = $(this).attr("data_id");
        var bus_course_code = $("#bus_course_code").val();
        var bus_course_name = $("#bus_course_name").val();
        var class_id = $("#class_id").val();
        var max = $("#max").val();
        $('input.route-order').each(function() {
            array.push($(this).val());
        });
        $("#route_order_hidden").val(array);
        var dataString = 'bus_course_code=' + bus_course_code + '&bus_course_name=' + bus_course_name + '&class_id=' + class_id + '&max=' + max;
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: $('#bus_couse').serialize(),
            url: url_top + '/bus_route/edit/' + data_id,
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>情報を更新しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/bus_route';
                        });
                    }, 1000);
                }
                else if (data.status == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>このバスコースコードは既存しています。他のバスコースコードを入力してください。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                        });
                    }, 2000);
                }
            }
        });
        array = [];
    }
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
        $('input.route-order').each(function() {
            array.push($(this).val());
        });
        $("#route_order_hidden").val(array);
        var dataString = 'bus_course_code=' + bus_course_code + '&bus_course_name=' + bus_course_name + '&class_id=' + class_id + '&max=' + max;
        $.ajax({
            type: 'POST',
            dataType:'json',
            data: $('#bus_couse').serialize(),
            url: url_top + '/bus_route/create/',
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-success');
                    $("#status_update").html("<b>バスコースを追加しました。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                            window.location = url_top + '/bus_route';
                        });
                    }, 1000);
                }
                else if (data.status == 0) {
                    $('#popup').click();
                    $('.modal-body').addClass('alert alert-danger');
                    $("#status_update").html("<b>このバスコースコードは既存しています。他のバスコースコードを入力してください。</b>");
                    window.setTimeout(function () {
                        $('#myModal').fadeToggle(300, function () {
                            $('#myModal').modal('hide');
                        });
                    }, 2000);
                }
            }
        });
        array = [];
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
            // $('button.btn').prop('disabled', false);
        } else {
            // $('button.btn').prop('disabled', 'disabled');
        }
    });
});

//create data bus stop
$("#create_bus_stop").click(function(e) {
    if ($('#bus_stop_form').valid()) {
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            dataType:'json',
            type: 'POST',
            data: $('#bus_stop_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
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
                else if (data.status == 0) {
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
            dataType : "json",
            type: 'POST',
            data: $('#bus_stop_form').serialize(),
            url: url,
            success: function (data) {
                console.log(data);
                if (data.status == 1) {
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
                else if (data.status == 0) {
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

//copy bus route
$("#mytable").on("click", ".copy", function (e) {
// $(".copy").click(function(e) {
        e.preventDefault();
        var table = url_top +'/bus_route'+"#mytable";
        var id = $(this).attr("id");
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url_top + '/bus_route/copy/'+id,
            success: function (data) {
                // console.log(data);
                $('#popup').click();
                $('.modal-body').addClass('alert alert-success');
                $("#status_update").html("<b>正常にコピーされた。 </b>");
                window.setTimeout(function () {
                    $('#myModal').fadeToggle(300, function () {
                        $('#myModal').modal('hide');
                    });
                }, 1000);
                //Compose template string
                String.prototype.compose = (function (){
                    var re = /\{{(.+?)\}}/g;
                    return function (o){
                        return this.replace(re, function (_, k){
                            return typeof o[k] != 'undefined' ? o[k] : '';
                        });
                    }
                }());
                var tbody = $('#mytable').children('tbody');
                var table = tbody.length ? tbody : $('#mytable');
                var row = '<tr>'+
                    '<td>{{bus_course_code}}</td>'+
                    '<td>{{bus_course_name}}</td>'+
                    '<td>{{class_name}}</td>'+
                    '<td>{{max}}</td>'+
                    '<td>{{action}}</td>'+
                    '</tr>';
                    //Add row
                    table.append(row.compose({
                        'bus_course_code':data.bus_course_code ,
                        'bus_course_name': data.bus_course_name,
                        'class_name': data.class_name,
                        'max':data.max,
                        'action':' <div class="row">\n' +
                            '                            <div class="col-xs-4">\n' +
                            '                                <a id="edit_row" href="" class="btn btn-outline-blue btn-block btn-sm">編集</a>\n' +
                            '                            </div>\n' +
                            '                            <div class="col-xs-4">\n' +
                            '                                <button id="delete_row" href="" class="btn btn-default btn-block btn-sm" data-type="マスター設定​">削除</button>\n' +
                            '                            </div>\n' +
                            '                            <div class="col-xs-4">\n' +
                            '                                <a id="copy_row" href="" class="btn btn-default btn-block btn-sm">コピー作成</a>\n' +
                            '                            </div>\n' +
                            '                        </div>',
                        })
                    );
                        var edit_row =url_top +'/bus_route/edit/'+data.id;
                        var delete_row =url_top + '/bus_route/delete/'+data.id;
                        var copy_row=url_top + '/bus_route/copy/'+data.id;
                        $('#edit_row').attr("href", edit_row);
            //             $('#delete_row').attr("href", delete_row);
            //             $('#copy_row').attr("href",copy_row);
            }
        });
});



