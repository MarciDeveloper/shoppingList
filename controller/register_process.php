<?php

require('connection.php');

require_once("../model/functions_users.php");

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
//generate a random salt
$salt = md5(uniqid(rand(), true));
//encrypt the password
$password = hash('sha256', $password.$salt);
// check if all the fields are filled
if(empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password) ) 
{ 
    echo '<script type="text/javascript">alert("All fields are required.")</script>' ;
     // Redirect the browser window back to the add customer page
    echo "<script>setTimeout(\"location.href = '../index.php';\",2000);</script>";
} else {
    //call the add_user() function
    $result = add_user($firstName, $lastName, $username, $email, $password, $salt);
if(!$result) {
echo ("Query error: " . mysqli_error($conn));
exit;
}
else {
    echo '<div class="success">';
    echo '<p><i class="far fa-thumbs-up"></i>' ."Congratulations ". $username . ", You registered successfully!". '</p>'; 
    echo '</div>';
// Redirect the browser window back to the add customer page
}
echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
}
?>

