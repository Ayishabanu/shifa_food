<?php include('partials-front/menu.php'); ?>
<!--Get food id and set its value-->
<?php
if(isset($_GET['food_id']))
{
    $food_id=$_GET['food_id'];
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
   $res=mysqli_query($db,$sql);
   $count=mysqli_num_rows($res);
            if($count==1)
            {
              $row=mysqli_fetch_assoc($res);
              $title=$row['title'];
              $price=$row['price'];
              $image_name=$row['image_name']; 
            }
            else
            {
             header('location:'.SITEURL);
            }
}
else
{
header('location:'.SITEURL);
}
?>

   
    <section class="food-search">
        <div class="container">
             <!-- Order form -->
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> 
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Ayisha banu" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9786xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@ayisha.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
<?php
if(isset($_POST['submit']))
{
$food=$_POST['food'];
$price=$_POST['price'];
$qty=$_POST['qty'];
$total=$price * $qty;
$order_date= date("Y-m-d h:i:sa");
$status="ordered";
$customer_name=$_POST['full-name'];
$customer_contact=$_POST['contact'];
$customer_email=$_POST['email'];
$customer_address=$_POST['address'];
$sql2="INSERT INTO tbl_order SET 
food='$food',
price=$price,
qty=$qty,
total=$total,
order_date='$order_date',
status='$status',
customer_name='$customer_name',
customer_email='$customer_email',
customer_contact='$customer_contact',
customer_address='$customer_address'
";
$res2=mysqli_query($db,$sql2);
if($res2==TRUE)
{
    $_SESSION['order']="<div class='sucess text-center'>order Placed Successfully!</div>";
    //redirect to home page
     header('location:'.SITEURL);
}
else
{
    $_SESSION['order']="<div class='error text-center'>Failed to order Food!<br/>Please Try Again!</div>";
    //redirect to home page
    header('location:'.SITEURL);
}
}
?>

        </div>
    </section>

  <?php include('partials-front/footer.php'); ?>