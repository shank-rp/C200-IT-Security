<?php
session_start();
?>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gottem - Change Password</title>
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
        if (isset($_SESSION['user_id']) && $_SESSION['role']=="admin"){ ?>
            <div>
                <form method="post" action="doPassword.php">
                    <label class="label">Change Password</label><br/><br/>
                    <label for="idNewPass">Enter your new password:</label>
                    <input type="text" id="idNewPass" name="newPassword"/><br/>
                    <input type="submit" value="Change" name="update" class="button"/><br/><br/><hr/>
                    <?php
                    if(isset($_POST['newPassword'])){
                        $_SESSION['newPassword']= "";
                        header("Location: doPassword.php");
                    }

                    if (isset($_SESSION['newPassword'])) {
                        $msg="";
                        if ($_SESSION['newPassword'] == "success"){
                            $msg = "Password changed!";
                        }
                        if ($_SESSION['newPassword'] == "fail"){
                            $msg = "Unable to change password.";
                        } ?><p><?php echo $msg; ?></p><br/>
                    <?php
                } 
                ?>
                </form>
            </div>
        <?php
        } else {
            include "invalid.php";
        } ?> 
    </body>
</html>