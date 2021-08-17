<?php
//start session management
session_start();
 //connect to the database
 require("../controller/connection.php");
// check if the user session is set
if(!isset($_SESSION['user']))
{
    // message to be displayed if the user is not logged in and try to access authorised areas
    $mssg = urlencode('Please register to access authorised areas');
     //if the user session is not set (i.e. the user is not logged in) redirect to the login page and display the error message
    header('location:login.php?mssg='.$mssg);
    }
    $username = $_SESSION['username'] ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Shopping list | Edit </title>
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
    <h2> <?php echo "$username" ?>, you can edit your items here</h2>
    <?php
        // require_once("../controller/connection.php");
        //retrieve the Category_ID from the URL
        $itemID = $_GET['itemID'];
        $itemName = $_GET['itemName'];
        $itemDescription = $_GET['itemDescription'];
        $itemPrice = $_GET['itemPrice'];
        // $itemPhoto = $_GET['itemPhoto'];
        global $conn;
        //query to select all categories from the database
        $sql = "SELECT * FROM shopping_items.item WHERE itemID =$itemID  ";
        //prepared statement
        $statement = $conn->prepare($sql);
        $statement->bindValue(':itemID', $itemID);
        $statement->bindValue(':itemName', $itemName);
        $statement->bindValue(':itemDescription', $itemDescription);
        $statement->bindValue(':itemPrice', $itemPrice);
        $statement->execute();
        $result1 = $statement->fetchAll();		
        $statement->closeCursor();
    ?>
    <div class="card">   
    <img class="card-img-top" src="images/grace-o-driscoll-_ODVlLRQoTk-unsplash.jpg" alt="Card image cap">
    <div class="container">
        <div class="card-body">
            <h3 class="card-title">Edit your item</h3>
            <br>
            <form class="card-text" action="../controller/product_update_process.php?itemID=<?php echo $itemID ?>" method="post">
                <div>
                    <label>Name* </label>
                    <input id="itemName" type="text" name="itemName" value="<?php echo $_GET['itemName'] ?>" required />
                </div>
                <div>
                    <label>Description* </label>
                    <textarea id="itemDescription" name="itemDescription" required /><?php echo $_GET['itemDescription'] ?></textarea>
                </div>
                <div>
                    <label>Price* </label>
                    <input id="itemPrice" type="text" name="itemPrice" value="<?php echo $_GET['itemPrice'] ?>" required />
                </div>
                <br>
                <div id="submit">
                            <input type="submit" value="Submit">
                </div>
            </form>
        </div>
   
   </div> 
    </div>
    <?php       
        include("partials/footer.php");
    ?>