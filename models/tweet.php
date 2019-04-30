<?php 
   

   require_once("classes.php");
    
      function time_since($since)
    {
        $chunks = array (
            array(60*60*24*365,'year'),
            array(60*60*24*30,'month'),
            array(60*60*24*7,'week'),
            array(60*60*24,'day'),
            array(60*60,'hour'),
            array(60,'minut'),
            array(1,'second')
        );

        for($i = 0 , $j = count($chunks); $i < $j; $i++)
        {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];

            if(($count = floor($since / $seconds)) !=0)
                break;
        }

        $print = ($count == 1) ? '1 '.$name: "$count {$name}s";
        return $print;
    }



    class Tweet extends DB
    {
        public function getAllTweets()
        {   
            $stmt = $this->connect()->query("select * from tweets");
    
            $this->print($stmt);
        }

        public function print($result)
        {
            $user = new User;
            
            if($result->rowCount()<1)
                echo "No tweets there...";
            
            while($row = $result->fetch())
            {
                echo "<div class='tweet'><p><a href=?page=profile&userid=".$row['userid'].">".$user->getUserById($row['userid'])['email']."</a><span class='times'>".time_since(time()- strtotime($row['datetime']))." ago</span>:</p>";

                echo "<p>".$row['tweet']."</p>";

                echo "<p><a class='toggleFollow' data-userID='".$row['userid']."'>";
                
                
                if($_SESSION["ID"])
                {
                    $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower=".$_SESSION['ID']." AND isFollowing =".$row['userid']." LIMIT 1";
                    
                    $isFollowingQueryResult = $this->connect()->query($isFollowingQuery);
                    
                    if($isFollowingQueryResult->rowCount()>0) 
                        echo "Unfollow";
                    else
                        echo "Follow";
                }
                else 
                {
                    echo "Please login to follow";
                }                        

                echo "</a></p></div>";
            }
        }

        public function getTweets($where)
        {
            $query = "select * from tweets ".$where;
            $stmt = $this->connect()->query($query);
    
            $this->print($stmt);
        }

        public function getFollowersTweets()
        {
           $query = "SELECT * FROM isFollowing WHERE follower =".$_SESSION['ID'];
             
            $result = $this->connect()->query($query);
            
            if($result->rowCount()>0)
            {
                $whereClause = "";

                while( $row = $result->fetch())
                {
                    if($whereClause == "")
                        $whereClause = " WHERE"; 
                    else  $whereClause.=" OR";  

                    $whereClause.= " userid = ".$row['isFollowing'];
                }

                $this->getTweets($whereClause);
            }
            else 
            {
                echo "No tweets there...";
            }
        }

        public function searchTweets($condition)
        {
            $whereClause = " WHERE tweet LIKE '%". $condition."%'";

            $this->getTweets($whereClause);


        }

        public function getUserTweets($id)
        {
            $whereClause="WHERE userid=".$id;       
            
            $this->getTweets($whereClause);
        }

        public function insertTweet($tweetContent)
        {   
            $insertQuery = "INSERT INTO tweets(tweet,userid,datetime) VALUES('". $tweetContent."',".
             $_SESSION['ID'].",NOW())";

            $this->connect()->query($insertQuery);
            echo "1";
        }
    }

?>