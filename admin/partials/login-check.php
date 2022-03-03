<?php

    if(isset($_SESSION['last_active_time']))
    {
        //to check whwter thr user is active or not
        if(time() - $_SESSION['last_active_time']>300)
        {
            header('location:'.SITEURL.'admin/logout.php');
            die();
        }
    }
    //to get the timestanp of the user when logging in
    $_SESSION['last_active_time'] = time(); 
    //authorization - access control
    //check wheter the user is logged in or not
    if(!isset($_SESSION['user'])) //if userr session is nto set
    {
        //user not logged in 
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin pannel</div>";
        //redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }    


    
?>