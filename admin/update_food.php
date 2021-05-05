<?php include('partials/menu.php');?>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
   $sql2="SELECT * FROM tbl_food WHERE id=$id";
   $res2=mysqli_query($db,$sql2);
  $count=mysqli_num_rows($res2);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
    $rows=mysqli_fetch_assoc($res2);
     $title=$rows['title'];
     $description=$rows['description'];
     $price=$rows['price'];
      $current_image=$rows['image_name'];
      $current_catagory=$rows['catagory_id'];
       $featured=$rows['featured'];
        $active=$rows['active'];
    }
    else
    {
        $_SESSION['Food_not_found']="<div class='error'>OOps! Food not found!</div>";
       header('location:'.SITEURL.'admin/manage-food.php'); 
    }
}
else
{
     header('location:'.SITEURL.'admin/manage-food.php'); 
}
 ?>

            <!-- main-content Starts Here -->
            <div class="main-content">
                <div class="wrapper">
                   <h1>Update Food</h1>
                   <br/><br/>
             <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">    
             <tr>
             <td>Title:</td>
             <td><input type="text" name="title" value="<?php echo $title?>"/></td>
             </tr>

             <tr>
             <td>Description:</td>
             <td><input type="text" name="description" value="<?php echo $description?>"/></td>
             </tr>

             <tr>
             <td>Price:</td>
             <td><input type="text" name="price" value="<?php echo $price?>"/></td>
             </tr>

             <tr>
             <td>Current Image:</td>
             <td>
             <?php
              if($current_image!="")
              {
            ?>
              <img width="150px" src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>"> 
             <?php
              }
              else
              {
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
             <td>Catagory:</td>
             <td>
             <select name="catagory">
             <?php
              $sql="SELECT * FROM tbl_catagory WHERE active='Yes'";
              $res=mysqli_query($db,$sql);
              $count=mysqli_num_rows($res);
              if($count>0)//chcek rows has value or not
             { 
              while($row=mysqli_fetch_assoc($res))
              {
                  $catagory_title=$row['title'];
                  $catagory_id=$row['id'];
                  ?>
                  <option <?php if($current_catagory==$catagory_id){echo 'selected';} ?> value="<?php echo $catagory_id; ?>" > <?php echo $catagory_title; ?> </option>
                  <?php
              }
               }
              else
              {
                 echo "<option value='0'>Catagory Not Found</option>";
               }

              ?>
             </select>
             </tr>
        
        
              <tr>
             <td>Featured:</td>
             <td>
             <input  <?php if($featured=='Yes'){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
             <input <?php if($featured=='No'){echo "checked";}?>  type="radio" name="featured" value="No">No
             </td>
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
             <input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
             </tr>

            </table>
            </form>
            
<?php

if(isset($_POST['submit']))
{
        $id=$_POST['id'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $current_image=$_POST['current_image'];
        $catagory=$_POST['catagory'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
        //checking upload button clicked or not
if(isset($_FILES['image']['name']))
    {   
        $image_name=$_FILES['image']['name'];
                //rename image which has same name
                    if($image_name!="")
                    {
                    $txt=end(explode('.',$image_name));
                    $image_name="Food_Catagory_".rand(000,999).'.'.$txt;//Food_Catagory_852.jpg
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../images/food/".$image_name;
                    $upload=move_uploaded_file($source_path, $destination_path);
                        if($upload==false)
                        {
                        $_SESSION['upload']="<div class='error'>Failed to upload file!</div>";
                        //redirect to manage-admin
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                        }
                    //remove image if current image is available
                        if($current_image!="")
                        {
                        $remove_path="../images/food/".$current_image;
                        $remove=unlink($remove_path);
                            if($remove==false)
                            {
                            $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image!</div>";
                            //redirect to manage-admin
                            header('location:'.SITEURL.'admin/manage-food.php');
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
$sql3="UPDATE  tbl_food SET
    title='$title',
    description='$description',
    price=$price,
    image_name='$image_name',
catagory_id=$catagory,
    featured='$featured',
    active='$active'
    WHERE id='$id'
    ";
$res3=mysqli_query($db,$sql3);
if($res3==true)
{
    $_SESSION['update']="<div class='sucess'>Food Updates Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    $_SESSION['update']="<div class='error'>OOps! Failed to Update Food!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/manage-food.php');
}
}
?>
</div>
</div>
<?php include('partials/footer.php');?>