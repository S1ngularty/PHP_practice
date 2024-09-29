<?php 
session_start();
include("includes/config.php");
include("structure/header.html");



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    if(filter_var($username, FILTER_VALIDATE_EMAIL)
     && filter_var($password, FILTER_VALIDATE_INT)){

     try{
        $result=  mysqli_query($conn,"SELECT u.first_name, u.user_id FROM
        user u inner join accounts a on u.user_id =a.user_id
        where username='$username' && password='$password' ");
     
        if(mysqli_num_rows($result)>0){
         $row=mysqli_fetch_assoc($result);
            $_SESSION['user_id']=$row['user_id'];
         $message="Welcome ". strtoupper($row['first_name'])."!";
         print "<script> alert('{$_SESSION['user_id']}'); window.location.href='home.php'; </script>";
         exit();
         
        }else{
            throw new exception ("Account does not exist!");
        }

     }catch(Exception $e){
      
        print "Error Occured: ".$e->getMessage();
     }
    }
    
}
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
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<div class="username">
    <label for="">Username: </label>
    <input type="text" name="username" placeholder="user@gmail.com">
</div>

<div class="password">

<label for="">Password:</label>
<input type="password" name="password">
</div>

<div class="btn">
    <input type="submit" name="submit" value="submit">
</div>

<div class="create">
    <p>dont have an account yet? <a href="index2.php" style="text-decoration: none;">create an account</a></p>
</div>
</form>

    </div>
</body>
</html>

<?php


?>