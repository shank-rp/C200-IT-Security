<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gottem - Collect Your Receipt!</title>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
        <style>
            label{
                width:330px;
                text-align:right;
                font-weight: bold;
                color: peru;
                font-size: 20px;
            }
            .button{
                margin-left: 350px;
            }
        </style>
    </head>
    <body>
        <a href="login.php" ><img src="logo/gottemlogo.png" class="logo"/></a><hr/>
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['role']=="user"){
            ?>
            <div>
                <form method="post" >
                    <label class="label">Get Receipt!</label><br/><br/>
                    <label for="idUsername">Username:</label>
                    <input type="text" id="idUsername" name="username" maxlength="32" required/><br/>
                    <input type="submit" value="Email Me" name="submit" class="button"/>
                    
                    <?php
                    if(isset($_POST['submit']) && !(strlen($_POST["username"]) > 32)){
                        $username = $_POST['username'];
                        $cmd = shell_exec("python3 sql_email.py " . $_POST["username"]);
                        echo "<h3><pre>{$cmd}</pre></h3>";
                    }?>
                </form>
            </div>
            <?php
        } else {
            include "invalid.php";
        } ?>
    </body>
</html>