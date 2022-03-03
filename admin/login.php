<?php include('../config/constants.php')?>

<html>
    <head>
        <title>Login - Car Order System</title>
        <link rel="stylesheet" href="../CSS/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>    

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br>  
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
                Username: <br><br>
                <input type="text" name="username" placeholder="Enter Username" required> <br> <br>
                Password: <br><br>
                <input type="password" name="password" placeholder="Enter Password" required> <br> <br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- login form ends here -->

            <p class="text-center">Created by  - <a href="../about-us.php">Muscles.inc</a></p>
        </div>
    </body>
</html>

<?php

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1. get data from login form
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        //$password = md5($_POST['password']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);


        //2. sql to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. execute the query
        $res = mysqli_query($conn, $sql); 

        //4. cound rows to check whether the user exisist or not
        $count = mysqli_num_rows($res);

       if($count==1)
       {
            //user available and login success
            $_SESSION['login'] = " <div class='success text-center'>Login Successfull</div>";
            //redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
       }
       else 
       {
           //user not available and login failed
            $_SESSION['login'] = " <div class='error text-center'>Username or Password did not match</div>";
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
       } 

    }
?>