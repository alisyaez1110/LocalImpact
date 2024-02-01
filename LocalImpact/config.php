<?php

// Assign the value from the database server
$server = "localhost";
$username = "root";
$password = "";
$dbName = "localimpact";

// Create a connection to the database
$conn = mysqli_connect($server, $username, $password, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// else {
//     echo "Your connection was successful";
// }

?>
