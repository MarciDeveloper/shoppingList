<?php
//connect to the database
require('connection.php');
// Require function
require_once("../model/functions_products.php");
// Fetch the data required
$itemName = $_POST['addName'];
$itemDescription = $_POST['addDescription'];
$itemPrice = $_POST['addPrice'];
$itemQuantity = $_POST['addQuantity'];
$catID = $_POST['catID'];
$userID = $_POST['userID'];
if(empty($itemName) || empty($itemDescription) || empty($itemPrice) || empty($itemQuantity) || empty($catID) ) 
{ 
    echo '<script type="text/javascript">alert("All fields are required.")</script>' ;
     // Redirect the browser window back to the add customer page
    echo "<script>setTimeout(\"location.href = '../index.php';\",2000);</script>";
} else {
    //call the add_item() function
    $result = add_item( $itemName, $itemDescription, $itemPrice, $itemQuantity, $catID, $userID);
    // Redirect the browser window back to the add customer page
    header("location: ../index.php");
    // }
}
?>