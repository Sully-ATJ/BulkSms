<?php
    if (isset($_POST["sub-user-alpha"])) {
        $id = $_POST["user-id"];
        $alphanumeric = $_POST["alphanumeric"];

        require '../../classes/dbh.class.php';
        require '../../classes/users.class.php';

        $userObj = new Users();
        $userObj->updateUserAlphanumeric($id, $alphanumeric);
        $userObj = null;
        unset($userObj);
        header("location: ../../clientAdmin.php");
        exit();
    }
    else {
        header("location: ../../clientAdmin.php?error=invalidpath");
        exit();
    }