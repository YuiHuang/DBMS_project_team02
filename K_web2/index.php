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
$result = $conn->query("select *
                        from rcp_info
                        where rcp_id not in (
                            select distinct rcp_id
                            from rcp_ingr
                            where ingr_id in (
                                select ingr_id
                                from user_ingr
                                where user_id = 0 and amount = 0
                            )
                        )");

//Query result
while ($row = $result->fetch_assoc()) {
    // print
    $dataFromBackend = $dataFromBackend . "@" . $row["rcp_id"] . "@" . $row["rcp_name"]. "@" . $row["minutes"] . "@" . $row["steps"] . "@" . $row["ingredients"]  . "<br>";
}//ingredient == comments
echo $dataFromBackend;

$result->free_result();

$conn->close();
?>

</body>
</html>
