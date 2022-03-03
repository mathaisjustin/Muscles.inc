<?php include('partials-front/menu.php');?>

    <!-- Car Search Section Starts Here -->
    <section class="car-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>car-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Cars.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Car Search Section Ends Here -->

    <!-- Car Menu Section Starts Here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car Catelog</h2>

            <?php
            //create sql querry to display categories that are activefrom database
                $sql = "SELECT * FROM tbl_car  WHERE active='Yes'";

                //execute the querry
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether the category is available or not
                if($count>0)
                {
                    //image availabe
                    //category available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                         <div class="car-menu-box">
                                <div class="car-menu-img">
                                    <?php
                                        //check whether image available or not
                                        if($image_name=="")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image Not Avaliable.</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>imgs/car/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="car-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="car-price">$<?php echo $price; ?></p>
                                    <p class="car-detail">
                                       <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?car_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //image not available
                    echo "<div class='error'>Car Not Found.</div>";
                }        
            ?>
            
            <div class="clearfix"></div>
        </div> 
    </section> 
    <!-- Car Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>