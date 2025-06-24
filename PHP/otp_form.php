<?php
session_start();
ob_start();

include_once("connect.php");
include_once("mailer.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");

// Housekeeping: Clean up expired OTPs and reset attempts (if 24 hours passed)
$q = "UPDATE password_token SET otp_attempts = 0 WHERE TIMESTAMPDIFF(HOUR, last_resend, NOW()) >= 24";
$con->query($q);
$remove_otp = "UPDATE password_token SET otp = NULL WHERE expires_at < '$current_time'";
$con->query($remove_otp);

$remainingTime = 0;
$canResend = true;

if (isset($_SESSION['forgot_email'])) {
    $email = $_SESSION['forgot_email'];
    $query = "SELECT last_resend FROM password_token WHERE email = '$email'";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['last_resend']) {
            $lastResendTimestamp = strtotime($row['last_resend']);
            $currentTime = time();
            $timeDifference = $currentTime - $lastResendTimestamp;
            $cooldown = 60; // seconds

            if ($timeDifference < $cooldown) {
                $remainingTime = ceil($cooldown - $timeDifference);
                $canResend = false;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
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

        .otp-card {
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

        .d-flex.justify-content-center.mb-4[name="otp"] {
            gap: 10px;
        }

        .form-control.otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 1.2em;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-control.otp-input:focus {
            outline: none;
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .error {
            color: #dc3545;
            font-size: 0.8em;
            margin-top: 10px;
            text-align: center;
        }

        #timer {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
        }

        #resend_otp {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        .text-danger {
            color: #dc3545 !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card otp-card">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Enter OTP</h2>
                <p class="text-muted text-center mb-4">Please enter the verification code sent to your email</p>

                <form action="otp_form.php" method="post">
                    <div class="d-flex justify-content-center mb-4" name="otp">
                        <input type="text" class="form-control otp-input" maxlength="1" autofocus
                            oninput="moveToNext(this, 0)" name="otp1">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 1)"
                            name="otp2">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 2)"
                            name="otp3">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 3)"
                            name="otp4">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 4)"
                            name="otp5">
                        <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 5)"
                            name="otp6">
                    </div>
                    <div class="error" id="otpError">
                        <?php if (isset($_COOKIE['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $_COOKIE['error'];
                                unset($_COOKIE['error']);
                                setcookie('error', '', time() - 3600, '/'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div id="timer" class="text-danger">
                        <?php if (!$canResend): ?>
                            Resend OTP in <span id="countdown"><?php echo $remainingTime; ?></span> seconds
                        <?php endif; ?>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-4" name="otp">
                        <button type="button" id="resend_otp"
                            class="btn text-white w-100 <?php echo $canResend ? '' : 'disabled'; ?>"
                            style="background-color: #dc3545;" <?php echo $canResend ? '' : 'disabled'; ?>>
                            Resend OTP
                        </button>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 mb-3" name="otp_btn">Verify OTP</button>
                </form>

                <div class="text-center">
                    <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
                </div>

            </div>
        </div>
    </div>

    <script>
        function moveToNext(input, index) {
            if (input.value.length === input.maxLength) {
                if (index < 5) {
                    input.parentElement.children[index + 1].focus();
                }
            }
        }

        const resendButton = document.getElementById('resend_otp');
        const timerDisplay = document.getElementById('timer');
        const countdownDisplay = document.getElementById('countdown');
        let remainingTime = <?php echo $remainingTime; ?>;

        function updateTimer() {
            if (remainingTime > 0) {
                countdownDisplay.textContent = remainingTime;
                remainingTime--;
                setTimeout(updateTimer, 1000);
            } else {
                timerDisplay.textContent = "You can now resend the OTP.";
                resendButton.classList.remove('disabled');
                resendButton.disabled = false;
            }
        }

        if (remainingTime > 0) {
            updateTimer();
        }

        resendButton.onclick = function(event) {
            event.preventDefault();
            window.location.href = 'resend_otp_forgot_password.php';
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
if (isset($_POST['otp_btn'])) {
    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $otp1 = $_POST['otp1'];
        $otp2 = $_POST['otp2'];
        $otp3 = $_POST['otp3'];
        $otp4 = $_POST['otp4'];
        $otp5 = $_POST['otp5'];
        $otp6 = $_POST['otp6'];

        $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

        // Fetch the OTP and expiry time from the database for the given email
        $query = "SELECT otp, expires_at FROM password_token WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_otp = $row['otp'];
            $expires_at = $row['expires_at'];

            // Check if OTP has expired
            if (!$db_otp || strtotime($expires_at) < strtotime($current_time)) {
                setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 5, '/');
?>
                <script>
                    window.location.href = 'forgot_password.php';
                </script>
                <?php
            } else {
                // Compare the OTPs
                if ($otp == $db_otp) {
                    // Redirect to new password page
                ?>
                    <script>
                        window.location.href = 'reset_password.php';
                    </script>
                <?php
                } else {
                    setcookie('error', 'Incorrect OTP', time() + 5, '/');
                ?>
                    <script>
                        window.location.href = 'otp_form.php';
                    </script>
            <?php
                }
            }
        } else {
            setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 5, '/');
            ?>
            <script>
                window.location.href = 'forgot_password.php';
            </script>
<?php
        }
    }
}
ob_end_flush();
?>