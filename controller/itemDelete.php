<?php
// start session management
session_start();
// Require database connection
require('connection.php');
// check if the session user is set
if(!isset($_SESSION['user']))
{
    // message to be displayed if the user is not logged in and try to access authorised areas
    $mssg = urlencode('Please register to access authorised areas');
    //if the user session is not set (i.e. the user is not logged in) redirect to the login page and display the error message
    header('location:../view/login.php?mssg='.$mssg);
    } else {
        require_once("../model/functions_products.php");
    // Fetch the data required
    $itemID = $_GET['itemID'];
    $soldID = $_GET['soldID'];
    $orderedQuantity = $_GET['orderedQuantity'];
    //call the delete_item() function
    $result = delete_item($soldID);
    if(!$result) {
    echo ("Query error: " . mysqli_error($conn));
    exit;
    }
    else {
         // Remove the quantity ordered from the stock available
    $sql = "UPDATE shopping_items.item SET itemQuantity = itemQuantity + $orderedQuantity WHERE itemID = $itemID";   
    $statement = $conn->prepare($sql);
    $statement->bindValue(':itemID', $itemID);
    $statement->bindValue(':orderedQuantity', $orderedQuantity);
    $result2 = $statement->execute();
    $statement->closeCursor();
    // Redirect the browser window back to the add customer page
    header("location: ../index.php");
    }
    }


?>