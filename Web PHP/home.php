<?php
session_start();
// php file that contains the common database connection code
include "dbFunctions.php";

if (isset($_GET['searchContain'])){
    $searchContain = $_GET['searchContain'];
}else{
    $searchContain = "";
}

$queryItems = "SELECT * FROM product WHERE description LIKE '%$searchContain%' ORDER BY item_name";

$resultItems = mysqli_query($link, $queryItems) or
        die(mysqli_error($link));

while ($row = mysqli_fetch_assoc($resultItems)) {
    $arrItems[] = $row;
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gottem - Home</title>
        <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
        <style>
            form{
                font-size: 20px; 
                font-weight: bold;
                color: peru;
                margin-left: 10px;
                display: inline;
            }
        </style>
    </head>
    <body>
        <a href="login.php" ><img src="logo/gottemlogo.png" class="logo"/></a><hr/>
        <?php
        if (isset($_SESSION['user_id'])){ ?>
            <div>
                <form method="get" action="home.php">
                    <label style="width: inherit;">Search: </label>
                    <input type="text" name="searchContain"/>
                    <input type="submit" value="Search" class="button"/>
                </form>
                <?php
                if (isset($_SESSION['user_id'])){
                    if ($_SESSION['role'] == "admin"){ 
                        ?> 
                        <form method="post" action="adminAdd.php">
                            <input type="submit" value="Add item!" class="button"/></form>
                        </form>
                        <?php
                    }else if ($_SESSION['role'] == "user"){ 
                        ?>      
                        <form method="post" action="receipt.php">
                            <input type="submit" value="Get Receipt!" class="button"/></form>
                        </form>
                        <?php 
                    } ?>
                    <form method="post" action="password.php">
                        <input type="submit" value="Change password" class="button"/></form>

                    <form method="post" action="logout.php">
                        <input type="submit" value="Logout" class="button"/></form>
                <?php
                } ?>
                            
                <?php
                if (empty($arrItems)){
                    echo "<h1 class='invalid'>No Results</h1>";
                }else{
                    for ($i = 0; $i < count($arrItems); $i++) {
                    $itemID = $arrItems[$i]['product_id'];
                    $itemName = $arrItems[$i]['item_name'];
                    $desc = $arrItems[$i]['description'];
                    $price = $arrItems[$i]['price'];
                    $image = $arrItems[$i]['image']; ?>
                    <table>
                        <tr>
                            <td rowspan="3"><label><a href="details.php?id=<?php echo $itemID; ?>"><img src="itempic/<?php echo $image ?>" class="image"/></a></label></td>
                            <td><label class="itemName"><a href="details.php?id=<?php echo $itemID; ?>" style="text-decoration: none; color: sienna;"><?php echo $itemName ?></a></label></td>
                        </tr>
                        <tr>
                            <td><label class="itemDetails"><?php echo $desc ?></label></td>
                            <td><label class="price"><i>$<?php echo $price; ?></i></label><br/></td>
                        </tr>
                        <tr><td class="hide">‎‏‏‎ ‎</td></tr>
                    </table> 
                <?php
                } 
            }?>
            </div>
            <?php
        } else {
            include "invalid.php";
        } ?>
    </body>
</html>