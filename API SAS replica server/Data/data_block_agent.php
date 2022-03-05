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
$id_bottle = $_GET["ID_bottle"];

// variable initialization
$result_id_user_send = "";
$result_id_bottle_send = "";
$result_un_org_send = "";
$result_curso_send = "";
$result_turma_send = "";


if (empty($id_bottle) && !empty($id_user)) {

    //query to check the associated bottle
    $sql_id_bottle_query = "SELECT ID_bottle FROM bottle_user_association WHERE ID_user='$id_user'";
    $result_id_bottle = $conn->query($sql_id_bottle_query);
    $result_id_bottle_send = $result_id_bottle->fetch_array()['ID_bottle'] ?? '';

    // after finding out the the user id querys are made to find the data associated with said user
    $sql_un_org = "SELECT ID_unidade_organica FROM users WHERE ID_user='$id_user'";
    $result_un_org = $conn->query($sql_un_org);
    $result_un_org_send = $result_un_org->fetch_array()['ID_unidade_organica'] ?? '';

    $sql_curso = "SELECT ID_curso FROM users WHERE ID_user='$id_user'";
    $result_curso = $conn->query($sql_curso);
    $result_curso_send = $result_curso->fetch_array()['ID_curso'] ?? '';

    $sql_turma = "SELECT ID_turma FROM users WHERE ID_user='$id_user'";
    $result_turma = $conn->query($sql_turma);
    $result_turma_send = $result_turma->fetch_array()['ID_turma'] ?? '';

    // data is concatenated in a string to be sent in the end 
    $data_package_esp32 =  "+ID=R001" . "&ID_user=" . $id_user . "&ID_uo=" . $result_un_org_send . "&ID_c=" . $result_curso_send . "&ID_t=" . $result_turma_send;
}

if (!empty($id_bottle) && empty($id_user)) {

    //query to find the user id associated to the bottle 
    $sql_id_user_query = "SELECT ID_user FROM bottle_user_association WHERE ID_bottle='$id_bottle'";
    $result_id_user = $conn->query($sql_id_user_query);
    $result_id_user_send = $result_id_user->fetch_array()['ID_user'] ?? '';

    // after finding out the the user id querys are made to find the data associated with said user
    $sql_un_org = "SELECT ID_unidade_organica FROM users WHERE ID_user='$result_id_user_send'";
    $result_un_org = $conn->query($sql_un_org);
    $result_un_org_send = $result_un_org->fetch_array()['ID_unidade_organica'] ?? '';

    $sql_curso = "SELECT ID_curso FROM users WHERE ID_user='$result_id_user_send'";
    $result_curso = $conn->query($sql_curso);
    $result_curso_send = $result_curso->fetch_array()['ID_curso'] ?? '';

    $sql_turma = "SELECT ID_turma FROM users WHERE ID_user='$result_id_user_send'";
    $result_turma = $conn->query($sql_turma);
    $result_turma_send = $result_turma->fetch_array()['ID_turma'] ?? '';

    // data is concatenated in a string to be sent in the end 
    $data_package_esp32 = "+ID=R001" . "&ID_user=" . $result_id_user_send . "&ID_uo=" . $result_un_org_send . "&ID_c=" . $result_curso_send . "&ID_t=" . $result_turma_send;
}

if (!empty($id_bottle) && !empty($id_user)) {

    // after finding out the the user id querys are made to find the data associated with said user
    $sql_un_org = "SELECT ID_unidade_organica FROM users WHERE ID_user='$id_user'";
    $result_un_org = $conn->query($sql_un_org);
    $result_un_org_send = $result_un_org->fetch_array()['ID_unidade_organica'] ?? '';

    $sql_curso = "SELECT ID_curso FROM users WHERE ID_user='$id_user'";
    $result_curso = $conn->query($sql_curso);
    $result_curso_send = $result_curso->fetch_array()['ID_curso'] ?? '';

    $sql_turma = "SELECT ID_turma FROM users WHERE ID_user='$id_user'";
    $result_turma = $conn->query($sql_turma);
    $result_turma_send = $result_turma->fetch_array()['ID_turma'] ?? '';

    // data is concatenated in a string to be sent in the end 
    $data_package_esp32 = "+ID=R001" . "&ID_user=" . $id_user . "&ID_uo=" . $result_un_org_send . "&ID_c=" . $result_curso_send . "&ID_t=" . $result_turma_send;
}

// the string is returned to the ESP32
echo $data_package_esp32;
