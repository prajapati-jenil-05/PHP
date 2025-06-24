<?php
session_start();
ob_start();

include_once("connect.php");
include_once("mailer.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");

if (isset($_SESSION['forgot_email'])) {
    $email = $_SESSION['forgot_email'];

    // Fetch OTP attempts and last resend time
    $query = "SELECT otp_attempts, last_resend FROM password_token WHERE email = '$email'";
    $result = $con->query($query);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $attempts = $row['otp_attempts'];
        $lastResendTimestamp = strtotime($row['last_resend']);
        $currentTime = time();

        // Check time difference (2 minutes = 120 seconds)
        if ($currentTime - $lastResendTimestamp < 60) {
            $remainingTime = ceil(30 - ($currentTime - $lastResendTimestamp));
            setcookie('error', 'Please wait for ' . $remainingTime . ' seconds before resending OTP.', time() + 5, '/');
            header("Location: otp_form.php");
            exit();
        }

        // Block further resends after 3 attempts
        if ($attempts >= 3) {
            setcookie('error', "OTP resend limit reached. You can generate a new OTP after 24 hours.", time() + 5, "/");
            header("Location: login.php");
            exit();
        }

        // Generate and send new OTP
        $email_time = date("Y-m-d H:i:s");
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minutes'));
        $new_otp = rand(100000, 999999);
        $updateQuery = "UPDATE password_token SET otp=?, otp_attempts=?, last_resend=NOW(), created_at=?, expires_at=? WHERE email=?";
        $stmt = $con->prepare($updateQuery);
        $attemptsIncremented = $attempts + 1;
        $stmt->bind_param("iisss", $new_otp, $attemptsIncremented, $email_time, $expiry_time, $email);

        if ($stmt->execute()) {
            $to = $email;
            $subject = "Reset password";
            $body = "<html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
                    h1 { color: black; }
                    .otp { font-size: 24px; font-weight: bold; color: #dc3545; }
                    .footer { margin-top: 20px; font-size: 0.8em; color: #777; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>Forgot Your Password?</h1>
                    <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
                    <p class='otp'>$new_otp</p>
                    <p>Please enter this OTP on the website to proceed with resetting your password.</p>
                    <p>If you did not request a password reset, please ignore this email.</p>
                    <div class='footer'>
                        <p>This is an automated message, please do not reply to this email.</p>
                    </div>
                </div>
            </body>
            </html>
            ";

            if (sendEmail($to, $subject, $body, "")) {
                setcookie("success", "New OTP for reset password has been sent successfully.", time() + 5, "/");
            } else {
                setcookie("error", "Error sending the new OTP for reset password.", time() + 5, "/");
            }
        } else {
            setcookie("error", "Error updating OTP information. Please try again.", time() + 5, "/");
        }
        $stmt->close();
    } else {
        setcookie("error", "Email not found in our records.", time() + 5, "/");
        header("Location: forgot_password.php");
        exit();
    }
    header("Location: otp_form.php");
    exit();
} else {
    header("Location: forgot_password.php");
    exit();
}
ob_end_flush();
