<?php 

// check authentication
if (! isset($_SESSION["isLogin"]) || ! $_SESSION["isLogin"] || $_SESSION["role"] == 0){
    header("Location: /?login");
    die("Permission Deny");
}

require_once LIBS . "handlerscore.php";
require_once LIBS . "validating.php";

$data = @json_decode(base64_decode($_COOKIE['data'])) ?? ""; 

// add events
if (isset($_POST["addevent"])){
    if (! isValidNumberic($_POST["weight"]) || ! isValidNumberic($_POST["maxscore"])){
        die("Invalid numberic");
    }
    if (! isValidDate($_POST["date"])){
        die("Invalid date");
    }
    // set default value
    $data = array(
        "name" 		=> $_POST['name']      	?? "Error",
        "weight" 	=> $_POST['weight']		?? 0,
        "date" 		=> $_POST['date']      	?? "1970-01-01",
        "maxscore" 	=> $_POST['maxscore']  	?? 0,
    );
    $result = insertEventModel($data);
    die("Added");
}

// load exist events
if (isset($_POST["loadEvent"])){
	$result = loadEventModel();
	die(json_encode($result));
}

// load confirmation?
if (isset($_POST["loadConfirmation"])){
    $result = loadConfirmationModel();
    die(json_encode($result));
}

// Submit confirmation
if (isset($_POST["submitConfirm"])){
    // Validating
    if (! isValidNumberic($_POST["playerId"]) || ! isValidNumberic($_POST["eventId"])){
        die("Invalid id");
    }
    if (! in_array($_POST["isConfirm"], array(1, 0))){
        die("Are you confirm?");
    }

    // update or detele row in score table, if confirm return that's score
    $data = confirmScoreModel($_POST["playerId"], $_POST["eventId"], $_POST["isConfirm"]);
    // chuyển đổi điểm và cập nhật bảng player
    addScore($_POST["playerId"], 
                $data["name"], 
                array(
                    "cryptScore" => $data["cryptScore"], 
                    "forScore"   => $data["forScore"],
                    "miscScore"  => $data["miscScore"],
                    "pwnScore"   => $data["pwnScore"],
                    "reScore"    => $data["reScore"],
                    "webScore"   => $data["webScore"]
                )
    );
    die("updated");
}

// reset score in table player from table score
if (isset($_POST["resetScore"])){
    die(resetScore());
}

// add notify
if (isset($_POST["addnotify"])){
    $data = array(
        "type" => "notify",
        "message" => "test",
        "start_at" => (new DateTime()) -> format("Y-m-d"),
        "stop_at" => (new DateTime()) -> format("Y-m-d"),
    );

    insertNotifyModel($data);
   die("ok");
}

?>