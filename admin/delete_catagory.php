   <?php
include('partials/config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        if($image_name!="")
        {
            $path="../images/catagory/".$image_name;
            $remove=unlink($path);
            if($remove==false)
            {
                  $_SESSION['remove']="<div class='error'>failed to  remove catagory image!</div>";
                   header('location:'.SITEURL.'admin/manage-catagory.php');
                  die();
            }
        }
   $sql="DELETE FROM tbl_catagory WHERE id=$id";
   $res=mysqli_query($db,$sql);
   if($res==TRUE)
{
    $_SESSION['delete']="<div class='sucess'>catagory deleted Successfully!</div>";
    //redirect to manage-catagory
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
else
{
    $_SESSION['delete']="<div class='error'>Failed to delete Catagory!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
}
    else
{
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
 ?>