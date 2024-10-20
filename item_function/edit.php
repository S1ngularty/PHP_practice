<?php 
session_start();
include("../includes/config.php");
include("../includes/framework.html");

if(isset($_SESSION['user_id']) && $_SESSION['role']=='admin'){

    if(isset($_POST['delete'])){
        $_SESSION['item_delete']=$_POST['delete'];
        header("location:delete.php");
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
          print "<tr class='table-$bg_color hover-secondary '  >
          <td>{$row['item_name']}</td>
          <td>{$row['price']}</td>
          <td>{$row['quantity']}</td>
          <td>{$row['date_added']}</td>
         <td style='text-align:center;'><button type='submit' value='edit' name='edit' class='btn btn-primary'>Edit</button>&nbsp;
           <button type='submit' value='{$row['item_id']}' name='delete' class='btn btn-danger'>Delete</button></td>
          </tr>";
        }
        print "</table> </form></div></body>";
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