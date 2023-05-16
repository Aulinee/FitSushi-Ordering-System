<?php
$servername = "localhost";
$username = "root";
$password = "Karmaakabane22";
$database = "fitsushi";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    
}

?>