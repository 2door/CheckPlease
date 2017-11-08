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
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One|Oxygen">
    </head>
    <body id="boxBody">
        <div id="regContent">
            <img src="images/SplitLogo.png" alt="The Splits Logo">
            <h1>Register</h1>
            <h2>Something went wrong, please try again</h2>
            <form action="signup.php" method="POST">
                <label>E-mail address:</label><br>
                <input type="email" name="email" placeholder=" Your e-mail address..." required><br>
                <label>Username:</label><br>
                <input type="text" name="username" placeholder=" Pick a username" required><br>
                <label>Password:</label><br>
                <input type="password" name="pass" placeholder=" Pick a strong password..." minlength="6" required><br>
                <label>Confirm:</label><br>
                <input type="password" name="confirm" placeholder=" Enter your password again..." required><br>
                <input id="register" type="submit" value="Register">
            </form>
        </div>
    </body>
</html>