<?php

    class DB 
    {
        private $servername;
        private $username;
        private $password;
        private $dbname;
       

        // mysql://b9ff5642ee091a:a01a0c5c@eu-cdbr-west-02.cleardb.net/heroku_1811ddbbc9d6917?reconnect=true
        private $cleardb_url;
        public function connect()
        {
            $cleardb_url=parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->servername = $cleardb_url["host"];
            $this->username = $cleardb_url["user"];
            $this->password = $cleardb_url["pass"];
            $this->dbname = substr($cleardb_url["path"],1);
            
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
