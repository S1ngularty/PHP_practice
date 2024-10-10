<?php 
session_start();
include("../structure/shopheader.html");
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
    if(isset($_POST['item_id']))
    foreach($_POST as $key => $value){
$ordered_product[$key] = $value;
    }

    // print_r($ordered_product);

if(isset($_SESSION['cart'])){
    if(isset($_SESSION['cart'][$ordered_product['item_id']]))
  unset($_SESSION['cart'][$ordered_product['item_id']]);

}
$_SESSION['cart'][$ordered_product['item_id']]=$ordered_product;

 print_r($_SESSION['cart']);
}
?>