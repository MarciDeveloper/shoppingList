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
    <title> My Shopping list | Login </title>
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
            <?php
        if( isset($_SESSION['user']) == true ) { 
            // grant access to the authorised areas if logged in
           echo "<a href='shop.php' type='button' class='btn btn-secondary'><i class='fas fa-shopping-cart'></i></a> ";
           echo "<a class='navbar-brand' href='addItem.php'>Add Item</a>";
        }
        ?>
            <a class="navbar-brand" href="destroy.php">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="card" id="loginCard">
            <form id="loginForm" action="../controller/authentication.php" method="post">
                <h3 class="card-title">Welcome back, please Login</h3>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" 
                    <?php if (isset($_COOKIE['remember_me'])) {echo "value='$_COOKIE{'remember_me'}'";} else {echo "value=''";} ?> required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember" value="1">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                <hr>
                <p>Do you need to <a href="register.php">register?</a></p>
            </form>
            </div>
            <br>
            <?php
                if(isset($_GET['mssg'])) {
                    $mssg = $_GET['mssg'];
                    echo '<p style="color:red;text-align:center; text-shadow: 1px 1px black;">' . $mssg . '</p>';
                   
                }
            ?>
            <br>

            
            
            <?php
                    //display a user message if there is an error
                    if(isset($_SESSION['error']))
                    { 
                        echo '<div class="error">';
                        echo '<p style="color:red;text-align:center; text-shadow: 1px 1px black;"><i class="far fa-thumbs-down"></i>' . $_SESSION['error'] . '</p>'; 
                        echo '</div>';
                        //unset the session named 'error' else it will show each time you visit the page
                        unset($_SESSION['error']);
                    }
                    //display a user message if action is successful
                    elseif(isset($_SESSION['success'])) 
                    { 
                        echo '<div class="success">';
                        echo '<p style="color:green;text-align:center;  text-shadow: 1px 1px black;"><i class="far fa-thumbs-up"></i>' . $_SESSION['success'] . '</p>'; 
                        echo '</div>';
                        //unset the session named 'success' else it will show each time you visit the page
                        unset($_SESSION['success']);
                    } 
           ?>
        </div>
   </div>
   <?php       
        include("partials/footer.php");
    ?>
  