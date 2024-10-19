<?php 
session_start();
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
        <center><h2>New Product</h2></center>
     <center>
     <div class="con1" style="padding: 30px; margin:50px; justify-content:center; display:flex;">
      <form action="store.php" method="post" enctype="multipart/form-data" >
       <div class="item2">
       <div class="item">
            <label for="" class="form-label">Item:</label><br>
            <input type="text" name="item" class="form-control" required>
        </div>
        <br>
        <div class="quantity">
            <label for="" class="form-label">Quantity:</label><br>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <br>
        <div class="description">
         <label for="" class="form-label">Description:</label>
         <textarea name="desc" class="form-control" id="desc"></textarea>
        </div>
        <br>
        <div class="quantity">
            <label for="" class="form-label">Price:</label><br>
            <input type="number" class="form-control" name="price" required>
        </div>
        <br>
        <div class="rating">
            <label for="" class="form-label">Rating:</label><br>
            <input type="number" name="rating" class="form-control">
        </div>
       </div>
        <br>
        <div class="item1">
        <label for="" class="form-label">Add Item Image:</label>
            <div class="">
            <img src="../item_function/item_default.png" alt="" style="height: 350px; width:400px;" class="form-control">
            </div>
        <div class="image">
            <input type="file" name="file" required  class="form-control">
            </div>
            <div class="mb-3" style="width:100%;">
            <button type="submit" name="add" value="add" class="btn btn-success" style="text-align:center; width:100%; margin-top:10px;">Submit</button>
            </div>
        </div>
       

        </form>
      </div>
     </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php

 if(isset($_POST['add'])){
    header("location:../shop_stocks/create.php");
exit;
}
}
?>