<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database2";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's email
$empmail = $_SESSION['email'] ?? '';

if (empty($empmail)) {
    die("No user is logged in.");
}

// Fetch employee data from the database
$sql = "SELECT * FROM employee WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $empmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        $employee['password'] = base64_decode($employee['password']); // Decode stored password
    } else {
        die("No employee found with the provided email.");
    }

    $stmt->close();
} else {
    die("Failed to prepare the SQL statement.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = trim($_POST["old_password"]);
    $newPassword = trim($_POST["new_password"]);
    $confirmPassword = trim($_POST["confirm_password"]);

    // Validate old password
    if ($oldPassword !== $employee['password']) {
        echo json_encode(["status" => "error", "message" => "Old password is incorrect."]);
        exit();
    } elseif ($newPassword !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "New password and confirm password do not match."]);
        exit();
    } else {
        // Update password in the database
        $encodedNewPassword = base64_encode($newPassword); // Encode new password
        $updateSql = "UPDATE employee SET password = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);

        if ($updateStmt) {
            $updateStmt->bind_param("ss", $encodedNewPassword, $empmail);
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
<div class="card shadow mb-4 mx-4 mt-4">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Change Password</h4>
        <hr>
        <div id="message" class="alert d-none"></div>
        <form id="changePasswordForm">
            <label for="old_password" class="form-label mb-3">Old Password</label>
            <input type="password" class="form-control shadow-sm mb-3" name="old_password" id="old_password" required>

            <label for="new_password" class="form-label mb-3">New Password</label>
            <input type="password" class="form-control shadow-sm mb-3" name="new_password" id="new_password" required>

            <label for="confirm_password" class="form-label mb-3">Confirm Password</label>
            <input type="password" class="form-control shadow-sm mb-3" name="confirm_password" id="confirm_password" required>

            <button type="submit" class="btn btn-outline-success mb-3" id="btn">Submit</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Handle form submission
        $("#changePasswordForm").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: "employee_change_password.php",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    const messageDiv = $("#message");
                    messageDiv.removeClass("d-none");

                    if (response.status === "success") {
                        messageDiv.removeClass("alert-danger").addClass("alert-success");
                    } else {
                        messageDiv.removeClass("alert-success").addClass("alert-danger");
                    }

                    messageDiv.text(response.message);
                },
                error: function() {
                    alert("An error occurred. Please try again.");
                }
            });
        });

        // Responsive design
        function checkScreenWidth() {
            if ($(window).width() < 1000) { // Change 768 to your desired breakpoint
                $(".card").removeClass("mb-4 mx-4 col-6");
            } else {
                $(".card").addClass("mb-4 mx-4 col-6"); // Re-add if needed on resize
            }
        }

        checkScreenWidth(); // Run on page load
        $(window).resize(checkScreenWidth); // Run on window resize
    });
</script>