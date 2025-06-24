<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}
$sql = "SELECT * FROM leave_requests WHERE status = 'Approved';";

$result = $conn->query($sql);

$approved_req = [];
while ($row = $result->fetch_assoc()) {
    $approved_req[] = $row;
}

echo json_encode($approved_req);
$conn->close();
