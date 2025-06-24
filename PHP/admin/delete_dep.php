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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['depid'])) {
    $depId = $_POST['depid'];

    // Prepare and bind update query
    $sql = "DELETE FROM department WHERE dep_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $depId);

    if ($stmt->execute()) {
        echo "<script>alert('Department deleted successfully!'); window.location.href = 'admin_panel.php?load=manDepartment';</script>";
    } else {
        echo "<script>alert('Error deleting department: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
