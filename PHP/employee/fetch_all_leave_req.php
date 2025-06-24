<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get logged-in user's email
$empmail = $_SESSION['email'] ?? '';

if (empty($empmail)) {
    die(json_encode(["error" => "No user is logged in."]));
}

// Fetch employee ID
$sql = "SELECT id FROM employee WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $empmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die(json_encode(["error" => "No employee found with the provided email."]));
    }

    $employee = $result->fetch_assoc();
    $empId = $employee['id'];
    $stmt->close();
} else {
    die(json_encode(["error" => "Failed to prepare the SQL statement."]));
}

// Fetch approved leave requests
$sql = "SELECT * FROM new_leave_req WHERE id = ? AND status = 'New'";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $empId);
    $stmt->execute();
    $result = $stmt->get_result();

    $all_req = [];
    while ($row = $result->fetch_assoc()) {
        $all_req[] = $row;
    }

    echo json_encode($all_req);
    $stmt->close();
} else {
    die(json_encode(["error" => "Failed to prepare leave requests query."]));
}

$conn->close();
