$(document).ready(function(){
    $("#Search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var keyword = 'keyword='+value;
        $.ajax({
            type: 'GET',
            url: 'ajax-search.php',
            data: keyword,
            success: function(server_response)
            {
                $('#datatable-responsive').remove();
                $('#content').html(server_response).show();
            }
        });

    });


    $('[data-toggle="popover"]').popover();
});