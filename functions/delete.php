<?php 
session_start();
include "../includes/config.php";
 $_GET['loc'];
 echo $path="../uploads/".$_GET['loc'];
 try{
    mysqli_begin_transaction($conn);
    $sql="DELETE FROM user where user_id={$_GET['id']}";
   $result=mysqli_query($conn,$sql);
  
   if(mysqli_affected_rows($conn)>0){
  if(unlink($path)){
    mysqli_commit($conn);
    $msg="account has been deleted successfully!";
    print"<script>alert('$msg');  </script>";
    header("location: ../index.php");
exit();
 }else{
    print "file not deleted";
 }
    
   }else{
    print "cant delete this file! please check your code";
   }

 }catch(Exception $x){
    mysqli_rollback($conn);
    print "encountered an error:".$x->getMessage();
 }

?>