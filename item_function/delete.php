<?php 
session_start();
include("../includes/config.php");
include("../includes/framework.html");

if(isset($_SESSION['user_id']) && $_SESSION['role']=='admin'){
print_r($_SESSION['item_delete']);
$item=$_SESSION['item_delete'];
$sql1="DELETE FROM items where item_id=?";
$stmt1= mysqli_prepare($conn,$sql1);
mysqli_stmt_bind_param($stmt1,'i',$item);
mysqli_stmt_execute($stmt1);
if(mysqli_affected_rows($conn)==1){
    unset($_SESSION['item_delete']);
    if(empty($_SESSION['item_id'])){
        header("location:edit.php");
        exit;

    }
   
}

}

?>