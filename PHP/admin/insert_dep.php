<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "my_database");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = trim($_POST['add_dep']);

    // Prevent SQL Injection
    $department_name = mysqli_real_escape_string($con, $department_name);

    // Check if department already exists
    $check_query = "SELECT * FROM department WHERE dep_name = '$department_name'";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Department already exists!'); window.location.href='admin_panel.php?load=department';</script>";
    } else {
        // Insert into database
        $query = "INSERT INTO department (dep_name) VALUES ('$department_name')";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('Department added successfully!'); window.location.href='admin_panel.php?load=department';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "'); window.location.href='admin_panel.php?load=department';</script>";
        }
    }

    mysqli_close($con);
}
