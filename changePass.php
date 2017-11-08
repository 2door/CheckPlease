<?php
	session_start();

	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();
	$user_id = $_SESSION['id'];
	$current = $_POST['current'];
	$new = $_POST['newpass'];

	$stmt = $db->prepare("SELECT * FROM users WHERE user_id=:user_id;");
	$stmt->bindValue(':user_id',$user_id, SQLITE3_INTEGER);
	if(($user = $users->fetchArray())) {
		$salt = $user['salt'];
		$pass = sha1($salt."--".$current);

		if($pass === $user['pass']) {
			$encrypted_pass = sha1($salt."--".$new);
			$stmt = $db->prepare("UPDATE users SET pass=".$encrypted_pass." WHERE user_id=:user_id;");
			$stmt->bindValue(':user_id',$user_id, SQLITE3_INTEGER)
			$stmt->execute();
;
			$stmt = $db->prepare("INSERT INTO notifs VALUES(NULL,:user_id,'Password changed');")
			$stmt->bindValue(':user_id',$user_id, SQLITE3_INTEGER);
			$stmt->execute();
		}
	}
?>