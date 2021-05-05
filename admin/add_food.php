<?php include('partials/menu.php'); ?>
<div class="main-content">
                <div class="wrapper">
                   <h1>Add Food</h1>
                  <br/><br/>
                  <?php
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
             <td><input type="text" name="title" placeholder="Enter the Title"></td>
             </tr>

             <tr>
             <td>Description:</td>
             <td><textarea name="description" cols="30" ropws="5" placeholder="Description of the food"></textarea>
             </td>
             </tr>
           
             <tr>
             <td>Price:</td>
             <td><input type="number" name="price"></td>
             </tr>

             <tr>
             <td>Select Image:</td>
             <td><input type="file" name="image"></td>
             </tr>

             <tr>
             <td>Select Catagory:</td>
             <td>
             <select name="catagory">
             <?php
             //display catagory from DB
             $sql="SELECT * FROM tbl_catagory WHERE active='Yes'";
             $res=mysqli_query($db,$sql);
             $count=mysqli_num_rows($res);//get all rows in DB
    if($count>0)//chcek rows has value or not
    { 
        while($rows=mysqli_fetch_assoc($res))
                    {//get individual data
                       $id=$rows['id'];
                       $title=$rows['title'];
                       ?>
                      <option value="<?php echo $id; ?>">  <?php echo $title; ?></option>
                     <?php
                    }
    
    }
    else
    {
        ?>
        <option value="0">No Catagory Found!</option>
        <?php
    }
             
             ?>
             </select>
             </td>
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
             <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
             </tr>

             </table>
                </form>
<?php
if(isset($_POST['submit']))
{
$title=$_POST['title'];
$description=$_POST['description'];
$price=$_POST['price'];
$catagory=$_POST['catagory'];
//default value setting
if(isset($_POST['featured']))
{
  $featured=$_POST['featured'];
}
else
{
    $featured="No";
}
if(isset($_POST['active']))
{
  $active=$_POST['active'];
}
else
{
    $active="No";
}
if(isset($_FILES['image']['name']))
{ 
    $image_name=$_FILES['image']['name'];
    //rename image which has same name
    if($image_name!="")
 {
    $txt=end(explode('.',$image_name));
    $image_name="Food_Name_".rand(000,999).'.'.$txt;//Food_Catagory_852.jpg
    $src=$_FILES['image']['tmp_name'];
    $dst="../images/food/".$image_name;
    $upload=move_uploaded_file($src, $dst);
    if($upload==false)
   {
    $_SESSION['upload']="<div class='error'>Failed to upload Food Image!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'/admin/add_food.php');
    die();
   }
  }
}
else{
    $image_name="";
}
//SQL query to save data inot DB
$sql2="INSERT INTO tbl_food SET
    title='$title',
    description='$description',
    price='$price',
    image_name='$image_name',
    catagory_id=$catagory,
    featured='$featured',
    active='$active'
    ";
  
$res2=mysqli_query($db,$sql2);
if($res2==true)
{
    $_SESSION['add']="<div class='sucess'>Food added Successfully!</div>";
    //redirect to manage-admin
    header('location:'.SITEURL.'/admin/manage-food.php');
}
else
{
    $_SESSION['add']="<div class='error'>Failed to add Food!<br/>Please try again later!</div>";
    //redirect to add-admin
    header('location:'.SITEURL.'/admin/add_food.php');
}
           
}
?>              
</div>
</div>
<?php include('partials/footer.php'); ?>