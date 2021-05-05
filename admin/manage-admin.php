
 <?php include('partials/menu.php');?>
            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Manage Admin</h1>
                  <br/><br/>
                <?php
                 if(isset($_SESSION['add']))
                 {echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//disappear session message
                 }
                 if(isset($_SESSION['delete']))
                 {echo $_SESSION['delete'];//display session message
                 unset($_SESSION['delete']);//disappear session message
                 }
                 if(isset($_SESSION['update']))
                 {echo $_SESSION['update'];//display session message
                 unset($_SESSION['update']);//disappear session message
                 }
                 if(isset($_SESSION['user_not_found']))
                 {echo $_SESSION['user_not_found'];//display session message
                 unset($_SESSION['user_not_found']);//disappear session message
                 }
                  if(isset($_SESSION['pwd_not_found']))
                 {echo $_SESSION['pwd_not_found'];//display session message
                 unset($_SESSION['pwd_not_found']);//disappear session message
                 }
                 if(isset($_SESSION['pwd-changed']))
                 {echo $_SESSION['pwd-changed'];//display session message
                 unset($_SESSION['pwd-changed']);//disappear session message
                 }
                 ?>
 <br/><br/><br/>
                 <!--Button to add admin-->
                 <a href="add_admin.php" class="btn-primary">Add Admin</a>
                 <br/><br/><br/>
            <table class="tbl-full">
             <tr>
             <th>S.No</th>
             <th>Full Nmae</th>
             <th>Username</th>
             <th>Actions</th>
             </tr>
              <?php
                 $sql="SELECT * FROM tbl_admin";
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
                       $full_name=$rows['full_name'];
                       $username=$rows['username'];
                     //display values in table
                     ?>
                     <tr>
                         <td><?php echo $sn++;?> </td>
                         <td><?php echo $full_name;?>  </td>
                         <td><?php echo $username;?> </td>
                        <td> 
                        <a href="<?php echo SITEURL; ?>admin/change_password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                         <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                     <?php
                    }
                    }
                    else
                    {
                        echo"fail";
                    }
                 }
                 ?>
             </table>
            </div>
            </div>
<?php include('partials/footer.php');?>