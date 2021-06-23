<?php
    if (isset($_POST["change-pwd"])) {
        $id = $_POST['id'];
        $pwd = $_POST["new-pwd"];
        $repPwd = $_POST["rep-pwd"];

        if ($pwd !== $repPwd) {
            header("location: ../../platformAdmin.php?error=pwdnotsame"); //add error message
            exit();
        }

        require '../../classes/dbh.class.php';
        require '../../classes/users.class.php';

        session_start();
        $usr  = new Users();


        if ($_SESSION["userType"] == 1) {
            $usr->changePassword($id, $pwd, 1);
            $usr = null;
            unset($usr);
            header("location: ../../platformAdmin.php");
            exit();
        }
        elseif ($_SESSION["userType"] == 2) {
            $usr->changePassword($id, $pwd, 2);
            $usr = null;
            unset($usr);
            header("location: ../../clientAdmin.php");
            exit();
        }
        elseif ($_SESSION["userType"] == 3) {
            $usr->changePassword($id, $pwd, 3);
            $usr = null;
            unset($usr);
            header("location: ../../clientUser.php");
            exit();
        }
    }
    else {
        session_start();
        if ($_SESSION["userType"] == 1) {
            header("location: ../../platformAdmin.php?error=invalidpath");
            exit();
        }
        elseif ($_SESSION["userType"] == 2) { 
            header("location: ../../clientAdmin.php?error=invalidpath");
            exit();
        }
        elseif ($_SESSION["userType"] == 3) {
            header("location: ../../clientUser.php?error=invalidpath");
            exit();
        }
        else {
            header("location: ../../login.php?error=invalidpath");
            exit();
        }
    }
