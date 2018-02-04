<?php 
require_once "config.php";
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn,"utf8");

// Tính năng cho phép tạo tài khoản mới
function registerModel($username, $password){
	global $conn;
	// check unique
	$stmt = $conn -> prepare("SELECT id FROM player WHERE username = ?");
	$stmt -> bind_param("s", $username);
	$stmt -> execute();
	$stmt -> bind_result($id);
	$stmt -> fetch();
	$stmt -> close();
	if (! is_null($id)){
		return false;
	}

	// insert into database
	$pwhash = sha1($password);
	$stmt = $conn -> prepare("INSERT INTO player(username, password, lastUpdate) VALUES (?, ?, CURRENT_DATE())");
	$stmt -> bind_param("ss", $username, $pwhash);
	$stmt -> execute();
	$stmt -> close();
	return true;
}

// Tính năng kiểm tra đăng nhập
function loginModel($username, $password){
	global $conn;
	$pwhash = sha1($password);
	$stmt = $conn -> prepare("SELECT * FROM player WHERE username = ? AND password = ?");
	$stmt -> bind_param("ss", $username, $pwhash);
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$row = $result -> fetch_assoc();
	return $row;
}

// Tính năng cập nhật thông tin cá nhân
function updateInfoModel($data){
	global $conn;
	$stmt = $conn -> prepare("UPDATE player SET fullname = ?, class = ?, email = ?, main_category = ? WHERE id = ?");
	$stmt -> bind_param("ssssi", 
						$data['fullname'], 
						$data['classname'], 
						$data['email'], 
						$data['maincategory'], 
						$data["userid"]
					);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	return true;
}

// Tính năng tạo event dành cho admin
function insertEventModel($data){
	global $conn;
	$stmt = $conn -> prepare("INSERT INTO event(name, weight, start_at, maxScore) VALUES (?, ?, ?, ?)");
	$stmt -> bind_param("sdsd", 
						$data["name"],
						$data["weight"],
						$data["date"],
						$data["maxscore"]
					);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	return true;
}

// Tính năng thêm điểm (raw) dành cho user
function insertScoreModel($data){
	global $conn;
	// Get event's id
	$stmt = $conn -> prepare("SELECT id FROM event WHERE name = ?");
	$stmt -> bind_param("s", $data["event"]);
	$stmt -> execute();
	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return false;
	} 
	$event = $result -> fetch_assoc();
	$stmt -> close();
	// insert score
	$stmt = $conn -> prepare("INSERT INTO score() VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)");
	$stmt -> bind_param("iidddddd", 
						$data["userid"],
						$event["id"],
						$data["cryptScore"],
						$data["forScore"],
						$data["miscScore"],
						$data["pwnScore"],
						$data["reScore"],
						$data["webScore"]
					);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	return true;
}

// Lấy tất cả thông tin event
function loadEventModel(){
	global $conn;
	$stmt = $conn -> prepare("SELECT * FROM event");
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$data = array();
	while($row = $result -> fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}

// lấy thông tin điểm (dạng raw) của user trong bảng score
function loadScoreModel($userid){
	global $conn;
	$stmt = $conn -> prepare("SELECT * FROM score WHERE playerID = ?");
	$stmt -> bind_param("i", $userid);
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$data = array();
	while($row = $result -> fetch_assoc()){
		$stmt2 = $conn -> prepare("SELECT name FROM event WHERE id = ?");
		$stmt2 -> bind_param("i", $row["eventID"]);
		$stmt2 -> execute();
		$row['event'] = ($stmt2 -> get_result() -> fetch_assoc())['name'];
		$stmt2 -> close();
		array_push($data, $row);
	}
	return $data;
}

// lấy tất cả thông tin điểm (dạng chuyển đổi) của user trong bảng player
function getAllUserScore(){
	global $conn;
	$stmt = $conn -> prepare("SELECT id, username, fullname, class, email, main_category, webScore, reScore, pwnScore, cryptScore, forScore, miscScore, totalScore, lastUpdate FROM player WHERE role = 0");
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$data = array();
	while($row = $result -> fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}

// Lấy thông tin điểm của 1 user nhất định trong bảng player
function getUserScore($id){
	global $conn;
	$stmt = $conn -> prepare("SELECT cryptScore, forScore, miscScore , pwnScore , reScore , webScore, lastUpdate FROM player WHERE id = ?");
	$stmt -> bind_param("i", $id);
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	return $result -> fetch_assoc();
}

// get event's info table by event id
function getInfoEvent($eventName){
	global $conn;
	$stmt = $conn -> prepare("SELECT * FROM event WHERE name = ?" );
	$stmt -> bind_param("i", $eventName);
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	return $result -> fetch_assoc();
}

// Cập nhật lại điểm trong bảng player khi user thêm điểm (raw) vào bảng score
function updateScoreModel($data){
	global $conn;
	$stmt = $conn -> prepare("UPDATE player SET cryptScore=?, forScore=?, miscScore=?, pwnScore=?, reScore=?, webScore=?, totalScore=?, lastUpdate=CURRENT_DATE() WHERE id = ?");
	$stmt -> bind_param("dddddddi", 
						$data['cryptScore'], 
						$data['forScore'], 
						$data['miscScore'], 
						$data['pwnScore'], 
						$data["reScore"],
						$data["webScore"],
						$data["totalScore"],
						$data["userid"]
					);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	return true;
}

// lấy danh sách user (không phải admin) trong bảng player 
function getAllId(){
	global $conn;
	$stmt = $conn -> prepare("SELECT id FROM player WHERE role != 1" );
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$data = array();
	while($row = $result -> fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}

// Tải điểm theo từng event mà user thêm và cần admin kiểm tra
function loadConfirmationModel(){
	global $conn;
	$stmt = $conn -> prepare("SELECT event.name, player.username, score.* FROM score, player, event WHERE score.playerID = player.id AND score.eventID = event.id and isConfirm = 0" );
	$stmt -> execute();

	$result = $stmt -> get_result();
	if ($result -> num_rows == 0){
		return ["error" => true];
	} 
	$data = array();
	while($row = $result -> fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}

// Admin confirm điểm
function confirmScoreModel($playerId, $eventId, $isConfirm){	
	if ($isConfirm === "1"){ // update isConfirm column
		$sql = "UPDATE score SET isConfirm = 1 WHERE playerID = ? and eventID = ?";
	}else{ // delete row
		$sql = "DELETE FROM score WHERE playerID = ? and eventID = ?";
	}

	global $conn;
	$stmt = $conn -> prepare($sql);
	$stmt -> bind_param("ii", $playerId, $eventId);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	$stmt -> close();

	// get score to change
	if ($isConfirm === "1"){
		$stmt2 = $conn -> prepare("SELECT event.name, score.* FROM score, event WHERE event.id=score.eventID AND playerID = ? AND eventID = ?");
		$stmt2 -> bind_param("ii", $playerId, $eventId);
		$stmt2 -> execute();
		$result2 = $stmt2 -> get_result();
		if ($result2 -> num_rows == 0){
			return ["error" => true];
		} 
		return $result2 -> fetch_assoc();
	}
}


// tinh nang reset score
function getAllScoreModel(){
	global $conn;
	$stmt = $conn -> prepare("SELECT event.name, score.* FROM score, event WHERE event.id=score.eventID AND isConfirm = 1");
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	$result = $stmt -> get_result();
	$data = array();
	while($row = $result -> fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}

// reset score in table player into 0
function resetScorePlayerModel($userId){
	global $conn;
	$sql = "UPDATE player SET cryptScore=0, forScore=0, miscScore=0, pwnScore=0, reScore=0, webScore=0, totalScore=0 WHERE id = ?";
	$stmt = $conn -> prepare($sql);
	$stmt -> bind_param("i", $userId);
	$stmt -> execute();
	if ($stmt->affected_rows === 0)
		return false;
	$stmt -> close();
}


?>
