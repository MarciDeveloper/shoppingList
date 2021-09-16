<?php
//start session management
session_start();
 //connect to the database
 require("../controller/connection.php");
 // check if the user session is set
//  if(isset($_SESSION['user']) == true ) {  
//     // grant access
//   } else { 
//     //redirect 
//     header('location:login.php');
//   }
//    $username = $_SESSION['username'] ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Shopping list | Shop </title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
    <link rel="stylesheet" href="css/shopping.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <!-- <h1 id= head> My Shopping list</h1> -->
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">My Shopping list</a>
            <a class="navbar-brand" href="shop.php"><i class="fas fa-shopping-cart"></i></a>
            <a class="navbar-brand" href="catalogue.php">Catalogue</a>
            <a class="navbar-brand" href="login.php">Login</a>
            <a class="navbar-brand" href="destroy.php">Logout</a>
        </div>
    </nav>
    <h2> Check our catalogue</h2>
    <div class="container">
        <ul class="list-group">
                    <?php
                        // retrieve the userID logged in
                        if(isset($_SESSION['user']) == true ) {  
                            $userID = $_SESSION['userID'];
                              } else {
                                $userID = '';   
                              };
                        //query the database
                        $sql = "SELECT * FROM shopping_items.item ";
                        //prepared statement
                        $statement = $conn->prepare($sql);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $statement->closeCursor();
                        
                        //display the category names in a hyperlink
                        foreach($result as $row): 
                            $itemID = $row['itemID']; 
                            $itemName = $row['itemName']; 
                            $itemDescription = $row['itemDescription'];
                            $itemPrice = $row['itemPrice']; 
                            $itemQuantity = $row['itemQuantity'];
                            if($itemQuantity === 0) {
                                $button =  "<button class='submit_item' type='submit' disabled><a id='edit' href = '../controller/product_add_process.php?userID=$userID&itemID=" . $row['itemID'] . "'><i style='color:grey' class='fas fa-plus-circle'></i> </a></button>;";
                            } else {
                                $button = "<button class='submit_item' type='submit' ><a id='edit' href = '../controller/product_add_process.php?userID=$userID&itemID=" . $row['itemID'] . "'><i class='fas fa-plus-circle'></i> </a></button>";
                            };
                            if(!isset($_SESSION['user'])) {
                            $add='';} else {
                            $add =  "<form method='POST' action='../controller/product_add_process.php?userID=$userID&itemID=" . $row['itemID'] . "'> 
                            <label for='quantity'>Quantity needed:</label>
                            <input type='number' id='quantity' name='quantity' min='1' max='$itemQuantity'>
                            <br>
                            <br>
                            $button
                            </form> "; }                  
                            echo "<li class='list-group-item' ><h3>".$row['itemName']."</h3><p> " . $row['itemDescription'] . "</p><p> Quantity available: " . $row['itemQuantity'] . "</p>
                            ".$add."
                            </li>";  
                        endforeach;
                     ?>
                     <?php
                        if(empty($result)) {
                            header('location: addItem.php');
                        }
                     ?>
         </ul>
         
    </div>
    <?php       
        include("partials/footer.php");
    ?>
  