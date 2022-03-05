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

$id_bottle = $_GET["ID_bottle"]; // get of the ids from the ESP32

// query to select the user of the receive bottle id
$sql_id_user = "SELECT ID_user FROM bottle_user_association WHERE ID_bottle='$id_bottle'";
$result_id_user = $conn->query($sql_id_user);
$result_user = $result_id_user->fetch_array()['ID_user'] ?? '';

// query to select the credit of the user 
$sql_credit = "SELECT credito FROM users WHERE ID_user='$result_user'";
$result_credit = $conn->query($sql_credit);
$result_credito = $result_credit->fetch_array()['credito'] ?? '';

if ($result_credito > 1) {  // credit verification

    echo "+1";
    $credit_new = $result_credito - 1;

    //query to update the amount of credit of the user
    $credit_update = "UPDATE users SET credito='$credit_new' WHERE ID_user='$result_user' ";
    $result_credit_update = $conn->query($credit_update);
}
