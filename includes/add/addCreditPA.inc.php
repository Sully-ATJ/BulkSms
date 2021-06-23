<?php
    if (isset($_POST["add-credit"])) {
        $credit = $_POST["credit"];
        $id = $_POST["company-id"];

        require '../../classes/dbh.class.php';
        require '../../classes/company.class.php';

        $company = new Company();
        $company->addCredit($credit, $id);
        $company = null;
        unset($company);
        header("location: ../../platformAdmin.php");
        exit();
    }
    else {
        header("location: ../../platformAdmin.php?error=invalidpath");
        exit();
    }