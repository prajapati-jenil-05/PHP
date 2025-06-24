<?php
session_start();
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php"); // Replace login.php with your actual login page
    exit();
}

$email = $_SESSION['email'];
$employee_id = null;
$leave_types = [];
$leave_ids = []; // Changed variable name to be plural for consistency
$db_host = "localhost"; // Replace with your database host
$db_user = "root";       // Replace with your database username
$db_pass = "";           // Replace with your database password
$db_name = "my_database"; // Replace with your database name

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee ID based on email
$stmt_emp = $conn->prepare("SELECT id FROM employee WHERE email = ?");
$stmt_emp->bind_param("s", $email);
$stmt_emp->execute();
$result_emp = $stmt_emp->get_result();

if ($result_emp->num_rows > 0) {
    $row_emp = $result_emp->fetch_assoc();
    $employee_id = $row_emp['id'];
} else {
    // Handle case where employee ID is not found for the given email
    echo "Error: Employee ID not found for email: " . $email;
    exit();
}
$stmt_emp->close();

// Fetch leave types from the database
$stmt_leaves = $conn->prepare("SELECT leave_id, leave_name FROM leaves");
$stmt_leaves->execute();
$result_leaves = $stmt_leaves->get_result();

if ($result_leaves->num_rows > 0) {
    while ($row_leave = $result_leaves->fetch_assoc()) {
        $leave_types[] = $row_leave['leave_name'];
        $leave_ids[] = $row_leave['leave_id']; // Store leave IDs
    }
} else {
    echo "No leave types found in the database.";
}
$stmt_leaves->close();

$conn->close();
?>
<style>
    /* Error message styling */
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }

    /* Success message styling */
    .success {
        color: green;
        font-size: 16px;
        display: block;
        margin-bottom: 10px;
    }

    /* Highlight invalid fields */
    input.error,
    select.error {
        border: 2px solid red;
        background-color: #ffe6e6;
        /* Light red background */
    }

    /* Highlight valid fields */
    input.valid,
    select.valid {
        border: 2px solid green;
        background-color: #e6ffe6;
        /* Light green background */
    }
</style>

<div class="card shadow mb-4 mx-4 mt-4 col-md-6">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Request Leave</h4>
        <hr>

        <?php
        // Display success/error messages
        if (isset($_SESSION['message'])) {
            echo '<div class="' . $_SESSION['message_type'] . '">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']); // Clear the message after displaying
            unset($_SESSION['message_type']); // Clear the message type
        }

        // Display validation errors
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo '<div class="alert alert-danger">';
            echo '<ul>';
            foreach ($_SESSION['errors'] as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
            unset($_SESSION['errors']); // Clear the errors after displaying
        }
        ?>

        <form id="leaveForm" action="process_leave.php" method="post">
            <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>">

            <div class="mb-3">
                <label for="leave_type" class="form-label">Leave Type:</label>
                <select class="form-select shadow-sm" id="leave_type" name="leave_type" required>
                    <option value="">Select Leave Type</option>
                    <?php for ($i = 0; $i < count($leave_types); $i++) : ?>
                        <option value="<?php echo htmlspecialchars($leave_ids[$i]); ?>"><?php echo htmlspecialchars($leave_types[$i]); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="from_date" class="form-label">From Date:</label>
                <input type="date" class="form-control shadow-sm" id="from_date" name="from_date" required>
            </div>
            <div class="mb-3">
                <label for="to_date" class="form-label">To Date:</label>
                <input type="date" class="form-control shadow-sm" id="to_date" name="to_date" required>
            </div>
            <button type="submit" class="btn btn-outline-primary w-100">Submit Leave Request</button>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#leaveForm").validate({
            rules: {
                leave_type: {
                    required: true
                },
                from_date: {
                    required: true,
                    date: true
                },
                to_date: {
                    required: true,
                    date: true,
                    greaterThan: "#from_date"
                }
            },
            messages: {
                leave_type: {
                    required: "Please select the Leave Type"
                },
                from_date: {
                    required: "Please select the From Date",
                    date: "Please enter a valid date"
                },
                to_date: {
                    required: "Please select the To Date",
                    date: "Please enter a valid date",
                    greaterThan: "To Date must be after or equal to From Date."
                }
            },
            errorClass: "error",
            validClass: "valid",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $.validator.addMethod("greaterThan", function(value, element, param) {
            if (!value || !$(param).val()) {
                return true; // Allow empty dates to be handled by the required rule
            }
            return new Date(value) >= new Date($(param).val());
        }, 'Must be greater than or equal to From Date.');
    });
</script>