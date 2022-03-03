<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Car</h1>
            <br><br>

            <?php
                if (isset($_SESSION['upload'])) 
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the Car">
                        </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of Car"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr> 
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                    //create PHP code to display categories
                                    //1. create sql to get all active categories from database
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";    

                                    //executing query
                                    $res = mysqli_query($conn, $sql);

                                    //count rows to check whether we have categories or not
                                    $count = mysqli_num_rows($res);

                                    //If count is greater than zero, we have rows else we dont have values
                                    if($count > 0)
                                    {
                                        //we have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the details of category
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            
                                            <?php
                                        }
                                    }
                                    else {
                                        //we dont have categories
                                        ?>
                                        <option value="0">No Categories Found</option>  
                                        <?php
                                    }        
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td>
                            <input type="submit" name="submit" value="Add Car" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php

                //check whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    //add the Car to the database
                    //echo "Clicked";

                    //1. Get the data from form
                        $title = mysqli_real_escape_string($conn, $_POST['title']);
                        $description = mysqli_real_escape_string($conn, $_POST['description']);
                        $price = mysqli_real_escape_string($conn,$_POST['price']);
                        $category = mysqli_real_escape_string($conn, $_POST['category']);

                        //check there radio button for fratured and active is clicked or not
                        if(isset($_POST['featured']))
                        {
                            $featured = $_POST['featured'];
                        }
                        else 
                        {
                            $featured = "No"; //setting default value   
                        }

                        if(isset($_POST['active']))
                        {
                            $active = $_POST['active'];
                        }
                        else 
                        {
                            $active = "No"; //setting default value   
                        }
                    //2. upload the image if selected 
                        //check whether the select image is clicked or not and upload the image only if the image is selected
                        if(isset($_FILES['image']['name']))
                        {
                            //Get the dtails of the selected image
                            $image_name = $_FILES['image']['name'];

                            //check whether the image is selected or not and upload image only if selected
                            if($image_name != "")
                            {
                                //image is selected
                                //A. rename the image
                                
                                //get the extenction of selected image (jpg, png, gif, etc)
                                $ext = end(explode('.', $image_name));
                                
                                //create new image name
                                $image_name = "Car_Name_".rand(000, 999).'.'.$ext;

                                //B. Upload the image
                                //get source path and destination path 
                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../imgs/car/".$image_name;
                                
                                //finally upload image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                 //check whether the image is uploaded or not
                                //and of the image is not uploaded thn we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                    //redirect to add car page
                                    header("location:".SITEURL."admin/add-car.php");
                                    //stop the process
                                    die();
                                }

                            }
                        }
                        else 
                        {
                            $image_name = ""; //setting default value as blank   
                        }

                    //3. Insert into database
                        //create a SQL query to save or add car
                        //for numerical value we dont need to pass value in quotes '' but for string value it is compulsory to add quotes ''
                        $sql2 = "INSERT INTO tbl_car SET
                            title = '$title',
                            description = '$description',
                            price = $price,
                            image_name = '$image_name',
                            category_id = $category,
                            featured = '$featured',
                            active = '$active'
                        ";

                        //exectute query
                        $res2 = mysqli_query($conn, $sql2);

                        //check whether data inserted or not
                        //4. redirect with message to manage car page
                        if($res2 == true)
                        {
                            //data inserted successfully
                            $_SESSION['add'] = "<div class='success'>Car Added Sucessfully.</div>";
                            //redirect
                            echo "<script>window.location.href='manage-car.php'</script>";
                        }
                        else 
                        {
                            //failed to insert data
                            $_SESSION['add'] = "<div class='error'>Failed to add Car.</div>";
                            //redirect
                            header("location:".SITEURL."admin/manage-car.php");
                        }     
                }

            ?>

        </div>
    </div>

<?php include('partials/footer.php') ?>