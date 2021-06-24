<?php

    Class Dbh{
        private $serverName;
        private $userName;
        private $password;
        private $dbName;

        public function connect(){
            $this->serverName = "serverName";
            $this->userName = "userName4DB";
            $this->password = "pwd4DB";
            $this->dbName = "nameOfDb";

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
