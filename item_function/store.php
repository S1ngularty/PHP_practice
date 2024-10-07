<?php 
session_start();
include("../includes/config.php");

if(!empty($_SESSION['user_id'])){
    
    try{

        $item=$_POST['item'];
       $quantity= $_POST['quantity'];
       $description=$_POST['desc'];
       $price=$_POST['price'];
       $img= $_FILES['file'];
       $allow=array('png','jpg','jpeg');
    
       $file_ext=explode('.',$img['name']);
       $extension=strtolower(end($file_ext));
    
       if(in_array($extension,$allow)){
      $newfile=uniqid('',true).".".$extension;
      $location="../shop_items/$newfile";
    
      mysqli_begin_transaction($conn);
         $sql1="INSERT INTO items (item_name,description,price,product_appearance, date_added) values ('$item','$description','$price','$newfile',now())";
       $result1= mysqli_query($conn,$sql1);
        echo "<br>$sql1";
    
         $sql2="INSERT INTO quantity (item_id,quantity) values (last_insert_id(),'$quantity')";
        $resut2=mysqli_query($conn,$sql2);
    
        echo "<br>$sql2";
    
        if(mysqli_affected_rows($conn)>0){
            move_uploaded_file($img['tmp_name'],$location);
            mysqli_commit($conn);
            print "success";
           
        
        }else{
            throw new  Exception("could'nt add the product");
        }
    
       }else{
        throw new Exception("file format is not allowed!");
       }
    
    
    }catch(Exception $e){
    mysqli_rollback($conn);
    print $e->getMessage();
    
    }


}
?>