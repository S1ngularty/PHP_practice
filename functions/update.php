<?php
session_start();
include "../includes/config.php";

$id=$_SESSION['user_id'];
if(!empty($_SESSION['user_id'])){
   $fname=trim(ucwords(strtolower($_POST['firstname'])));
   $lname=trim(ucwords(strtolower($_POST['lastname'])));
  $age=trim($_POST['age']);
  $gender=$_POST['gender'];
  $username=trim($_POST['username']);
  $password=sha1($_POST['password']);
  $confirm_pass=sha1($_POST['cpass']);
   $img= $_FILES['file'];
   $allow=array('png','jpg','jpeg');

   $file_ext=explode('.',$img['name']);
   echo $extension=strtolower(end($file_ext));

   if(in_array($extension,$allow))

try{
  if(in_array($extension,$allow) && $password==$confirm_pass)  { 
   $newfile=uniqid('',true).".".$extension;
   $location="../uploads/".$newfile;
   $current_file="../uploads/".$_POST['current_file'];

    mysqli_begin_transaction($conn);
    $sql1="UPDATE user SET first_name=?, Last_name=?, age=?,gender=? WHERE user_id=?";
    $stmt1=mysqli_prepare($conn,$sql1);
    mysqli_stmt_bind_param($stmt1,'ssisi',$fname,$lname,$age,$gender,$id);

    $sql2="UPDATE accounts  SET  username=?, password=? WHERE user_id=?";
    $stmt2=mysqli_prepare($conn,$sql2);
    mysqli_stmt_bind_param($stmt2,'ssi',$username,$password,$id);

    $sql3= "UPDATE profile SET image=?, date_uploaded=now() WHERE user_id=?";
    $stmt3=mysqli_prepare($conn,$sql3);
    mysqli_stmt_bind_param($stmt3,'si',$newfile,$id);

    mysqli_stmt_execute($stmt1);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_execute($stmt3);

    if(mysqli_stmt_affected_rows($stmt3)>0){
      if(file_exists($current_file)){
        if(unlink($current_file)){
         if( move_uploaded_file($img['tmp_name'],$location)){
          print "file uploaded successfully";
          mysqli_commit($conn);
          header("location: ../home.php");
          exit;
         }else{
          throw new Exception("file failed to move to uploaded file");
         }
        }else{
          throw new Exception("failed to replace the file");
        }
      }else{
        if( move_uploaded_file($img['tmp_name'],$location)){
          print "file uploaded successfully";
          mysqli_commit($conn);
          header("location: ../home.php");
          exit;
         }else{
          throw new Exception("file failed to move to uploaded file");
         }
      }
    }else{
      throw new Exception("failed to update");
    }


  }else{
    throw new Exception("File type is not valid");
  }

}catch(Exception $x){
  mysqli_rollback($conn);
  print $x->getMessage();
}

}


?>