<?php
//start session management
session_start();
 //connect to the database
 require("../controller/connection.php");
 // check if the user session is set
 if( isset($_SESSION['user']) == true ) { 
    
    // grant access
  } else { 
    //redirect 
    header('location:view/login.php');
  }
   $username = $_SESSION['username'] ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Shopping list | Home </title>
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
            <a class="navbar-brand" href="addItem.php">Add Item</a>
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
                        $sql = "SELECT * FROM shopping_items.item WHERE userID = '$userID'  ";
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
                            if(!isset($_SESSION['user'])) {
                            $edit='';} else {
                            $edit =  "<p><a id='edit' href = 'view/editItems.php?itemName=$itemName&itemDescription=$itemDescription&itemPrice=$itemPrice&itemID=" . $row['itemID'] . "'><i class='far fa-edit'></i> </a> <span> | </span>  <a href= 'controller/itemDelete.php?itemID=$itemID' ><i class='fas fa-trash-alt'></i></a></p>"; }                  
                            echo "<li class='list-group-item' ><h3>".$row['itemName']."</h3><p> " . $row['itemDescription'] . "</p><p> Quantity available: " . $row['itemQuantity'] . "</p>".$edit." </li>";  
    
                        endforeach;
                     ?>
                     <?php
                        if(empty($result)) {
                            header('location: view/addItem.php');
                        }
                     ?>
         </ul>
         
    </div>
  
    


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
