<?php
// 連接到資料庫，獲取資料
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

// 返回JSON格式的資料
header('Content-Type: application/json');
echo json_encode($data);
?>
