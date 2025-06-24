<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in admin's email
$adminEmail = $_SESSION['email'] ?? '';

if (empty($adminEmail)) {
    die("No admin is logged in.");
}

// Fetch admin data from the database
$sql = "SELECT PASSWORD FROM employee WHERE email = ? AND role = 'admin'";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $adminEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        echo json_encode(["status" => "error", "message" => "Admin user not found."]);
        exit();
    }

    $admin = $result->fetch_assoc();
    $storedHashedPassword = $admin['PASSWORD'];
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Failed to prepare the SQL statement."]);
    exit();
}

// Handle AJAX request to check old password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === "check_old_password") {
    $oldPassword = trim($_POST["old_password"]);

    if (password_verify($oldPassword, $storedHashedPassword)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Old password is incorrect."]);
    }
    exit();
}

// Handle form submission for password update
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["action"])) {
    $oldPassword = trim($_POST["old_password"]);
    $newPassword = trim($_POST["new_password"]);
    $confirmPassword = trim($_POST["confirm_password"]);

    // Validate old password again (for security in case JS is disabled)
    if (!password_verify($oldPassword, $storedHashedPassword)) {
        echo json_encode(["status" => "error", "message" => "Old password is incorrect."]);
        exit();
    } elseif ($newPassword !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "New password and confirm password do not match."]);
        exit();
    } else {
        // Hash the new password using password_hash()
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in the database
        $updateSql = "UPDATE employee SET PASSWORD = ? WHERE email = ? AND role = 'admin'";
        $updateStmt = $conn->prepare($updateSql);

        if ($updateStmt) {
            $updateStmt->bind_param("ss", $hashedNewPassword, $adminEmail);
            if ($updateStmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Password updated successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update password. Please try again."]);
            }
            $updateStmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to prepare the update statement."]);
        }
    }
    exit();
}
$conn->close();
?>
<style>
    .card {
        width: 100%;
        max-width: 500px;
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .error {
        color: red;
        font-size: small;
        display: block;
    }

    .error-message {
        color: red;
        margin-top: 5px;
        font-size: small;
    }
</style>
<div class="card shadow mb-4 mx-4 mt-4">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Change Password</h4>
        <hr>
        <div id="message" class="alert d-none"></div>
        <form id="changePasswordForm">
            <label for="old_password" class="form-label mb-3">Old Password: </label>
            <input type="password" class="form-control shadow-sm mb-2" name="old_password" id="old_password" required minlength="6">
            <div id="old_password_error" class="error-message"></div>

            <label for="new_password" class="form-label mb-3">New Password: </label>
            <input type="password" class="form-control shadow-sm mb-3" name="new_password" id="new_password" required minlength="6">

            <label for="confirm_password" class="form-label mb-3">Confirm Password: </label>
            <input type="password" class="form-control shadow-sm mb-3" name="confirm_password" id="confirm_password" required minlength="6" equalTo="#new_password">
            <br>
            <button type="submit" class="btn btn-outline-success mb-3" id="btn">Submit</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#old_password").on("blur", function() {
            var oldPassword = $(this).val();
            var errorDiv = $("#old_password_error");

            if (oldPassword.length >= 6) {
                $.ajax({
                    url: "admin_change_password.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        action: "check_old_password",
                        old_password: oldPassword
                    },
                    success: function(response) {
                        if (response.status === "error") {
                            errorDiv.text(response.message).show();
                        } else {
                            errorDiv.hide();
                        }
                    },
                    error: function() {
                        alert("An error occurred while checking the old password.");
                    }
                });
            } else {
                errorDiv.hide(); // Hide if the field is empty and validation will handle it on submit
            }
        });

        $("#changePasswordForm").validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 0
                },
                new_password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: "Please enter your old password.",
                    minlength: "Your old password must be at least 6 characters long."
                },
                new_password: {
                    required: "Please enter your new password.",
                    minlength: "Your new password must be at least 6 characters long."
                },
                confirm_password: {
                    required: "Please confirm your new password.",
                    minlength: "Your new password must be at least 6 characters long.",
                    equalTo: "Please enter the same password as above."
                }
            },
            submitHandler: function(form) {
                var oldPasswordError = $("#old_password_error");
                if (oldPasswordError.is(":visible")) {
                    return false; // Prevent submission if old password check failed
                }

                const formData = $(form).serialize();

                $.ajax({
                    url: "admin_change_password.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        const messageDiv = $("#message");
                        messageDiv.removeClass("d-none");

                        if (response.status === "success") {
                            messageDiv.removeClass("alert-danger").addClass("alert-success");
                            form.reset();
                            $("#old_password_error").hide(); // Hide error message on successful update
                        } else {
                            messageDiv.removeClass("alert-success").addClass("alert-danger");
                        }

                        messageDiv.text(response.message);
                    },
                    error: function() {
                        alert("An error occurred. Please try again.");
                    }
                });
            }
        });

        // Responsive design (remains the same)
        function checkScreenWidth() {
            if ($(window).width() < 1000) {
                $(".card").removeClass("mb-4 mx-4");
            } else {
                $(".card").addClass("mb-4 mx-4");
            }
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);
    });
</script>