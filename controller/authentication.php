<?php
    //start session management
    session_start();
    //connect to the database
    require('connection.php');
    //retrieve the functions
    require('../model/functions_users.php');
    //retrieve the username and password entered into the form
    $username = $_POST['username'];
    $password = $_POST['password']; 
   

    if($_POST['remember'] == '1' || $_POST["remember"]=='on'){
        $cookie_name = "remember_me";
        $cookie_value = $username;
        $year = time() + 31536000;
        setcookie($cookie_name, $cookie_value, $year);
    }
    

    if(empty($username) || empty ($password)) {
         echo '<script type="text/javascript">alert("All fields are required.")</script>' ;
        // Redirect the browser window back to the add customer page
         echo "<script>setTimeout(\"location.href = '../index.php';\",2000);</script>";
    } else {
    //call the retrieve_salt() function
    $result = retrieve_salt($username);
        
    //retrieve the random salt from the database
    $salt = $result['salt'];
    

    //generate the hashed password with the salt value
    $password = hash('sha256', $password.$salt); 
        
    //call the login() function
    $count = login($username, $password);

    $sql = "SELECT userID FROM shopping_items.user WHERE username = '$username' AND password = '$password'";
    //prepared statement
    $result = $conn->query($sql);
    //fetch the first record in the result set
    $row = $result->fetch();
    $userID = $row['userID'];
  
    //if there is one matching record
    if($count == 1)
    { 
        //start the user session to allow authorised access to secured web pages
        $_SESSION['user'] = $user;
        $_SESSION['username'] = $username;
        $_SESSION['userID'] = $userID;
        //if login is successful, create a success message to display on the products page
        $_SESSION['success'] = 'Hello ' . $username . '. Have a great day!';
        //redirect to products.php
        header('location:../index.php');
        
    }
    else
    {
    //if login not successful, create an error message to display on the login page
    $_SESSION['error'] = 'Incorrect username or password. Please try again.';
    //redirect to login.php
    header('location:../view/login.php');
    }
    }
    
 ?>