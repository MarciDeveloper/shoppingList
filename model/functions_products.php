<?php
function update_item($itemID, $itemName,  $itemDescription, $itemPrice)
{
  global $conn;
  $sql = "UPDATE shopping_items.item SET itemName = :itemName, itemDescription = :itemDescription, itemPrice = :itemPrice WHERE itemID = :itemID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':itemID', $itemID);
  $statement->bindValue(':itemName', $itemName);
  $statement->bindValue(':itemDescription', $itemDescription);
  $statement->bindValue(':itemPrice', $itemPrice);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

?>

<?php
//create a function to add a new product
function add_item( $itemName, $itemDescription, $itemPrice, $itemQuantity, $catID, $userID)
{
    global $conn;
    $sql = "INSERT INTO shopping_items.item ( itemName, itemDescription, itemPrice, itemQuantity, catID, userID) VALUES ( :itemName, :itemDescription, :itemPrice, :itemQuantity, :catID , :userID)";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':itemName', $itemName);
    $statement->bindValue(':itemDescription', $itemDescription);
    $statement->bindValue(':itemPrice', $itemPrice);
    $statement->bindValue(':itemQuantity', $itemQuantity);
    $statement->bindValue(':catID', $catID);
    $statement->bindValue(':userID', $userID);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;   
}

?>

<?php
//create a function to delete an existing product
function delete_item($itemID)
{
    global $conn;
    $sql = "DELETE FROM shopping_items.item WHERE itemID = :itemID ";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':itemID', $itemID);
    
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;		
}








