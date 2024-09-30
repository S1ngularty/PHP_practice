<?php
session_start();
include ("../includes/config.php");
include ("../structure/header.html");
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
<body>
<div class="container">
    <form action="update.php" method="POST" enctype="multipart/form-data">
    <div class="firstname">
    <label for="">First Name:</label>
    <input type="text" name="firstname" placeholder="user" value="<?php echo $row['first_name'] ?>">
  </div>

  <div class="lastname">
<label for="">Last Name:</label>
<input type="text" name="lastname" value="<?php echo $row['Last_name'] ?>" >
  </div>

  <div class="age">
    <label for="">Age:</label>
    <input type="number" name="age" value="<?php echo $row['age'] ?>">
  </div>

  <div class="genders">
    <label for="">Gender:</label>
   <select name="gender" id="genderid" >
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="email">Email</option>
   </select>
  </div>

<div class="username">
    <label for="">Username:</label>
    <input type="text" name="username" placeholder="user@example.com" value="<?php echo $row['username'] ?>">
</div>

<div class="password">
    <label for="">Password:</label>
    <input type="text" name="password" value="<?php echo $row['password'] ?>" >
</div>

<div class="cpassword">
    <label for="">Confirm Password:</label>
    <input type="text" name="cpass" >
</div>

<div class="img">
    <label for="">profile: </label>
    <input type="file" name="file">
    <input type="hidden" name="date_uploaded" value="<?php echo $row['date_uploaded'] ?>">
    <input type="hidden" name="current_file" value="<?php echo $row['image'] ?>">
</div>

<div class="btn">
<input type="submit" value="Create" name="update">
</div>


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