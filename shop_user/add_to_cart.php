<?php 
session_start();
include("../structure/shopheader.html");
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
    if(isset($_POST['product_id'])){
    foreach($_POST as $key => $value){
$ordered_product[$key] = $value;
    }

    // print_r($ordered_product);
 
    if(isset($_SESSION['cart'][$ordered_product['product_id']])){
        unset($_SESSION['cart'][$ordered_product['product_id']]);
    $_SESSION['cart']=array_filter($_SESSION['cart']);
}
$_SESSION['cart'][$ordered_product['product_id']]=$ordered_product;

    
    print "<pre>";
    print_r($_SESSION['cart']);
    print "</pre>";
    header("location:../shop.php");
exit;
}
}

?>