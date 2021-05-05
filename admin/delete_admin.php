 <?php
 include('partials/config/constants.php');
    $id=$_GET['id'];    
   $sql="DELETE FROM tbl_admin WHERE id=$id";
   $res=mysqli_query($db,$sql);
   if($res==TRUE)
{
    $_SESSION['delete']="<div class='sucess'>Admin deleted Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['delete']="<div class='error'>Failed to delete Admin!<br/>Please try again!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
 ?>