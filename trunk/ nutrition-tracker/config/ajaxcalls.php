<?php
require "config.php";

// Handle ajax calls...
if (isset($_REQUEST['method']))
{
	switch (strtoupper($_REQUEST['method'])) {
		case "SAVENOTE":
			saveNote($_REQUEST["user_id"], $_REQUEST["tracker_date"], $_REQUEST["tracker_note"]);
			break;
		default:
	}
}

function saveNote($user_id, $tracker_date, $tracker_note)
{
	global $conn;
	
	if (trim($tracker_note) == "") {
		$conn->execute("DELETE FROM tracker_notes WHERE user_id = ? AND tracker_date = ?", array($user_id, $tracker_date));
		echo json_encode(true);
		die;
	}

	$sql = "SELECT tracker_date FROM tracker_notes WHERE user_id = ? AND tracker_date = ?";
	$res = $conn->getOne($sql, array($user_id, $tracker_date));

	if (strlen($res) == 0) {
		$sql = "INSERT INTO tracker_notes (user_id, tracker_date, tracker_note) VALUES (?, ?, ?)";
		$conn->execute($sql, array($user_id, $tracker_date, stripslashes($tracker_note)));
	} 
	else {
		$sql = "UPDATE tracker_notes SET tracker_note = ? WHERE user_id = ? AND tracker_date = ?";
		$conn->execute($sql, array(stripslashes($tracker_note), $user_id, $tracker_date));
	}
	
	if ($conn->errorno > 0) {
		echo json_encode(false);
		die;
	}
	
	echo json_encode(true);
} // saveNote