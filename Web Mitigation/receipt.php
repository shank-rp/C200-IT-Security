<?php
session_start();
include "dbFunctions.php";
$_SESSION['user_id'] = 2;
$_SESSION['role'] = "user";
?>

<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gottem - Home</title>
    <style>
        .logo{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .button{
            background-color: #008CBA;
            color: white;
            font-size: 16px;
            width: 250px;
            font-size: 25px;
        }
        table{
            margin-left:auto;
            margin-right:auto;
        }
        h2{
            text-align:center;
        }
    </style>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Collect Your Receipt!</title>
    </head>
    <body>
        
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['role']=="user"){
            ?>
            <a href="receipt.php" ><img src="logo/gottemlogo.png" width="500" height="150" class="logo"/></a><br/>
            <form method="post" >
                <table>
                    <tr>
                        <td><input type="submit" value="Email My Receipt" name="submit" class="button"/><br/><br/></td>
                    </tr>
                </table>

                <?php
                if(isset($_POST['submit'])){

                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT username FROM account where user_id = $user_id";
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    mysqli_close($link);

                    $row = mysqli_fetch_assoc($result);

                    $cmd = shell_exec("python sql_email.py " . $row["username"]);
                    echo "<h2><pre>{$cmd}</pre></h2>";
                }
                ?>

            </form>
            <?php
        } else {
            include "invalid.php";
        }
        ?>
            
    </body>
</html>