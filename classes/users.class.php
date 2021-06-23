<?php
    
    Class Users extends Dbh{

        public function getUser($name){

            $sql = "SELECT * FROM users WHERE user_name = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name]);


            $results = $stmt->fetchAll();
            return $results;
        }

        public function createPlatformAdminUser($id, $name, $username, $password, $email, $address){

            $sql = "INSERT INTO platform_admin(admin_id,admin_first_name, admin_last_name, admin_username, admin_password, admin_email, admin_address) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id, $fname, $lname, $username, $password, $email, $address]);

            $sql = "INSERT INTO users(users_id, user_first_name, user_last_name, user_username, user_password, user_email, user_address, user_usertype) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id, $fname, $lname, $username, $pwd, $email, $address,"1"]);


            //the message
            $msg = "Your login credentials are\nUsername: ".$username."\nPassword: ".$pwd;

            //use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            //Send a mail to the user with their login credentials
            mail($email,"Login Credentials",$msg);

        }

        public function createClientAdminUser($adminId, $companyId, $fname, $lname, $username, $pwd, $email, $address){

            $sql = "INSERT INTO client_admin(admin_id, company_id, admin_first_name, admin_last_name, admin_username, admin_password, admin_email, admin_address) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$adminId, $companyId, $fname, $lname, $username, $pwd, $email, $address]);

            $sql = "INSERT INTO users(users_id, user_first_name, user_last_name, user_username, user_password, user_email, user_address, user_usertype) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$adminId, $fname, $lname, $username, $pwd, $email, $address,"2"]);


            //the message
            $msg = "Your login credentials are\nUsername: ".$username."\nPassword: ".$pwd;

            //use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            //Send a mail to the user with their login credentials
            mail($email,"Login Credentials",$msg);

        }


        public function createClientSubUser($id, $companyId, $alphanumeric, $fname, $lname, $username, $pwd, $email, $address){

            $sql = "INSERT INTO client_sub_user(users_id, company_id, alphanumeric_id, user_first_name, user_last_name, user_username, user_password, user_email, user_address) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id, $companyId, $alphanumeric, $fname, $lname, $username, $pwd, $email, $address]);

            $sql = "INSERT INTO users(users_id, user_first_name, user_last_name, user_username, user_password, user_email, user_address, user_usertype) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id, $fname, $lname, $username, $pwd, $email, $address,"3"]);


            //the message
            $msg = "Your login credentials are\nUsername: ".$username."\nPassword: ".$pwd;

            //use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            //Send a mail to the user with their login credentials
            mail($email,"Login Credentials",$msg);

        }

        public function getAllSubUsers($id){

            $sql = "SELECT * from client_sub_user WHERE company_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            while ($row = $stmt->fetch()) {
                echo "<option value=". $row['users_id'].">
                        " .$row['user_first_name']. " ".$row['user_last_name']. "       
                    </option>";
            }
        }

        public function updateUserAlphanumeric($id, $alphanumeric){

            $sql = "UPDATE client_sub_user SET alphanumeric_id=? WHERE users_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$alphanumeric,$id]);
        }
        

        //login user function
        public function loginUser($username, $pwd){
            $sql = "SELECT * FROM users WHERE user_username = ? OR user_email = ?;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username,$username]);

            $result = $stmt->fetch();

            //check if username exits in database
            if ($result === false) {
                header("location: ../login.php?error=wronglogin");
                exit();
            }

            //check if entered password matches the one in the database
            $pwdDb = $result["user_password"];
            if($pwd !== $pwdDb){
                header("location: ../login.php?error=wrongpwd");
                exit();
            }
            session_start();
            $_SESSION["userId"] = $result["users_id"];
            $_SESSION["fname"] = $result["user_first_name"];
            $_SESSION["lname"] = $result["user_last_name"];
            $_SESSION["userType"] = $result["user_usertype"];

            if ($result["user_usertype"] == 1) {
                header("location: ../platformAdmin.php");
                exit();
            }
            elseif ($result["user_usertype"] == 2) {

                $sql = "SELECT company_id FROM client_admin WHERE admin_id = ?;";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$_SESSION["userId"]]);
                $res = $stmt->fetch();
                $_SESSION["companyId"] = $res["company_id"];
                header("location: ../clientAdmin.php");
                exit();
            }
            elseif ($result["user_usertype"] == 3) {

                $sql = "SELECT company_id, alphanumeric_id FROM client_sub_user WHERE users_id = ?;";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$_SESSION["userId"]]);
                $res = $stmt->fetch();
                $_SESSION["companyId"] = $res["company_id"];
                $_SESSION["alphanumericId"] = $res["alphanumeric_id"];
                header("location: ../clientUser.php");
                exit();
            }
            

        }

        //check if any of the inputs are empty
        public function emptyInputLogin($username, $pwd){
            $result;
            if(empty($username) || empty($pwd)){
                $result = true;
            }
            else{
                $result = false;
            }
            return $result;
        }

        public function changePassword($id, $pwd, $userType){

            $sql = "UPDATE users SET user_password=? WHERE users_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$pwd,$id]);
            if ($userType == 1) {
                $sql = "UPDATE platform_admin SET admin_password=? WHERE admin_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$pwd,$id]);
            }
            elseif ($userType == 2) {
                $sql = "UPDATE client_admin SET admin_password=? WHERE admin_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$pwd,$id]);
            }
            elseif ($userType == 3) {
                $sql = "UPDATE client_sub_user SET user_password=? WHERE users_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$pwd,$id]);
            }
        }

        
    }