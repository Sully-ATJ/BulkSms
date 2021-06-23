<?php

    if (isset($_POST["create-admin"])) {
        $adminId = $_POST["id"];

        session_start();

        $companyId = $_SESSION["companyId"];
        $alphanumeric = $_POST["alphanumeric"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $address = $_POST["address"];
         

        //Generating initial random password
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd =  substr(str_shuffle($data), 0, 8);


        require '../../classes/dbh.class.php';
        require '../../classes/users.class.php';


        $userObj = new Users();
        $userObj->createClientSubUser($adminId, $companyId, $alphanumeric, $fname, $lname, $username, $pwd, $email, $address);
        $userObj = null;
        unset($userObj);
        header("location: ../../clientAdmin.php");
        exit();
    }
    else {
        header("location: ../../clientAdmin.php?error=invalidpath");
        exit();
    }