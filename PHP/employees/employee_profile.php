<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
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
    } else {
        die("No employee found with the provided email.");
    }

    $stmt->close();
} else {
    die("Failed to prepare the SQL statement.");
}
?>
<div class="card shadow mb-4 mx-3 mt-3">
    <div class="card-header py-3" style="text-align: right;">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo "(" . ($_SESSION["role"]) . ")" . " " . $_SESSION["email"]; ?></h6>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                    <img src="profile_pictures/<?php echo $employee['photo']; ?>" style="width: 320px;" class="img-fluid mx-auto d-block rounded-circle shadow-lg" alt="Profile Picture">
                </div>
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row not-extra">
                    <div class="col-12 mb-3" style="margin-top: 15px;">
                        <label for="eid" class="form-label ">Employee ID:</label>
                        <input type="eid" class="form-control shadow-sm" id="eid" placeholder="<?php echo $employee['id']; ?>" name="eid" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="efname" class="form-label ">First Name:</label>
                        <input type="efname" class="form-control shadow-sm" id="efname" placeholder="<?php echo $employee['firstname']; ?>" name="efname" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="elname" class="form-label ">Last Name:</label>
                        <input type="elname" class="form-control shadow-sm" id="elname" placeholder="<?php echo $employee['lastname']; ?>" name="elname" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="email" class="form-label ">Email:</label>
                        <input type="email" class="form-control shadow-sm" id="email" placeholder="<?php echo $employee['email']; ?>" name="email" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="doj" class="form-label ">Salary:</label>
                        <input type="doj" class="form-control shadow-sm" id="doj" placeholder="<?php echo $employee['salary']; ?>" name="doj" disabled>
                    </div>
                </div>
                <div class="col-12 row extra-row">
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="department" class="form-label ">Department:</label>
                        <input type="department" class="form-control shadow-sm" id="department" placeholder="<?php echo $employee['department']; ?>" name="department" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="mobile" class="form-label ">Mobile No.:</label>
                        <input type="mobile" class="form-control shadow-sm" id="mobile" placeholder="<?php echo $employee['mobile']; ?>" name="mobile" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="country" class="form-label ">Country:</label>
                        <input type="country" class="form-control shadow-sm" id="country" placeholder="<?php echo $employee['country']; ?>" name="country" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="state" class="form-label ">State:</label>
                        <input type="state" class="form-control shadow-sm" id="state" placeholder="<?php echo $employee['state']; ?>" name="state" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="city" class="form-label ">City:</label>
                        <input type="city" class="form-control shadow-sm" id="city" placeholder="<?php echo $employee['city']; ?>" name="city" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="dob" class="form-label ">Date of Birth:</label>
                        <input type="dob" class="form-control shadow-sm" id="dob" placeholder="<?php echo $employee['date_of_birth']; ?>" name="dob" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="doj" class="form-label ">Date of Joining:</label>
                        <input type="doj" class="form-control shadow-sm" id="doj" placeholder="<?php echo $employee['date_of_joining']; ?>" name="doj" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="address" class="form-label ">Address:</label><br>
                        <textarea type="address" class="form-control shadow-sm" id="address" placeholder="<?php echo $employee['address']; ?>" name="address" disabled></textarea>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    </div>

                    <div class="col-l-6 col-xl-6 col-md-12 " style="text-align: left; margin-top: 32px;">
                        <a href="#" class="btn btn-outline-warning font-weight-bold text-uppercase" style="padding: 5px 30px 5px 30px;" onclick="$('#content').load('employee_profile_update.php')">
                            Update
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            if ($(window).width() < 768) { // Change 768 to your desired breakpoint
                $(".card").removeClass("mb-4 mx-3 mt-3");
                $(".extra-row").removeClass("row");
                $(".not-extra").removeClass("row");
            } else {
                $(".card").addClass("mb-4 mx-3 mt-3"); // Re-add if needed on resize
                $(".extra-row").addClass("row");
                $(".not-extra").addClass("row");
            }
        }

        checkScreenWidth(); // Run on page load
        $(window).resize(checkScreenWidth); // Run on window resize

        $("#togglePassword").click(function() {
            let passwordField = $("#password");
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
            } else {
                passwordField.attr("type", "password");
            }
        });
    });
</script>