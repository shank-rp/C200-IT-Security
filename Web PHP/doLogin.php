<?php
session_start();
// php file that contains the common database connection code
include "dbFunctions.php";

$msg = "";
$username = $_POST['username'];
$password = $_POST['password'];

//match the username and password entered with database record
$query = "SELECT user_id,username,role FROM account 
      WHERE username='$username' AND password = SHA1('$password')";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
        
//if record is found, store id and username into session
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['username'] = $row['username'];
    header("Location: home.php");
        
} else {
    $_SESSION['check'] = "wrong";
    header("Location: login.php");
}
?>