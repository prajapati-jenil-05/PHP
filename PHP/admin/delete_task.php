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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskid'])) {
    $taskId = $_POST['taskid'];

    // Prepare and bind update query
    $sql = "DELETE FROM tasks WHERE TaskID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        echo "<script>alert('Task deleted successfully!'); window.location.href = 'admin_panel.php?load=manTasks';</script>";
    } else {
        echo "<script>alert('Error deleting task: " . $stmt->error . "');</script>";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
