<?php
// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['employee_id'])) {
    $employeeId = $_POST['employee_id'];

    // Prepare and bind update query
    $sql = "DELETE FROM employee WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);

    if ($stmt->execute()) {
        echo "<script>alert('Employee deleted successfully!'); window.location.href = 'admin_panel.php?load=manEmployee';</script>";
    } else {
        echo "<script>alert('Error deleting employee: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
