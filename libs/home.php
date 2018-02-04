<?php 
require_once MODEL;
require_once LIBS . "validating.php";
require_once LIBS . "handlerscore.php";

// check authentication
if (! isset($_SESSION["isLogin"]) || ! $_SESSION["isLogin"]){
	header("Location: /?login");
	die("Permission Deny");
}
// logout handler
if (isset($_POST['logout'])){
    session_destroy();
    setcookie("data", null, -1, "/");
    header("Location: /?scoreboard");
    die("Logout");
}
// redirect belong user's role
if ($_SESSION['role'] === 1){
    header("Location: /?administrator");
    die("Redirect to admin page");
}

$data = @json_decode(base64_decode($_COOKIE['data'])) ?? ""; 

// update profile handler
if (isset($_POST['update'])){
    // validating
    (isValidEmail($_POST["email"]))               ?: die("Invalid Email");
    (isValidClassName($_POST["classname"]))       ?: die("Invalid Data");
    (isValidCategories($_POST['maincategory']))   ?: die("Invalid Data");

    // set default value 
    $data = array(
        "userid"        => $_SESSION['userid'],
        "fullname"      => $_POST["fullname"]       ?? "",
        "classname"     => $_POST["classname"]      ?? "AT?",
        "email"         => $_POST["email"]          ?? "fakemail",
        "maincategory"  => $_POST["maincategory"]   ?? ""
    );
    $result = updateInfoModel($data);
    ($result) ? die("Updated and re-login") : die("No rows updated");
}

// add score
if (isset($_POST['addscore'])){
    // Validating
    array_pop($_POST);
    $eventname = array_pop($_POST);
    if (! isValidString($eventname))    
        die("Invalid data");
    
    foreach ($_POST as $key => $value) {
        if (! isValidNumberic($value))
            die("Invalid Numberic");
    }
    // set default value
    $data = array(
        "userid"         => $_SESSION['userid'],
        "event"          => $eventname                ?? "",
        "webScore"       => $_POST['webScore']        ?? 0,
        "reScore"        => $_POST['reScore']         ?? 0,
        "pwnScore"       => $_POST['pwnScore']        ?? 0,
        "cryptScore"     => $_POST['cryptScore']      ?? 0,
        "forScore"       => $_POST['forScore']        ?? 0,
        "miscScore"      => $_POST['miscScore']       ?? 0,
    );
    // insert data into table score with isConfirm = 0
    $result = insertScoreModel($data);
    // return
    if ($result){
        die("Added");
    }else
        die("Error");
}

// load added score
if (isset($_POST["loadScore"])){
    $result = loadScoreModel($_SESSION['userid']);
    die(json_encode($result));
}

// load exist events
if (isset($_POST["loadEvents"])){
    $result = loadEventModel();
    die(json_encode($result));
}
?>