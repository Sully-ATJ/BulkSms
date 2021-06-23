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
    <link href='https://css.gg/globe-alt.css' rel='stylesheet'>
    <link href='https://css.gg/dollar.css' rel='stylesheet'>
    <link href='https://css.gg/mail.css' rel='stylesheet'>
    <link rel="stylesheet" href="Css/index.css">
    <title>Bulk SMS Platform</title>
</head>
<body>
    <div class="navBar">
        <a class="logo" alt="Logo"href="index.php">LOGO</a>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <?php
                if(isset($_SESSION["userId"])){
                    if($_SESSION["userType"] == 1){
                        echo "<li><a href='platformAdmin.php'>Profile</a></li>";
                    }
                    elseif ($_SESSION["userType"] == 2) {
                        echo "<li><a href='clientAdmin.php'>Profile</a></li>";
                    }
                    elseif ($_SESSION["userType"] == 3) {
                        echo "<li><a href='clientUser.php'>Profile</a></li>";
                    }
                    echo "<li><a href='includes/logout.inc.php'> Log out</a></li>";
                }
                else {
                    echo "<li><a href='login.php'>Login</a></li>";
                }
            ?>
        </ul>
    </div>
    <div id="home" class="section ">
        <div class="home-content">
            <h2>Send bulk SMS with ease.</h2>
            <h3>Reach your customers with personalized messages. Create recipient lists, compose messages and send them on mass at your desired time.</h3>
            <a href="#contact">Contact Us</a>
        </div>
    </div>
    <div id="services" class="section container">
        <div class="card">
            <i class="gg-globe-alt"></i>
            <h4>Global Reach</h4>
            <p>Send messages to anywhere in the world</p>
        </div>
        <div class="card">
            <i class="gg-mail"></i>
            <h4>Bulk Messages</h4>
            <p>Reach all you customers by sending to hundreds of messages at the same time</p>
        </div>
        <div class="card">
            <i class="gg-dollar"></i>
            <h4>No Hidden Fees</h4>
            <p>Transparent pricing, Pay only for the messages you send.</p>
        </div>
    </div>
    <div id="contact" class="section">
        <form action="includes/contact.inc.php" method="post">
            <h4>Contact Us</h4>
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="FULL NAME" required>
            </div>
            <div class="form-group">
                <input type="text" id="phone-no" name="phone-no" placeholder="PHONE NO" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="EMAIL" required>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" cols="30" rows="10" required></textarea>
            </div>
            <button type="submit" id="submit" name="contact">Send</button>
        </form>
    </div>
    <div class="footer">
            &copy 2021 All Rights Reserved.
    </div>
</body>
</html>