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
$ID_user = $_GET["ID_user"];
$ID_bottle = $_GET["ID_bottle"];

// query that inserts the association into the db
$sql = "INSERT INTO bottle_user_association (ID_user,ID_bottle) VALUES ('$ID_user','$ID_bottle')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
