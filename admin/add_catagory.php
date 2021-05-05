<?php
include('partials/menu.php');
?>
<div class="main-content">
                <div class="wrapper">
                   <h1>Add Catagory</h1>
                  <br/><br/>
                  <?php
                  if(isset($_SESSION['add']))
                 {echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//disappear session message
                 }
                 if(isset($_SESSION['upload']))
                 {echo $_SESSION['upload'];//display session message
                 unset($_SESSION['upload']);//disappear session message
                 }
                  ?>
                  <br/><br/>
                 
                <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">    
             <tr>
             <td>Title:</td>
             <td><input type="text" name="title" placeholder="Enter the Title"/></td>
             </tr>

             <tr>
             <td>Image:</td>
             <td><input type="file" name="image"/></td>
             </tr>

             <tr>
             <td>Featured:</td>
             <td><input type="radio" name="featured" value="Yes">Yes</input>
                 <input type="radio" name="featured" value="No">No</input>
             </td>
             </tr>

             <tr>
             <td>Active</td>
             <td><input type="radio" name="active" value="Yes">Yes</input>
                 <input type="radio" name="active" value="No">No</input>
            </td>
             </tr>

             <tr>
             <td colspan="2"><input type="submit" name="submit" value="Add Catagory" class="btn-secondary"/></td>
             </tr>

             </table>
                </form>
                  
</div>
</div>
<?php
if(isset($_POST['submit']))
{
$title=$_POST['title'];
if(isset($_POST['featured']))
{
  $featured=$_POST['featured'];
}
else{
    $featured="No";
}
if(isset($_POST['active']))
{
  $active=$_POST['active'];
}
else{
    $active="No";
}
//check file selected
//print_r($_FILES['image']);
//die();
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
    $_SESSION['upload']="<div class='error'>Failed to upload Catagory Image!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/add_catagory.php');
    die();
}
}
}
else{
    $image_name="";
}

//SQL query to save data inot DB
$sql="INSERT INTO tbl_catagory SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    ";
$res=mysqli_query($db,$sql) or die (mysqli_error());
if($res==TRUE)
{
    $_SESSION['add']="<div class='sucess'>Catagory added Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'admin/manage-catagory.php');
}
else
{
    $_SESSION['add']="<div class='error'>Failed to add Catagory!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'admin/add_catagory.php');
}
}
?>
<?php
include('partials/footer.php');
?>