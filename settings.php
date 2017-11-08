<!-- -->
<!DOCTYPE html>
<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display errors", 1);

    require "security.php";
    if(!loggedIn()){
        header("Location:decide.php");
        exit(); 
    }

    echo $_SESSION['id'];
?>
<?php 
    require "database.php";
    $db = new Database();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>THE App!</title>
        <link rel="stylesheet" type="text/css" href="./css/settings.css" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One|Oxygen">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/createGroup.js"></script>
        <script src="js/addMember.js"></script>
        <script src="js/addBill.js"></script>
        <script src="js/deleteB.js"></script>
        <script src="js/deleteG.js"></script>
        <script src="js/dropdown.js"></script>
    </head>
    <body>
        <div class="nav">
            <img src="images/SplitLogo.png" alt="The Splits Logo">
            <div id="select">SETTINGS
                <div class="dropdown">
                    <ul>
                        <li><a href="mainpage.php">DASHBOARD</a></li>
                        <li><a href="index.php">LOG OUT</a></li>
                    </ul>
                </div>
            </div>
            <?php
                $stmt = $db->prepare("SELECT * FROM users WHERE user_id=:user_id;");
                $stmt->bindValue(':user_id',$_SESSION['id'], SQLITE3_INTEGER);
                $usrs = $stmt->execute();
                if(($usr = $usrs->fetchArray())) {
                    echo "<h1>The Splits - Hello, ";
                    h($usr['username']);
                    echo"!</h1>";
                }
            ?>
        </div>
        <div class="content">
            <h1>Change Settings</h1>
            <h2>Change Password</h2>
            <form id="changePass" method="POST">
                <label>Current password:</label><br>
                <input id="current" type="password" name="current" placeholder=" Enter your current password..." required><br>
                <label>New password:</label><br>
                <input id="new" type="password" name="new" placeholder=" Pick a strong new password..." minlength="6" required><br>
                <label>Confirm password:</label><br>
                <input id="confirm" type="password" name="confirm" placeholder=" Enter new password again..."required><br>
                <input type="submit" value="Change"><br>
            </form>
            <h2>Change e-mail</h2>
            <form id="changeEmail" method="POST">
                <label>New e-mail address:</label><br>
                <input type="email" name="email" placeholder=" Enter the new address..." required><br>
                <input type="submit" value="Change">
            </form>
            <h2>Change username</h2>
            <form id="changeUsername" method="POST">
                <label>Username:</label><br>
                <input type="text" name="username" placeholder=" Pick a new user name..." required><br>
                <input type="submit" value="Change">
            </form> 
        </div>
    </body>
</html>