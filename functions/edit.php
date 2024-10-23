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
    padding: 20px;
width: 60%;
  }

  .form-label{
    text-align: start;
    display: block;
  }

.main{
  height: 500px;
  width: 1200px;
}

.box{
  box-shadow:  0 0 10px rgba(0, 0, 0, 0.3);
  margin: 50px;
  padding:30px;
  width: 80%;
}
.main-box{
  justify-content: center;
  display: flex;
}
</style>
<body>

 <div class="main-box">
 <div class="box">
   <form action="update.php" method="POST" enctype="multipart/form-data">

<div class="main">
<div class="con1">
  <div class="label1"><h3>Information</h3></div>
  <br>
 <div class="firstname" id="content">
  <label class="form-label" for="">First Name:</label>
  <input class="form-control" type="text" name="firstname" placeholder="user" value="<?php echo $row['first_name'] ?>">
</div>
<br>
<div class="lastname"  id="content">
<label class="form-label" for="">Last Name:</label>
<input class="form-control" type="text" name="lastname" value="<?php echo $row['Last_name'] ?>" >
</div>
<br>
<div class="age" id="content">
  <label class="form-label" for="">Age:</label>
  <input class="form-control" type="number" name="age" value="<?php echo $row['age'] ?>">
</div>
<br>
<div class="genders" id="content">
  <label class="form-label" for="">Gender:</label>
 <select name="gender" id="genderid" >
  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="email">Email</option>
 </select>
</div>
<br>

</div>
<div class="con2">
  <div class="label2"><h3>Account</h3></div>
  <br>
<div class="username">
  <label class="form-label" for="">Username:</label>
  <input class="form-control" type="text" name="username" placeholder="user@example.com" value="<?php echo $row['username'] ?>">
</div>
<br>
<div class="password" id="content">
  <label class="form-label" for="">Password:</label>
  <input class="form-control" type="text" name="password" value="<?php echo $row['password'] ?>" >
</div>
<br>
<div class="cpassword" id="content">
  <label class="form-label" for="">Confirm Password:</label>
  <input  class="form-control" type="text" name="cpass" >
</div>
</div>
<br>
<div class="con3">
<div class="label3"><h3>Profile</h3></div>
<br>
<div class="profile">
<img src="<?php print "../uploads/{$row['image']}"; ?>" alt="" style="width: 350px; height:500; border:solid black thin; border-radius:10px;">
</div>
<div class="img" id="content">
  <br>
  <input type="file" name="file" class="form-control">
  <input type="hidden"  name="date_uploaded" value="<?php echo $row['date_uploaded'] ?>">
  <input type="hidden" name="current_file" value="<?php echo $row['image'] ?>"></div>

</div>
</div>
<br>


<center>
<input type="submit" value="Create" class="btn btn-primary" name="update" style="width: 100%; border-radius:5px; ">
</center>

  </form>
   </div>
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