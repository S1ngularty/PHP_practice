<?php 
session_start();
include("structure/shopheader.html");
include("includes/config.php");

if(!empty($_SESSION['user_id'])){
 $_SESSION['user_id'];

$sql1="SELECT * FROM items";
$result=mysqli_query($conn,$sql1);

if(isset($_GET['search'])){
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
<body>
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
    <div class="container" id="container2">
<form action="../user_profile/shop_order/purchase.php" class="row g-0" method="post" enctype="multipart/form-data" style="display:flex;">
<?php while ($row = mysqli_fetch_assoc($result)){
print "<div class='col-sm-4 col-md-3 col-xl-2 text-center border border-primary rounded' style='padding:5px; margin:5px;'><img src='../user_profile/Shop_Items/{$row['product_appearance']}' class='img img-thumbnail img-responsive' style='width:200px; height:200px;' alt='{$row['item_name']}'><label for='' class='form-label'>{$row['item_name']}</label><br><button class='btn btn-primary' name='subbutton' value='{$row['item_id']}'>Add To Cart</div> ";
}
 ?>

</form>
    </div>

  <div class="container" id="button_home">
  <form action="home.php" method="post" enctype="multipart/form-data">
    <input type="submit" class="btn btn-primary" value="Go back to Home">
  </form>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php 
}else{
    session_destroy();
    print "Please <a href=index.php>login</a> first!";
}

?>