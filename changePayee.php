<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();
	$payed = $_POST['payed'];
	$payee_id = $_POST['payee_id'];

	$stmt = $db->prepare("UPDATE payees SET payed=:payed WHERE payee_id=:payee_id;");
	$stmt->bindValue(':payed',$payed, SQLITE3_INTEGER);
	$stmt->bindValue(':payee_id',$payee_id, SQLITE3_INTEGER);
	$stmt->execute();

	$stmt = $db->prepare("SELECT * FROM payees WHERE payee_id=:payee_id;");
	$stmt->bindValue(':payee_id',$payee_id, SQLITE3_INTEGER);
	$payees = $stmt->execute();
	$payee = $payees->fetchArray(); //for payee id

	$bill = $db->querySingle("SELECT * FROM bills WHERE bill_id=".$payee['bill_id'].";");
	if($payee['user_id'] != $bill['owner']) {
		$group = $db->querySingle("SELECT * FROM groups WHERE group_id=".$bill['group_id'].";");
		if($payed == 1) {
			$db->query("INSERT INTO notifs VALUES(NULL,".$payee['user_id'].",'Payment for ".$bill['name']." in group ".$group['name']." confirmed');");
		}
		else {
			$db->query("INSERT INTO notifs VALUES(NULL,".$payee['user_id'].",'Payment for ".$bill['name']." in group ".$group['name']." renounced');");
		}
	}
?>
