<?php
// Create a function to update the item
function update_item($soldID, $itemQuantity, $orderedQuantity)
{
  global $conn;
  $sql = "UPDATE shopping_items.sold SET orderedQuantity = :itemQuantity WHERE soldID = :soldID";
  $statement = $conn->prepare($sql);
  $statement->bindValue(':soldID', $soldID);
  $statement->bindValue(':itemQuantity', $itemQuantity);
  $result = $statement->execute();
  $statement->closeCursor();
  return $result;
}

?>

<?php
//create a function to add a new product
function add_item( $itemID, $userID, $orderedQuantity)
{
    global $conn;
    $sql = "INSERT INTO shopping_items.sold ( itemID, userID, orderedQuantity) VALUES ( :itemID, :userID, :orderedQuantity)";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':itemID', $itemID);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':orderedQuantity', $orderedQuantity);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
  
}

?>

<?php
//create a function to delete an existing product
function delete_item($soldID)
{
    global $conn;
    $sql = "DELETE FROM shopping_items.sold WHERE soldID = :soldID ";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':soldID', $soldID);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;		
}








