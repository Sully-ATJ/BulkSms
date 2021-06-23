<?php
    include 'includes/class-autoload.inc.php';
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Css/clientuser.css">
    <script src="Js/clientuser.js" type="text/javascript"></script>
    <title>Client User</title>
</head>
<body>
    <div class="navBar">
        <a href="index.php">LOGO</a>
        <a id="message" class="tab-links">Messages</a>
        <a id="setting" class="tab-links">Settings</a>
        <?php
            if(isset($_SESSION["userId"])){
                $cid = $_SESSION["companyId"];
                echo "<div class='dropdown'>
                    <button class='dropbtn'>".$_SESSION["fname"]. " ".$_SESSION["lname"]."
                        <i class='fa fa-caret-down'></i>
                    </button>
                    <div class='dropdown-content'>
                        <a>Company ID:". $cid ."</a>
                        <a href='includes/logout.inc.php'> Log out</a>
                    </div>
                </div>";
            }
        ?>
    </div>
    <div class="page-content">
        <div id="messageC" class="tab-page">
            <!-- ---------------Create message tab--------------- -->
            <form action="includes/create/message.inc.php" method="POST">
                <h5>Create Message</h5>
                <?php
                    echo '<input type="hidden" name="alphanumeric" value="'.$_SESSION['alphanumericId'].'">';
                ?>
                <div class="form-group">
                    <label for="list-Id">Select Recipient List:</label>
                    <select name="list-Id" id="" required>
                        <option value="">>---Select---<</option>
                        <?php
                            $listObj = new Smslist();
                            $listObj->getAllLists($_SESSION["companyId"]);
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">SMS Content: </label>
                    <textarea name="message" id="message" cols="45" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="delivery_date">Delivery Date: </label>
                    <input type="date" class="form-input"  name="delivery_date" required>
                    <small id="help" class="form-text text-muted">Format: DD-MM-YYYY</small>
                </div>
                <div class="form-group">
                    <label for="delivery_time">Delivery time: </label>
                    <input type="time" class="form-input"  name="delivery_time" required>
                    <small id="help" class="form-text text-muted">Format: HH:MM</small>
                </div>
                <button type="submit" name="create-message" class="Btn submitBtn">Submit</button>
            </form>
            <form action="includes/create/specialMessages.inc.php" method="post">
                <h5>Create Special message</h5>
                <?php
                    echo '<input type="hidden" name="alphanumeric" value="'.$_SESSION['alphanumericId'].'">';
                ?>
                <div class="form-group">
                    <label for="list-Id">Select Recipient List:</label>
                    <select name="list-Id" id="" required>
                        <option value="">>---Select---<</option>
                        <?php
                            $listObj = new Smslist();
                            $listObj->getAllLists($_SESSION["companyId"]);
                        ?>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="message">SMS Content: </label>
                    <textarea name="message" id="message" cols="45" rows="5" required></textarea>
                </div>
                <button type="submit" name="create-special-message" class="Btn submitBtn">Submit</button>
            </form>
        </div>

         <!-- ---------------Settings tab--------------- -->
        <div id="settingC" class="tab-page">
                <form action="includes/update/changePassword.inc.php" method="post">
                    <h4>Change Password</h4>
                    <?php
                        echo '<input type="hidden" name="id" value="'.$_SESSION['userId'].'">';
                    ?>
                    <div class="form-group">
                        <label for="new-pwd">Enter New Password: </label>
                        <input type="password" class="form-input" name="new-pwd" required>
                    </div>
                    <div class="form-group">
                        <label for="rep-pwd">Repeat New Password: </label>
                        <input type="password" class="form-input" name="rep-pwd" required>
                    </div>
                    <button type="submit" name="change-pwd" class="Btn submitBtn">Submit</button>
                </form>
        </div>
    </div>
</body>
</html>