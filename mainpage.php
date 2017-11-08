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
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
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
            <div id="select">DASHBOARD
                <div class="dropdown">
                    <ul>
                        <li><a href="settings.php">SETTINGS</a></li>
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
        <div id="actions">
            <input class="createGroup" type="button" value="Create group">
            </form>
        </div>
        <div id="notifs">
                <table>
                    <?php 
                        $stmt = $db->prepare("SELECT * FROM notifs WHERE owner=:id ORDER BY notif_id DESC;");
                        $stmt->bindValue(':id',$_SESSION['id'], SQLITE3_INTEGER);
                        $notifs = $stmt->execute();
                        
                        while(($row = $notifs->fetchArray())){
                            echo "<tr><td>";
                            h($row['message']);
                            echo "</td></tr>";
                        }
                    ?>
                </table>
        </div>
        <div class="content">
                <?php
                    $stmt = $db->prepare("SELECT * FROM members WHERE user_id=:id;");
                    $stmt->bindValue(':id',$_SESSION['id'], SQLITE3_INTEGER);
                    $memberships = $stmt->execute();
                    while(($membership = $memberships->fetchArray())) {
                            $stmt = $db->prepare("SELECT * FROM groups WHERE group_id=:mid;");
                            $stmt->bindValue(':mid',$membership['group_id'], SQLITE3_INTEGER);
                            $groups = $stmt->execute();
                            while(($group = $groups->fetchArray())) {
                                if($group['owner'] == $_SESSION['id']) echo "<img id='crown' src='images/crown.png' alt='own'>";
                                echo "<h1>";
                                h($group['name']);
                                echo "</h1>";
                                        echo "<img class='add' id='".$group['group_id']."' src='images/add.png' alt='add'>";
                                if($group['owner'] == $_SESSION['id']) echo " <img class='addm' id='".$group['group_id']."' src='images/adfriend.png' alt='add member'>
                                                                        <img class='deleteGroup' id='".$group['group_id']."' src='images/trash.png' alt='delete'>";
                                echo "<h2 id='members".$group['group_id']."'>- Members: ";
                                $stmt = $db->prepare("SELECT * FROM members WHERE group_id=:group_id;");
                                $stmt->bindValue(':group_id',$group['group_id'], SQLITE3_INTEGER);
                                $mbshps = $stmt->execute();
                                if(($mbshp = $mbshps->fetchArray())) {
                                    h($mbshp['username']);
                                }
                                while(($mbshp = $mbshps->fetchArray())) {
                                    echo ", ";
                                    h($mbshp['username']);
                                }
                                echo    "</h2><table id='group' class='".$group['group_id']."'>";

                                $step = 0;
                                $stmt = $db->prepare("SELECT * FROM bills WHERE group_id=:gid;");
                                $stmt->bindValue(':gid',$group['group_id'], SQLITE3_INTEGER);
                                $bills = $stmt->execute();
                                while(($bill = $bills->fetchArray())) {
                                    if($step == 0) {
                                        $step = 1;
                                        echo "<tr>
                                                <td>";                                                 
                                        if($bill['owner'] == $_SESSION['id']) { 
                                            echo "<div id='ownedBox'><input class='deleteBill' id='".$bill['bill_id']."' type='button' value='x'><img src='images/crown.png' alt='own'><h2>";
                                            h($bill['name']);
                                            echo "</h2> <br>You own this bill";
                                        }
                                        else {
                                            echo "<div id='box'><h2>";
                                            h($bill['name']);
                                            echo "</h2>";
                                            $stmt = $db->prepare("SELECT * FROM payees WHERE bill_id=:bid AND user_id=:uid;");
                                            $stmt->bindValue(':bid',$bill['bill_id'], SQLITE3_INTEGER);
                                            $stmt->bindValue(':uid',$_SESSION['id'], SQLITE3_INTEGER);
                                            $payees = $stmt->execute();
                                            while(($payee = $payees->fetchArray())) {
                                                if($payee['payed'] == 0) echo "<br>You owe &pound".$bill['each'];
                                                else echo "<br>You have payed!";
                                            }
                                        }
                                        echo "<hr>
                                                <table>
                                                    <tr id='initial'>
                                                        <td id='left'>Name</td>
                                                        <td id='right'>Owes(&pound)</td>
                                                    </tr>";
                                        $stmt = $db->prepare("SELECT * FROM payees WHERE bill_id=:bid;");
                                        $stmt->bindValue(':bid',$bill['bill_id'], SQLITE3_INTEGER);
                                        $payees = $stmt->execute();
                                        while(($payee = $payees->fetchArray())) {
                                            echo   "<tr>
                                                    <td id='left'>";
                                            if($bill['owner'] == $_SESSION['id']) {
                                                echo "<input class='check' id='".$payee['payee_id']."' type='checkbox' ";
                                                if($payee['payed'] == 1) echo "checked";
                                                echo ">";
                                            }
                                            h($payee['username']);
                                            echo "</td>
                                                        <td id='right'>".$bill['each']."</td>
                                                    </tr>";
                                        }
                                        echo   "</table>
                                                <table>
                                                    <tr id='total'>
                                                        <td></td>
                                                        <td id='right'>Total: ".$bill['amount']."</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>";
                                    } else  {
                                        $step = 0;
                                        echo "<td>";
                                        if($bill['owner'] == $_SESSION['id']) {
                                            echo "<div id='ownedBox'><input class='deleteBill' id='".$bill['bill_id']."' type='button' value='x'><img src='images/crown.png' alt='own'><h2>";
                                            h($bill['name']);
                                            echo "</h2><br> You own this bill";
                                        }
                                        else {
                                            echo "<div id='box'><h2>";
                                            h($bill['name']);
                                            echo "</h2>";
                                            $stmt = $db->prepare("SELECT * FROM payees WHERE bill_id=:bid AND user_id=:uid;");
                                            $stmt->bindValue(':bid',$bill['bill_id'], SQLITE3_INTEGER);
                                            $stmt->bindValue(':uid',$_SESSION['id'], SQLITE3_INTEGER);
                                            $payees = $stmt->execute();
                                            while(($payee = $payees->fetchArray())) {
                                                if($payee['payed'] == 0) echo "<br>You owe &pound".$bill['each'];
                                                else echo "<br>You have payed!";
                                            }
                                        }
                                        echo "<hr>
                                                <table>
                                                    <tr id='initial'>
                                                        <td id='left'>Name</td>
                                                        <td id='right'>Owes(&pound)</td>
                                                    </tr>";
                                        $stmt = $db->prepare("SELECT * FROM payees WHERE bill_id=:bid;");
                                        $stmt->bindValue(':bid',$bill['bill_id'], SQLITE3_INTEGER);
                                        $payees = $stmt->execute();
                                        $sum = 0;
                                        while(($payee = $payees->fetchArray())) {
                                            echo   "<tr>
                                                    <td id='left'>"; 
                                            if($bill['owner'] == $_SESSION['id']) {
                                                echo "<input class='check' id='".$payee['payee_id']."' type='checkbox' ";
                                                if($payee['payed'] == 1) echo "checked";
                                                echo ">";
                                            }
                                            h($payee['username']);
                                            echo "</td>
                                                    <td id='right'>".$bill['each']."</td>
                                                    </tr>";
                                        }
                                        echo   "</table>
                                                <table>
                                                    <tr id='total'>
                                                        <td></td>
                                                        <td id='right'>Total: ".$bill['amount']."</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>";
                                    }
                                }
                                if($step == 1) echo "<td><div></div></td></tr>";

                                echo "</table>";
                            }
                    }
                ?>
                <div class="modal_group">
                    <div class="modal_bg"></div>
                    <div class="modal_dialog">
                        <h1>Create a group</h1><br>
                        <label>Group name:</label><br>
                        <input id="group_name" type="text" name="groupName" maxlength="30"><br>
                        <input id="createGroup" type="button" value="Create">
                        <input id="cancelGroup" type="button" value="Cancel">
                    </div>
                </div>
                <div class="modal_member">
                    <div class="modal_bg"></div>
                    <div class="modal_dialog">
                        <h1>Add a group member</h1>
                        <label>Member e-mail</label><br>
                        <input id="member_email" type="text" name="member_email" maxlength="30"><br>
                        <input id="addMember" type="button" value="Add">
                        <input id="cancelMember" type="button" value="Cancel">
                    </div>
                </div>
                <div class="modal_bill">
                    <div class="modal_bg"></div>
                    <div class="modal_dialog">
                        <h1>Add a bill</h1><br>
                        <label>Bill name</label><br>
                        <input id="bill_name" type="text" name="bill_name" maxlength="30"><br>
                        <label>Bill amount(&pound):</label><br>
                        <input id="bill_amount" type="number" name="bill_amount" min="1" step="any"><br>
                        <input id="addBill" type="button" value="Add">
                        <input id="cancelBill" type="button" value="Cancel">
                    </div>
                </div>
                <div class="modal_deleteB">
                    <div class="modal_bg"></div>
                    <div class="modal_dialog">
                        <h1>Are you sure you want to delete this bill?</h1><br><br>
                        <input id="deleteB" type="button" value="Yes">
                        <input id="cancelB" type="button" value="No">
                    </div>
                </div>
                <div class="modal_deleteG">
                    <div class="modal_bg"></div>
                    <div class="modal_dialog">
                        <h1>Are you sure you want to delete this group?</h1><br><br>
                        <input id="deleteG" type="button" value="Yes">
                        <input id="cancelG" type="button" value="No">
                    </div>
                </div>
        </div>
    </body>
</html>