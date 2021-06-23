<?php

    class Company extends Dbh{

        public function createCompany($title, $email, $contactPerson, $phoneNo, $address, $credit, $alphanumeric){

            $sql = "INSERT INTO company(company_title, company_email, company_contact_person, company_phone_number, company_address, company_credit) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title, $email, $contactPerson, $phoneNo, $address, $credit]);

            $sql = "SELECT * from company WHERE company_title = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title]);

            $res = $stmt->fetch();

            $sql = "INSERT INTO company_alphanumerics(company_id, alphanumeric) VALUES (?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$res["company_id"], $alphanumeric]);
        }

        public function getAllCompanies(){

            $sql = "SELECT * from company";
            $stmt = $this->connect()->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<option value=". $row['company_id'].">
                        " .$row['company_title']. "        
                    </option>";
            }
        }

        public function getCompanyAlphanumerics($id){
            $sql = "SELECT * from company_alphanumerics WHERE company_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            while ($row = $stmt->fetch()) {
                echo "<option value=". $row['alphanumeric_id'].">
                        " .$row['alphanumeric']. "        
                    </option>";
            }
        }

        public function getCompanyCredit($id){
            $sql = "SELECT company_credit from company WHERE company_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $credit = $stmt->fetch();
            echo "<label class='credit'>Credit Balance: " .$credit['company_credit']."<label>";
        }

        public function addAlphanumeric($id, $alphanumeric){

            $sql = "INSERT INTO company_alphanumerics(company_id, alphanumeric) VALUES (?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id, $alphanumeric]);
        }

        public function addCredit($credit, $id){
            $sql = "UPDATE company SET company_credit = (company_credit + ?) WHERE company_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$credit, $id]);
        }
    }