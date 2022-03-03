<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category </h1>
            <br><br>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                  if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <br><br>
            <!-- add category form-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="yes"> Yes
                            <input type="radio" name="featured" value="no"> No
                        </td>
                    </tr>
                     <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="yes"> Yes
                            <input type="radio" name="active" value="no"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Cateory" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- add catagory form-->

        <?php
        
        //1. check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "clicked";
            //1. get the value from category form
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            
            //for radio input, we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                //get the value from form
                $featured = $_POST['featured'];
            }
            else 
            {
                //set the default value
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active']; 
            }
            else
            {
                $active = "No";
            }
            //check whether image is selected or not and set the value for image name accordingly
            //print_r($_FILES['image']);

            //die(); //break the code here

            if(isset($_FILES['image']['name']))
            {
                //upload the immage
                //to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload image onnly if image is selected
                if($image_name != "")
                {

                    //autorename uploaded image
                    //get the extension of the imgage(jpg, png, gif, etc e.g."car1.jpg"
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Car_Category_".rand(000, 999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../imgs/category/".$image_name;

                    //finally uplaod the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    //and of the image is not uploaded thn we will stop the process and redirect with error message
                    if($upload==false)
                    {
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        //redirect to add category page
                        header("location:".SITEURL."admin/add-category.php");
                        //stop the process
                        die();
                    }

                }
            }
            else 
            {
                //dont upload image and set the image name value as blank
                $image_name = "";
            }

            //2. create SQL query to insert category into database
            $sql = "INSERT INTO tbl_category SET
                title ='$title',
                image_name = '$image_name',
                featured ='$featured',
                active ='$active'
            ";

            //3. execute the query and save in database
            $res = mysqli_query($conn, $sql);

            //4. check whether the query executed or not and data added or not
            if($res==true)
            {
                //query executed and category inserted
                $_SESSION['add'] = "<div class='success'>Category Sucessfully Added.</div>";
                //redirect to manage catory page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else 
            {
                //failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add Category.</div>";
                //redirect to manage catory page
                header('location:'.SITEURL.'admin/add-category.php');
            }
        }
        
        ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>