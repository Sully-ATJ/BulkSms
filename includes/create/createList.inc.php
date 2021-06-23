<?php
    if (isset($_POST["create-list"])) {

        $listName = $_POST["list-name"];
        session_start();
        

        require '../../classes/dbh.class.php';
        require '../../classes/smslist.class.php';

        $list = new Smslist();
        $list->createList($listName, $_SESSION["companyId"]);
        $list = null;
        unset($list);
        header("location: ../../clientAdmin.php");
        exit();
    }
    else {
        header("location: ../../clientAdmin.php?error=invalidpath");
        exit();
    }