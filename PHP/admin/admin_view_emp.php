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

// Check if 'empid' is set in the POST request
if (isset($_POST['empid'])) {
    $empId = $_POST['empid'];

    // Fetch employee data from the database based on empId
    $sql = "SELECT * FROM employee WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter to the SQL query
        $stmt->bind_param("i", $empId);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if data is found
        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
            // $employee['password'] = base64_decode($employee['password']);
        } else {
            echo "No employee found with the provided ID.";
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
        exit();
    }
} else {
    // Redirect to an error page or show a message if no ID is passed
    echo "No employee ID provided.";
    exit();
}
?>
<div class="card shadow mb-4 mx-3 mt-3">
    <div class="card-header py-3" style="text-align: right;">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo "(" . ("Employee") . ")" . " " . $employee['email']; ?></h6>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                    <img src="../images/employee.png" style="width: 320px;" class="img-fluid mx-auto d-block rounded shadow-lg" alt="Profile Picture">
                </div>
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row not-extra">
                    <div class="col-12 mb-3" style="margin-top: 15px;">
                        <label for="eid" class="form-label ">Employee ID:</label>
                        <input type="eid" class="form-control shadow-sm" id="eid" placeholder="<?php echo $employee['id']; ?>" name="eid" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="efname" class="form-label ">First Name:</label>
                        <input type="efname" class="form-control shadow-sm" id="efname" placeholder="<?php echo $employee['firstname']; ?>" name="efname" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="elname" class="form-label ">Last Name:</label>
                        <input type="elname" class="form-control shadow-sm" id="elname" placeholder="<?php echo $employee['lastname']; ?>" name="elname" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="email" class="form-label ">Email:</label>
                        <input type="email" class="form-control shadow-sm" id="email" placeholder="<?php echo $employee['email']; ?>" name="email" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="password" class="form-label ">Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control shadow-sm" id="password" value="*************" name="password" readonly>
                        </div>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <input type="text" class="form-control shadow-sm" id="gender" placeholder="<?php if ($employee['gender'] == 'Male') {
                                                                                                        echo "Male";
                                                                                                    }
                                                                                                    if ($employee['gender'] == 'Female') {
                                                                                                        echo "Female";
                                                                                                    }
                                                                                                    ?>" name="gender" readonly>
                    </div>
                </div>
                <div class="col-12 row extra-row">
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="department" class="form-label ">Department:</label>
                        <input type="department" class="form-control shadow-sm" id="department" placeholder="<?php echo $employee['department']; ?>" name="department" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="mobile" class="form-label ">Mobile No.:</label>
                        <input type="mobile" class="form-control shadow-sm" id="mobile" placeholder="<?php echo $employee['mobile']; ?>" name="mobile" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="country" class="form-label ">Country:</label>
                        <input type="country" class="form-control shadow-sm" id="country" placeholder="<?php echo $employee['country']; ?>" name="country" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="state" class="form-label ">State:</label>
                        <input type="state" class="form-control shadow-sm" id="state" placeholder="<?php echo $employee['state']; ?>" name="state" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="city" class="form-label ">City:</label>
                        <input type="city" class="form-control shadow-sm" id="city" placeholder="<?php echo $employee['city']; ?>" name="city" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="dob" class="form-label ">Date of Birth:</label>
                        <input type="dob" class="form-control shadow-sm" id="dob" placeholder="<?php echo $employee['date_of_birth']; ?>" name="dob" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="doj" class="form-label ">Date of Joining:</label>
                        <input type="doj" class="form-control shadow-sm" id="doj" placeholder="<?php echo $employee['date_of_joining']; ?>" name="doj" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="salary" class="form-label ">Salary:</label>
                        <input type="salary" class="form-control shadow-sm" id="salary" placeholder="<?php echo $employee['salary']; ?>" name="salary" readonly>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="address" class="form-label ">Address:</label><br>
                        <textarea type="address" class="form-control shadow-sm" id="address" placeholder="<?php echo $employee['address']; ?>" name="address" readonly></textarea>
                        <!-- <input type="address" class="form-control shadow-sm" id="address" placeholder="<?php echo "Address"; ?>" name="address" readonly> -->
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3" style="text-align: left; margin-top: 32px;">
                        <a href="#" class="btn btn-outline-warning font-weight-bold text-uppercase" style="padding: 5px 30px 5px 30px;" onclick="$('#content').load('admin_edit_emp.php',{empid: <?php echo $empId; ?>})">
                            Update
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#togglePassword").click(function() {
        let passwordField = $("#password");
        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
        } else {
            passwordField.attr("type", "password");
        }
    });
</script>