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

    //預先處理防止SQL攻擊 
    $stmt = $conn->prepare("UPDATE user_ingr
                        SET amount = ?
                        WHERE ingr_id = (
                            SELECT ingr_id
                            FROM ingr
                            WHERE ingr_name = ?
                        )");
    $stmt->bind_param("ss",$_POST["ingredientAmount"], $_POST["ingredientName"]);
    $stmt->execute();
    $stmt->close();
} else {
    $ingredientName = "DefaultName";
}

echo "Connected to database successfully" . "<br>";

//Do query
$result = $conn->query("SELECT * FROM user_ingr,ingr where user_ingr.ingr_id=ingr.ingr_id and user_ingr.amount > 0");

//Query result
while ($row = $result->fetch_assoc()) {
    // print
    $dataFromBackend = $dataFromBackend . "user_id: " . $row["user_id"] ." ingr_name: " . $row["ingr_name"] .  " amount: " . $row["amount"] . "<br>";
}

echo $dataFromBackend;

$result->free_result();

$conn->close();
?>

</body>
</html>
