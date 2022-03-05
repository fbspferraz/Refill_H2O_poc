<?php

//DB information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto2";

$conn = new mysqli($servername, $username, $password, $dbname); // Create connection
if ($conn->connect_error) { // Check connection
    die("Connection failed: " . $conn->connect_error);
}

$id_user = $_GET["ID_user"]; // get of the ids from the ESP32

// query to select the credit of the user 
$sql_credit = "SELECT credito FROM users WHERE ID_user='$id_user'";
$result_credit = $conn->query($sql_credit);
$result_credito = $result_credit->fetch_array()['credito'] ?? '';

if ($result_credito > 1) { // credit verification
    
    echo "+1";
    $credit_new = $result_credito - 1;
    
    //query to update the amount of credit of the user
    $credit_update = "UPDATE users SET credito='$credit_new' WHERE ID_user='$id_user' ";
    $result_credit_update = $conn->query($credit_update);
}
