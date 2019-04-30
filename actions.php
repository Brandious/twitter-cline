<?php

    include("functions.php");
    require_once("classes.php");

    if($_GET['action'] == "loginSignup")
    {  
        $user = new User;
      
        $error="";


        if(!$_POST['email'])
        {
            $error = "Email is required";
        }
        else if(!$_POST['password'])
        {
            $error = "Password is required"; 
        }  
        else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) 
        {
            $error = "Invalid email format"; 
        }

        if($error != "")
        {
            echo $error;
            exit();
        }
        
        $result = $user->getUserByEmail($_POST['email']);

        if($_POST["loginActive"] == "0")
        {
           
            

            if($result)
            {
                echo "Mail is taken";
            }
            else 
            {
               $userResult = $user->insertUser($_POST['email'],$_POST['password']);

              
         
            }
           
        }
        else
        {
           
            if($result['password'] == md5(md5($result['ID']).$_POST['password']))
            {
                echo "1";
                $_SESSION['ID'] = $result['ID'];
            }
            else 
             $error = "Wrong mail or password"; 
        }
        

        if($error != "")
        {
            echo $error;
            exit();
        }
        
    
    }
 

    if($_GET['action'] == 'toggleFollow')
    {    
        
        $result = $user->followUser($_POST['userid']);
          
    }

    if($_GET['action'] == 'postTweet')
    {
        if(!$_POST ['tweetContent'])
        {
            echo "Your Tweet is empty";
        }
        else if(strlen($_POST['tweetContent'])>255)
        {
            echo "Your Tweet is too long";
        }
        else 
        {
            $tweet->insertTweet($_POST ['tweetContent']);           
        }
    }

    

?>