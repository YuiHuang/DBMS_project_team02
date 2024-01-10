<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "recipe"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die($conn->connect_error);
}

$conn->begin_transaction();
$inputData = $_POST['inputData'];

try {
    $Name = $inputData ;

    $stmt_update = $conn->prepare("UPDATE user_ingr
                                    SET amount = 0
                                    WHERE ingr_id = (
                                        SELECT ingr_id
                                        FROM ingr
                                        WHERE ingr_name = ?);");
    $stmt_update->bind_param("s", $Name);
    $stmt_update->execute();
    $stmt_update->close();

    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
}

$conn->close();
?>
