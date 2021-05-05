<?php include('partials-front/menu.php'); ?>

    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>

    <!--Order Message Displayed here -->
<?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
<?php
   $sql="SELECT * FROM tbl_catagory WHERE active='Yes' AND featured='Yes' LIMIT 3";
   $res=mysqli_query($db,$sql);
   $count=mysqli_num_rows($res);
   if($count>0)//check rows has value or not
   { 
                    while($rows=mysqli_fetch_assoc($res))
                    {//get individual data
                       $id=$rows['id'];
                       $title=$rows['title'];
                       $image_name=$rows['image_name']; 
                     ?>
                      <a href="<?php echo SITEURL;?>category-foods.php?catagory_id=<?php echo $id;?>">
                <div class="box-3 float-container">
                <?php
                 if($image_name!="")
                         {
                           ?>
                          <img src="<?php echo SITEURL; ?>images/catagory/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                           <?php
                         }
                         else{
                             echo "<div class='error'>Image does not exists!</div>";
                         }
                ?>
               
                 <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
                    <?php 
                    
                    }
   }
    else{
         echo "<div class='error'>Image does not exists!</div>";
          }          
?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
<?php
   $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
   $res2=mysqli_query($db,$sql2);
   $count2=mysqli_num_rows($res2);
   if($count2>0)//check rows has value or not
   { 
                    while($row1=mysqli_fetch_assoc($res2))
                    {//get individual data
                       $id=$row1['id'];
                       $title=$row1['title'];
                       $description=$row1['description'];
                       $price=$row1['price'];
                       $image_name=$row1['image_name']; 
                     ?>
                <div class="food-menu-box">
                <div class="food-menu-img">
                     <?php
                        if($image_name!="")
                         {
                           ?><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve"><?php
                         }
                         else
                         {
                             echo "<div class='error'>Image does not exists!</div>";
                         }
                     ?>
                </div>

                   <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail"><?php echo $description; ?></p>
                    <br>
                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                    </div>
                 </div>
       <?php 
                    
     }
   }
    else
    {
         echo "<div class='error'>Food Not Available!</div>";
    }          
?>     
        <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>
   