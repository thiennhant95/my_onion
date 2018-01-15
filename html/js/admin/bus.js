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
$('input[type=asia-time]').w2field('time',  { format: 'h24' });

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
$("#insert-more").click(function () {
    $("#route-table").each(function () {
        var tds = '<tr>';
        jQuery.each($('tr:last td', this), function () {
            tds += '<td>' + $(this).html() + '</td>';
        });
        tds += '</tr>';
        if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
        } else {
            $(this).append(tds);
        }
    });
});

//validate edit/ create bus course-route
$(document).ready(function() {
    $("#bus_couse").validate({
        rules: {
            bus_course_code: "required",
            bus_course_name: "required",
            max: {
                required: true,
                number: true
            },
            'route_order[]': {
                required: true,
                number: true
            },
            go_time: "required",
            ret_time: "required",
        },
        messages: {
            bus_course_code: "必須",
            bus_course_name: "必須",
            max: {
                required: "必須",
                number: "数字形式"
            },
            'route_order[]': {
                required: "必須",
                number: "数字形式"
            },
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
    $('#bus_couse input').on('keyup blur', function () {
        if ($('#bus_couse').valid()) {
            $('button.btn').prop('disabled', false);
        } else {
            $('button.btn').prop('disabled', 'disabled');
        }
    });
});