<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "my_database");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_name = trim($_POST['add_leave']);
    $leave_desc = trim($_POST['leave_desc']);
    if (isset($_POST['is_paid'])) {
        $is_paid = (int)$_POST['is_paid'];
    } else {
        $is_paid = 0;
    }
    print_r($_POST);

    // Prevent SQL Injection
    $leave_name = mysqli_real_escape_string($con, $leave_name);

    // Check if leave already exists
    $check_query = "SELECT * FROM leaves WHERE leave_name = '$leave_name'";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Leave type already exists!'); window.location.href='admin_panel.php?load=manLeave';</script>";
    } else {
        // Insert into database
        $query = "INSERT INTO leaves (leave_name,description,is_paid) VALUES ('$leave_name','$leave_desc','$is_paid')";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('Leave type added successfully!'); window.location.href='admin_panel.php?load=manLeave';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "'); window.location.href='admin_panel.php?load=manLeave';</script>";
        }
    }

    mysqli_close($con);
}
