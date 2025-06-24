<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT TaskID, Title, AssignedTo, StartTime, EndTime, Status FROM tasks";

$result = $conn->query($sql);

$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);
$conn->close();
