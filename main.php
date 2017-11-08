<!DOCTYPE html>
<html>
    <head>
        <title>THE App!</title>
        <link rel="stylesheet" type="text/css" href="./css/main.css" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One|Oxygen">
    </head>
    <body>
        <div class="nav">
            <img src="images/SplitLogo.png">
            <div id="select"><select name="nav">
                <option selected>DASHBOARD</option>
                <option id="settings">SETTINGS</option>   <!-- create a popup on click -->
                <option id="logout">LOG OUT</option>    <!-- logout and head to mainpage on clik -->
            </select></div>
        </div>
        <div id="actions">
            <form method="POST">
                <label>Create individual bill</label><br>
                <input type="text" name="billName" placeholder=" Bill name"><br>
                <input id="actionButt" type="submit" value="Create"><br>
            </form>
            <form method="POST">
                <label>Create group</label><br>
                <input type="text" name="groupName" placeholder="Group name"><br>
                <input id="actionButt" type="submit" value="Create">
            </form>
        </div>
        <div id="notifs">
                <table>
                    <tr><td>Notification 1</td></tr>
                    <tr><td>Notification 2</td></tr>
                    <tr><td>Notification 3</td></tr>
                    <tr><td>Notification 4</td></tr>
                </table>
        </div>
        <div class="content">
                <img id="crown" src="images/crown.png">
                <h1>CS Boyz</h1>
                <img src="images/add.png">
                <img src="images/adfriend.png">
                <table id="group">
                <img class="deleteGroup">
                    <tr> <!-- step 0 begin -->
                        <td>
                            <div id="box">
                                <image class="deleteBill" src="images/x.png">
                                <h2>Crisps</h2>
                                You owe: $2
                                <hr>
                                <table>
                                    <tr id="initial">
                                        <td id="left">Name</td>
                                        <td id="right">Owes ($)</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Shalin</td>
                                        <td id="right">10</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                </table> 
                                <table>
                                    <tr id="total">
                                        <td></td>
                                        <td id="right">Total:  22.1</td>
                                    </tr>
                                </table>
                            </div>
                        </td> <!-- step 0 end -->
                        <td>  <!-- step 1 begin -->
                            <div id="ownedBox">
                                <img src="images/crown.png"><h2>Crisps</h2>
                                You own this bill
                                <image class="deleteBill" src="images/x.png">
                                <hr>
                                <table>
                                    <tr id="initial">
                                        <td id="left">Name</td>
                                        <td id="right">Owes ($)</td>
                                    </tr>
                                    <tr>
                                        <td id="left"><input type="checkbox" checked>Shalin</td>
                                        <td id="right">10</td>
                                    </tr>
                                    <tr>
                                        <td id="left"><input type="checkbox">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr id="total">
                                        <td></td>
                                        <td id="right">Total:  22.1</td>
                                    </tr>
                                </table>
                            </div>
                        </td> 
                    </tr> <!-- step 1 end  AND  alternative-->
                </table>
                
                <h1>House Boyz</h1>
                <img src="images/add.png">
                <img src="images/adfriend.png">
                <table id="group">
                    <tr>
                        <td>
                            <div id="box">
                                <h2>Food</h2>
                                <hr>
                                <table>
                                    <tr id="initial">
                                        <td id="left">Name</td>
                                        <td id="right">Owes ($)</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Shalin</td>
                                        <td id="right">10</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr id="total">
                                        <td></td>
                                        <td id="right">Total:  22.1</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div id="box">
                                <h2>Food</h2>
                                <hr>
                                <table>
                                    <tr id="initial">
                                        <td id="left">Name</td>
                                        <td id="right">Owes ($)</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Shalin</td>
                                        <td id="right">10</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                    <tr>
                                        <td id="left">Sammy</td>
                                        <td id="right">10.1</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr id="total">
                                        <td></td>
                                        <td id="right">Total:  22.1</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
    </body>
</html>