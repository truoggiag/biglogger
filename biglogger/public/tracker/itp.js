    $(document).ready(function(){
  var data = 'id_app=bf9f7f0f-1aca-4a95-847f-1fb3890b0c6e&key=86d24c4648e5115330312e5884f82a6a';
  $.ajax({
            type: 'GET',
              url: 'http://biglogger.snvn.net/api/contentvisitor',
            data: data,
            success: function(server_response)
            {
                console.log(server_response);
            }
        });
});