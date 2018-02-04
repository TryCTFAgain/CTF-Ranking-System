// load libs
$.getScript( "/assets/js/validate.js", function() {});

$('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});

$("#register").click(function(event){
	event.preventDefault();
	$(this).hide();
	$("#login").hide();
	$("#dynamic-img").css("margin-top","-500px");
	capt = $("#captcha").show();
});

$("#submitCaptcha").click(function(event){
	event.preventDefault();
	usn = $("input[name=username]")[0].value.split(' ').join('_');
	pwd = $("input[name=password]")[0].value;
	capt = $("input[name=captcha]")[0].value;
	
	// validating
	if (! regex(usn, "username")){
		$('#notice').html("Username length from 3 to 25");
		return false;
	}

	post_data = {
		username: usn,
		password: pwd,
		captcha: capt,
		register: true
	}
	$.ajax({
		type: "post",
		url: "#",
		data: post_data,
		success: function(data){
			if (data === "Success"){
				$("#login").click();
			}
			$('#notice').html(data);
		}
	})
});
$("#login").click(function(event){
	event.preventDefault();
	usn = $("input[name=username]")[0].value.split(' ').join('_');
	pwd = $("input[name=password]")[0].value;
	post_data = {
		username: usn,
		password: pwd,
		login: true
	}
	$.ajax({
		type: "post",
		url: "#",
		data: post_data,
		success: function(data){
			if (data == "Success"){
				location = "/?home";
			}
			$('#notice').html(data);
		}
	})
})