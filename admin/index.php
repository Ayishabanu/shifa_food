<?php include('partials/menu.php');?>
        <!-- main-content Starts Here -->
        <div class="main-content">
            <div class="wrapper">
               <h1>DASHBOARD</h1>
               <br/><br/>
               <?php if(isset($_SESSION['login']))
                 {echo $_SESSION['login'];//display session message
                 unset($_SESSION['login']);//disappear session message
                 }
               ?>
               <br/><br/>
               <div class="col-4 text-center">
<?php
$sql="SELECT * FROM tbl_catagory";
$res=mysqli_query($db,$sql);
$count=mysqli_num_rows($res);
  ?>
            <h1><?php echo $count; ?></h1>
            <br/>Catagories
               </div>
        
               <div class="col-4 text-center">
<?php
$sql1="SELECT * FROM tbl_food";
$res1=mysqli_query($db,$sql1);
$count1=mysqli_num_rows($res1);
  ?>
            <h1><?php echo $count1; ?></h1>
               <br/>Foods
            </div>

            <div class="col-4 text-center">
<?php
$sql2="SELECT * FROM tbl_order";
$res2=mysqli_query($db,$sql2);
$count2=mysqli_num_rows($res2);
  ?>
            <h1><?php echo $count2; ?></h1>
            <br/>Orders
            </div>

            <div class="col-4 text-center">
<?php
$sql4="SELECT SUM(total) AS Total FROM tbl_order";
$res4=mysqli_query($db,$sql4);
$row4=mysqli_fetch_assoc($res4);
$Total_revenue=$row4['Total'];
?>
           <h1>$<?php echo $Total_revenue; ?></h1>
            <br/>Revenue
                        </div>
<div class="clearfix"></div>
            </div>
        </div>
<?php include('partials/footer.php');?>