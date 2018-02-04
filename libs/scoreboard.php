<?php  
require_once MODEL;
require_once "config.php";
require_once LIBS . "handlerscore.php";

if (isset($_POST["loadscore"])){
	$data = getAllUserScore();
	die(json_encode($data));
}

if (isset($_POST["updatescore"])){
	$userIds = getAllId();
	foreach ($userIds as $index => $user) {
		$p_new = updateScore($user["id"]);
		$data = array(
					"cryptScore"=> $p_new["cryptScore"],
					"forScore"	=> $p_new["forScore"],
					"miscScore"	=> $p_new["miscScore"],
					"pwnScore"	=> $p_new["pwnScore"],
					"reScore"	=> $p_new["reScore"],
					"webScore"	=> $p_new["webScore"],
					"totalScore"=> $p_new["totalScore"],
					"userid"	=> $user["id"]
				);
		updateScoreModel($data);
	}
	die("Updated Success");
}
?>