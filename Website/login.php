<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['pass'];


$sql = "SELECT * FROM users WHERE email = '$email' AND pass ='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) { 
    if($row['email'] == $email && $row['pass'] == $pass) {
        //$row['nmecanografico']; 
        $_SESSION["n_meca"] = $row['nmecanografico']; 
        header("Location: user/index_instituto_user.php");
        exit();
    }
  }
} else {
    header("Location: login_form_error.php");
    exit();
}
$conn->close();
?>



