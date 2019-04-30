<?php




require_once("classes.php");
session_start();

$user = new User;
$tweet = new Tweet;

    if($_GET['function'] == 'logout')
    {
         session_unset();
    }


    function displayTweets($type)
    {      
        global $tweet;
        global $user;
       
        if($type == 'public')
        {
            $tweet->getAllTweets();
        }
        else if($type == 'yourtweets')
        {
            
            $whereClause = "WHERE userid= ".$_SESSION['ID'];
            
            $tweet->getTweets($whereClause);
          
        }
        else if($type == 'isFollowing')
        {
            $tweet->getFollowersTweets();

        }
        else if($type == 'search')
        {    
            $tweet->searchTweets($_GET['q']);
        }
        else if(is_numeric($type))
        {
            $result = $user->getUserById($type);
            echo "<h2>".$result['email']."'s Tweets </h2>";

            $tweet->getUserTweets($type);

        }       
    }
    
    function displaySearch()
    {
        echo '

        <form class="form-inline">
            <div class="form-group">
                 <input type="hidden" name="page" value="search">
                 <input type="text" name="q" class="form-control" id="search" placeholder="Search">
                <button type="submit" class="btn btn-primary">Search Tweets</button>
            </div>
        </form>
        
        ';
    }

    function displayTweetBox()
    {
        if($_SESSION['ID'] > 0 )
        {
            echo '
            <div id="tweetSuccess" class="alert alert-success">
                Tweet posted successfully
            </div>

            <div id="tweetFail" class="alert alert-danger">
                
            </div>


            <div class="form">
                 <div class="form-group">
                    <textarea class="form-control" id="tweetContent" placeholder="Enter Tweet"></textarea>
                </div>
                    <button id="postTweetButton" class="btn btn-primary">Submit Tweet</button>
            </div>
          ';
        }
    }

    function displayUsers()
    {
        global $user;
        $user->getAllUsers();
    }

?>
 