<?php include('partials-front/menu.php') ?>  
    
    <!-- car search starts here -->
    <section class="car-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>car-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Car..." required>
                <input type="submit" name="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- car search ends here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- categories starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Cars</h2>
            <br>

            <?php
                //create sql querry to display categories from database
                $sql = "SELECT * FROM tbl_category  WHERE active='Yes' AND featured='Yes' LIMIT 3";

                //execute the querry
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check category is available or not
                if($count>0)
                {
                    //categories available
                    while ($row=mysqli_fetch_assoc($res)) 
                    {
                        //get values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-cars.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                //check whether image is available or not
                                if($image_name=="")
                                {
                                    //display error message
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                        <img src="<?php echo SITEURL; ?>imgs/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                                ?>
                        </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Category Not Added.</div>";
                }                        
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories ends here -->

    <!-- car menu starts here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car Catelog</h2>
            <br>
               <?php
                //getting cars from database that are active and featured
                $sql2 = "SELECT * FROM tbl_car WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check whether food available or not
                if($count2>0)
                {
                    //car available
                    while($row = mysqli_fetch_assoc($res2))
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
                                        //check whether the image is available or not
                                        if($image_name=="")
                                        {
                                            //display error message
                                            echo "<div class='error'>Image Not Available.</div>";
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

                                <div class="clearfix"></div>
                            </div>
                        <?php
                    }
                }
                else
                {
                  //car not available
                   echo "<div class='error'>Car Not Avaliable.</div>";  
                }
            ?>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="cars.php">See All Cars...</a>
        </p>
    </section> 
    <!-- car menu ends here -->

    <!-- brands starts here -->
    <section class="brands text-center">
        <div class="container">
            <h1 class="text-center">Our Brands</h1>
            <br>
            <br>
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/ios-filled/50/000000/bmw.png" /></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/ios/50/000000/trotting-horse.png" /></a>
                </li>
                <li>
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="70" height="61" viewBox="0 0 172 172"
                        style=" fill:#000000;">
                        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
                            stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                            font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                            <path d="M0,172v-172h172v172z" fill="none"></path>
                            <g fill="#000000">
                                <path
                                    d="M82.41667,39.41667h35.83333l-82.41667,93.16667h-35.83333zM136.16667,39.41667h35.83333l-82.41667,93.16667h-35.83333z">
                                </path>
                            </g>
                        </g>
                    </svg></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/carbon-copy/65/000000/chevrolet.png" /></a>
                </li>
            </ul>
        </div>
        <br><br>
    </section>
    <!-- brands ends here -->
   
<?php include('partials-front/footer.php') ?>    