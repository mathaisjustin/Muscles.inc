<?php include('partials-front/menu.php');?>

<!-- categories section starts here -->
  <section class="categories">
    <div class="container">
        <h2 class="text-center">Explore our Various Exotic and Powerful Cars</h2>
        <br><br>
        <?php
          //create sql querry to display categories that are activefrom database
          $sql = "SELECT * FROM tbl_category  WHERE active='Yes'";

          //execute the querry
          $res = mysqli_query($conn, $sql);

          //count rows
          $count = mysqli_num_rows($res);

          //check whether the category is available or not
          if($count>0)
          {
            //category available
            while($row = mysqli_fetch_assoc($res))
            {
              //get the values
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
            //category not available
            echo "<div class='error'>Category Not Found.</div>";
          }
        ?>
      <div class="clearfix"></div>
    </div>
  </section>
<!-- categories section ends here -->

<?php include('partials-front/footer.php'); ?>