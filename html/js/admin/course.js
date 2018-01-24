// get item cost
$(document).ready(function(){
    $("#cost_item_id").change(function () {
    var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#cost_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#cost_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});
// get item rest
$(document).ready(function(){
    $("#rest_item_id").change(function () {
        var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#rest_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#rest_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});

// get item bus
$(document).ready(function(){
    $("#bus_item_id").change(function () {
        var id =this.value;
        $.ajax({
            type: "GET",
            url: url_top +'/course/get_item/'+id,
            dataType : "json",
        })
            .done(function(data){
                console.log(data);
                $('#bus_item').html(data.sell_price+'円');
            })
            .fail(function(){
                $('#bus_item').html('<i class="glyphicon glyphicon-info-sign"></i>空のデータ');
            });
    })
});

//update course
$(document).ready(function() {
    $("#update").click(function (e) {
        if ($('#course_form').valid()) {
            e.preventDefault();
            var id = $(this).attr("data_id");
            $.ajax({
                dataType: 'json',
                type: 'POST',
                data: $('#course_form').serialize(),
                url: url_top+'/course/edit/'+id,
                success: function (data) {
                    console.log(data);
                    if (data.status == 1) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-success');
                        $("#status_update").html("<b>情報を更新しました。 </b>");
                        window.setTimeout(function () {
                            $('#myModal').fadeToggle(300, function () {
                                $('#myModal').modal('hide');
                                window.location = url_top + '/course';
                            });
                        }, 1000);
                    }
                    else if (data.status == 0) {
                        $('#popup').click();
                        $('.modal-body').addClass('alert alert-danger');
                        $("#status_update").html("<b>このコースコードは既存しています。再度してください。</b>");
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
});