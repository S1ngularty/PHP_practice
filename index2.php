<?php
include("includes/config.php");
include("structure/header.html");
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    if(ctype_alpha($_POST["firstname"])== true &&
      ctype_alpha($_POST["lastname"])== true &&
      filter_input(INPUT_POST,'age',FILTER_VALIDATE_INT) &&
      filter_input(INPUT_POST,'password',FILTER_VALIDATE_INT) &&
      ($_POST['password']== $_POST['cpass'])

      ){
 
      try{
      
        mysqli_begin_transaction($conn);
        $first =$_POST['firstname'];
        $last=$_POST['lastname'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];

        $sql1="INSERT INTO user (first_name,Last_name,age,gender,date_created)
        values('$first','$last','$age','$gender',now())";

        mysqli_query($conn,$sql1);

        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql2="INSERT INTO accounts (user_id,username,password) 
        values (last_insert_id(),'$username','$password')";

        mysqli_query($conn,$sql2);

   $last_id=mysqli_insert_id($conn);

        $file=$_FILES["file"]["name"];
        echo $tmp=$_FILES["file"]["tmp_name"];
        $type=$_FILES["file"]["type"];
        echo $error=$_FILES["file"]["error"];
        $allowed=array("png","jpg","jpeg");

        $file_ext=explode('.',$file);
        $extension=strtolower(end($file_ext));

        if(in_array($extension,$allowed)){
          $newfile=uniqid('',true).".".$extension;
          $location="uploads/".$newfile;

         echo $sql3="INSERT INTO profile (user_id,image,date_uploaded)
        values(last_insert_id(),'$newfile',now())";
        $result=  mysqli_query($conn,$sql3);

        if(mysqli_affected_rows($conn)>0){
          move_uploaded_file($tmp,$location);
          header("location: index.php");
          mysqli_commit($conn);
          exit;
        } else{
          throw new Exception("uploading failed!");
        }
        }else{
          throw new Exception("file type invalid");
        }
     
        
      }catch(Exception $e){
        mysqli_rollback($conn);
        print "encountered an error:".$e->getMessage();

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
<body>
    <div class="container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>"
          method="post" enctype="multipart/form-data">
 
        <div class="firstname">
    <label for="">First Name:</label>
    <input type="text" name="firstname" placeholder="user" required>
  </div>

  <div class="lastname">
<label for="">Last Name:</label>
<input type="text" name="lastname" required>
  </div>

  <div class="age">
    <label for="">Age:</label>
    <input type="number" name="age" required>
  </div>

  <div class="genders">
    <label for="">Gender:</label>
   <select name="gender" id="genderid">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="email">Email</option>
   </select>
  </div>

<div class="username">
    <label for="">Username:</label>
    <input type="text" name="username" placeholder="user@example.com" required>
</div>

<div class="password">
    <label for="">Password:</label>
    <input type="Password" name="password" required >
</div>

<div class="cpassword">
    <label for="">Confirm Password:</label>
    <input type="password" name="cpass" required>
</div>

<div class="img">
    <label for="">profile: </label>
    <input type="file" name="file">
</div>

<div class="btn">
<input type="submit" value="Create" name="create">
</div>

<div class="text">
    <p>Already have an account? <a href="index.php">Sign In</a></p>
</div>

        </form>
    </div>
</body>
</html>