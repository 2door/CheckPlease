<!DOCTYPE html>
<?php
    session_start();
    session_destroy();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>THE App!</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css"/>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One|Oxygen"/>
    </head>
    <body>
        <div class="nav">
            <img src="images/SplitLogo.png" alt="The Splits Logo">
            <form action="access.php" id="navLogin" method="POST">
                <input type="email" name="login" placeholder=" Your e-mail address">
                <input type="password" name="loginPass" placeholder=" Your password">
                <input type="submit" value="Go!">
            </form>
            <h1>Log In:</h1>
        </div>
        <div class="index">
            <h1>The Splits</h1>
            <div id="description">
                <p>When everybody has to pitch in money to pay a bill, there's always somebody who doesn't have enough cash on them. 'The Splits' is the app that will take away the hassle of having to remember who paid what.</p>
                <p>Now, you can just save your bills and keep track of who still has to pay their part. So what are you waiting for? Sign up and make your life easier!</p>
            </div>
            <div id="mainRegister">
                <h2>Register!</h2>
                <form action="signup.php" method="POST">
                    <label>E-mail address:</label><br>
                    <input id="registerBox" type="email" name="email" placeholder=" Enter your e-mail address.." maxlength="45"><br>
                    <label>Username:</label><br>
                    <input id="registerBox" type="text" name="username" placeholder=" Pick a username..." maxlength="25"><br>
                    <label>Password:</label><br>
                    <input id="registerBox" type="password" name="pass" placeholder=" Pick a strong password..." maxlength="40"><br>
                    <label>Confirm password:</label><br>
                    <input id="registerBox" type="password" name="confirm" placeholder=" Enter your password again..." maxlength="40"><br>
                    <input id="registerButt" type="submit" value="Register!">
                </form>
            </div>
        </div>
    </body>
</html>