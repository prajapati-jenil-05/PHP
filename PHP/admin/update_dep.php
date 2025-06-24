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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['depid']) && isset($_POST['add_dep'])) {
    $depId = $_POST['depid'];
    $depName = trim($_POST['add_dep']);

    if (empty($depName)) {
        echo "Department name cannot be empty.";
        exit();
    }

    // Prepare and bind update query
    $sql = "UPDATE department SET dep_name = ? WHERE dep_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $depName, $depId);

    if ($stmt->execute()) {
        echo "<script>alert('Department updated successfully!'); window.location.href = 'admin_panel.php?load=manDepartment';</script>";
    } else {
        echo "<script>alert('Error updating department: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
