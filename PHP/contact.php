<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "my_database");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["fullname"])) {
    // Sanitize inputs
    $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $subject = mysqli_real_escape_string($con, $_POST["subject"]);
    $mobile = mysqli_real_escape_string($con, $_POST["mobile"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);

    // Improved validation logic
    $error = [];

    // Check for recent submission (e.g., within last 24 hours)
    $recentQuery = "SELECT `created_at` FROM `contact_request` 
                   WHERE (`email` = '$email' OR `mobile` = '$mobile')
                   ORDER BY `created_at` DESC LIMIT 1";
    $recentResult = mysqli_query($con, $recentQuery);

    if (mysqli_num_rows($recentResult) > 0) {
        $lastSubmission = mysqli_fetch_assoc($recentResult);
        $lastTime = strtotime($lastSubmission['created_at']);
        $cooldown = 24 * 60 * 60; // 24-hour cooldown

        if ((time() - $lastTime) < $cooldown) {
            $remaining = gmdate("H:i", $cooldown - (time() - $lastTime));
            $error[] = "You can submit another request in $remaining";
        }
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format";
    }

    // Validate mobile format (example for 10-digit numbers)
    if (!preg_match('/^\d{10}$/', $mobile)) {
        $error[] = "Invalid mobile number";
    }

    if (empty($error)) {
        // Insert into database
        $q = "INSERT INTO `contact_request`(`fullname`, `email`, `subject`, `mobile`, `message`) 
              VALUES ('$fullname', '$email', '$subject', '$mobile', '$message')";

        if ($con->query($q)) {
            setcookie('success', 'Message sent successfully', time() + 5, "/");
            header("Location: index.php");
            exit();
        } else {
            setcookie('error', 'Error in sending message!', time() + 5, "/");
            error_log("Database error: " . $con->error);
        }
    } else {
        setcookie('error', implode('<br>', $error), time() + 5, "/");
        header("Location: index.php");
        exit();
    }
}
