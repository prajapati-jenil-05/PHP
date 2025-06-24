<?php
session_start();
// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";
$email = $_SESSION["email"];
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['leaveid'])) {
    $leaveId = $_POST['leaveid'];
    $sql = "SELECT * FROM leaves WHERE leave_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $leaveId);
    $stmt->execute();
    $result = $stmt->get_result();
    $leave = $result->fetch_assoc();
} else {
    echo "No leave ID provided.";
    exit();
}
?>

<body>
    <div class="card shadow mb-4 mx-4 mt-4 col-6">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Update Leave Type</h4>
            <hr>
            <form action="update_lv.php" method="post" id="leaveForm">
                <input type="hidden" name="leaveid" value="<?php echo $leave['leave_id']; ?>">
                <label for="add_leave" class="form-label mb-3">Leave Type</label>
                <input type="text" class="form-control shadow-sm mb-3" name="add_leave" id="add_leave" value="<?php echo $leave['leave_name']; ?>" required>
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control mb-3" name="leave_desc" id="description" rows="3"><?php echo $leave['description']; ?></textarea>
                <div class="form-check">
                    <input class="form-check-input shadow-sm mb-3" type="checkbox" name="is_paid" id="is_paid" value=1 <?php echo ($leave['is_paid'] ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_paid">Is Paid</label>
                </div>  
                <div class="btn-group col-l-6 col-xl-6">
                    <button type="submit" class="btn btn-outline-success" id="btn">Submit</button>
                    <button type="button" onclick="$('#content').load('admin_manage_leave.php');" class="btn btn-outline-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>

<style>
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }

    input.error {
        border: 2px solid red;
        background-color: #ffe6e6;
    }

    input.valid {
        border: 2px solid green;
        background-color: #e6ffe6;
    }
</style>

<script>
    $(document).ready(function() {
        $("#leaveForm").validate({
            rules: {
                add_leave: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                leave_desc: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                }
            },
            messages: {
                add_leave: {
                    required: "Please enter a leave type.",
                    minlength: "Leave type must be at least 3 characters long.",
                    maxlength: "Leave type cannot exceed 50 characters."
                },
                leave_desc: {
                    required: "Leave description is required.",
                    minlength: "Description must be at least 3 characters long.",
                    maxlength: "Description cannot exceed 100 characters."
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function(element) {
                $(element).addClass('error').css({
                    "border": "2px solid red",
                    "background-color": "#ffe6e6"
                });
            },
            unhighlight: function(element) {
                $(element).removeClass('error').css({
                    "border": "2px solid green",
                    "background-color": "#e6ffe6"
                });
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        function checkScreenWidth() {
            if ($(window).width() < 1000) {
                $(".card").removeClass("mb-4 mx-4 col-6");
            } else {
                $(".card").addClass("mb-4 mx-4 col-6");
            }
        }
        checkScreenWidth();
        $(window).resize(checkScreenWidth);
    });
</script>