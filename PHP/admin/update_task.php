<?php
$con = mysqli_connect("localhost", "root", "", "my_database") or die("Error connecting to database");

if (isset($_POST['taskid']) && isset($_POST['status'])) {
    $taskid = $_POST['taskid'];
    $status = $_POST['status'];

    $updateQuery = "UPDATE tasks SET Status='$status' WHERE TaskID='$taskid'";

    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Task status updated successfully!'); window.location.href='admin_panel.php?load=manTasks';</script>";
    } else {
        echo "<script>alert('Error updating task status.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}

mysqli_close($con);
