<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}
$sql = "SELECT * FROM leave_requests;";

$result = $conn->query($sql);

$all_req = [];
while ($row = $result->fetch_assoc()) {
    $all_req[] = $row;
}

echo json_encode($all_req);
$conn->close();
