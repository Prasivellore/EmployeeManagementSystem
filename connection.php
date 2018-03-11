<?php
function getdb(){
$servername = "localhost";
$username = "root";
$password = "";
$db = "crude";

try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
     //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>

