<?php 
session_start();
include("structure/shopheader.html");
include("includes/config.php");

if(!empty($_SESSION['user_id'])){
 $_SESSION['user_id'];

$sql1="SELECT * FROM items s inner join quantity q using(item_id)";
$result=mysqli_query($conn,$sql1);

if(isset($_GET['search'])){//search form
  $keyword=$_GET['searchtext'];
   $sql2="SELECT * FROM items WHERE description LIKE '%$keyword%'";
  $result=mysqli_query($conn,$sql2);
  $count=mysqli_num_rows($result);
  if($count == 0){
 print "$count no item found!";
  }else{
  print "$count items found.";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin-bottom:20px;">
<div class="container" style="justify-content: center; display:flex; align-items:center;">
<div class="container" >
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">options</button>
        <ul class="dropdown-menu" aria-labelledby="dropdown">
            <li class="dropdown-item">school supplies</li>
            <li class="dropdown-item">cloths</li>
            <li class="dropdown-item">gadgets/devices</li>
            <li class="dropdown-item">foods</li>
            <li class="dropdown-item">other</li>
        </ul>
    </div>

  <!-- searh bar -->
    <div class="searchbar">
      <form action="<?php $_SERVER['PHP_SELF']?>" method="get" enctype="multipart/form-data">
      <input type="text" class="form-control" name="searchtext">
      <input type="submit" class="btn btn-primary" name="search" value="search">
      </form>
    </div>
</div>
<br>
<br>



    <div class="container" id="container2" style="display: flex; ">

<?php while ($row = mysqli_fetch_assoc($result)){

print "<form action='../user_profile/shop_order/add_to_cart.php'  method='post' enctype='multipart/form-data' >
<div class=' text-center border border-primary rounded' style='padding:5px; margin:5px; width:200px; height:450px;'><input type='hidden' name='product_name' value='{$row['item_name']}'>
<img src='../user_profile/Shop_Items/{$row['product_appearance']}' class='img img-thumbnail img-responsive' style='width:200px; height:200px;' alt='{$row['item_name']}'><input type='hidden' name='product_price' value='{$row['price']}'>
<label for='' class='form-label'>{$row['item_name']}</label><br><div style='text-align:start;'><strong>Price: </strong><i style='color:orange;'>P ".$row['price'].".00</i></div><br>
<div style='text-align:start;'><label>Quantity</label><input type='number' value='1' name='product_quantity' class='form-control' size='2' maxlength='2'min='1' max='{$row['quantity']}' style='margin-bottom:5px;'> </div>
<br><button class='btn btn-primary' name='product_id' value='{$row['item_id']}' style='marigin: bottom 5px;'>Add To Cart</button></div> </form>";
}
 ?>


    </div>

  <div class="container" id="button_home" >
  <button class="btn btn-primary " onclick="window.location.href='../user_profile/home.php';">Home</button>
    <button class="btn btn-primary " onclick="window.location.href='../user_profile/shop_order/view_orders.php';">View Cart</button>
  </div>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php 
print "<pre>";
print_r($_SESSION['cart']);
print "</pre>";
}else{
    session_destroy();
    print "Please <a href=index.php>login</a> first!";
}

?>