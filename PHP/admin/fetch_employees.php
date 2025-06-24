<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}
if ($page = 1) {
    $sql = "SELECT * FROM employee"; // Removed password for security
}
$result = $conn->query($sql);

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

echo json_encode($employees);
$conn->close();
