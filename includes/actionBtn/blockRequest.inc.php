<?php
    require '../../classes/dbh.class.php';
    require '../../classes/smslist.class.php';
    

    $req = new Smslist();
    $req->blockAlphanumeric($_GET['id'], $_GET['bid']);
    $req = null;
    unset($req);
    header("location: ../../platformAdmin.php");
    exit();
    
    