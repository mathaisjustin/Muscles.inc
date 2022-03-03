<?php include('partials/menu.php'); ?>

<?php
    //check whether id is set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id = $_GET['id'];
        // sql query to get the selected car
        $sql2 = "SELECT * FROM tbl_car WHERE id=$id";
        //execute query
        $res2 = mysqli_query($conn, $sql2);
        //get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);
        //get the individual values of selected fcar
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else 
    {
        //redirect to manage car
        header('location:'.SITEURL.'admin/manage-car.php');
    }

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Car</h1>
        <br><br>
        
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                     <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
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
                                    <img src="<?php echo SITEURL; ?>imgs/car/<?php echo $current_image;?>"width="100px">
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
                        <td>Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                    //querry to get active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                    //execute querry
                                    $res = mysqli_query($conn, $sql);
                                    //count rows
                                    $count = mysqli_num_rows($res);

                                    //check whether category available or not
                                    if($count>0)
                                    {
                                        //category availble
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                            //echo "<option value='$category_id'>$category_title</option>";
                                            ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php
                                        }
                                    }
                                    else 
                                    {
                                        //category not available
                                        echo "<option value='0'>Category Not Avaliable.</option>";    
                                    }
                                ?>
                            </select>
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
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Update Car" class="btn-secondary">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        </td>
                    </tr>
                </table>
            </form>
           
            <?php
                if(isset($_POST['submit']))
                {
                    //echo "clicked";
                    //1. get all the values from our form
                    $id = mysqli_real_escape_string($conn,$_POST['id']);
                    $title = mysqli_real_escape_string($conn,$_POST['title']);
                    $description = mysqli_real_escape_string($conn,$_POST['description']);
                    $price = mysqli_real_escape_string($conn,$_POST['price']);
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

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
                            //get the extension of the imgage(jpg, png, gif, etc e.g."fo car1.jpg"
                            $ext = end(explode('.', $image_name));

                            //rename the image
                            $image_name = "Car_Name_".rand(000, 999).'.'.$ext;
                            //source path
                            $source_path = $_FILES['image']['tmp_name'];
                            //destination path
                            $destination_path = "../imgs/car/".$image_name;

                            //finally uplaod the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check whether the image is uploaded or not
                            //and of the image is not uploaded thn we will stop the process and redirect with error message
                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                //redirect to add category page
                                header("location:".SITEURL."admin/manage-car.php");
                                //stop the process
                                die();
                            }

                            //B. remove the current image if available
                            if($current_image!="")
                            {
                                $remove_path = "../imgs/car/".$current_image;

                                $remove = unlink($remove_path);

                                // check whether the image is removed or not
                                // if faled to remove then display message and stop the process
                                if($remove==false)
                                {
                                    // fales to remove the image
                                    $_SESSION['failed-remove'] ="<div class='error'>Failed to Remove Current Image.</div>";
                                    // redirect
                                    header("location:".SITEURL."admin/manage-car.php");
                                    // stop the process
                                    die();
                                }
                            }
                            else
                            {
                                $image_name = $current_image;
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
                    $sql3 = "UPDATE tbl_car SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";

                    //execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    // redirect to manage category with message
                    //check whether executed or not
                    if($res3==true)
                    {
                        //category updated
                        $_SESSION['update'] = "<div class='success'>Car Updated Sucessfully</div>";
                        //redirect
                        // echo "Success";
                        // header('location:'.SITEURL.'admin/manage-fcar.php');
                        echo "<script>window.location.href='manage-car.php'</script>";
                    }
                    else {
                        // failed to update query
                        $_SESSION['update'] = "<div class='error'>Failed to Update Car. </div>";
                        //redirect
                        //echo "Failed";
                        header('location:'.SITEURL.'admin/manage-car.php');
                    }
                }
            ?>
        </div>
</div>

<?php include('partials/footer.php'); ?>