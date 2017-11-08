<?php
	session_start();

	error_reporting(E_ALL);
	ini_set("display errors", 1);

	require "database.php";
	$db = new Database();

	$owner = $_SESSION['id'];
	$group_id = $_POST['group_id'];
	$name = $_POST['bill_name'];
	$amount = (float) $_POST['bill_amount'];

	$stmt = $db->prepare("SELECT * FROM members WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$members = $stmt->execute();
	$nr = 0.0;
	while(($member = $members->fetchArray())) {
		$nr++;
	}
	if( $nr == 0.0 ) $nr = 1.0;
	$each = (float) round( (float) $amount/$nr, 2, PHP_ROUND_HALF_DOWN);

	$stmt = $db->prepare("INSERT INTO bills VALUES(NULL,0,:owner,:group_id,:name,:amount,:each);");
	$stmt->bindValue(':owner',$owner, SQLITE3_INTEGER);
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$stmt->bindValue(':name',$name, SQLITE3_TEXT);
	$stmt->bindValue(':amount',$amount, SQLITE3_FLOAT);
	$stmt->bindValue(':each',$each, SQLITE3_FLOAT);
	$stmt->execute();

	$stmt = $db->prepare("SELECT * FROM members WHERE group_id=:group_id;");
	$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
	$members = $stmt->execute();

	$bill = $db->querySingle("SELECT * FROM bills ORDER BY bill_id DESC LIMIT 1;");
	while(($member = $members->fetchArray())) {
		$stmt = $db->prepare("INSERT INTO payees VALUES(NULL,".$bill['bill_id'].",".$member['user_id'].",:username,0);");
		$stmt->bindValue(':username',$member['username'], SQLITE3_TEXT);
		$stmt->execute();
		if($member['user_id'] != $owner) {
			$stmt = $db->prepare("SELECT * FROM users WHERE user_id=:user_id;");
			$stmt->bindValue(':user_id',$owner, SQLITE3_INTEGER);
			$users = $stmt->execute();
			$user = $users->fetchArray();
			$stmt = $db->prepare("SELECT * FROM groups WHERE group_id=:group_id;");
			$stmt->bindValue(':group_id',$group_id, SQLITE3_INTEGER);
			$groups = $stmt->execute();
			$group = $groups->fetchArray();
			$db->query("INSERT INTO notifs VALUES(NULL,".$member['user_id'].",'".$user['username']." added a bill to ".$group['name']."');");
		}
	}
?>