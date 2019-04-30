<?php 
    

    require_once("classes.php");
    class User extends DB
    {
        public function getAllUsers()
        {   
           
            $stmt = $this->connect()->query("select * from users");
    
        
            while($row = $stmt->fetch())
            {
                echo "<p><a href=?page=profile&userid=".$row['ID'].">".$row['email']."</a></p>";
            }
        }

        public function getUserById($id)
        {   
            
            
             $query = 'select * from users where ID= ?';
             $stmt = $this->connect()->prepare($query);
             $stmt-> execute([$id]);
            
             $user = $stmt->fetch();
             return $user;
        }

        public function getUserByEmail($email)
        {   
            
            
             $query = 'select * from users where email= ?';
             $stmt = $this->connect()->prepare($query);
             $stmt -> execute([$email]);
            
             $user = $stmt->fetch();
             return $user;
        }

        public function followUser($userid)
        {
            $query = "SELECT * FROM isFollowing WHERE follower =". $_SESSION['ID']." AND isFollowing = ".
            $userid." LIMIT 1";

            $result = $this->connect()->query($query);

            if($result->rowCount()>0)
            {
                $row =$result->fetch();
                $deleteQuery="DELETE FROM isFollowing WHERE id = ".$row['ID']." LIMIT 1";

                $this->connect()->query($deleteQuery);
                echo "1";
            }
            else
            {
                $insertQuery = "INSERT INTO   isFollowing(follower,isFollowing) VALUES(". $_SESSION['ID'].",".
                $userid.")";
                
                $this->connect()->query($insertQuery);
                echo "2";
            
            }
            return $result;

        }

        public function insertUser($email, $password)
        {   

            $insertQuery = "INSERT INTO users (`email`, `password`) VALUES ('$email', '$password')";
            
            $stmt = $this->connect()->prepare($insertQuery);
            $stmt -> execute();

             if($this->getUserByEmail($email))
             {
                $_SESSION["ID"] = $this->getUserByEmail($email)['ID'];

                $updateQuery = "UPDATE users SET password='".md5(md5($_SESSION["ID"]).$_POST['password'])."' WHERE id = ".$_SESSION["ID"]." LIMIT 1";

                $stmt = $this->connect()->prepare($updateQuery);
                $stmt -> execute();
                echo "1";
                return $user;

            }
            else 
                echo $error= "Couldn't create user";

        }
    }

?>