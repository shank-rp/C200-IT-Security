<?php
include "dbFunctions.php";

session_start();
//$_SESSION['user_id'] = 1;
//$_SESSION['role'] = "admin";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gottem - Add Items!</title>
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
        <a href="home.php" ><img src="logo/gottemlogo.png" class="logo"/></a><hr/>
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['role']=="admin"){ ?>
            <div>
                <form method="post" enctype="multipart/form-data">
                    <label class="label">Add item!</label><br/><br/>
                    <label>Item Name:</label>
                    <input type="text" name="item_name" style="width:230px;" required/>
                    <label>Item Price:</label>
                    <input type="number" name="price" style="width:230px;" required/><br/><br/>
                    <label>Description:</label>
                    <textarea cols="30" rows="5" name="desc" required></textarea>
                    <input type="file" name="item_pic" required style="margin-left: 350px"/><br/><br/>
                    <input type="submit" value="Post item!" name="submit" class="button"/><br/><br/>
                    
                    <?php
                    if(isset($_POST['submit'])){
                            
                        $targetPath = "itempic/";
                        $fileName = basename($_FILES['item_pic']['name']);
                        $completePath = $targetPath . $fileName;

                        $exten = explode(".",$fileName);
                        $exten = strtolower(end($exten));
                        
                        if ($exten == 'jpg' || $exten == 'jpeg'){
                            if (move_uploaded_file($_FILES['item_pic']['tmp_name'], $completePath)){

                                $item_name = $_POST["item_name"];
                                $price = $_POST["price"];
                                $desc = $_POST["desc"];

                                $query = "INSERT INTO product
                                          VALUES ('', '$item_name', '$desc', $price, '$fileName')";
                                $result = mysqli_query($link, $query);
                                mysqli_close($link);
                                
                                if ($result){
                                    echo "<h4>Published</h4>";
                                }else{
                                    echo "<h4>An error has occured</h4>";
                                }
                            }else{
                                echo "<h4>An error has occured</h4>";
                            }
                        }else{
                            echo "Only JPEG filetype accepted";
                        }
                    } ?>
                </form>
            </div>
            <?php
        } else {
            include "invalid.php";
        } ?>     
    </body>
</html>