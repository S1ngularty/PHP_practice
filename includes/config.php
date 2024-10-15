<?php

try{
    $conn=mysqli_connect('localhost','root','','user_accounts');
if(!$conn){
    throw new Exception("Connect to the database first!");
}
}catch(Exception $e){
    print $e->getMessage();
}


?>  