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

// Check if request is POST and contains valid JSON
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(["error" => "Invalid request method."]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'], $data['status'])) {
    die(json_encode(["error" => "Missing parameters."]));
}

$leaveId = intval($data['id']);
$status = in_array($data['status'], ["Approved", "Rejected"]) ? $data['status'] : "";

if (empty($status)) {
    die(json_encode(["error" => "Invalid status."]));
}

// Update leave request status
$sql = "UPDATE new_leave_req SET status = ? WHERE Id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("si", $status, $leaveId);
    if ($stmt->execute()) {
        echo json_encode(["success" => "Leave request updated successfully."]);
    } else {
        echo json_encode(["error" => "Failed to update leave request."]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Failed to prepare SQL statement."]);
}

$conn->close();
