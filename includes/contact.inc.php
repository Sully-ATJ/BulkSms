<?php

    if(isset($_POST["contact"])) {
        //the message
        $msg = $_POST["name"]." sent you the following message:\n" .$_POST["message"]. "\n you can reach them at " .$_POST["phone"]. " or " .$_POST["email"];

        $email = "Change this to the email you want to receive business enquires";
        //use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        //Send a mail to the user with their login credentials
        mail($email,"Contact Message",$msg);

        header("location: ../index.php");
    }
    else{
        header("location: ../index.php?error=invalidpath");
    }
?>