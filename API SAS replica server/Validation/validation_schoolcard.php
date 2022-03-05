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

// get of the ids from the ESP32
$id_user = $_GET["ID_user"];

// query to find all the associated users
$sql_id_user = "SELECT ID_user FROM bottle_user_association";
$result_id_user = $conn->query($sql_id_user);

// place the user ids all in an array
if ($result_id_user->num_rows > 0) {
    while ($row = $result_id_user->fetch_assoc()) {
        $store_array_id_user[] =  $row['ID_user'];
    }
}

// go through said array to find what user id matches with the one received from the ESP32
for ($i = 0; $i < count($store_array_id_user); $i++) {
    if ($store_array_id_user[$i] == $id_user) {
        // if associated sends the response to the ESP32
        echo "+1";
        break;
    }
}
