(function($){

  $(document).ready(function() {
    $('#github-data').DataTable({
      "ajax": {
        "url": "http://localhost/lexumo/get_repositories.php?languages=cpp;c",
        "dataSrc": function(data){
          return data.payload;
        }
      },
      "pageLength": 20,
      "columns": [
        { "data": "repository_id" },
        { "data": "repository_short_name" },
        { "data": "repository_full_name" },
        { "data": "language" },
        { 
          "data": "url",
          "title": "Order No.",
          "render": function (data) {
            return '<a href="' + data + '" target="_blank">' + data + '</a>';
          }
        }
      ]
    });
  });

})(jQuery);