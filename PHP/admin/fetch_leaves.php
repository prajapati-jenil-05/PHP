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
    $sql = "SELECT leave_id, leave_name FROM leaves"; // Removed password for security
}
$result = $conn->query($sql);

$leave = [];
while ($row = $result->fetch_assoc()) {
    $leave[] = $row;
}

echo json_encode($leave);
$conn->close();
