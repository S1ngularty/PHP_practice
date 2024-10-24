<?php 
session_start();
include("includes/config.php");
include("includes/framework.html");
include("structure/header.html");



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=trim($_POST["username"]);
    $password=sha1(trim($_POST["password"]));
    if(filter_var($username, FILTER_VALIDATE_EMAIL)){

     try{
        $sql1="SELECT u.first_name, u.user_id , a.role FROM
        user u inner join accounts a on u.user_id =a.user_id
        where username=? && password=? ";
       $stmt1=mysqli_prepare($conn,$sql1);

       mysqli_stmt_bind_param($stmt1,'ss',$username,$password);
     mysqli_stmt_execute($stmt1);

     mysqli_stmt_store_result($stmt1);
     mysqli_stmt_bind_result($stmt1,$first_name,$user_id,$role);

     if(mysqli_stmt_num_rows($stmt1)===1){
    mysqli_stmt_fetch($stmt1);
    $_SESSION['user_id']=$user_id;
    $_SESSION['role']=$role;
if($role=='user'){
    header("location:shop.php");
exit;
}else{
    header("location:home.php");
    exit;
}

     }else{
        throw new Exception("account does not exist");
     }
        // if(mysqli_num_rows($result)>0){
        //  $row=mysqli_fetch_assoc($result);
        //     $_SESSION['user_id']=$row['user_id'];
        //  $message="Welcome ". strtoupper($row['first_name'])."!";
        //  print "<script> alert('$message'); window.location.href='home.php'; </script>";
        //  exit();
         

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
<style>
.main{
    height: 100%;
    justify-content: space-evenly;
    align-items: center;
    display: flex;
    
}

.container,.logo{
    height: 400px;
    width: 700px;
    margin: 20px;
    padding: 50px;

}

.logo{
    justify-content: start;
    align-items: center;
    display: flex;
    flex-direction: column;
    
}



</style>
<body style="height: 100vh;">
  <div class="main">
    <div class="logo">
        <h1>Singularity</h1>
        <p>"One Vision, Infinite Potential."</p>
    </div>
  <div class="container" style="justify-content: center; display:flex; ">
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
  </div>
</body>
</html>
