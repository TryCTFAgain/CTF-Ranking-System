
$().ready(function(){
    // load libs
    $.getScript( "/assets/js/validate.js", function() {
        getscore();
    });

    $(window).resize(function () {
        $('#fresh-table').bootstrapTable('resetView');
    });

    // update everyday
    updatescore();
});

function getscore(){
    // refresh scoreboard
    $.ajax({
        type: 'post',
        url: "",
        data: {loadscore: true},
        async: true,
        success: function(data){
            data = JSON.parse(data);

            if (! data['error']){
                $data = data.sort(function(a, b){
                    return b['totalScore']- a['totalScore'];
                })
                tbody = $('#content-table');
                data.forEach(function(col, index){
                    tr = $(`<tr data-index=${index}/>`);
                    tagA = `<a href="/?profile&${entities(col['id'])}" target="_blank">${entities(col['username'])}</a>`;
                    $('<td/>').html(index + 1).appendTo(tr);
                    $('<td/>').html(tagA).appendTo(tr);
                    $('<td/>').html(entities(col['webScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['reScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['pwnScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['cryptScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['forScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['miscScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['totalScore'].toFixed(2))).appendTo(tr);
                    $('<td/>').html(entities(col['lastUpdate'])).appendTo(tr);
                    tr.appendTo(tbody);
                });
                loadboostrap();
            }
            
            
        }
    });
}

function loadboostrap(){
    var full_screen = false;
    $('#fresh-table').bootstrapTable({
        toolbar: ".toolbar",

        showRefresh: false,
        search: true,
        showToggle: true,
        showColumns: true,
        pagination: true,
        striped: true,
        pageSize: 10,
        pageList: [8,10,25,50,100],
        
        formatShowingRows: function(pageFrom, pageTo, totalRows){
            //do nothing here, we don't want to show the text "showing x of y from..." 
        },
        formatRecordsPerPage: function(pageNumber){
            return pageNumber + " rows visible";
        },
        icons: {
            refresh: 'fa fa-refresh',
            toggle: 'fa fa-th-list',
            columns: 'fa fa-columns',
            detailOpen: 'fa fa-plus-circle',
            detailClose: 'fa fa-minus-circle'
        }
    });
}
// Update score in database every day
function updatescore(){
    $.ajax({
        type: "post",
        url:"",
        data: {"updatescore": true},
        success: function(data){
            console.log(data);
        }
    })
}


// login handler
$('#loginBtn').click(function () {
    location = "/?login";
});

// logout handler
$('#logoutBtn').click(function(){
   $.ajax({
       type: "post",
       url: "/?home",
       data: "logout=1",
       success: function(data){
           location = "/?scoreboard";
       }
   })
});


