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