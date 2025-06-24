<?php
session_start();
ob_start();

include_once("connect.php");
include_once("mailer.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
// $delete_query = "DELETE FROM password_token WHERE expires_at < '$current_time'";
// $con->query($delete_query);
$q = "UPDATE password_token
SET otp_attempts = 0
WHERE TIMESTAMPDIFF(HOUR, last_resend, NOW()) >= 24";
$con->query(query: $q);
$remove_otp = "update password_token set otp=NULL WHERE expires_at < '$current_time'";
$con->query($remove_otp);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            padding: 30px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .reset-card {
            border: none;
            box-shadow: none;
            background-color: transparent;
        }

        .card-body {
            padding: 0;
        }

        h2 {
            color: black;
            text-align: center;
            margin-bottom: 20px;
        }

        p.text-muted {
            color: #777 !important;
            text-align: center;
            margin-bottom: 25px;
            font-size: 0.9em;
        }

        .mb-4 {
            margin-bottom: 25px !important;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9em;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .error {
            color: #dc3545;
            font-size: 0.8em;
            margin-top: 5px;
        }

        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        .text-danger {
            color: #dc3545 !important;
            text-decoration: none !important;
        }

        .alert {
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card reset-card">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Reset Password</h2>
                <p class="text-muted text-center mb-4">Please enter your new password below.</p>

                <form action="reset_password.php" method="post">
                    <?php if (isset($_COOKIE['success'])): ?>
                        <div class="alert alert-success"><?php echo $_COOKIE['success'];
                                                            unset($_COOKIE['success']);
                                                            setcookie('success', '', time() - 3600, '/'); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_COOKIE['error'])): ?>
                        <div class="alert alert-danger"><?php echo $_COOKIE['error'];
                                                        unset($_COOKIE['error']);
                                                        setcookie('error', '', time() - 3600, '/'); ?></div>
                    <?php endif; ?>
                    <div class="mb-4">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="Enter new password"
                            data-validation="required strongPassword min max" data-min="8" data-max="25" name="newPassword" required>
                        <div class="error" id="newPasswordError"></div>
                    </div>

                    <div class="mb-4">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password"
                            data-validation="required confirmPassword" data-password-id="newPassword" name="confirmPassword" required>
                        <div class="error" id="confirmPasswordError"></div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 mb-3" name="reset_pwd_btn">Update Password</button>

                    <div class="text-center">
                        <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['reset_pwd_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $password = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password !== $confirmPassword) {
            setcookie('error', 'Passwords do not match.', time() + 5, '/');
            header("Location: reset_password.php");
            exit();
        }

        // Basic password strength check (you can enhance this)
        if (strlen($password) < 8) {
            setcookie('error', 'Password must be at least 8 characters long.', time() + 5, '/');
            header("Location: reset_password.php");
            exit();
        }

        // Consider hashing the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update the user's password in the registration table
        $update_query = "UPDATE employee SET PASSWORD = '$hashedPassword' WHERE email = '$email'";
        if (mysqli_query($con, $update_query)) {
            // Delete the token from the password_token table
            $delete_query = "DELETE FROM password_token WHERE email = '$email'";
            mysqli_query($con, $delete_query);
            unset($_SESSION['forgot_email']);

            setcookie('success', 'Password has been reset successfully. You can now login with your new password.', time() + 5, '/');
            header("Location: login.php");
            exit();
        } else {
            setcookie('error', 'Error in resetting Password: ' . mysqli_error($con), time() + 5, '/');
            header("Location: reset_password.php");
            exit();
        }
    } else {
        setcookie('error', 'No email found for resetting password. Please restart the forgot password process.', time() + 5, '/');
        header("Location: forgot_password.php");
        exit();
    }
}
ob_end_flush();
?>