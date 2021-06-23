<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="navBar">
        <a href="index.php">LOGO</a>
    </div>
    <div class="login">
        <form action="includes/login.inc.php" method="post">
            <h2>Login</h2>
            <input type="text" name="uid" placeholder="Username/email" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <button type="submit" name="login" class="Btn submitBtn">Login</button>
        </form>
        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo"<p style='color:#f00'>Fill in all fields!</p>";
                }
                elseif ($_GET["error"] == "wronglogin") {
                    echo"<p style='color:#f00'=>Incorrect login credentials!</p>";
                }
                elseif ($_GET["error"] == "wrongpwd") {
                    echo"<p style='color:#f00'>Incorrect password!</p>";
                }
            }   
        ?>
    </div>
    
</body>
</html>