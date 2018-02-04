<?php  
require_once MODEL;
require_once LIBS . "validating.php";

// load user's data: score, info

if (isset($_POST["loadInfo"])){
	// Validating
	if (! isset($_POST['userid']) || ! isValidNumberic($_POST['userid'])){
		die("Invalid data");
	}

    $score = loadScoreModel($_POST['userid']);
    $allInfo = getAllUserScore();

    foreach ($allInfo as $info => $d) {
    	if ($d['id'] == $_POST['userid']){
    		$info = array(
    			"username" => $d["username"],
    			"fullname" => $d["fullname"],
    			"class"		=> $d["class"],
    			"email"		=> $d["email"],
    			"main_category" => $d["main_category"]
    		);
    		break;
    	}
    }
    $result = array("score" => $score, "info" => $info);
    die(json_encode($result));
}



?>