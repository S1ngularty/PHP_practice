<?php 
session_start();
include("../structure/shopheader.html");
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
 $purchase_id=$_POST['subbutton'];
    
 echo $sql1="SELECT * FROM items i inner join quantity q on i.item_id=q.item_id where i.item_id=$purchase_id";
$result=mysqli_query($conn,$sql1);

if(mysqli_affected_rows($conn)>0){
echo "success";
$row=mysqli_fetch_assoc($result);

?>

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
<body>
    <br>
    <br>
    <br>
<div class="container" id="conatainer1" style="justify-content:start; display:flex; border:solid thin; width:700px; height:500px; padding: 30px;">
    <form action="store.php" method="post" enctype="multipart/form-data">
<div class="information" style="justify-content: space-between; align-items:center; display:flex;">
    <div class="container" id="img" style="width:400px; justify-content:center; display:flex;">
        <img src="../Shop_Items/<?php print $row['product_appearance']; ?>" class="img img-thumbnail" alt="<?php print $row['item_name']; ?>" style="height: :200px; width:200px;">
    </div>

    <div class="container" id="textinfo" style="width:400px; justify-content:start; display:block; height:300px;">
        <label for="" class="form-label"><strong><?php print strtoupper($row['item_name']) ?></strong></label>
        <div class="price" style="width:200px; margin:0%;"><p><?php print "<strong>Price: </strong><i style='color:orange;'>P ".$row['price'].".00</i>" ?></p></div>
        <div class="price" style="width:200px; margin:0%;"><p><?php print "<strong>Stocks: </strong>".$row['quantity']." pcs" ?></p></div>
        <div class="text" style="width:200px; margin:0%;"><p><?php print "<strong>Date Added: </strong>".$row['date_added']?></p></div>
        <div class="text" style="width:200px; margin:0%;"><p><?php print "<strong>Description: </strong>".$row['description']?></p></div>
        <div class="text" style="width:200px; margin:0%;"><p><?php print "<strong>Rating: </strong>"?>4.0</p></div>

    </div>
</div>



    </form>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
crossorigin="anonymous"></script>
</body>
</html>

<?php 
}
}


?>