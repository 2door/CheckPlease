<?php
    session_start();
    require "database.php";
    include "authenticate.php";
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $confirm = $_POST['confirm'];
    
    if( ($pass !== $confirm) || ($email === '') || ($username === '') || ($pass === '') ) {
        header('Location:register.php');
        exit();
    }
    
    $db = new Database();
    $stmt = $db->prepare("SELECT * FROM users WHERE email=:email;");
    $stmt->bindValue(':email',$email, SQLITE3_TEXT);
    $result = $stmt->execute();
    if(($res = $result->fetchArray())) {
        header('Location:register.php');
        exit();
    }
    
    $salt = sha1(time());
  	$encrypted_pass = sha1($salt."--".$pass);
    
    $stmt = $db->prepare("INSERT INTO users VALUES(NULL,:email,:username,:salt,:pass);");
    $stmt->bindValue(':email',$email, SQLITE3_TEXT);
    $stmt->bindValue(':username',$username, SQLITE3_TEXT);
    $stmt->bindValue(':salt',$salt, SQLITE3_TEXT);
    $stmt->bindValue(':pass',$encrypted_pass, SQLITE3_TEXT);
    $stmt->execute();
    
    auth($db, $email, $pass);
?>