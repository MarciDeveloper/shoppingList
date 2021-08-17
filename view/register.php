<?php
//start session management
session_start();
 //connect to the database
 require("../controller/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Shopping list | Register </title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">	
    <link rel="stylesheet" href="css/shopping.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
    <!-- As a link -->
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">My Shopping list</a>
            <a class="navbar-brand" href="shop.php"><i class="fas fa-shopping-cart"></i></a>
            <a class="navbar-brand" href="addItem.php">Add Item</a>
            <a class="navbar-brand" href="destroy.php">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="card" id="loginCard">
            <form id="registerForm" action="../controller/register_process.php" method="post">
                <h3 class="card-title">Register your profile</h3>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" name="firstName" class="form-control" id="firstName" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div> -->
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            </div>
        </div>
   </div>

   <?php       
        include("partials/footer.php");
    ?>
  