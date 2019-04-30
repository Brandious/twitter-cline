<?php

    class DB 
    {
        private $servername;
        private $username;
        private $password;
        private $dbname;
       

        // mysql://b9ff5642ee091a:a01a0c5c@eu-cdbr-west-02.cleardb.net/heroku_1811ddbbc9d6917?reconnect=true

        public function connect()
        {
            $this->servername = "eu-cdbr-west-02.cleardb.net/heroku_1811ddbbc9d6917";
            $this->username = "b9ff5642ee091a";
            $this->password = "a01a0c5c";
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
