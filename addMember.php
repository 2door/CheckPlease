<?php
	
	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();

	$group_id = $_POST['group_id'];
	$email = $_POST['email'];

	$stmt = $db->prepare("SELECT * FROM users WHERE email=:email;");
	$stmt->bindValue(':email',$email, SQLITE3_TEXT);
	$users = $stmt->execute();

	if(($user = $users->fetchArray())) {
		$stmt = $db->prepare("SELECT * FROM members WHERE group_id=:group_id AND user_id=:user_id;");
		$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
		$stmt->bindValue(':user_id',$user['user_id'], SQLITE3_INTEGER);
		$memberships = $stmt->execute();

		if(!($membership = $memberships->fetchArray())) {
			$stmt = $db->prepare("INSERT INTO members VALUES(NULL,:group_id,:username,:user_id);");
			$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
			$stmt->bindValue(':username',$user['username'], SQLITE3_TEXT);
			$stmt->bindValue(':user_id',$user['user_id'], SQLITE3_INTEGER);
			$stmt->execute();

			$stmt = $db->prepare("SELECT * FROM groups WHERE group_id=:group_id;");
			$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
			$groups = $stmt->execute();
			$group = $groups->fetchArray();

			$db->query("INSERT INTO notifs VALUES(NULL,".$user['user_id'].",'You were added to ".$group['name']."');");

			echo ", ".$user['username'];
		}
	}
	echo "";
?>