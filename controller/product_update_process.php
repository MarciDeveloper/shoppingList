
<?php
// Require database connection
require('connection.php');
// Require function
require_once("../model/functions_products.php");
// Fetch the data required
$itemID = $_GET['itemID'];
$itemName = $_POST['itemName'];
$itemDescription = $_POST['itemDescription'];
$itemPrice = $_POST['itemPrice'];
// check if all the fields are filled
if(empty($itemName) || empty($itemDescription) || empty($itemPrice)) {
   echo '<script type="text/javascript">alert("All fields are required.")</script>' ;
   // Redirect the browser window back to the add customer page
    echo "<script>setTimeout(\"location.href = '../index.php';\",2000);</script>";
} else {
    //call the update_item() function
    $result = update_item($itemID, $itemName,  $itemDescription, $itemPrice);
    // Redirect the browser window back to the admin page
    header("location: ../index.php"); 
}
  

?>

  