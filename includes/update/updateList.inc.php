<?php
    if (isset($_POST["add-Tolist"])) {

        $listId = $_POST["list-id"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phoneNo = $_POST["phone-no"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $dob = $_POST["date-of-birth"];


        require '../../classes/dbh.class.php';
        require '../../classes/smslist.class.php';

        $list = new Smslist();
        $list->addToList($listId, $fname, $lname, $phoneNo, $email, $address, $dob);
        $list = null;
        unset($list);
        header("location: ../../clientAdmin.php");
        exit();
    }
    else {
        header("location: ../../clientAdmin.php?error=invalidpath");
        exit();
    }