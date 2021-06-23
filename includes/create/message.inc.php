<?php
    if(isset($_POST["create-message"])){
        $alphanumeric  = $_POST["alphanumeric"];
        $listId = $_POST["list-Id"];
        $message = $_POST["message"];
        $delivery_date = $_POST["delivery_date"];
        $delivery_time = $_POST["delivery_time"];

        require '../../classes/dbh.class.php';
        require '../../classes/message.class.php';
        

        $msgObj = new Message();
        
        session_start();
        if ($_SESSION['userType'] == 2) {
            $msgObj->createMessageAdmin($alphanumeric, $listId, $message, $delivery_date, $delivery_time);
            $msgObj = null;
            unset($msgObj);
            header("location: ../../clientAdmin.php");
        }
        elseif ($_SESSION['userType'] == 3) {
            $msgObj->createMessage($alphanumeric, $listId, $message, $delivery_date, $delivery_time);
            $msgObj = null;
            unset($msgObj);
            header("location: ../../clientUser.php");
        }
        exit();
    }
    else {
        session_start();
        if ($_SESSION['userType'] == 2) {
            header("location: ../../clientAdmin.php?error=invalidpath");
            exit();
        }
        elseif ($_SESSION['userType'] == 3) {
            header("location: ../../clientUser.php?error=invalidpath");
            exit();
        }
    }
?>