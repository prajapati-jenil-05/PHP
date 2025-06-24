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
$con->query($q);
$remove_otp = "update password_token set otp=NULL WHERE expires_at < '$current_time'";
$con->query($remove_otp);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            color: #555;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 420px;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .forgot-card {
            border: none;
            box-shadow: none;
            background-color: transparent;
        }

        .card-body {
            padding: 0;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 500;
        }

        p.text-muted {
            color: #777 !important;
            text-align: center;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .mb-4 {
            margin-bottom: 20px !important;
        }

        .form-label {
            display: block;
            margin-bottom: 7px;
            color: #343a40;
            font-weight: 400;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 11px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.2s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .error {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .btn-outline-danger {
            color: #e74c3c;
            border-color: #e74c3c;
            transition: all 0.2s ease-in-out;
        }

        .btn-outline-danger:hover {
            background-color: #e74c3c;
            color: #fff;
            border-color: #e74c3c;
        }

        .text-center {
            text-align: center;
        }

        .text-decoration-none {
            text-decoration: none !important;
        }

        .mb-3 {
            margin-bottom: 18px !important;
        }

        .alert {
            margin-bottom: 18px;
            border-radius: 5px;
            padding: 12px;
            font-size: 0.9rem;
        }

        .alert-danger {
            background-color: #fdecea;
            border-color: #f9d7d4;
            color: #c0392b;
        }

        .alert-success {
            background-color: #e8f8f3;
            border-color: #d1f0e9;
            color: #27ae60;
        }

        .btn-outline-secondary {
            color: #7f8c8d;
            border-color: #7f8c8d;
            transition: all 0.2s ease-in-out;
        }

        .btn-outline-secondary:hover {
            background-color: #7f8c8d;
            color: #fff;
            border-color: #7f8c8d;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#email').on('blur', function() {
                var email = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'check_duplicate_Email.php',
                    data: {
                        email1: email
                    },
                    success: function(response) {
                        if (response == 'false') {
                            $('#emailError').text('Email is not registered. Please enter registered email address').show();
                            $('#email').addClass('is-invalid');
                        } else {
                            $('#emailError').text('').hide();
                            $('#email').removeClass('is-invalid');
                        }
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container py-5">
        <div class="card forgot-card">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Forgot Password</h2>
                <p class="text-muted text-center mb-4">Enter your email address and we'll send you instructions to reset your password.</p>

                <form action="forgot_password.php" method="post">
                    <?php if (isset($_COOKIE['error'])): ?>
                        <div class="alert alert-danger"><?php echo $_COOKIE['error'];
                                                        unset($_COOKIE['error']);
                                                        setcookie('error', '', time() - 3600, '/'); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_COOKIE['success'])): ?>
                        <div class="alert alert-success"><?php echo $_COOKIE['success'];
                                                            unset($_COOKIE['success']);
                                                            setcookie('success', '', time() - 3600, '/'); ?></div>
                    <?php endif; ?>
                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                        <div class="error" id="emailError"></div>
                    </div>

                    <button type="submit" class="btn btn-outline-danger w-100 mb-3" name="forgot_btn">Reset Password</button>

                    <div class="text-center">
                        <a href="login.php" class="text-decoration-none btn btn-outline-secondary w-100">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['forgot_btn'])) {
        $email = $_POST['email'];

        // Check if the email exists in the employee table
        $check_employee_query = "SELECT email FROM employee WHERE email = '$email'";
        $emp_result = $con->query($check_employee_query);

        if ($emp_result && mysqli_num_rows($emp_result) > 0) {
            $query = "SELECT * FROM password_token WHERE email = '$email'";
            $result = mysqli_fetch_assoc($con->query($query));
            $otp = rand(100000, 999999);
            $body = "<html>
                <head>
                    <style>
                        body { font-family: 'Helvetica Neue', Arial, sans-serif; line-height: 1.5; color: #555; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 8px; }
                        h1 { color: #2c3e50; }
                        .otp { font-size: 22px; font-weight: bold; color: #e74c3c; }
                        .footer { margin-top: 20px; font-size: 0.85em; color: #777; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h1>Forgot Your Password?</h1>
                        <p>We received a request to reset your password. Here is your One-Time Password (OTP):</p>
                        <p class='otp'>$otp</p>
                        <p>Please enter this OTP on the website to proceed with resetting your password.</p>
                        <p>If you did not request a password reset, please ignore this email.</p>
                        <div class='footer'>
                            <p>This is an automated message, please do not reply to this email.</p>
                        </div>
                    </div>
                </body>
                </html>
                ";

            $subject = "Password Reset - OTP";
            $email_time = date("Y-m-d H:i:s");
            $expiry_time = date("Y-m-d H:i:s", strtotime('+1 minutes'));

            if ($result) {
                $attempts = $result['otp_attempts'];
                if ($attempts >= 3) {
                    // Email exists, display error message
                    setcookie('error', "The maximum limit for generating OTP is reached. You can generate a new OTP after 24 hours from the last OTP generated time.", time() + 5, "/");
                    // No immediate redirect here
                } else { ?>
                    <script>
                        window.location.href = "otp_form.php";
                    </script>
                    <?php
                }
            } else {
                $attempts = 0;
                $q = "INSERT INTO  password_token  (email, otp, created_at,expires_at,otp_attempts,last_resend) VALUES ('$email', '$otp', '$email_time','$expiry_time',$attempts,now())";
                if (sendEmail($email, $subject, $body, "")) {
                    if ($con->query($q)) {
                        $_SESSION['forgot_email'] = $email;
                        setcookie('success', 'OTP sent to your registered email address. The OTP will expire in 2 minutes.', time() + 5);
                    ?>
                        <script>
                            window.location.href = "otp_form.php";
                        </script>
            <?php
                    } else {
                        setcookie('error', 'Failed to generate OTP and store it in the database', time() + 5);
                    }
                } else {
                    setcookie('error', 'Failed to send the OTP in mail. Please try again later.', time() + 5);
                }
            }
        } else {
            // Email not found in employee table
            setcookie('error', 'Email address not found in our records.', time() + 5);
            ?>
            <script>
                window.location.href = "forgot_password.php";
            </script>
    <?php
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>