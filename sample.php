<?php
include "includes/config.php";
include "structure/header.html";
session_start();
 echo $id= $_SESSION['user_id'];

$query="SELECT * FROM user u inner join accounts a on u.user_id=a.user_id
 inner join profile p on u.user_id=p.user_id where u.user_id = '22'";

$result=mysqli_query($conn,$query);

 if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo $first=$row['first_name'];
    echo $last=$row['Last_name'];
    echo  $age=$row['age'];
    echo  $gender=$row['gender'];
    echo  $username=$row['username'];
    echo  $password=$row['password'];
    echo  $file=$row['image'];
    echo $create=$row['first_name'];
 }
?>