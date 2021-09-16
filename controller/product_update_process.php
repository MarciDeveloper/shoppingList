<?php
// Require database connection
require('connection.php');
// Require function
require_once("../model/functions_products.php");
// Fetch the data required
$itemID = $_GET['itemID'];
$soldID = $_GET['soldID'];
$previousQuantity = $_POST['previousQuantity'];
$itemQuantity = $_POST['itemQuantity'];
$orderedQuantity = $_POST['orderedQuantity'];
if(empty($itemQuantity)) {
   echo '<script type="text/javascript">alert("The quantity is required.")</script>' ;
   // Redirect the browser window back to the add customer page
    echo "<script>setTimeout(\"location.href = '../index.php';\",2000);</script>";
} else {
    //call the update_item() function
    $result = update_item($soldID, $itemQuantity, $orderedQuantity);
    // if statement to check if the itemQuantity is greater than ordererQuantity, remove from the inventory, otherwise, add it back to it.
    if ($itemQuantity > $orderedQuantity) {
        $sql = "UPDATE shopping_items.item SET itemQuantity = itemQuantity - ( $itemQuantity -  $previousQuantity ) WHERE itemID = $itemID";   
        $statement = $conn->prepare($sql);
        $statement->bindValue(':itemID', $itemID);
        $statement->bindValue(':itemQuantity', $itemQuantity);
        $result2 = $statement->execute();
        $statement->closeCursor();
    } elseif ($itemQuantity < $orderedQuantity) {
        $sql = "UPDATE shopping_items.item SET itemQuantity = itemQuantity + ( $previousQuantity - $itemQuantity ) WHERE itemID = $itemID";   
        $statement = $conn->prepare($sql);
        $statement->bindValue(':itemID', $itemID);
        $statement->bindValue(':itemQuantity', $itemQuantity);
        $result2 = $statement->execute();
        $statement->closeCursor();
    };
    // Redirect the browser window back to the index page
    header("location: ../index.php"); 
}
  

?>

  