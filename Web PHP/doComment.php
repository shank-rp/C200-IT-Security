<?php
session_start();
include "dbFunctions.php";

$user_id=$_SESSION['user_id'];
$itemID=$_GET['id'];
$review=$_SESSION['review'];

$queryReview="INSERT INTO review(review, user_id, product_id)
                VALUES ('$review', '$user_id', '$itemID')";
$resultReview= mysqli_query($link, $queryReview) or die('Error querying database');

if($resultReview){
    $_SESSION['review']="success";
}else{
    $_SESSION['review']="fail";
}

header("Location: details.php?id=$itemID");
?>