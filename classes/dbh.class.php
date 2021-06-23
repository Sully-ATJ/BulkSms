<?php

    Class Dbh{
        private $serverName;
        private $userName;
        private $password;
        private $dbName;

        public function connect(){
            $this->serverName = "127.0.0.1";
            $this->userName = "root";
            $this->password = "1234567890";
            $this->dbName = "smsplatform";

            try {
                $dsn = "mysql:host=" .$this->serverName.";dbname=". $this->dbName;
                $pdo = new PDO($dsn, $this->userName, $this->password);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            } catch (PDOException $e) {
                echo "Connection failed: ".$e->getMessage();
            }
            
            
        }
    }
?>