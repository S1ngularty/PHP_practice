<?php 
session_start();
include "../includes/config.php";
include "../structure/header.html";

if(isset($_SESSION['user_id']) && isset($_SESSION['role'])=='admin'){

    $sql="SELECT * FROM customer_carts";
    $result=mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn)>0){
        print"<div style='margin: 50px;'>
        <table width='50%' cellpadding='6' class='table'> 
        <tr>
        <th>Customer ID </th>
        <th>First name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>Account </th>
        <th>Product Ordered</th>
        <th>Product Price</th>
        <th>Date Item Placed</th>

        </tr>";
        $c=0;
        while($row= mysqli_fetch_assoc($result)){
            $bg_color=  ($c++%2==1)? 'primary' : 'info';
            print "<tr class='table border'>
            <td>{$row['Customer_id']}</td>
            <td>{$row['firstname']}</td>
            <td>{$row['lastname']}</td>
            <td>{$row['gender']}</td>
            <td>{$row['account']}</td>
            <td>{$row['product_ordered']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['item_placed']}</td>
            </tr>";
        }
        print " </table>
        </div>";
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
    tr{
        text-align: center;
    }
</style>
<body>
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php 
}

?>