<?php
    require '../../classes/dbh.class.php';
    require '../../classes/message.class.php';

    session_start();
    
    $msg = new Message();
    $msg->deleteMessage($_GET['id']);
    $msg = null;
    unset($msg);
    if ($_SESSION["userType"] == 1) {
        header("location: ../../platformAdmin.php");
        exit();
    }
    elseif ($_SESSION["userType"] == 2) {
        header("location: ../../clientAdmin.php");
        exit();
    }
    