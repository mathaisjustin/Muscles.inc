<?php
//include constants.php here
    include('../config/constants.php');

    //1. get the id of admin to be deleted
    $id = $_GET['id'];
    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed sucessfully or not
    if($res==TRUE)
    {
        //query executed sucessfully and admin deleted
        //echo "Admin Delete";
        //create session variable to display message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted sucessfully</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        //faled to delete admin
        //echo "Failed to Delete Admin";
        //create session variable to display message 
        $_SESSION['delete'] = "<div class= 'error'>Admin Deleted unsucessfully</div>";
        //redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3.redirect to manage admin page with message(sucess/error)

?>