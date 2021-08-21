<?php
session_start();
include "dbFunctions.php";

$user_id=$_SESSION['user_id'];
$newPassword=$_GET['newPassword'];


$queryNewPassword="UPDATE account SET password = SHA1('$newPassword') WHERE user_id = ('$user_id')";
$resultPassword =mysqli_query($link, $queryNewPassword) or die('Error querying database');

if($resultPassword){
    $_SESSION['newPassword']="success";
    
}else{
    $_SESSION['newPassword']="fail";
}

header("Location: password.php");
?>
