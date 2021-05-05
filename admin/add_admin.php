<?php include('partials/menu.php');?>
            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Add Admin</h1>
                   <br/><br/>
                   <?php
                 if(isset($_SESSION['add']))
                 {echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//disappear session message
                 }
                 ?>
                 <br/><br/>
                <form action="" method="POST">
            <table class="tbl-30">    
             <tr>
             <td>Full name:</td>
             <td><input type="text" name="fullname" placeholder="Enter Your Name"/></td>
             </tr>

             <tr>
             <td>User name:</td>
             <td><input type="text" name="username" placeholder="Enter Your User Name"/></td>
             </tr>

             <tr>
             <td>Password</td>
             <td><input type="password" name="password" placeholder="Enter Your Password"/></td>
             </tr>

             <tr>
             <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"/></td>
             </tr>

             </table>
                </form>


            </div>
            </div>

<?php include('partials/footer.php');?>
<?php
if(isset($_POST['submit']))
{
$full_name=$_POST['fullname'];
$username=$_POST['username'];
$password=md5($_POST['password']);
//SQL query to save data inot DB
$sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
$res=mysqli_query($db,$sql) or die (mysqli_error());
if($res==TRUE)
{
    $_SESSION['add']="<div class='sucess'>Admin added Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['add']="<div class='error'>Admin not added!<br/>Please try Again!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/add_admin.php');
}
}
?>