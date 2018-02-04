<?php 
require_once "config.php";
require_once LIBS . "login.php";

// captcha
$_SESSION['captcha'] = simple_php_captcha();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href=<?php echo ASSETS . "images/favicon.png" ?>>
	<title>Login | KMA CTF</title>
    <!-- css -->
    <link rel="stylesheet" href=<?php echo ASSETS . "theme-login/css/picnic.css";?>>
    <link rel="stylesheet" href=<?php echo ASSETS . "theme-login/css/style.css"; ?>>
    <link rel="stylesheet" type="text/css" href=<?php echo ASSETS . "css/login.css"; ?>>	
    <!-- javascript -->
    <script type="text/javascript" src=<?php echo ASSETS . "js/jquery-1.10.2.min.js"?>></script>
    <script src=<?php echo ASSETS . "/theme-login/js/marked.js"; ?>></script>
    <script src=<?php echo ASSETS . "/theme-login/js/base.js"; ?>></script>	
    	
</head>
<body class="login">
	<div id="content">
        <h1>Login/Register</h1>
        <hr>
        <form method="post" accept-charset="utf-8" action="#">
            <div class="third">
            	<input type="text" class="stack" name="username" placeholder="Nickname (printable ascii)" required="" autofocus="">
            	<input type="password" class="stack" name="password" placeholder="Password" required="">
            	<button id="login" class="stack icon-paper-plane">Login</button>
            	<button id="register" class="stack icon-paper-plane">Register</button>
                <div id="captcha">
                    <img class="captcha" src="<?php echo $_SESSION['captcha']['image_src'];?>" alt="">
                    <input type="text" class="stack" name="captcha" placeholder="Captcha" required="">
                    <button id="submitCaptcha" class="stack icon-paper-plane">Submit</button>
                </div>  
            </div>
            <div>
            	<p id="notice" style="color: red">&nbsp;</p>
            </div>
        </form>
    </div>
	<iframe id="dynamic-img" src=<?php echo RESOURCES . "dynamic-img.html" ?> frameborder="0" scrolling="no"></iframe>
	<script src=<?php echo ASSETS . "js/login.js";?> type="text/javascript" charset="utf-8"></script>
</body>
</html>