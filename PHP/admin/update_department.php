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
if (isset($_POST['depid'])) {
    $depId = $_POST['depid'];
    // Fetch the department data from the database based on the departmentId
    // Example query:
    $sql = "SELECT * FROM department WHERE dep_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $depId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Assuming department data is found
    $department = $result->fetch_assoc();
} else {
    // Redirect to an error page or show a message if no ID is passed
    print_r($_POST);
    echo "No department ID provided.";
    exit();
}
?>
<div class="card shadow mb-4 mx-4 mt-4 col-5">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Update Department</h4>
        <hr>
        <form action="update_dep.php" method="post" id="departmentForm" name="form1">
            <input type="hidden" name="depid" value="<?php echo $department['dep_id']; ?>">
            <label for="add_dep" class="form-label mb-3">Department Name</label>
            <input type="text" class="form-control shadow-sm mb-3" placeholder="<?php echo $department['dep_name']; ?>" name="add_dep" id="add_dep">
            <div class="btn-group col-l-6 col-xl-6">
                <button type="submit" class="btn btn-outline-success" id="btn">Submit</button>
                <button type="button" onclick="$('#content').load('admin_manage_dep.php');" class="btn btn-outline-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>
<style>
    /* Error message styling */
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }

    /* Highlight invalid fields */
    input.error {
        border: 2px solid red;
        background-color: #ffe6e6;
        /* Light red background */
    }

    /* Highlight valid fields */
    input.valid {
        border: 2px solid green;
        background-color: #e6ffe6;
        /* Light green background */
    }
</style>
<script>
    $(document).ready(function() {
        // Initialize form validation
        $("#departmentForm").validate({
            rules: {
                add_dep: {
                    required: true,
                    minlength: 3, // Minimum length of 3 characters
                    maxlength: 50 // Maximum length of 50 characters
                }
            },
            messages: {
                add_dep: {
                    required: "Please enter a department name.",
                    minlength: "Department name must be at least 3 characters long.",
                    maxlength: "Department name cannot exceed 50 characters."
                }
            },
            errorPlacement: function(error, element) {
                // Place error messages below the input field
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                // Add error class to invalid fields
                $(element).addClass(errorClass).removeClass(validClass);
                $(element).css({
                    "border": "2px solid red",
                    "background-color": "#ffe6e6"
                });
            },
            unhighlight: function(element, errorClass, validClass) {
                // Add valid class to valid fields
                $(element).removeClass(errorClass).addClass(validClass);
                $(element).css({
                    "border": "2px solid green",
                    "background-color": "#e6ffe6"
                });
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        function checkScreenWidth() {
            if ($(window).width() < 1000) { // Change 768 to your desired breakpoint
                $(".card").removeClass("mb-4 mx-4 col-5");
            } else {
                $(".card").addClass("mb-4 mx-4 col-5");
            }
        }

        checkScreenWidth(); // Run on page load
        $(window).resize(checkScreenWidth); // Run on window resize
    });
</script>