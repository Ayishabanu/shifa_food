<?php include('partials/menu.php');?>
            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Update Catagory</h1>
                   <br/><br/>

<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
   $sql="SELECT * FROM tbl_catagory WHERE id=$id";
   $res=mysqli_query($db,$sql);
  $count=mysqli_num_rows($res);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
    $rows=mysqli_fetch_assoc($res);
     $title=$rows['title'];
      $current_image=$rows['image_name'];
       $featured=$rows['featured'];
        $active=$rows['active'];
    }
    else
    {
        $_SESSION['catagory_not_found']="<div class='error'>OOps! Catagory not found!</div>";
       header('location:'.SITEURL.'admin/manage-catagory.php'); 
    }
}
else{
     header('location:'.SITEURL.'admin/manage-catagory.php'); 
}
 ?>
                    <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">    
             <tr>
             <td>Title:</td>
             <td><input type="text" name="title" value="<?php echo $title?>"/></td>
             </tr>

             <tr>
             <td>Current Image:</td>
             <td>
             <?php
              if($current_image!=""){
            ?>
            <img width="150px" src="<?php echo SITEURL;?>images/catagory/<?php echo $current_image;?>"> 
             <?php
              }
              else{
                  echo "<div class='error'>Image not added</div>";
              }
              ?>
             </td>
             </tr>

             
             <tr>
             <td>New Image:</td>
             <td><input type="file" name="image"></td>
             </tr>
        
        
              <tr>
             <td>Featured:</td>
             <td>
             <input  <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
             <input <?php if($featured=="No"){echo "checked";}?>  type="radio" name="featured" value="No">No</td>
             </tr>

              <tr>
             <td>Active:</td>
             <td>
             <input  <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
             <input <?php if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No">No</td>
             </tr>

             <tr>
             <td colspan="2">
             <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
             <input type="submit" name="submit" value="Update Catagory" class="btn-secondary"></td>
             </tr>

             </table>
                </form>
<?php

if(isset($_POST['submit']))
{
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
if(isset($_FILES['image']['name']))
{   
    $image_name=$_FILES['image']['name'];
    //rename image which has same name
    if($image_name!="")
    {
    $txt=end(explode('.',$image_name));
    $image_name="Food_Catagory_".rand(000,999).'.'.$txt;//Food_Catagory_852.jpg
    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/catagory/".$image_name;
    $upload=move_uploaded_file($source_path, $destination_path);
    if($upload==false)
    {
    $_SESSION['upload']="<div class='error'>Failed to upload file!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
    die();
    }
    //remove image if current image is available
    if($current_image!="")
    {
    $remove_path="../images/catagory/".$current_image;
    $remove=unlink($remove_path);
    if($remove==false)
    {
    $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
    die();
    }
    }
   }
   else
   {
   $image_name=$current_image;
   }
}
else
{
    $image_name=$current_image;
}

//SQL query to save data inot DB
$sql2="UPDATE  tbl_catagory SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id='$id'
    ";
$res2=mysqli_query($db,$sql2);
if($res2==TRUE)
{
    $_SESSION['update']="<div class='sucess'>Catagory Updates Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
else
{
    $_SESSION['update']="<div class='error'>OOps! Failed to Update Catagory!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
}
?>
</div>
</div>

<?php include('partials/footer.php');?>