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
    $sql = "SELECT dep_id, dep_name FROM department"; // Removed password for security
}
$result = $conn->query($sql);

$departments = [];
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

echo json_encode($departments);
$conn->close();
