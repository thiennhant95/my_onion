
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
