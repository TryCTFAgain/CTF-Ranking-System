<?php 
require_once "config.php";
require_once MODEL;
require_once LIBS . "scoreboard.php";
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href=<?php echo ASSETS . "images/favicon.png" ?>>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
	
	<title>Scoreboard | KMA CTF</title>

    <!-- css -->
    <link rel="stylesheet" href=<?php echo ASSETS . "bootstrap/css/bootstrap.css";?> /> 
    <link rel="stylesheet" href=<?php echo ASSETS . "bootstrap/css/fresh-bootstrap-table.css";?> />
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "css/scoreboard.css"; ?>>
    <link rel="stylesheet" href="<?php echo ASSETS . "theme-scoreboard/css/animate.min.css"; ?>" />
    <!--     Fonts and icons     -->
    <link href=<?php echo ASSETS . "font-awesome/css/font-awesome.min.css"; ?> rel="stylesheet" type='text/css'>
    <link href=<?php echo ASSETS . "font-awesome/css/font-family-roboto.css"; ?> rel='stylesheet' type='text/css'>
    <!-- javascript -->
    <script type="text/javascript" src=<?php echo ASSETS . "js/jquery-1.10.2.min.js"; ?>></script>
    <script type="text/javascript" src=<?php echo ASSETS . "bootstrap/js/bootstrap.js"; ?>></script>
    <script type="text/javascript" src=<?php echo ASSETS . "bootstrap/js/bootstrap-table.js"; ?>></script>   
    <script src="<?php echo ASSETS . "theme-scoreboard/js/bootstrap-notify.js"; ?>"></script>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript" charset="utf-8" async defer>
        $(document).ready(function(){
            // notify
            noti.showNotification(
                '<b>THÔNG BÁO</b> - ', 
                'AceBear Security Contest Weight Voting. Trọng số tạm thời là 26, có thay đổi admin sẽ cập nhật', 
                'https://ctftime.org/event/564/weight/'
            )
        });

        // Browser notify
      var OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
        OneSignal.init({
          appId: "b22655dc-0c15-4078-a9e7-5ab447e8394b",
        });
      });
        
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="fresh-table full-color-dark">
                        <div class="toolbar">
                        	<?php 
    	                    	if (! isset($_SESSION["isLogin"]) || ! $_SESSION["isLogin"]){
    								echo '<button id="loginBtn" class="btn btn-default">Login</button>';
    							}else{
                                    echo '<button id="logoutBtn" class="btn btn-default">Logout</button>';
    								echo '<a href="/?home" class="btn btn-default">Home</a>';
    							}
                                echo '<a href="/?events" class="btn btn-default">Events</a>';
    						?>
                        </div>
                        
                        <table id="fresh-table" class="table">
                            <thead>
                                <th data-field="Rank" data-sortable="true">Rank</th>
                            	<th data-field="Nickname" data-sortable="true">Nickname</th>
                            	<th data-field="Web" data-sortable="true">Web</th>
                            	<th data-field="RE" data-sortable="true">RE</th>
                            	<th data-field="Pwn" data-sortable="true">Pwn</th>
                            	<th data-field="Crypto" data-sortable="true">Crypto</th>
                            	<th data-field="Forensic" data-sortable="true">Forensic</th>
                            	<th data-field="Misc" data-sortable="true">Misc</th>
                                <th data-field="Total" data-sortable="true">Total</th>
                            	<th data-field="lastUpdated" data-sortable="true">Last Updated</th>
                            </thead>
                            <tbody id="content-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- javascript events -->
    <script type="text/javascript" src="<?php echo ASSETS . "theme-scoreboard/js/notify.js"; ?>"></script>   
    <script src=<?php echo ASSETS . "js/scoreboard.js"; ?> charset="utf-8"></script>
</body>
</html>

