<!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gottem - Login</title>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
        <style>
            label{
                width:330px;
                text-align:right;
                margin:6px;
                font-weight: bold;
                color: sienna;
            }
            p{
                text-align: center;
                margin:auto;
                font-size: 15px;
            }
            .button{
                width: 80px;
            }
        </style>
    </head>
    <body>
        <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                header("Location: home.php");
            } else{
                ?>
                <img src="logo/gottemlogo.png" class="logo"/><hr/>
                <div>
                    <form method="post" action="doLogin.php">
                        <label class="label">Log in!</label><br/><br/>
                        <label for="idUsername">Username:</label>
                        <input type="text" id="idUsername" name="username"/><br/>
                        <label for="idPassword">Password:</label>
                        <input type="password" id="idPassword" name="password"/>
                        <input type="submit" value="Login" name="submit" class="button"/><br/><br/><hr/>
                        
                        <?php
                        if (isset($_SESSION['check'])) {
                            if ($_SESSION['check'] == "wrong"){
                                $_SESSION['check'] = "correct";
                                $msg = "Invalid username or password. Please try again."; ?>
                                <p style="color: red;"><?php echo $msg; ?></p><br/>
                            <?php
                            }
                        } ?>
                                
                        <p>Don't have an account? Create account <a href="home.php">here</a></p>
                    </form>
                </div>
                <?php
            }
            ?>
    </body>
</html>
