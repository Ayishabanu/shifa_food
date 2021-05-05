<?php
include('partials/config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        if($image_name!="")
        {
          $path="../images/food/".$image_name;
           $remove=unlink($path);
            if($remove==false)
            {
                  $_SESSION['remove']="<div class='error'>failed to  delete food Image!</div>";
                   header('location:'.SITEURL.'admin/manage-food.php');
                  die();
            }
        }
$sql="DELETE FROM tbl_food WHERE id=$id";
$res=mysqli_query($db,$sql);
if($res==true)
{
    $_SESSION['delete']="<div class='sucess'>food deleted Successfully!</div>";
    //redirect to manage-food
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    $_SESSION['delete']="<div class='error'>Failed to delete food!</div>";
    
    header('location:'.SITEURL.'admin/delete_food.php');
}


}
else
{
    $_SESSION['unauthorize']="<div class='error'>You are not allowed to access this page!</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>