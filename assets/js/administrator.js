// load libs
$.getScript( "/assets/js/validate.js", function() {});

// update events
jQuery(function ($) {
    var traffic = [], traffic2 = [];
    // load event's data
    $(document).ready(function(){
    	$.ajax({
    		type: "post",
            async: true,
    		data: {'loadEvent':true},
    		success: function(data){
    			data = JSON.parse(data);
                if (! data['error']){
        			data.forEach(function(row, index) {
    					traffic.push({
    						ID: entities(row['id']),
    						Name: entities(row['name']),
    						Weight: entities(row['weight']),
    						"Start time": entities(row['start_at']),
    						"Max score": entities(row['maxScore'])
    					})
    				});
                }
				// update to table
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
		                { field: "ID", width: "10px", title: "ID" },
		                { field: "Name", width: "100px", title: "Name" },                
		                { field: "Weight", width: "20px", title: "Weight" },                
		                { field: "Start time", width: "50px", title: "Start time"},
		                { field: "Max score", width: "50px", title: "Max score"},
	                ]
	            });     
    		}
    	});

        // load score for confirm?
        $.ajax({
            type: "post",
            data: {'loadConfirmation': true},
            success: function(data){
                data = JSON.parse(data);
                if (! data['error']){
                    data.forEach(function(row, index) {
                        traffic2.push({
                            Player  : entities(row['username']),
                            Events: entities(row['name']), 
                            "Web Exploit": entities(row['webScore']),
                            Reverse: entities(row['reScore']),
                            Pwnable: entities(row['pwnScore']),
                            Crypto: entities(row['cryptScore']),
                            Forensic: entities(row['forScore']),
                            Misc: entities(row['miscScore']),
                            Confirm:
                            `&nbsp;<button type="button" class="btn btn-sm btn-success" value="${entities(row["playerID"])}-${entities(row["eventID"])}"><i class="fa fa-check fa-xs"></i></button>`
                            + "&nbsp;&nbsp;&nbsp;&nbsp;" +  
                            `<button type="button" class="btn btn-sm btn-danger" value="${entities(row["playerID"])}-${entities(row["eventID"])}"><i class="fa fa-times fa-xs"></i></button>`
                        })
                    });
                }
                // update to table
                $("#confirmation").shieldGrid({
                    dataSource: {
                        data: traffic2
                    },
                    sorting: {
                        multiple: true,
                        paging: false,
                    },
                    rowHover: false,
                    columns: [
                        { field: "Player", width: "70px", title: "Player" },
                        { field: "Events", width: "70px", title: "Events" },
                        { field: "Web Exploit", width: "50px", title: "Web Exploit" },                
                        { field: "Reverse", width: "50px", title: "Reverse" },                
                        { field: "Pwnable", width: "50px", title: "Pwnable"},
                        { field: "Crypto", width: "50px", title: "Crypto"},
                        { field: "Forensic", width: "50px", title: "Forensic"},
                        { field: "Misc", width: "50px", title: "Misc"},
                        { field: "Confirm", width: "50px", title: "Confirm"},
                    ]
                });     
            }
        })
    });
});

// logout
$("#logout").click(function(){
   $.ajax({
       type: "post",
       url: "/?home",
       data: "logout=1",
       success: function(data){
           location = "/?scoreboard";
       }
   })
});

// add events
$('#addbtn').click(function(event){
    var post_data = {
        name: $("#addEvent")[0].value,
        weight: $("#addWeight")[0].value,
        date: $("#addDate")[0].value,
        maxscore: $("#addMaxScore")[0].value,
        addevent: true
    }
    $.ajax({
        type: "post",
        url: "",
        data: post_data,
        success: function(data){
            $("#noticeModal").html(data);
            if (data == "Added")
                location.reload();
        }
    })
})

// reply button click
function btnClick(e){
    e = e || window.event;
    e = e.target || e.srcElement;
 
    if (e.nodeName !== "BUTTON" && e.nodeName !== "I"){
        return;
    }

    value = (e.nodeName == "BUTTON")    ? e.value   : e.closest('button').value;
    playerId = value.split("-")[0];
    eventId = value.split("-")[1];
    isConfirm = 1;
    if ($(e).attr("class").indexOf("success") == -1){
        if ($(e.closest("button")).attr("class").indexOf("success") == -1){
            isConfirm = 0;
        }
    }
    post_data = {
        playerId: playerId,
        eventId: eventId,
        isConfirm: isConfirm,
        submitConfirm: true
    }
    $.ajax({
        type: "post",
        data: post_data,
        success: function(data){
            $(e).parents().closest("tr").css("display", "none");
        }
    })
}

$("#reset").click(function(event){
    $.ajax({
        type: "post",
        url: "",
        data: {resetScore: true},
        success: function(data){
            alert(entities(data));
        }
    })
})