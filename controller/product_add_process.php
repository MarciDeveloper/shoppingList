<?php
//connect to the database
require('connection.php');
// Require function
require_once("../model/functions_products.php");
// Fetch the data required
// $itemName = $_GET['itemName'];
// $itemDescription = $_GET['itemDescription'];
// $itemPrice = $_GET['itemPrice'];
$orderedQuantity = $_POST['quantity'];
// $catID = $_POST['catID'];
$itemID = $_GET['itemID']; 
$userID = $_GET['userID'];
if( empty($orderedQuantity)  ) 
{ 
    echo '<script type="text/javascript">alert("The quantity is required.")</script>' ;
     // Redirect the browser window back to the add customer page
    echo "<script>setTimeout(\"location.href = '../view/catalogue.php';\",2000);</script>";
} else {
    //call the add_item() function
    $result = add_item( $itemID, $userID, $orderedQuantity);
    // Remove the quantity ordered from the stock available
    $sql = "UPDATE shopping_items.item SET itemQuantity = itemQuantity - $orderedQuantity WHERE itemID = $itemID";   
    $statement = $conn->prepare($sql);
    $statement->bindValue(':itemID', $itemID);
    $statement->bindValue(':orderedQuantity', $orderedQuantity);
    $result2 = $statement->execute();
    $statement->closeCursor();
    // Redirect the browser window back to the add customer page
    // echo "<script>window.location.href=../index.php </script>";
    header("location: ../index.php");
    // }
}

?>