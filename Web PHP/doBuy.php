<?php
session_start();
include "dbFunctions.php";

$user_id=$_SESSION['user_id'];
$itemID=$_GET['id'];

$queryBuy="INSERT INTO receipt(date, user_id, product_id)
                VALUES (CURDATE(), '$user_id', '$itemID')";
$resultBuy= mysqli_query($link, $queryBuy) or die('Error querying database');

if($resultBuy){
    $_SESSION['purchase']="success";
}else{
    $_SESSION['purchase']="fail";
}

header("Location: details.php?id=$itemID");
?>