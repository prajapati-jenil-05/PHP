<?php
session_start();
print_r($_POST);
// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";
$email = $_SESSION["email"];
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leaveid']) && isset($_POST['add_leave'])) {
    $leaveId = $_POST['leaveid'];
    $leaveName = trim($_POST['add_leave']);
    $leave_desc = $_POST['leave_desc'];
    if (isset($_POST['is_paid'])) {
        $is_paid = $_POST['is_paid'];
    } else {
        $is_paid = 0;
    }

    if (empty($leaveName)) {
        echo "leave name cannot be empty.";
        exit();
    }

    // Prepare and bind update query
    $sql = "UPDATE leaves SET leave_name = ?,description = ?, is_paid = ? WHERE leave_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $leaveName, $leave_desc, $is_paid, $leaveId);

    if ($stmt->execute()) {
        echo "<script>alert('Leave updated successfully!'); window.location.href = 'admin_panel.php?load=manLeave';</script>";
    } else {
        echo "<script>alert('Error updating leave: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
