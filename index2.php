<?php
include("includes/config.php");
include("structure/header.html");
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    if(ctype_alpha($_POST["firstname"])== true &&
      ctype_alpha($_POST["lastname"])== true &&
      filter_input(INPUT_POST,'age',FILTER_VALIDATE_INT) &&
      ($_POST['password']== $_POST['cpass'])

      ){
 
      try{
      
        mysqli_begin_transaction($conn);
        $first =trim($_POST['firstname']);
        $last=trim($_POST['lastname']);
        $age=trim($_POST['age']);
        $gender=trim($_POST['gender']);
        $role=trim($_POST['role']);

       echo $sql1="INSERT INTO user (first_name,Last_name,age,gender,date_created)
        values(?,?,?,?,now())";
        $stmt1=mysqli_prepare($conn,$sql1);
        mysqli_stmt_bind_param($stmt1,'ssis',$first,$last,$age,$gender);
        mysqli_stmt_execute($stmt1);

        echo $last_id = mysqli_insert_id($conn);

        $username=trim($_POST['username']);
        $password=sha1(trim(($_POST['password'])));

       echo $sql2="INSERT INTO accounts (user_id,username,password,role) 
        values (?,?,?,?)";
     $stmt2=mysqli_prepare($conn,$sql2);
     mysqli_stmt_bind_param($stmt2,'isss',$last_id,$username,$password,$role);
     mysqli_stmt_execute( $stmt2);


        $file=$_FILES["file"]["name"];
         $tmp=$_FILES["file"]["tmp_name"];
        $type=$_FILES["file"]["type"];
         $error=$_FILES["file"]["error"];
        $allowed=array("png","jpg","jpeg");

        $file_ext=explode('.',$file);
        $extension=strtolower(end($file_ext));

        if(in_array($extension,$allowed)){
          $newfile=uniqid('',true).".".$extension;
          $location="uploads/".$newfile;

         echo $sql3="INSERT INTO profile (user_id,image,date_uploaded)
        values(?,?,now())";
        $stmt3=mysqli_prepare($conn,$sql3);
        mysqli_stmt_bind_param($stmt3,'is',$last_id,$newfile);
        mysqli_stmt_execute($stmt3);

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
<!--interface-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous">
</head>
<style>

.con2,.con1{
  margin: 50px;
}

</style>
<body>
    <div class="container" style="justify-content:center; display:flex;">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>"
          method="post" enctype="multipart/form-data" >
 
        <div class="container" id="main_container" style="display: flex; justify-content:center;">
        <div class="con1">
        <div class="firstname">
    <label for="" class="form-label">First Name:</label>
    <input type="text" name="firstname" placeholder="user" class="form-control" required>
  </div>
<br>
  <div class="lastname">
<label for="" class="form-label">Last Name:</label>
<input type="text" name="lastname" class="form-control" required>
  </div>
<br>
  <div class="age" >
    <label for="" class="form-label">Age:</label>
    <input type="number" name="age" class="form-control" required>
  </div>
<br>
  <div class="genders">
    <label for="" class="form-label">Gender:</label>
   <select name="gender" id="genderid">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="email">Email</option>
   </select>
  </div>
        </div>
<br>
<div class="con2">
<div class="username">
    <label for="" class="form-label">Username:</label>
    <input type="text" name="username" placeholder="user@example.com" class="form-control" required>
</div>
<br>
<div class="role">
    <label for="" class="form-label">Role:</label>
   <select name="role" id="role">
    <option value="admin">Admin</option>
    <option value="user">User</option>
   </select>
</div>
<br>
<div class="password">
    <label for="" class="form-label">Password:</label>
    <input type="Password" name="password" class="form-control" required >
</div>
<br>
<div class="cpassword">
    <label for="" class="form-label">Confirm Password:</label>
    <input type="password" name="cpass" class="form-control" required>
</div>
<br>
<div class="img">
    <label for="" class="form-label">profile: </label>
    <input type="file" name="file" class="form-control">
</div>
<br>
<div class="btn">
<input type="submit" value="Create" name="create" class="btn btn-success">
</div>
<br>
<div class="text">
    <p>Already have an account? <a href="index.php">Sign In</a></p>
</div>

</div>
        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>
</body>
</html>