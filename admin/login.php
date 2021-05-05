<?php include('partials/config/constants.php');?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="..\css\admin.css">
</head>
<body>
  <div class="login">
  <h1 class="text-center">login</h1>
  <br/><br/>
  <?php if(isset($_SESSION['login']))
                 {echo $_SESSION['login'];//display session message
                 unset($_SESSION['login']);//disappear session message
                 }
         if(isset($_SESSION['no-login-message']))
                 {echo  $_SESSION['no-login-message'];//display session message
                 unset( $_SESSION['no-login-message']);//disappear session message
                 }
                 
?>
   <br/><br/>
            <form action="" method="POST" class="text-center">
             User name:<br/><br/>
             <input type="text" name="username" placeholder="Enter Your User Name"/><br/><br/>
           
             Password:<br/><br/>
             <input type="password" name="password" placeholder="Enter Your Password"/><br/><br/>

            <input type="submit" name="submit" value="Login" class="btn-secondary"/>
             </form> 
             <br/><br/>
  <p class="text-center">created by <a href="https://ayishabanu.github.io/portfolio/" >ayishabanu</a></p>
  </div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
//SQL query to save data inot DB
$sql="SELECT * FROM tbl_admin WHERE
    username='$username' AND
    password='$password'
    ";
$res=mysqli_query($db,$sql);
 if($res==TRUE)
 {
  $count=mysqli_num_rows($res);//get all rows in DB
    if($count==1)//chcek rows has value or not
    { 
              $_SESSION['login']="<div class='sucess'>Login Sucessful!</div>";
              $_SESSION['user']=$username;
               header('location:'.SITEURL.'admin/');   
    }
    else
    {
       $_SESSION['login']="<div class='error text-center'>OOps! Username and password is not match!</div>";
       header('location:'.SITEURL.'admin/login.php');
    }
}
}
?>