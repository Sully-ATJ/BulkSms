<?php

    if(isset($_POST["login"])){
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];


        require '../classes/dbh.class.php';
        require '../classes/users.class.php';

        $userObj = new Users();
        if ($userObj->emptyInputLogin($username, $pwd) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        $userObj->loginUser($username, $pwd);
    }
    else{
        header("location: ../login.php");
    }

?>