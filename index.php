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
         print "<script> alert('$message'); window.location.href='home.php'; </script>";
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<body>


    <div class="container" style="justify-content: center; display:flex;">
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<div class="username">
    <label for="" class="form-label">Username: </label><br>
    <input type="text" name="username" placeholder="user@gmail.com" class="user form-control border border-success-subtle rounded-3" required>
</div>
<br>

<div class="password">

<label for="" class="form-label">Password:</label><br>
<input type="password" name="password" class="form-control border border-success-subtle" required>
</div>
<br>
<div class="btn " style="display: flex; justify-content:center;">
    <input type="submit" name="submit" value="submit" class="btn btn-primary">
</div>

<div class="create">
    <p>dont have an account yet? <a href="index2.php" style="text-decoration: none;">create an account</a></p>
</div>
</form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php


?>