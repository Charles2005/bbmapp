<?php
$servername = "localhost";  
$username = "root";    
$password = "";    
$database = "bbmdb";    

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if(!$conn){
    exit("Sorry, Connection Error...");
}
?>