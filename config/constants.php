<?php
    //start session
    session_start();

    //create constants to store non repeatitive values
    define('SITEURL', 'https://localhost/Muscles.inc/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'muscles.inc');

    //database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    //selecting database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

?>