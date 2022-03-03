<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Car</h1>
        <br>
            <br>
               <!-- button to add Car -->
            <a href="<?php echo SITEURL; ?>admin/add-car.php" class="btn-primary">Add Car</a>
            <br>
            <br>
            <br>

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                } 
                
                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                } 
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

            ?>

    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        
        <?php
            //create sql query to get all the car 
            $sql ="SELECT * FROM tbl_car ";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //create serial number variable and assign value as 1
            $sn = 1;
            
            //check whether the data is ther in database
            if($count > 0)
            {
                //we have data in database
                //display the data
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php 
                                //check whether the image is avalable or not
                                if($image_name!=="")
                                {
                                    //display the image
                                    ?>

                                    <img src="<?php echo SITEURL;?>imgs/car/<?php echo $image_name;?>" width="100px">

                                    <?php
                                }
                                else {
                                    //display the message
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-car.php?id=<?php echo $id; ?>" class="btn-secondary">Update Car</a>
                            <a href="<?php echo SITEURL;?>admin/delete-car.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Car</a>
                        </td>
                    </tr>

                    <?php
                }
            }    
            else 
            {
                //we dont have data
                echo "<tr><td colspan='7' class='error'> Car Not Added Yet. </td></tr>";
                
            }
        ?>
    </table>
    </div>
</div>

<?php include('partials/footer.php') ?>