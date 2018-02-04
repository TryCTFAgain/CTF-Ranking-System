

// Load score
jQuery(function ($) {
    // update to table
    $(document).ready(function(){
        // load libs
        $.getScript( "/assets/js/validate.js", function() {
          load();
        });
    });           
});

// load Score
function load(){
  var traffic = []  

  $.ajax({
      type: "post",
      data: {"load": true},
      dataType: "json",
      success: function(data){
          $.each(data, function(index, event){
            traffic.push({
                "Title": entities(`${event['title']}`),
                "Start": entities(`${event['start']}`),
                "Finish": entities(`${event['finish']}`),
                "Weight": entities(`${event['weight']}`),
                "Description": entities(`${event['description']}`),
            })
          })

          $("#events").shieldGrid({
              dataSource: {
                  data: traffic
              },
              sorting: {
                  multiple: true
              },
              rowHover: false,
              paging: false,
              columns: [
                  { field: "Title", width: "75px", title: "Title" },
                  { field: "Start", width: "50px", title: "Start" },                
                  { field: "Finish", width: "50px", title: "Finish" },                
                  { field: "Weight", width: "20px", title: "Weight"},
                  { field: "Description", width: "200px", title: "Description"},
              ]
          });     
      }
  });
}
