<?php
//start session management
session_start();
 //connect to the database
 require("controller/connection.php");
 // check if the user session is set
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
    <link rel="stylesheet" href="view/css/shopping.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">My Shopping list</a>
            <?php
        if( isset($_SESSION['user']) == true ) { 
            // grant access to the authorised areas if logged in
           echo "<a href='view/shop.php' type='button' class='btn btn-secondary'><i class='fas fa-shopping-cart'></i></a> ";
           echo "<a class='navbar-brand' href='view/addItem.php'>Add Item</a>";
        }
        ?>
            <a class="navbar-brand" href="view/login.php">Login</a>
            <a class="navbar-brand" href="view/destroy.php">Logout</a>
        </div>
    </nav>
    <div class="container" id="intro">
        <div class="card" id=beginCard>
            <div class="card-body">
                <h2 class="card-title" style="color: #0d6efd"> My Shopping list</h2>
                <p class="card-text">Play around with the shopping list</p>
                 <p class="card-text">Register Add, remove, and Edit items</p>
                 <?php
                 if( isset($_SESSION['user']) == true ) { 
            // grant access to the authorised areas if logged in
            echo "<a href='view/shop.php' type='button' class='btn btn-secondary'>List</a> ";
        } else {
            echo "<a href='view/login.php' type='button' class='btn btn-secondary'>Login</a> ";
        }
        ?>
            
            </div>
            
        </div>
      
    </div>
    


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
