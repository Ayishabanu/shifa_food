<?php include('partials/menu.php');?>
            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Update Admin</h1>
                   <br/><br/>
<?php
    $id=$_GET['id'];    
   $sql="SELECT * FROM tbl_admin WHERE id=$id";
   $res=mysqli_query($db,$sql);
   if($res==TRUE)
{
  $count=mysqli_num_rows($res);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
    $rows=mysqli_fetch_assoc($res);
     $full_name=$rows['full_name'];
      $username=$rows['username'];
    }
    else
    {
       header('location:'.SITEURL.'admin/manage-admin.php'); 
    }
                     //display va
}
 ?>

                    <form action="" method="POST">
            <table class="tbl-30">    
             <tr>
             <td>Full name:</td>
             <td><input type="text" name="fullname" value="<?php echo $full_name?>"/></td>
             </tr>

             <tr>
             <td>User name:</td>
             <td><input type="text" name="username" value="<?php echo $username ?>" /></td>
             </tr>

             <tr>
             <td colspan="2">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
             <input type="submit" name="submit" value="Update Admin" class="btn-secondary"/></td>
             </tr>

             </table>
                </form>
                </div>
            </div>

<?php
if(isset($_POST['submit']))
{
$id=$_POST['id'];
$full_name=$_POST['fullname'];
$username=$_POST['username'];
//SQL query to save data inot DB
$sql="UPDATE  tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
$res=mysqli_query($db,$sql) or die (mysqli_error());
if($res==TRUE)
{
    $_SESSION['update']="<div class='sucess'>Admin Updates Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['update']="<div class='error'>OOps! Failed to Update!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
}
?>
<?php include('partials/footer.php');?>