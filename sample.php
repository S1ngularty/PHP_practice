<?php
include "includes/config.php";
include "structure/header.html";
session_start();
 echo $id= $_SESSION['user_id'];


 $sql1="SELECT * FROM items";
 $result=mysqli_query($conn,$sql1);

if(isset($_POST['btn'])){
    echo $_POST['product_quantity'];
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
    <form action="sample.php" method="post">
    <input type='number'  name='product_quantity' class='form-control' size='2' value="1" maxlength='2'  style='margin-bottom:5px;'><input type='submit' name='btn'>
    </form>
</body>
</html>