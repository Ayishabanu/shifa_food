<?php include('partials/menu.php');?>
<div class="main-content">
            <div class="wrapper">
              <h1>Manage Food</h1>
              <br/><br/><br/>
                 <!--Button to add admin-->
                 <a href="../admin/add_food.php" class="btn-primary">Add Food</a>
                 <br/><br/><br/>
                 <?php
                 if(isset($_SESSION['add']))
                 {echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//disappear session message
                 }
                 if(isset($_SESSION['delete']))
                 {echo $_SESSION['delete'];//display session message
                 unset($_SESSION['delete']);//disappear session message
                 }
                 if(isset($_SESSION['remove']))
                 {echo $_SESSION['remove'];//display session message
                 unset($_SESSION['remove']);//disappear session message
                 }
                  if(isset($_SESSION['unautorize']))
                 {echo $_SESSION['unautorize'];//display session message
                 unset($_SESSION['unautorize']);//disappear session message
                 }
                  if(isset($_SESSION['update']))
                 {echo $_SESSION['update'];//display session message
                 unset($_SESSION['update']);//disappear session message
                 }
                 ?>
            <table class="tbl-full">
             <tr>
             <th>S.No</th>
             <th>Title</th>
             <th>Price</th>
             <th>Image</th>
             <th>Featured</th>
             <th>Active</th>
            <th>Actions</th>
             </tr>
              <?php
                 $sql="SELECT * FROM tbl_food";
                 $res=mysqli_query($db,$sql);
                 if($res==TRUE)//chcek query executed or not
                 {
                     $count=mysqli_num_rows($res);//get all rows in DB
                     $sn=1;
                    if($count>0)//chcek rows has value or not
                    { 
                      while($rows=mysqli_fetch_assoc($res))
                    {//get individual data
                       $id=$rows['id'];
                       $title=$rows['title'];
                       $price=$rows['price'];
                       $image_name=$rows['image_name'];
                       $featured=$rows['featured'];
                       $active=$rows['active'];
                        ?>
             <tr>
             <td><?php echo $sn++;?> </td>
            <td><?php echo $title;?>  </td>
             <td><?php echo $price;?>  </td>
                       <td>
                         <?php 
                         if($image_name!="")
                         {
                           ?>
                           <img width="100px" src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>">
                           <?php
                         }
                         else{
                             echo "<div class='error'>Image does not exists!</div>";
                         }

                         ?> 
                         </td>
             <td><?php echo $featured;?> </td>
            <td><?php echo $active;?> </td>
             <td> 
             <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>" class="btn-secondary">Update Food</a>
             <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
             </td>
             </tr>

                <?php
                    }
                    }
                    else
                    {
                        ?>
                        <tr>
                        <td colspan="2"><div class="error">No Food Added</div></td>
                        </tr>
                        <?php
                    }
                 }
                 ?>

             </table>
           
            </div>
</div>
<?php include('partials/footer.php');?>