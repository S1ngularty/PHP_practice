<?php
session_start();
include ("../includes/config.php");
include ("../structure/header.html");
include ("../includes/framework.html");
try{

if(!empty($_SESSION['user_id'])){


$sql1="SELECT * FROM user u inner join accounts a 
on u.user_id=a.user_id inner join profile p on
 u.user_id=p.user_id where u.user_id='{$_SESSION['user_id']}'";

 $result= mysqli_query($conn,$sql1);

 $row=mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  .main{
    justify-content: space-evenly;
    display: flex;
    border: thin solid;
    padding: 20px;
width: 60%;
  }

  .form-label{
    text-align: start;
  }
</style>
<body>
<div class="container">
    <form action="update.php" method="POST" enctype="multipart/form-data">
    <center>
  <div class="main">
  <div class="con1">
   <div class="firstname">
    <label class="form-label" for="">First Name:</label>
    <input class="form-control" type="text" name="firstname" placeholder="user" value="<?php echo $row['first_name'] ?>">
  </div>
<br>
  <div class="lastname">
<label class="form-label" for="">Last Name:</label>
<input class="form-control" type="text" name="lastname" value="<?php echo $row['Last_name'] ?>" >
  </div>
<br>
  <div class="age">
    <label class="form-label" for="">Age:</label>
    <input class="form-control" type="number" name="age" value="<?php echo $row['age'] ?>">
  </div>
<br>
  <div class="genders">
    <label class="form-label" for="">Gender:</label>
   <select name="gender" id="genderid" >
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="email">Email</option>
   </select>
  </div>
   </div>

<div class="con2">
<div class="username">
    <label class="form-label" for="">Username:</label>
    <input class="form-control" type="text" name="username" placeholder="user@example.com" value="<?php echo $row['username'] ?>">
</div>
<br>
<div class="password">
    <label class="form-label" for="">Password:</label>
    <input class="form-control" type="text" name="password" value="<?php echo $row['password'] ?>" >
</div>
<br>
<div class="cpassword">
    <label class="form-label" for="">Confirm Password:</label>
    <input  class="form-control" type="text" name="cpass" >
</div>
<br>
<div class="img">
    <label class="form-label" for="">profile: </label>
    <input type="file" name="file">
    <input type="hidden" class="form-control" name="date_uploaded" value="<?php echo $row['date_uploaded'] ?>">
    <input type="hidden" name="current_file" value="<?php echo $row['image'] ?>">
</div>
</div>
  </div>
<br>


<input type="submit" value="Create" name="update" style="width: 60%;">
</center>



    </form>
</div>
</body>
</html>

<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
    header("location:../functions/update.php?file=$file");
    exit;
  }


}else{
  throw new Exception("Please <a href=../index.php>Log In</a> first!");
}

}catch(Exception $x){
  print $x->getMessage();
}
?>