<?php
    //include constans file
    include('../config/constants.php');

    //echo "delete page"; 
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get the value and delete
        // echo "get value and delete";

        //1.get id and image name
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is avaliable
        if($image_name != "")
        {
            //getthe image path
            $path = "../imgs/car/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed ot remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session message
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Car Image</div>";
                //redirect to manage Car page
                header("location:".SITEURL."admin/manage-car.php");
                //stop the process
                die();
            }
        }


        //delete data from database
        //sql query to delete from database
        $sql = "DELETE FROM tbl_car WHERE id=$id";

        //execute querry
        $res = mysqli_query($conn, $sql);

        //check wheter the data is deleted from database or not
        //redirect to manage Car page with message
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Car Deleted Sucessfully.</div>";
            //redirect to manage Car
            header("location:".SITEURL."admin/manage-car.php");
        }
        else 
        {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Car.</div>";
            //redirect to manage car
            header("location:".SITEURL."admin/manage-car.php");
        }
    }
    else 
    {
        //redirect to manage Car page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header("location:".SITEURL."/admin/manage-car.php");
    }
?>