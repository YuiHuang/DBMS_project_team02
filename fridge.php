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

if (isset($_POST["ingredientName"])) {

    // 使用预处理语句，防止 SQL 注入攻击
    $stmt = $conn->prepare("INSERT INTO `test` (`name`, `amount`) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST["ingredientName"], $_POST["ingredientAmount"]);
    // 执行 SQL 语句
    $stmt->execute();
    // 关闭预处理语句和数据库连接
    $stmt->close();
} else {
    $ingredientName = "DefaultName";
}

echo "Connected to database successfully" . "<br>";

//Do query
$result = $conn->query("SELECT * FROM test");

//Query result
while ($row = $result->fetch_assoc()) {
    // print
    $dataFromBackend = $dataFromBackend . "name: " . $row["name"] . " amount: " . $row["amount"] . "<br>";
}

echo $dataFromBackend;

$result->free_result();

$conn->close();
?>

</body>
</html>
