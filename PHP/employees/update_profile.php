<?php
session_start();
include '../connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $efname = $_POST['efname'];
    $elname = $_POST['elname'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    // Check if a new profile picture is uploaded
    if (!empty($_FILES['profile_picture']['name'])) {
        $photo = uniqid() . basename($_FILES['profile_picture']['name']);
        $target_dir = "profile_pictures/";
        $target_file = $target_dir . $photo;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
            $update_query = "UPDATE employee SET firstname=?, lastname=?, mobile=?, country=?, state=?, city=?, address=?, photo=? WHERE email=?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param("sssssssss", $efname, $elname, $mobile, $country, $state, $city, $address, $photo, $email);
        } else {
            echo "<script>alert('Invalid image format! Only JPG, JPEG, PNG & GIF allowed.'); window.location.href = 'update_profile.php';</script>";
            exit();
        }
    } else {
        $update_query = "UPDATE employee SET firstname=?, lastname=?, mobile=?, country=?, state=?, city=?, address=? WHERE email=?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("ssssssss", $efname, $elname, $mobile, $country, $state, $city, $address, $email);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href = 'employee_panel.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $con->close();
}
