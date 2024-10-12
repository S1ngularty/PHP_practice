<?php
include "includes/config.php";
include "structure/header.html";
session_start();
 echo $id= $_SESSION['user_id'];


if(isset($_POST['btn'])){
    if(!empty($_POST['check'])){
        print'the checkbox is set<br>'.$_POST['check'];
    }else{
        print"the checkbox is not set";
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
    <form action="sample.php" method="post">
    <input type='checkbox'  name='check'  value="del"><input type='submit' name='btn' value="set">
    </form>
</body>
</html>