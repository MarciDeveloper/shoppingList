<?php
    //database connection details
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "shopping_items";

    try {
        //connect to the database
        $conn = new PDO( "mysql:host = $host; dbname = 
        shopping_items", $user, $password);
        //set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>