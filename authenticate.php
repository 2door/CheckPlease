<?php
    session_start();
    function auth($db, $email, $pass) {
    
        $stmt = $db->prepare("SELECT * FROM users WHERE email=:email;");
        $stmt->bindValue(':email',$email, SQLITE3_TEXT);
        $users = $stmt->execute();
    
        while(($user = $users->fetchArray())) {
            if(sha1($user['salt']."--".$pass) == $user['pass']) { //salt : $salt = sha1(time());
                $_SESSION['id'] = $user['user_id'];
                header('Location:mainpage.php');
                exit();
            } else {
                header('Location:login.php');
                exit();
            }
        }
        header('Location:login.php');
        exit();
    }
?>