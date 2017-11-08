<?php
	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();
	$group_id = $_POST['group_id'];

	$stmt = $db->prepare("SELECT * FROM groups WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$groups = $stmt->execute();
	$group = $groups->fetchArray();

	$stmt = $db->prepare("SELECT * FROM members WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$members = $stmt->execute();
	while(($member = $members->fetchArray())) {
		$db->query("INSERT INTO notifs VALUES(NULL,".$member['user_id'].",'Group ".$group['name']." has been deleted');");
	}

	$stmt = $db->prepare("SELECT * FROM bills WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$bills = $stmt->execute();

	while(($bill = $bills->fetchArray())) {
		$db->query("DELETE FROM payees WHERE bill_id=".$bill['bill_id'].";");
	}

	$stmt = $db->prepare("DELETE FROM members WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$stmt->execute();

	$stmt = $db->prepare("DELETE FROM groups WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$stmt->execute();

	$stmt = $db->prepare("DELETE FROM bills WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$stmt->execute();
?>