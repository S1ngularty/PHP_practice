<?php 
session_start();
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
    print "hello";
    $search=$_GET['search'];
   
    $sql1="SELECT * FROM items FROM description LIKE '%$search%'";
   $result= mysqli_query($conn,$sql1);

    if(mysqli_num_rows($result)>0){
      header("location:../shop.php");
      exit;
    }else{
        print"failed";
    }

}


?>