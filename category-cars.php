<?php include('partials-front/menu.php'); ?>

<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id 
        $category_id = $_GET['category_id'];
        //get the category title based on category title
        $sql = "SELECT title FROM tbl_category WhERE id=$category_id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //get the value from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- Car Search Section Starts Here -->
    <section class="car-search text-center">
        <div class="container">
            
            <h2>Cars on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Car Search Section Ends Here -->

    <!-- Car Mnu Section Starts Here -->
    <section class="car-menu">
        <div class="container">
            <h2 class="text-center">Car Catelog</h2>
        
             <?php
                //create sql querry to display car based on selected category 
                $sql2 = "SELECT * FROM tbl_car  WHERE category_id=$category_id";

                //execute the querry
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check whether the category is available or not
                if($count2>0)
                {
                    //image availabe
                    //category available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        //get the values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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
                                    <p class="car-price"><?php echo $price; ?></p>
                                    <p class="car-detail"><?php echo $description; ?></p>
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

<?php include('partials-front/footer.php');?>