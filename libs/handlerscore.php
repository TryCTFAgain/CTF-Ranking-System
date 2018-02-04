<?php 
require_once "config.php";
require_once MODEL;

date_default_timezone_set('Asia/Ho_Chi_Minh');

function HS($lastupdate){
	$currentdate = new DateTime();
	$deltadate = $currentdate -> diff($lastupdate) -> days;
	return pow(2, - $deltadate / 10);
}

// exchange score by time
function updateScore($userid){
	// Lấy thông tin điểm của 1 user nhất định trong bảng player
	$userscore = getUserScore($userid);
	$lastupdate = new DateTime(array_pop($userscore));
	$p_old = $userscore;

	$hs = HS($lastupdate);
	$p_new = array("totalScore" => 0);
	foreach ($p_old as $index => $value) {
		$tmp = $value * $hs;
		$p_new[$index] = $tmp;
		$p_new["totalScore"] += $tmp;
	}
	return $p_new;
}

function addScore($userId, $eventName, $rawScore){
	// hs = ?
	$eventInfo = getInfoEvent($eventName);
	$eventDate = new DateTime($eventInfo["start_at"]);
	$hs = HS($eventDate);
	$X = 2000;

	$sum = array_sum($rawScore);
	($sum != 0) ?: die("No change or resetted");

	$tmp = $eventInfo["weight"] * ($X / $eventInfo["maxScore"]) * $sum * $hs;
	$sum_ = round($tmp, 2);

	// get new score in table player
	$p_new = updateScore($userId);
	$newScore = array();
	foreach ($rawScore as $index => $value) {
		$tmp = ($sum_ / $sum) * $value;
		$newScore[$index] = round($tmp + $p_new[$index], 2);
	}
	$newScore["userid"] = $userId;
	$newScore["totalScore"] = $sum_;
	updateScoreModel($newScore);
	return $newScore;
}

function resetScore(){
	// get all score in table score
	$scoreList = getAllScoreModel();
	foreach ($scoreList as $index => $uScore) {
		// reset score in table player (= 0)
		resetScorePlayerModel($uScore['playerID']);
		// set new score in table player 
		addScore($uScore['playerID'], 
				$uScore['name'], 
				array(
                    "cryptScore" => $uScore["cryptScore"], 
                    "forScore"   => $uScore["forScore"],
                    "miscScore"  => $uScore["miscScore"],
                    "pwnScore"   => $uScore["pwnScore"],
                    "reScore"    => $uScore["reScore"],
                    "webScore"   => $uScore["webScore"]
                )
		);
	}
	die("OK");
}

?>