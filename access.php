<?php
    session_start();
    require "database.php";
    include "authenticate.php";
    
    $email = $_POST['login'];
    $pass = $_POST['loginPass'];
    $db = new Database();
    auth($db, $email, $pass);
?>