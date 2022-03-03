<?php include('partials-front/menu.php'); ?>

    <!-- car search section starts here -->
    <section class="car-search text-center">
        <div class="container">
            <?php
                //get the search keyword
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Cars on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>
        </div>
    </section>
    <!-- car search section ends here -->

    <!-- car menu Section Starts Here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car Catelog</h2>
    
            <?php
                //get the search keyword
                $search = $_POST['search'];

                //sql qurry to get car based on search keyword
                $sql = "SELECT * FROM tbl_car WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //executing the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether the car avalable or not
                if($count>0)
                {
                    //car availabe
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="car-menu-box">
                                <div class="car-menu-img">
                                    <?php
                                        //check whether image is avalable or not
                                        if($image_name=="")
                                        {
                                            //display error message
                                            echo "<div class='error'>Image Not Available.</div>";
                                        }
                                        else
                                        {
                                            //image avaliable
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
                                        <?php echo $description ?>
                                    </p>
                                    <br>

                                    <a href="order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //car not availabe
                    echo "<div class='error'>Car Not Found.</div>";
                }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- car menu section ends here -->

<?php include('partials-front/footer.php'); ?>