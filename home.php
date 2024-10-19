<?php
session_start();
include "includes/config.php";
include "structure/header.html";

try{
    if(!empty($_SESSION['user_id'])){
         $id= $_SESSION['user_id'];

     $query="SELECT * FROM user u inner join accounts a on u.user_id=a.user_id
     inner join profile p on u.user_id=p.user_id where u.user_id = $id";
    
    $result=mysqli_query($conn,$query);
    
     if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $first=$row['first_name'];
        $last=$row['Last_name'];
        $age=$row['age'];
        $gender=$row['gender'];
        $username=$row['username'];
        $password=$row['password'];
        $file=$row['image'];
        $create=$row['first_name'];

     }
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body style="font-family:Arial,sans-serif;">

<div class="main" style="justify-content:center; display:flex;">
<div class="container" style="padding: 30px; margin: 20px; border: solid black 1px; height: auto; width: 500px; font-family: Arial, sans-serif;">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

   
        <div style="text-align: center; margin-bottom: 20px;">
            <h2>Personal Resume</h2>
        </div>


        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="basic_info" style="width: 60%;">
                <h3>Basic Personal Information</h3>
                <div class="info" style="padding: 5px;">
                    <strong>Name:</strong> <?php print "$first $last"; ?>
                </div>
                <div class="info" style="padding: 5px;">
                    <strong>Age:</strong> <?php print $age . " yrs old"; ?>
                </div>
                <div class="info" style="padding: 5px;">
                    <strong>Gender:</strong> <?php print $gender; ?>
                </div>
            </div>

            <div class="profile_picture" style="width: 35%; text-align: center;">
                <?php print "<img style='height: 150px; width: 150px; border-radius: 50%; object-fit: cover;' src='uploads/$file' alt='Profile Picture'>"; ?>
            </div>
        </div>

        <h3 style="padding: 10px 0; border-bottom: 1px solid black;">Account Information</h3>

        <div class="account_info">
            <div class="info" style="padding: 5px;">
                <strong>Username:</strong> <?php print $username; ?>
            </div>
            <div class="info" style="padding: 5px;">
                <strong>Password:</strong> <?php print $password; ?>
            </div>
        </div>

    </form>
</div>
</div>
<div class="options">
    <label for="">Option:</label>
    <button><?php print "<a href='functions/delete.php?id=$id&loc=$file' style='text-decoration:none; color:black;'>Delete</a>";?></button>
    <button><?php print "<a href='functions/edit.php' style='text-decoration:none; color:black;'>Update Account</a>";?></button>
   <?php if($_SESSION['role']=='admin'){
   print "<button><a href='item_function/create.php' style='text-decoration:none; color:black;'>Add Product</a></button>" ;  
   print "<button><a href='admin_interface/orderline.php' style='text-decoration:none; color:black;'>Orderline</a></button>" ;  
}else{
   print "<button> <a href='shop.php' style='text-decoration:none; color:black;'>Go to Shop</a></button>";
}
   
   ?>
    <button><?php print "<a href='functions/logout.php' style='text-decoration:none; color:black;'>Log out</a>";?></button>
</div>

</body>
</html>

<?php 
}
else{
   throw new Exception("Please log in first! <a href=index.php >Log in</a>");
 
}
}catch(Exception $e){
print $e->getMessage();
}
?>