<?php
    if (isset($_POST["create-company"])) {
        $title = $_POST["company-title"];
        $email = $_POST["company-email"];
        $contactPerson = $_POST["contact-name"]; 
        $phoneNo = $_POST["company-phoneNo"]; 
        $address = $_POST["address"]; 
        $credit = $_POST["credit"]; 
        $alphanumeric = $_POST["alphanumeric"];

        require '../../classes/dbh.class.php';
        require '../../classes/company.class.php';

        $company = new Company();
        $company->createCompany($title, $email, $contactPerson, $phoneNo, $address, $credit, $alphanumeric);
        $company = null;
        unset($company);
        header("location: ../../platformAdmin.php");
        exit();
    }
    else {
        header("location: ../../platformAdmin.php?error=invalidpath");
        exit();
    }