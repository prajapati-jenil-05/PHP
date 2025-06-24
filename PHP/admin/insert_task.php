<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $con = mysqli_connect("localhost", "root", "", "my_database");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Collect form data
    $taskname = mysqli_real_escape_string($con, $_POST['taskname']);
    $taskdesc = mysqli_real_escape_string($con, $_POST['taskdesc']);
    $startdate = mysqli_real_escape_string($con, $_POST['startdate']);
    $enddate = mysqli_real_escape_string($con, $_POST['enddate']);
    $employee_id = mysqli_real_escape_string($con, $_POST['assignto']);

    // Fetch the employee's name to store in AssignedTo
    $query = "SELECT firstname FROM employee WHERE id = '$employee_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $assignedTo = $row['firstname'];

    // Default status for new tasks
    $status = 'Not Started';

    // Insert data into tasks table
    $sql = "INSERT INTO tasks (Title, TaskDescription, AssignedTo, StartTime, EndTime, Status, employee_id) 
            VALUES ('$taskname', '$taskdesc', '$assignedTo', '$startdate', '$enddate', '$status', '$employee_id')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Task assigned successfully!'); window.location.href='admin_panel.php?load=task';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "'); window.history.back();</script>";
    }

    // Close connection
    mysqli_close($con);
} else {
    echo "<script>alert('Invalid Request'); window.location.href='admin_panel.php?load=task';</script>";
}
