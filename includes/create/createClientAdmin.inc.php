<?php

    if (isset($_POST["create-admin"])) {
        $adminId = $_POST["id"];
        $companyId = $_POST["company-id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $email = $_POST["email"]; 

        //Generating initial random password
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd =  substr(str_shuffle($data), 0, 8);


        require '../../classes/dbh.class.php';
        require '../../classes/users.class.php';


        $userObj = new Users();
        $userObj->createClientAdminUser($adminId, $companyId, $fname, $lname, $username, $pwd, $email, $address);
        $userObj = null;
        unset($userObj);
        header("location: ../../platformAdmin.php");
        exit();
        
    }
    else {
        header("location: ../../platformAdmin.php?error=invalidpath");
        exit();
    }