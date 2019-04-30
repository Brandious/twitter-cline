<?php

    include("functions.php");

    require_once("classes.php");
    include("views/header.php");
    include("styles.css");
    
    if($_GET['page'] == 'timeline')
        include("views/timeline.php");
    else if($_GET['page'] == 'yourtweets')
        include("views/yourtweets.php");
    else if($_GET['page'] == 'search')
        include("views/search.php");
    else if($_GET['page'] == 'profile')
        include("views/profiles.php");
    else 
        include("views/home.php");

       
    include("views/footer.php");


     

?>