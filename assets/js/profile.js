// load libs
$.getScript( "/assets/js/validate.js", function() {});

// load scoreboard
jQuery(function ($) {
    var traffic = [];

    $(document).ready(function(){
        $.ajax({
            type: "post",
            data: {
              userid: userid,
              loadInfo: true
            },
            success: function(data){
                data = JSON.parse(data);
                score = data["score"];
                info = data["info"];

                // fill table info
                $("<p></p>").html(entities(info["username"])).appendTo($("#info"))
                $("<p></p>").html(entities(info["fullname"])).appendTo($("#info"))
                $("<p></p>").html(entities(info["main_category"])).appendTo($("#info"))
                $("<p></p>").html(entities(info["class"])).appendTo($("#info"))
                $("<p></p>").html(entities(info["email"])).appendTo($("#info"))
                

                // fill table score
                if (! score['error']){
                  score.forEach(function(row, index) {
                    eventName = (row['isConfirm'] == 1) ? entities(row['event'])  : `<font color="#818285">${entities(row['event'])}</font>`
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
    });           
});

