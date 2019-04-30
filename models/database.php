<?php

    class DB 
    {
        private $servername;
        private $username;
        private $password;
        private $dbname;
       
        public function connect()
        {
            $this->servername = "localhost";
            $this->username = "brandious";
            $this->password = "helloworld";
            $this->dbname = "twitter";
            
            try
            {
                $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";";
                $pdo = new PDO($dsn, $this->username, $this->password);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
                return $pdo;
            }
            catch(Exception $e)
            {
                echo "Connection failed: ".$e->getMessage();
            }

        }
    }


?>
