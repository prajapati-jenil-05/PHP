<?php
session_start();
include '../connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $efname = $_POST['efname'];
    $elname = $_POST['elname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $salary = (int) $_POST['salary'];
    $department = $_POST['department'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $photo = uniqid() . $_FILES['profile_picture']['name'];

    // Check if email or mobile already exists
    $check_query = "SELECT * FROM employee WHERE email = ? OR mobile = ?";
    $stmt = $con->prepare($check_query);
    $stmt->bind_param("ss", $email, $mobile);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Error: Email or Mobile number already exists!'); window.location.href = 'admin_panel.php?load=employee';</script>";
    } else {
        // Insert new employee
        $sql = "INSERT INTO employee (firstname, lastname, email, PASSWORD, salary, department, mobile, country, state, city, date_of_birth, date_of_joining, address, photo, gender) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssdssssssssss", $efname, $elname, $email, $password, $salary, $department, $mobile, $country, $state, $city, $dob, $doj, $address, $photo, $gender);

        if ($stmt->execute()) {
            if (!is_dir("profile_pictures")) {
                mkdir("profile_pictures");
            }
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], "profile_pictures/" . $photo);
            echo "<script>alert('Employee added successfully!'); window.location.href = 'admin_panel.php?load=employee';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    $stmt->close();
    $con->close();
}
