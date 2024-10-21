<?php 
session_start();
include("../includes/config.php");
include("../includes/framework.html");

if(isset($_SESSION['user_id']) && $_SESSION['role']=='admin'){

    print "<pre>";
        print_r($_SESSION['item_edit']);
        print "</pre>";
    if(isset($_POST['update'])){
       print "hello";
      try{
      echo  $id=$_SESSION['item_edit']['item_id'];
        $item=$_POST['item'];
       $quantity= $_POST['quantity'];
       $description=$_POST['desc'];
       $price=$_POST['price'];
       $rating=$_POST['rating'];
       $img=$_FILES['file']['name'];
       $tmp=$_FILES['file']['tmp_name'];
       $type=$_FILES["file"]["type"];
       $error=$_FILES["file"]["error"];
      $allowed=array("png","jpg","jpeg");

    $file_ext=explode('.',$img);
    $extension=strtolower(end($file_ext));

    if(in_array($extension,$allowed)){
        $new_file=uniqid('',true).".".$extension;
        $loc="../Shop_Items/".$new_file;

    mysqli_begin_transaction($conn);
     $sql1="UPDATE items SET item_name=?, description=?,price = ?, product_appearance= ?,rating=? WHERE item_id=?";
     $stmt1=mysqli_prepare($conn,$sql1);
     
     mysqli_stmt_bind_param($stmt1,'ssisis',$item,$description,$price,$new_file,$rating,$id);
     $sql2="UPDATE quantity SET quantity=? WHERE item_id=?";
     $stmt2=mysqli_prepare($conn,$sql2);
     mysqli_stmt_bind_param($stmt2,'ii',$quantity,$id);

     $path="../Shop_Items/".$_SESSION['item_edit']['item_img'];
    
     if(move_uploaded_file($tmp,$loc)){
     mysqli_stmt_execute($stmt1); 
     mysqli_stmt_execute($stmt2);
    
     if(mysqli_stmt_affected_rows($stmt1)){
        if(file_exists($path)){
            unlink($path);
         }
        mysqli_commit($conn);
        unset($_SESSION['item_edit']);
        header("location:../item_function/edit.php");
        exit;
     }else{
        throw new Exception ("no row affected");
     }
    }else{
        throw new Exception("faile to move the file");
    }


    }else{
        throw new Exception("file type is not valid");
    }

}catch(Exception $e){
        mysqli_rollback($conn);
        print "error: ". $e->getMessage();
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
<style>
    .con1{
        box-shadow:  0 0 10px rgba(0, 0, 0, 0.3);
        width: 1000px;
        padding: 30px;
        border-radius: 10px;
    }
    form {
  height: 500px;
  width: 1000px;
  padding-left: 50px;
  padding-top:30px;
  margin-bottom:20px ;
  justify-content: space-evenly;
  display: flex;
         
    }

    center{
        margin-top: 20px;
    }
    img:hover{
        border: #198754 solid thin;
    }
   
    .btn{
        color: #198754;
        background-color: #fff;
        border-color: #198754;
    }
    .btn:hover{
        color: #fff;
        background-color:#198754;
        border-color: #198754;
    }

   label{
    width: 100%;
        text-align: start;
        font-family: Arial, sans-serif;
        font-weight: bold;
    }

    .form-control:hover{
        border-color: #198754;
    }
    img{
        margin-bottom:10px;
    }

   

</style>
<body>
<div class="conatainer" id="container">
        <center><h2>Edit Product</h2></center>
     <center>
     <div class="con1" style="padding: 30px; margin:50px; justify-content:center; display:flex;">
      <form action="update.php" method="post" enctype="multipart/form-data" >
       <div class="item2">
       <div class="item">
            <label for="" class="form-label">Item:</label><br>
            <input type="text" name="item" class="form-control" value="<?php print $_SESSION['item_edit']['item_name'] ?>" required>
        </div>
        <br>
        <div class="quantity">
            <label for="" class="form-label">Quantity:</label><br>
            <input type="number" name="quantity" class="form-control" value="<?php print $_SESSION['item_edit']['item_qty'] ?>" required>
        </div>
        <br>
        <div class="description">
         <label for="" class="form-label">Description:</label>
         <textarea name="desc" class="form-control" id="desc" ><?php print $_SESSION['item_edit']['item_description'] ?></textarea>
        </div>
        <br>
        <div class="quantity">
            <label for="" class="form-label">Price:</label><br>
            <input type="number" class="form-control" name="price" value="<?php print $_SESSION['item_edit']['item_price'] ?>" required>
        </div>
        <br>
        <div class="rating">
            <label for="" class="form-label">Rating:</label><br>
            <input type="number" name="rating" class="form-control" value="<?php print $_SESSION['item_edit']['item_rating'] ?>">
        </div>
       </div>
        <br>
        <div class="item1">
        <label for="" class="form-label">Add Item Image:</label>
            <div class="">
            <img src="<?php print "../Shop_Items/".$_SESSION['item_edit']['item_img']; ?>" alt="" style="height: 350px; width:400px;" class="form-control">
            </div>
        <div class="image">
            <input type="file" name="file" required  class="form-control">
            </div>
            <div class="mb-3" style="width:100%;">
            <button type="submit" name="update" value="update" class="btn btn-success" style="text-align:center; width:100%; margin-top:10px;">Update</button>
            </div>
        </div>
       

        </form>
      </div>
     </center>
    </div>
</body>
</html>


<?php 
}

?>