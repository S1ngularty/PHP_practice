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
</head>
<body>
    <div class="conatainer">
        <form action="store.php" method="post" enctype="multipart/form-data">
        <div class="item">
            <label for="">Item:</label><br>
            <input type="text" name="item" required>
        </div>
        <br>
        <div class="quantity">
            <label for="">Quantity:</label><br>
            <input type="number" name="quantity" required>
        </div>
        <br>
        <div class="description">
         <label for="">Description:</label>
         <textarea name="desc" id="desc"></textarea>
        </div>
        <br>
        <div class="quantity">
            <label for="">Price:</label><br>
            <input type="number" name="price" required>
        </div>
        <br>
        <div class="rating">
            <label for="">Rating:</label><br>
            <input type="number" name="rating">
        </div>
        <br>
        <div class="image">
            <label for="">Product Appearance</label><br>
            <input type="file" name="file" required >

            <div class="btn">
                <input type="submit" value="add" name="add">
            </div>
        </div>

        </form>
    </div>
</body>
</html>

<?php

 if(isset($_POST['add'])){
    header("location:../shop_stocks/create.php");
exit;
}
}
?>