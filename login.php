<!DOCTYPE html>
<?php 
    session_start();
    if(isset($_SESSION['id'])){
        session_destroy();
        header("Location:index.php");
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One|Oxygen">
    </head>
    <body id="boxBody">
        <div id="loginContent">
            <img src="images/SplitLogo.png" alt="The Splits Logo">
            <h1>Log In</h1>
            <h2>Something went wrong, please try again</h2>
            <form action="access.php" method="POST">
                <label>E-mail address:</label><br>
                <input type="email" name="login" placeholder=" Your e-mail address..." required><br>
                <label>Password:</label><br>
                <input type="password" name="loginPass" placeholder=" Your password..." required><br>
                <input id="login" type="submit" value="Log In">
            </form>
        </div>
    </body>
</html>