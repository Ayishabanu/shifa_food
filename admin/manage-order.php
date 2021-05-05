<?php include('partials/menu.php');?>
<div class="main-content">
            <div class="wrapper">
               <h1>Manage Order</h1>
               <br/><br/>
               <?php
               if(isset($_SESSION['update'])){
                   echo $_SESSION['update'];
                   unset($_SESSION['update']);
               }
               ?>
               <br/><br/>
            <table class="tbl-full">
             <tr>
             <th>S.No</th>
             <th>Food</th>
             <th>Price</th>
             <th>Qty</th>
             <th>Total</th>
             <th>Order Date</th>
             <th>Status</th>
             <th>Customer Name</th>
             <th>Email</th>
             <th>Contact</th>
             <th>Address</th>
             <th>Actions</th>
             </tr>
             <hr/>
<?php
$sql="SELECT * FROM tbl_order ORDER BY id DESC";
$res=mysqli_query($db,$sql);
if($res==TRUE)//chcek query executed or not
{
    $count=mysqli_num_rows($res);//get all rows in DB
    $sn=1;
if($count>0)//chcek rows has value or not
{ 
    while($rows=mysqli_fetch_assoc($res))
{
    $id=$rows['id'];
    $food=$rows['food'];
    $price=$rows['price'];
    $qty=$rows['qty'];
    $total=$rows['total'];
     $order_date=$rows['order_date'];
    $status=$rows['status'];
    $customer_name=$rows['customer_name'];
    $customer_email=$rows['customer_email'];
    $customer_contact=$rows['customer_contact'];
    $customer_address=$rows['customer_address'];
     ?>
             <tr>
             <td><?php echo $sn++; ?></td>
             <td><?php echo $food; ?></td>
             <td><?php echo $price; ?></td>
              <td><?php echo $qty; ?></td>
             <td><?php echo $total; ?></td>
              <td><?php echo $order_date; ?></td>
             <td>
             <?php 
            if($status=="ordered"){echo "<label>$status</label>"; }
            elseif($status=="ondelivery"){echo "<label style='color:orange;'>$status</label>"; }
             elseif($status=="delivered"){echo "<label style='color:green;'>$status</label>"; }
              elseif($status=="cancelled"){echo "<label style='color:red;'>$status</label>"; }
             
             ?>
             </td>
              <td><?php echo $customer_name; ?></td>
             <td><?php echo $customer_email; ?></td>
              <td><?php echo $customer_contact; ?></td>
               <td><?php echo $customer_address; ?></td>
             <td> 
               <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
             </td>
             </tr>
    
    <?php
}
}
else
{
    echo  "<tr><td colspan='12'><div class='error'>No Order!</div></td></tr>";
}
}

?>
            

            
             </table>
           
            </div>
</div>
<?php include('partials/footer.php');?>