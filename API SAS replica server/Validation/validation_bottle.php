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
$id_bottle = $_GET["ID_bottle"];

// query to find all the associated bottles
$sql_id_bottle = "SELECT ID_bottle FROM bottle_user_association";
$result_id_bottle = $conn->query($sql_id_bottle);

// place the bottle ids all in an array
if ($result_id_bottle->num_rows > 0) {
    while ($row_id_bottle = $result_id_bottle->fetch_assoc()) {
        $store_array_id_bottle[] =  $row_id_bottle['ID_bottle'];
    }
}

// go through said array to find what bottle id matches with the one received from the ESP32
for ($i = 0; $i < count($store_array_id_bottle); $i++) {
    if ($store_array_id_bottle[$i] == $id_bottle) {
        // if associated sends the response to the ESP32
        echo "+1";
        break;
    }
}
