
<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Food Catagories</h2>

<?php
   $sql="SELECT * FROM tbl_catagory WHERE active='Yes'";
   $res=mysqli_query($db,$sql);
   $count=mysqli_num_rows($res);
   if($count>0)//chcek rows has value or not
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
                         else
                         {
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
         echo "<div class='error'>Catagory Not Found!</div>";
          }          
?>
         <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php include('partials-front/footer.php'); ?>