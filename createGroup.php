<?php
	session_start();

	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();
	$name = $_POST['groupName'];
	$owner = $_SESSION['id'];

	if($name !== '') {
		$stmt = $db->prepare("INSERT INTO groups VALUES(NULL,:owner,:name);");
		$stmt->bindValue(':owner',$owner, SQLITE3_INTEGER);
		$stmt->bindValue(':name',$name, SQLITE3_TEXT);
		$stmt->execute();

		$stmt = $db->prepare("SELECT * FROM groups WHERE owner=:owner ORDER BY group_id DESC LIMIT 1;");
		$stmt->bindValue(':owner',$owner, SQLITE3_INTEGER);
		$result = $stmt->execute();
		$group = $result->fetchArray();

		$stmt = $db->prepare("SELECT * FROM users WHERE user_id=:owner;");
		$stmt->bindValue(':owner',$owner, SQLITE3_INTEGER);
		$result = $stmt->execute();
		$user = $result->fetchArray();

		$stmt = $db->prepare("INSERT INTO members VALUES(NULL,".$group['group_id'].",:username,:user_id);");
		$stmt->bindValue(':username',$user['username'], SQLITE3_TEXT);
		$stmt->bindValue(':user_id',$owner, SQLITE3_INTEGER);
		$stmt->execute();
	} 