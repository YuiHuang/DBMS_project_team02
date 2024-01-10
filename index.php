<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Example</title>
</head>
<body>

<?php
$dataFromBackend = "";
$servername = "localhost";
$username = "root";
$password = "";
$database = "recipe"; 

// connect to db
$conn = new mysqli($servername, $username, $password, $database);

// check connectivity
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to database successfully" . "<br>";

//Do query
$result = $conn->query("SELECT * FROM ingr");

//Query result
while ($row = $result->fetch_assoc()) {
    // print
    $dataFromBackend = $dataFromBackend . "id: " . $row["ingr_id"] . " Name: " . $row["ingr_name"] . "<br>";
}

echo $dataFromBackend;

$result->free_result();

$conn->close();
?>

</body>
</html>
