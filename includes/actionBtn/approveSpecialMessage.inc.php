<?php
    require '../../classes/dbh.class.php';
    require '../../classes/message.class.php';

    session_start();
    $msg = new Message();

    if ($_SESSION["userType"] == 1) {
        $msg->approveSpecialMessage($_GET['id']);
        $msg = null;
        unset($msg);
        header("location: ../../platformAdmin.php");
        exit();
    }
    elseif ($_SESSION["userType"] == 2) {
        $msg->clearSpecialMessage($_GET['id']);
        $msg = null;
        unset($msg);
        header("location: ../../clientAdmin.php");
        exit();
    }