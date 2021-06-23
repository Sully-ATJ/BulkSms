<?php
    if (isset($_POST["add-alphanumeric"])) {
        $id = $_POST["company-id"];
        $alphanumeric = $_POST["alphanumeric"];

        require '../../classes/dbh.class.php';
        require '../../classes/company.class.php';

        $company = new Company();
        $company->addAlphanumeric($id, $alphanumeric);
        $company = null;
        unset($company);
        header("location: ../../platformAdmin.php");
        exit();
    }
    else {
        header("location: ../../platformAdmin.php?error=invalidpath");
        exit();
    }