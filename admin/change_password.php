<?php include('partials/menu.php');?>
            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Change Password</h1>
                   <br/><br/>
<?php
    $id=$_GET['id'];    
 ?>

                    <form action="" method="POST">
            <table class="tbl-30">    
             <tr>
             <td>Current password:</td>
             <td><input type="password" name="current_password" value=""/></td>
             </tr>

             <tr>
             <td>New password:</td>
             <td><input type="password" name="new_password" value=""/></td>
             </tr>

             <tr>
             <td>Confirm password:</td>
             <td><input type="password" name="confirm_password" value=""/></td>
             </tr>

             <tr>
             <td colspan="2">
             <input type="hidden" name="id" value="<?php echo $id; ?>"/>
             <input type="submit" name="submit" value="Change Password" class="btn-secondary"/></td>
             </tr>

             </table>
                </form>
                </div>
            </div>

<?php
if(isset($_POST['submit']))
{
$id=$_POST['id'];    
$current_password=md5($_POST['current_password']);
$new_password=md5($_POST['new_password']);
$confirm_password=md5($_POST['confirm_password']);
  $sql="SELECT * FROM  tbl_admin WHERE id=$id AND password='$current_password'
    ";
$res=mysqli_query($db,$sql);
   if($res==TRUE)
 {
  $count=mysqli_num_rows($res);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
             if($new_password==$confirm_password)//chcek rows has value or not
          { 
              $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id 
             ";
             $res1=mysqli_query($db,$sql2);
                if($res1==TRUE)
                {
                 $_SESSION['pwd-changed']="<div class='sucess'>Password Changed Sucessfully!</div>";
               header('location:'.SITEURL.'admin/manage-admin.php');   
                 }
              
        }
           else
        {
          $_SESSION['pwd_not_found']="<div class='error'>OOps! Password does not match!</div>";
             header('location:'.SITEURL.'admin/manage-admin.php');
         }
    }
    else
    {
        $_SESSION['user_not_found']="<div class='error'>OOps! There is no user with current password!</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
  }
}
 ?>
<?php include('partials/footer.php');?>