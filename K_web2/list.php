<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "recipe"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ingr_name FROM ingr";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

//JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
