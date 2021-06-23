<?php
    if(isset($_POST["create-special-message"])){
        $alphanumeric  = $_POST["alphanumeric"];
        $listId = $_POST["list-Id"];
        $message = $_POST["message"];
        

        require '../../classes/dbh.class.php';
        require '../../classes/message.class.php';

        $msgObj = new Message();
        $sql = "SELECT recipient_id, recipient_dob FROM recipients WHERE list_id=?";
        $stmt = $msgObj->connect()->prepare($sql);
        $stmt->execute([$listId]);
        
        
    
        session_start();
        if ($_SESSION['userType'] == 2) {
            while ($row= $stmt->fetch()) {
                $d_Date = substr_replace($row["recipient_dob"],date("Y"),0, 4);
                $msgObj->createSpecialMessageAdmin($alphanumeric,$listId, $row["recipient_id"], $message, $d_Date, "8:00");
            }
            
            $msgObj = null;
            unset($msgObj);
            header("location: ../../clientAdmin.php");
        }
        elseif ($_SESSION['userType'] == 3) {
            while ($row= $stmt->fetch()) {
                $d_Date = substr_replace($row["recipient_dob"],date("Y"),0, 4);
                $msgObj->createSpecialMessage($alphanumeric,$listId, $row["recipient_id"], $message, $d_Date, "8:00");
            }
            
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