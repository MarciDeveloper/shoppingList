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
    <title> Shopping list | Add </title>
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
    <h2> <?php echo "$username" ?>, you can add items to your list</h2>
    <?php
            //create a function to retrieve data for the category dropdown menu
            function get_category_dropdown()
            {
                global $conn;		
                $sql = 'SELECT * FROM shopping_items.category ORDER BY catID ';	
                //use a prepared statement to enhance security
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetchAll();
                $statement->closeCursor();
                return $result;
            }
         ?>
         <!-- <?php
            $userID = $_SESSION['userID'];
            echo $userID;
         ?> -->
    <div class="card" >   
    <img class="card-img-top" src="images/maria-lin-kim-8RaUEd8zD-U-unsplash.jpg" alt="Card image cap">
    <div class="container">
        <div class="card-body">
            <h3 class="card-title">Add item</h3>
            <br>
            <form class="card-text" action="../controller/product_add_process.php?userID=$userID" method="post">
                <div>
                    <label>Name* </label>
                    <input id="addName" type="text" name="addName" value="" required />
                </div>
                <div>
                    <label>Description* </label>
                    <textarea id="addDescription" name="addDescription" required /></textarea>
                </div>
                <div>
                    <label>Price* </label>
                    <input id="addPrice" type="number" name="addPrice" value="" required />
                </div>
                <div>
                    <label>Quantity* </label>
                    <input id="addQuantity" type="number" name="addQuantity" value="" required />
                </div>
                <input type="hidden" name="userID" value="<?php echo $userID; ?>" />
                <br>
                <select name='catID'>
                <option value="">Item Category</option>
                <?php
                    //retrieve the selected categoryID
                    $selected = $result['catID'];
                    //call the get_category_dropdown() function
                    $result = get_category_dropdown();
                    //display the category data in each row using a foreach loop
                    //do not display duplicates i.e. only display the selected category one time
                    foreach($result as $row):
                        if($selected != $row['catID'])
                        {
                            echo "<option value=" . $row['catID'] . ">" . $row['catName'] . "</option>";
                        }
                    endforeach
                ?>	
                </select>
                <br>
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