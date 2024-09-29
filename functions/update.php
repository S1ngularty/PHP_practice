<?php
session_start();
include "../includes/config.php";
$id=$_SESSION['user_id'];
print_r($_SESSION);

if(!empty($_SESSION['user_id'])){
    $fname=$_POST['firstname'];
    $lname=$_POST['lastname'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $username=$_POST['username'];
    $password=$_POST['password'];
     $img= $_FILES['file'];
     $allow=array('png','jpg','jpeg');

     $file_ext=explode('.',$img['name']);
     echo $extension=strtolower(end($file_ext));


if(ctype_alpha($_POST["firstname"])== true &&
ctype_alpha($_POST["lastname"])== true &&
filter_input(INPUT_POST,'age',FILTER_VALIDATE_INT) &&
filter_input(INPUT_POST,'password',FILTER_VALIDATE_INT) &&
  ($_POST['password']== $_POST['cpass']) && in_array($extension,$allow)){

      try{
          mysqli_begin_transaction($conn);
          $sql1="UPDATE  user set first_name='$fname', 
          Last_name='$lname',age='$age',gender='$gender' where user_id='$id'";
          
          echo "<br>". $sql1;
          
          mysqli_query($conn,$sql1);
          
          $sql2="UPDATE  accounts SET username='$username', password ='$password'  where user_id='$id'";
          mysqli_query($conn,$sql2);
          echo "<br>". $sql2;
          
          $newfile=uniqid('',true).".".$extension;
          $location="../uploads/".$newfile;

          $sql3="UPDATE profile SET image='$newfile', date_uploaded=now()  where user_id='$id'";
          echo "<br>". $sql3;
          mysqli_query($conn,$sql3);

          if(mysqli_affected_rows($conn)>0){
          $path="../uploads/".$_POST['current_file'];
          
          if(unlink($path)){
            move_uploaded_file($img['tmp_name'],$location);
            mysqli_commit($conn);
           header("location: ../home.php");
          exit;

          }else{
            throw new Exception("failed to replace the current profile");
          }
                    
          }else{
            throw new Exception("failed on executing commands");
          }
          
        }catch(Exception $x){
                  mysqli_rollback($conn);
                  print "Error: ". $x->getMessage();
          
        }
    }



}



?>