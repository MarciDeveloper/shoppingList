<?php
//start session management
session_start();
 //connect to the database
 require("../controller/connection.php");
 // check if the user session is set
 if(isset($_SESSION['user']) == true ) {  
    // grant access
  } else { 
    //redirect 
    header('location:login.php');
  }
   $username = $_SESSION['username'] ;
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
    <h2> Hi <?php echo "$username" ?>, this is your list</h2>
    <div class="container">
        <ul class="list-group">
                    <?php
                        // retrieve the userID logged in
                        $userID = $_SESSION['userID'];
                        //query the database
                        $sql = "SELECT * FROM shopping_items.item INNER JOIN shopping_items.sold ON shopping_items.item.itemID = shopping_items.sold.itemID WHERE shopping_items.sold.userID = $userID ";
                        //prepared statement
                        $statement = $conn->prepare($sql);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $statement->closeCursor();
                        
                        //display the category names in a hyperlink
                        foreach($result as $row): 
                            $soldID = $row['soldID'];
                            $itemID = $row['itemID']; 
                            $itemName = $row['itemName']; 
                            $itemDescription = $row['itemDescription'];
                            $itemPrice = $row['itemPrice']; 
                            $orderedQuantity = $row['orderedQuantity'];
                            $itemQuantity = $row['itemQuantity'];
                            if(!isset($_SESSION['user'])) {
                            $edit='';} else {
                            $edit =  "<p><a id='edit' href = 'editItems.php?itemName=$itemName&soldID=$soldID&orderedQuantity=$orderedQuantity&itemQuantity=$itemQuantity&itemDescription=$itemDescription&itemPrice=$itemPrice&itemID=" . $row['itemID'] . "'><i class='far fa-edit'></i> </a> <span> | </span>  <a href= '../controller/itemDelete.php?itemID=$itemID&soldID=$soldID&orderedQuantity=$orderedQuantity' ><i class='fas fa-trash-alt'></i></a></p>"; }                  
                            echo "<li class='list-group-item' ><h3>".$row['itemName']."</h3><p> " . $row['itemDescription'] . "</p><p> Quantity ordered: " . $row['orderedQuantity'] . "</p>".$edit." </li>";  
    
                        endforeach;
                     ?>
                     <?php
                        if(empty($result)) {
                            header('location: catalogue.php');
                        }
                     ?>
         </ul>
         
    </div>
    <?php       
        include("partials/footer.php");
    ?>
  