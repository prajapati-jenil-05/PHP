<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT employee_id, first_name, last_name, email, mobile_number, department, salary FROM employees";

$result = $conn->query($sql);

$salary = [];
while ($row = $result->fetch_assoc()) {
    $salary[] = $row;
}

echo json_encode($salary);
$conn->close();
