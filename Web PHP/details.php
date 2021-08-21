<!DOCTYPE html>
<?php 
session_start();
include "dbFunctions.php";

$itemID=$_GET['id'];

$itemQuery = "SELECT * FROM product WHERE product_id = $itemID";
$itemResult = mysqli_query($link, $itemQuery) or die(mysqli_error($link));
$itemRow = mysqli_fetch_array($itemResult);
if(!empty($itemRow)){
    $itemName=$itemRow['item_name'];
    $desc=$itemRow['description'];
    $price=$itemRow['price'];
    $image=$itemRow['image'];
}

$reviewQuery = "SELECT r.review, a.username FROM review r
        INNER JOIN product p ON p.product_id=r.product_id 
        INNER JOIN account a ON r.user_id=a.user_id 
        WHERE p.product_id = $itemID";
$reviewResult = mysqli_query($link, $reviewQuery) or die(mysqli_error($link));
while ($reviewRow = mysqli_fetch_array($reviewResult)) {
    $arrReview[]=$reviewRow;
} 
mysqli_close($link);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gottem - Item Details</title>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
        <style>
            label{
                text-align: center;
                width: 300px;
            }
            .button{
                float: right;
                margin-right: 200px;
                font-size: 20px;
            }
            div.reviews{
                width: 700px;
                margin-left: 50px;
            }
            p{
                color: maroon;
            }
        </style>
    </head>
    <body>
        <a href="login.php" ><img src="logo/gottemlogo.png" class="logo"/></a><hr/>
        <?php
        if (isset($_SESSION['user_id'])){ ?>
            <div>
                <form name="buyProduct" method="post">
                    <table>
                        <tr>
                            <td rowspan="3"><label><img src="itempic/<?php echo $image ?>" class="image"/></label></td>
                            <td><label class="itemName"><?php echo $itemName ?></label></td>
                        </tr>
                        <tr>
                            <td><label class="itemDetails"><?php echo $desc ?></label></td>
                        <tr>
                            <td><label class="price"><i>$<?php echo $price; ?></i></label></td>
                        </tr>
                    </table>
                    <label><b>One-Size</b></label>
                    
                    <?php
                    if ($_SESSION['role'] == "user"){
                    ?>
                   
                    <input type="submit" name="buy" value="Buy item" class="button"/><br/><br/><br/>
                    
                    <?php
                        if(isset($_POST['buy'])){
                            header("Location: doBuy.php?id=$itemID");
                        } 
                        if (isset($_SESSION['purchase'])) {
                            $msg="";
                            if ($_SESSION['purchase'] == "success"){
                                $_SESSION['purchase'] = "";
                                $msg = "Successfully purchased item.";
                            }
                            if ($_SESSION['purchase'] == "fail"){
                                $_SESSION['purchase'] = "";
                                $msg = "Purchase failed. Please try again.";
                            } ?><p style="margin-left: 470px"><?php echo $msg; ?></p><br/>
                            <?php
                        } ?>

                    </form>

                    <div class="reviews"><p style="font-size: 22px; font-weight: bold">Reviews:</p>
                    <form name="reviewProduct" method="post">
                        <i>Wish to leave a review?</i><br/>
                        <textarea name="reviewPara" cols="50" rows="3"></textarea>
                        <input type="submit" name="review" value="Post!" class="button" style="margin-right: 200px;"/><br/>

                        <?php
                        if(isset($_POST['review'])){
                            $_SESSION['review']=$_POST['reviewPara'];
                            header("Location: doComment.php?id=$itemID");
                        }
                        if (isset($_SESSION['review'])) {
                            $msg="";
                            if ($_SESSION['review'] == "success"){
                                $_SESSION['review'] = "";
                                $msg = "Review posted!";
                            }
                            if ($_SESSION['review'] == "fail"){
                                $_SESSION['review'] = "";
                                $msg = "Unable to post review.";
                            } ?><p><?php echo $msg; ?></p><br/>
                        <?php
                    } 
                    }
                    ?>
                </form><hr/><br/>

                <?php
                if(isset($arrReview)){
                    for($i=0;$i<count($arrReview);$i++){
                    $username=$arrReview[$i]['username'];
                    $review=$arrReview[$i]['review'];
                    echo "<b style='text-transform: uppercase; font-size:18px'>".$username.": </b><i>".$review."</i><br/><br/>";
                    }
                }else{
                    echo "<b>Be the first to leave a review!<b/>";
                } ?>
                </div>
            </div>
            <?php
        } else {
            include "invalid.php";
        } ?>
    </body>
</html>
