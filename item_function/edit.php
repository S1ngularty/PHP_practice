<?php 
session_start();
include("../includes/config.php");
include("../includes/framework.html");

if(isset($_SESSION['user_id']) && $_SESSION['role']=='admin'){

if(isset($_POST['reset'])){
    unset($_SESSION["item_edit"]);
}

    if(isset($_POST['delete'])){
        $_SESSION['item_delete']=$_POST['delete'];
        header("location:delete.php");
        exit;
    }
    
    else if(isset($_POST['edit_id'])){
            $itemID=$_POST['edit_id'];
        $modify=[
           'item_name' =>   $_POST['item_name'][$itemID],
           'item_price' =>   $_POST['item_price'][$itemID],
           'item_qty' =>   $_POST['item_qty'][$itemID],
           'item_added' =>   $_POST['item_added'][$itemID],
           'item_rating' =>   $_POST['item_rating'][$itemID],
           'item_description' =>   $_POST['item_description'][$itemID],
           'item_img' =>   $_POST['item_appearance'][$itemID],
           'item_id' => $itemID
        ];

print "<pre>";
        print_r($_SESSION);
        print "</pre>";

    $_SESSION['item_edit']=$modify;
header("location:update.php");
exit;

    }

    $sql1="SELECT * FROM items INNER JOIN quantity using(item_id) ";
    $result=mysqli_query($conn,$sql1);
    $bg_color;
    if(mysqli_affected_rows($conn)>0){
        print "<body class='container'style='justify-content:center ; display:flex ; padding-top:50px;'>
        <div style='width:70%; justify-content:center ; display:flex ;'>
        <form action='{$_SERVER['PHP_SELF']}' method='post' style='width:100%; '>
        <table class='table' width='90%' cellpadding='6 '>
        <tr >
        <th id='header'>Product Name</th>
        <th id='header'>Product Price</th>
        <th id='header'>Product Stocks</th>
        <th id='header'>Date Added</th>
         <th id='header'>Option</th>
        </tr>";
        $c=0;
        while($row = mysqli_fetch_assoc($result)){
            $bg_color=($c++%2==1) ? 'secondary' : '';
          print "<tr class='table-$bg_color hover-secondary'>
          <td>{$row['item_name']} <input type='hidden' class='' name='item_name[{$row['item_id']}]' value='{$row['item_name']}'> </td>
          <td>{$row['price']}<input type='hidden' class='' name='item_price[{$row['item_id']}]' value='{$row['price']}'></td>
          <td>{$row['quantity']}<input type='hidden' class='' name='item_qty[{$row['item_id']}]' value='{$row['quantity']}'></td>
          <td>{$row['date_added']}<input type='hidden' class='' name='item_added[{$row['item_id']}]' value='{$row['date_added']}'></td>
         <td style='text-align:center;'><button type='submit' value='{$row['item_id']}' name='edit_id' class='btn btn-primary'>Edit</button>&nbsp;
           <button type='submit' value='{$row['item_id']}' name='delete' class='btn btn-danger'>Delete</button></td>
          </tr>
          <input type='hidden' class='' name='item_appearance[{$row['item_id']}]' value='{$row['product_appearance']}'>
          <input type='hidden' class='' name='item_description[{$row['item_id']}]' value='{$row['description']}'>
          <input type='hidden' class='' name='item_rating[{$row['item_id']}]' value='{$row['rating']}'>";
          
        }
        print "</table><input type='submit' value='unset' name='reset'>"; 
       print " </form></div></body>";
        
    }else{
        print "no item found!";
    }

}


?>
<style>
    #header{
        background-color:#212529;
        color: white;
        border: #fff thin solid;
        text-align: center;
    }

  
</style>

