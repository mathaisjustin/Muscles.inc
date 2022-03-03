<?php include('partials/menu.php'); ?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <?php
            
                //check whether the id is set or not
                if(isset($_GET['id']))
                {
                    //get the id and all other detail
                    //echo "getting the data";
                    $id = $_GET['id'];

                    // create sql query to get all other datails
                    $sql = "SELECT * FROM tbl_category where id=$id";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the rows to check  whether the id is valid or not
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        // get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else {
                        // redirect to manage category page
                        $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                        // redirect
                        header("location:".SITEURL."admin/manage-category.php");
                    }
                }
                else 
                {
                    //redirect to manage category
                    header("location:".SITEURL."admin/manage-category.php");
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php  echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php 
                                if($current_image != "")
                                {
                                    //display the image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>imgs/category/<?php echo $current_image;?>"width="150px">
                                    <?php
                                }
                                else {
                                    // display message
                                    echo "<div class='error'>Image Not Added.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                     <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr >
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php

                if(isset($_POST['submit']))
                {
                    //echo "clicked";
                    //1. get all the values from our form
                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                    $active = mysqli_real_escape_string($conn, $_POST['active']);

                    // 2. updating new image if selected
                    // check whether the selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        // get the image details
                        $image_name = $_FILES['image']['name'];
                        
                        // check whether theimage is available or not
                        if($image_name != "")
                        {
                            // image available

                            //A. upload the new image

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
                                header("location:".SITEURL."admin/manage-category.php");
                                //stop the process
                                die();
                            }

                            //B. remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path = "../imgs/category/".$current_image;

                                $remove = unlink($remove_path);

                                // check whether the image is removed or not
                                // if faled to remove then display message and stop the process
                                if($remove==false)
                                {
                                    // fales to remove the image
                                    $_SESSION['failed-remove'] ="<div class='error'>Failed to Remove Current Image.</div>";
                                    // redirect
                                    header("location:".SITEURL."admin/manage-category.php");
                                    // stop the process
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }

                    }
                    else {
                        $image_name = $current_image;
                    }
                    
                    // 3.update the database
                    $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // redirect to manage category with message
                    //check whether executed or not
                    if($res2==true)
                    {
                        //category updated
                        $_SESSION['update'] = "<div class='success'>Category Updated Sucessfully</div>";
                        //redirect
                        header('location:'.SITEURL.'admin/manage-category.php');
                        
                    }
                    else {
                        // failed to update query
                         $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                        //redirect
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>