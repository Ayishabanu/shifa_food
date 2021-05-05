<?php include('partials/menu.php');?>
<!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Update Food</h1>
                   <br/><br/>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
   $sql="SELECT * FROM tbl_order WHERE id=$id";
   $res=mysqli_query($db,$sql);
  $count=mysqli_num_rows($res);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
    $rows=mysqli_fetch_assoc($res);
     $food=$rows['food'];
     $price=$rows['price'];
     $status=$rows['status'];
      $qty=$rows['qty'];
      $customer_name=$rows['customer_name'];
       $customer_email=$rows['customer_email'];
        $customer_contact=$rows['customer_contact'];
        $customer_address=$rows['customer_address'];
    }
    else
    {
        $_SESSION['Food_not_found']="<div class='error'>OOps! order not found!</div>";
       header('location:'.SITEURL.'admin/manage-order.php'); 
    }
}
else
{
     header('location:'.SITEURL.'admin/manage-order.php'); 
}
 ?>

             <form action="" method="POST">
            <table  class="tbl-30">    
             <tr>
             <td>Food Name:</td>
             <td><b><?php echo $food; ?> </b> </td>
             </tr>
           
            <tr>
             <td>Price:</td>
             <td><b>$<?php echo $price ?></b></td>
             </tr>

             <tr>
             <td>Qty:</td>
             <td><input type="number" name="qty" value="<?php echo $qty ?>"/></td>
             </tr>

             <tr>
             <td>Status:</td>
             <td>
             <select name="status">
            <option <?php if($status=="ordered") {echo "selected"; }?> value='ordered'>Ordered</option>
            <option <?php if($status=="ondelivery") {echo "selected"; }?> value='ondelivery'>On Delivery</option>";
            <option <?php if($status=="delivered") {echo "selected"; }?>  value='delivered'>Delivered</option>";
            <option <?php if($status=="cancelled") {echo "selected"; }?>  value='cancelled'>Cancelled</option>";
            </select>
             </td>
             </tr>

            <tr>
             <td>Name:</td>
             <td><input type="text" name="customer_name" value="<?php echo $customer_name ?>"/></td>
             </tr>

            <tr>
             <td>Email:</td>
             <td><input type="email" name="customer_email" value="<?php echo $customer_email ?>"/></td>
             </tr>

            <tr>
             <td>Contact:</td>
             <td><input type="text" name="customer_contact" value="<?php echo $customer_contact ?>"/></td>
             </tr>

             <tr>
             <td>Address:</td>
             <td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address ?></textarea></td>
             </tr>

              <tr>
             <td colspan="2">
              <input type="hidden" name="price" value="<?php echo $price; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
             <input type="submit" name="submit" value="Update Order" class="btn-secondary"></td>
             </tr>

               </table>
               </form>    
<?php

if(isset($_POST['submit']))
{
        $id=$_POST['id'];
        $qty=$_POST['qty'];
        $price=$_POST['price'];
          $total = $price * $qty;
        $status=$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_email=$_POST['customer_email'];
        $customer_contact=$_POST['customer_contact'];
         $customer_address=$_POST['customer_address'];
        //checking upload button clicked or not


//SQL query to save data inot DB
$sql2="UPDATE  tbl_order SET
   total= $total,
    qty=$qty,
    status='$status',
    customer_name='$customer_name',
    customer_email='$customer_email',
    customer_contact='$customer_contact',
       customer_address='$customer_address'
    WHERE id='$id'
    ";
$res2=mysqli_query($db,$sql2);
if($res2==true)
{
    $_SESSION['update']="<div class='sucess'>Order Updates Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-order.php');
}
else
{
    $_SESSION['update']="<div class='error'>OOps! Failed to Update Order!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-order.php');
}
}
?>
</div>
</div>
<?php include('partials/footer.php');?>