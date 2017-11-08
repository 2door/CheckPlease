<?php
	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();
	$bill_id = $_POST['bill_id'];

	$stmt = $db->prepare("SELECT * FROM payees WHERE bill_id=:bill_id;");
	$stmt->bindValue(':bill_id',$bill_id, SQLITE3_INTEGER);
	$payees = $stmt->execute();

	$stmt = $db->prepare("SELECT * FROM bills WHERE bill_id=:bill_id;");
	$stmt->bindValue(':bill_id',$bill_id, SQLITE3_INTEGER);
	$bills = $stmt->execute();
	$bill = $bills->fetchArray();

	$stmt = $db->prepare("SELECT * FROM groups WHERE group_id=:group_id;");
	$stmt->bindValue(':bill_id',$bill['group_id'], SQLITE3_INTEGER);
	$groups = $stmt->execute();
	$group = $bills->fetchArray();

	while(($payee = $payees->fetchArray())) {
		$db->query("INSERT INTO notifs VALUES(NULL,".$payee['user_id'].",'Bill ".$bill['bill_id']." has been deleted from group ".$group['name']."');");
	}

	$stmt = $db->prepare("DELETE FROM payees WHERE bill_id=:bill_id;");
	$stmt->bindValue(':bill_id',$bill_id, SQLITE3_INTEGER);
	$stmt->execute();

	$stmt = $db->prepare("DELETE FROM bills WHERE bill_id=:bill_id;");
	$stmt->bindValue(':bill_id',$bill_id, SQLITE3_INTEGER);
	$stmt->execute();


?>