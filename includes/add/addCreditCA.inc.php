<?php
    if (isset($_POST["add-credit"])) {
        $credit = $_POST["credit"];
        

        require '../../classes/dbh.class.php';
        require '../../classes/company.class.php';

        session_start();


        $company = new Company();
        $company->addCredit($credit, $_SESSION["companyId"]);
        $company = null;
        unset($company);
        header("location: ../../clientAdmin.php");
        exit();
    }
    else {
        header("location: ../../clientAdmin.php?error=invalidpath");
        exit();
    }