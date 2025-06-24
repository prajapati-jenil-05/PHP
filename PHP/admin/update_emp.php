<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['eid'])) {
    $empId = $_GET['eid'];
    $firstName = $_POST['efname'];
    $lastName = $_POST['elname'];
    $salary = $_POST['salary'];
    $department = $_POST['department'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $updatePassword = false;

    // Check if password fields are filled
    if (!empty($_POST['password']) && !empty($_POST['confpassword'])) {
        if ($_POST['password'] === $_POST['confpassword']) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $updatePassword = true;
        } else {
            echo "Passwords do not match!";
            exit();
        }
    }

    // Check if a file is uploaded
    if (!empty($_FILES['profile_picture']['name'])) {
        $targetDir = "profile_pictures/";
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            $updatePhoto = true;
        } else {
            echo "<script>alert('Error uploading photo!');</script>";
            exit();
        }
    } else {
        $updatePhoto = false;
    }

    // Prepare SQL statement
    if ($updatePassword && $updatePhoto) {
        $sql = "UPDATE employee SET firstname=?, lastname=?, salary=?, department=?, mobile=?, country=?, state=?, city=?, address=?, password=?, photo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssssssssi", $firstName, $lastName, $salary, $department, $mobile, $country, $state, $city, $address, $password, $fileName, $empId);
    } elseif ($updatePassword) {
        $sql = "UPDATE employee SET firstname=?, lastname=?, salary=?, department=?, mobile=?, country=?, state=?, city=?, address=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsssssssi", $firstName, $lastName, $salary, $department, $mobile, $country, $state, $city, $address, $password, $empId);
    } elseif ($updatePhoto) {
        $sql = "UPDATE employee SET firstname=?, lastname=?, salary=?, department=?, mobile=?, country=?, state=?, city=?, address=?, photo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsssssssi", $firstName, $lastName, $salary, $department, $mobile, $country, $state, $city, $address, $fileName, $empId);
    } else {
        $sql = "UPDATE employee SET firstname=?, lastname=?, salary=?, department=?, mobile=?, country=?, state=?, city=?, address=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssssssi", $firstName, $lastName, $salary, $department, $mobile, $country, $state, $city, $address, $empId);
    }

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Employee details updated successfully!'); window.location.href = 'admin_panel.php?load=manEmployee';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
