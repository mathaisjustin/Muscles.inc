<?php
    //include constans file
    include('../config/constants.php');

    //echo "delete page"; 
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "get value and delete";
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is avaliable
        if($image_name != "")
        {
            //image is avaliable. so remove it
            $path = "../imgs/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed ot remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                //redirect to manage category page
                header("location:".SITEURL."admin/manage-category.php");
                //stop the process
                die();
            }
        }


        //delete data from database
        //sql query to delete from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute querry
        $res = mysqli_query($conn, $sql);

        //check wheter the data is deleted from database or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Sucessfully.</div>";
            //redirect to manage category
            header("location:".SITEURL."admin/manage-category.php");
        }
        else 
        {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage category
            header("location:".SITEURL."admin/manage-category.php");
        }
        //redirect to manage category page with message
    }
    else 
    {
        //redirect to manage category page
        header("location:".SITEURL."/admin/manage-category.php");
    }
?>