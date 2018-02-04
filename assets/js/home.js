

// Load score
jQuery(function ($) {
    // update to table
    $(document).ready(function(){
        // load libs
        $.getScript( "/assets/js/validate.js", function() {
          loadScore();
          getlistevents();
        });
    });           
});

// load Score
function loadScore(){
  var traffic = [];
  $.ajax({
      type: "post",
      data: {'loadScore':true},
      success: function(data){
          data = JSON.parse(data);
          if (! data['error']){
            data.forEach(function(row, index) {
              eventName = (row['isConfirm'] == 1) 
                            ? entities(row['event'])  
                            : `<font color="#818285">${entities(row['event'])}</font>`
              traffic.push({
                  "Events": eventName, 
                  'Web Exploit': entities(row['webScore']), 
                  'Reverse': entities(row['reScore']), 
                  'Pwnable': entities(row['pwnScore']), 
                  "Cryptography": entities(row['cryptScore']),
                  "Forensic": entities(row['forScore']),
                  "Misc": entities(row['miscScore'])
              })
          });
          }
          // update to table
          $("#scoreboard").shieldGrid({
              dataSource: {
                  data: traffic
              },
              sorting: {
                  multiple: true
              },
              rowHover: false,
              paging: false,
              columns: [
                  { field: "Events", width: "100px", title: "Events" },
                  { field: "Web Exploit", width: "50px", title: "Web Exploit" },                
                  { field: "Reverse", width: "50px", title: "Reverse" },                
                  { field: "Pwnable", width: "50px", title: "Pwnable"},
                  { field: "Cryptography", width: "50px", title: "Cryptography"},
                  { field: "Forensic", width: "50px", title: "Forensic"},
                  { field: "Misc", width: "50px", title: "Misc"},
              ]
          });     
      }
  });
}

// logout
$("#logout").click(function(){
   $.ajax({
       type: "post",
       url: "",
       data: "logout=1",
       success: function(data){
           location = "/?scoreboard";
       }
   })
});

// update info
$('#updateinfo').click(function(){
   var fullname = $('#fullname')[0].value,
       classname = $('#class')[0].value,
       email = $('#email')[0].value,
       maincategory = $('#mainCategory')[0].value,
       post_data = {
            fullname: fullname,
            classname: classname,
            email: email,
            maincategory: maincategory,
            update: true,
       };
       flag = 1;

       if (! regex(email, "email")){
           $("#notice").html("Email invalid");
           flag = 0;
       }
       if (! regex(classname, "class")){
           $("#notice").html("Classname not found");
           flag = 0;
       }
   
       if (flag === 1){
           $.ajax({
               type: "post",
               url: "",
               data: post_data,
               success: function(data){
                   $("#notice").html(entities(data));
               }
           })
       }
});

// add score
$('#addbtn').click(function(event){
    var post_data = {
        webScore: $("#addWeb")[0].value,
        reScore: $("#addRE")[0].value,
        pwnScore: $("#addPwn")[0].value,
        cryptScore: $("#addCrypt")[0].value,
        forScore: $("#addFor")[0].value,
        miscScore: $("#addMisc")[0].value,
        eventScore: $("#addEvent")[0].value,
        addscore: true
    }
    $.ajax({
        type: "post",
        url: "",
        data: post_data,
        success: function(data){
            $('#noticeModal').html(data);
            if (data == "Added"){
                alert("Waiting admin confirm");
                location.reload();
            }
        }
    })
})

function getlistevents(){
  $.ajax({
        type: 'post',
        data: {'loadEvents': true},
        success: function(data){
            data = JSON.parse(data);
            if (data['error']){
              return;
            }
            data.forEach(function(row, index){
                $option = $('<option>' + entities(row['name']) + '</option>')
                $('#addEvent').append($option);
            });
        }
    })
}