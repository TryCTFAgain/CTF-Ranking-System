<?php  
require_once "config.php";
require_once MODEL;
require_once  RESOURCES_ . "simple-php-captcha/simple-php-captcha.php";

if (isset($_POST['login'])){
	if (! isset($_POST['username']) || empty($_POST['username']) || ! isset($_POST['password']) || empty($_POST['password'])){
		die("Username or password invalid");
	}
	if (! preg_match('/^[\w\d!#&*+,.:;=?@\[\] ^_{|}~-]*$/i', $_POST['username'] . $_POST['password'])){
		die("Username or password invalid");
	}
	$result = loginModel($_POST['username'], $_POST['password']);
	if (isset($result['error'])){
		$_SESSION["isLogin"] = false;
		die("Login failed");
	}
	
	$_SESSION["role"] = $result["role"];
	$_SESSION["isLogin"] = true;
	$_SESSION["userid"] = $result["id"];
	$_SESSION['password'] = $result['password'];
	$result['password'] = "Cencored";
	setcookie("data", base64_encode(json_encode($result)), time() + (86400 * 30), "/");
	die("Success");
}

if (isset($_POST['register'])){
	if (! isset($_POST["captcha"]) || (strtolower($_SESSION["captcha"]["code"]) !== strtolower($_POST["captcha"]))){
		die("Wrong captcha");
	}
	if (! isset($_POST['username']) || (strlen($_POST['username']) < 3) || (strlen($_POST['username']) > 25)){
		die("Username length from 3 to 25");
	}
	if (! isset($_POST['username']) || empty($_POST['username']) || ! isset($_POST['password']) || empty($_POST['password'])){
		die("Username or password invalid");
	}
	if (! preg_match('/^[\w\d!#&*+,.:;=?@\[\] ^_{|}~-]*$/i', $_POST['username'] . $_POST['password'])){
		die("Username or password invalid");
	}

	$result = registerModel($_POST['username'], $_POST['password']);
	if ($result){
		$_SESSION['captcha'] = array("code"=>"fasfasfafafaf", "image_src"=> "");
		die("Success");
	}else
		die("Username is already exist");
}
?>