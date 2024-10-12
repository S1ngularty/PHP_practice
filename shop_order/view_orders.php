<?php 
session_start();
include("../structure/shopheader.html");
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
 
    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){ //cart view
        print "cart have some items";
       print "<div class='container' id='view-cart' >";
       echo '<h3>Your Shopping Cart</h3>';
          echo '<form method="POST" action="view_orders.php">';
          echo '<table width="50%"  cellpadding="6" class="table">';
       print "<tbody>";
       $c=0;
       $total=0;
      foreach($_SESSION['cart'] as $ordered){
        $item_name = $ordered['product_name'];
        $item_price = $ordered['product_price'];
        $item_quantity = $ordered['product_quantity'];
        $item_id = $ordered['product_id'];
        $bg_color=($c++%2==1)? 'primary' : 'info';
      print "<tr class='table-$bg_color'><td> $item_name </td>";
      print "<td class='table-$bg_color'>Quantity:<input type='number' size='2' maxlength='2' name='item_quantity[$item_id]' value='$item_quantity'> </td>";
      print "<input type='hidden' name='qty[$item_id]' value='$item_quantity'>";
      print "<td> Price:<i> $item_price</i> </td>";
      $total=($item_price * $item_quantity);
      print "<td>Total:<i> $total</i> </td>";
      print "<td class='table-$bg_color'><button class='btn btn-warning hover-danger' name='product_remove' value='$item_id'>Remove</button></td></tr>";
      }
      
          print "</tbody></table>
          </form></div>";

      }

        if(!empty($_POST['product_remove'])){
                unset($_SESSION['cart'][$_POST['product_remove']]);   
                header("Location: " . $_SERVER['PHP_SELF']);
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
<style>
.hover-danger:hover{
    background-color: #dc3545;
    border-color: #dc3545;
    color: #fff;
}

</style>
<body>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>