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
        <form method="post" id="form" action="update_emp.php?eid=<?php echo $employee['id']; ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                    <img src="profile_pictures/<?php echo $employee['photo']; ?>" id="profileImage" style="width: 320px;" class="img-fluid mx-auto d-block rounded shadow-lg" alt="Profile Picture">
                </div>
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row not-extra">
                    <div class="col-12 mb-3" style="margin-top: 15px;">
                        <label for="eid" class="form-label ">Employee ID:</label>
                        <input type="eid" class="form-control shadow-sm" id="eid" value="<?php echo $employee['id']; ?>" name="eid" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="efname" class="form-label ">First Name:</label>
                        <input type="efname" class="form-control shadow-sm" id="efname" value="<?php echo $employee['firstname']; ?>" name="efname" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="elname" class="form-label ">Last Name:</label>
                        <input type="elname" class="form-control shadow-sm" id="elname" value="<?php echo $employee['lastname']; ?>" name="elname" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="email" class="form-label ">Email:</label>
                        <input type="email" class="form-control shadow-sm" id="email" value="<?php echo $employee['email']; ?>" name="email" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="password" class="form-label ">Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control shadow-sm" id="password" placeholder="Ex. hakunamatata" name="password" required>
                            <div class="input-group-text">
                                <input type="checkbox" id="togglePassword" class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="salary" class="form-label ">Salary:</label>
                        <input type="salary" class="form-control shadow-sm" id="salary" value="<?php echo $employee['salary']; ?>" name="salary" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="confpassword" class="form-label ">Confirm Password:</label>
                        <div class="input-group" id="checkConfPassword">
                            <input type="password" class="form-control shadow-sm" id="confPassword" name="confpassword" placeholder="Ex. hakunamatata" required>
                            <div class="input-group-text">
                                <input type="checkbox" id="toggleConfPassword" class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <select class="form-select" name="gender" id="gender" disabled>
                            <option value="default">Select Gender</option>a
                            <option value="Male" <?php
                                                    if ($employee['gender'] == 'Male') {
                                                        echo "selected";
                                                    }
                                                    ?>>Male</option>
                            <option value="Female" <?php
                                                    if ($employee['gender'] == 'Female') {
                                                        echo "selected";
                                                    }
                                                    ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 row extra-row">
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="department" class="form-label ">Department:</label>
                        <input type="department" class="form-control shadow-sm" id="department" value="<?php echo $employee['department']; ?>" name="department" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="mobile" class="form-label ">Mobile No.:</label>
                        <input type="mobile" class="form-control shadow-sm" id="mobile" value="<?php echo $employee['mobile']; ?>" name="mobile" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="country" class="form-label ">Country:</label>
                        <input type="country" class="form-control shadow-sm" id="country" value="<?php echo $employee['country']; ?>" name="country" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="state" class="form-label ">State:</label>
                        <input type="state" class="form-control shadow-sm" id="state" value="<?php echo $employee['state']; ?>" name="state" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="city" class="form-label ">City:</label>
                        <input type="city" class="form-control shadow-sm" id="city" value="<?php echo $employee['city']; ?>" name="city" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="dob" class="form-label ">Date of Birth:</label>
                        <input type="date" class="form-control shadow-sm" id="dob" value="<?php echo $employee['date_of_birth']; ?>" name="dob" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="doj" class="form-label ">Date of Joining:</label>
                        <input type="date" class="form-control shadow-sm" id="doj" value="<?php echo $employee['date_of_joining']; ?>" name="doj" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="address" class="form-label ">Address:</label><br>
                        <textarea type="address" class="form-control shadow-sm" id="address" name="address" required><?php echo $employee['address']; ?></textarea>
                        <!-- <input type="address" class="form-control shadow-sm" id="address" value="<?php echo "Address"; ?>" name="address" required> -->
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <input type="file" name="profile_picture" id="profile_p" class="form-control shadow-sm" onchange="updateProfile(this);" accept="image/*">
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 btn-group groupy" style="text-align: left;">
                        <button type=" submit" class="btn btn-outline-primary">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="button" class="btn btn-outline-danger" onclick="$('#content').load('admin_manage_employee.php');">Cancel</button>
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
    $("#toggleConfPassword").click(function() {
        let passwordField = $("#confPassword");
        if (passwordField.attr("type") === "password") {
            passwordField.attr("type", "text");
        } else {
            passwordField.attr("type", "password");
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                eid: {
                    required: true,
                    digits: true
                },
                efname: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                elname: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: false,
                },
                confpassword: {
                    required: false,
                    equalTo: "#password"
                },
                salary: {
                    required: true,
                    number: true
                },
                department: {
                    required: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                dob: {
                    required: true,
                    date: true
                },
                doj: {
                    required: true,
                    date: true
                },
                address: {
                    required: true,
                    minlength: 10
                },
                gender: {
                    required: true,
                    notDefault: "default"
                }
            },
            messages: {
                eid: {
                    required: "Employee ID is required",
                    digits: "Employee ID must be a number"
                },
                efname: {
                    required: "First Name is required",
                    minlength: "First Name must be at least 2 characters",
                    maxlength: "First Name cannot be more than 50 characters"
                },
                elname: {
                    required: "Last Name is required",
                    minlength: "Last Name must be at least 2 characters",
                    maxlength: "Last Name cannot be more than 50 characters"
                },
                email: {
                    required: "Email is required",
                    email: "Invalid email format"
                },
                password: {
                    required: "Password is not required"
                },
                confpassword: {
                    required: "Confirm Password is not required",
                    equalTo: "Passwords do not match"
                },
                salary: {
                    required: "Salary is required",
                    number: "Salary must be a valid number"
                },
                department: {
                    required: "Department is required"
                },
                mobile: {
                    required: "Mobile number is required",
                    digits: "Only numbers allowed",
                    minlength: "Mobile number must be exactly 10 digits",
                    maxlength: "Mobile number must be exactly 10 digits"
                },
                country: {
                    required: "Country is required"
                },
                state: {
                    required: "State is required"
                },
                city: {
                    required: "City is required"
                },
                dob: {
                    required: "Date of Birth is required",
                    date: "Enter a valid date"
                },
                doj: {
                    required: "Date of Joining is required",
                    date: "Enter a valid date"
                },
                address: {
                    required: "Address is required",
                    minlength: "Address must be at least 10 characters long"
                },
                gender: {
                    required: "Gender is required.",
                    notDefault: "Please select Male or Female"
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "password") {
                    error.insertAfter("#checkPassword"); // Inserts the error message after the checkbox
                } else if (element.attr("name") === "confpassword") {
                    error.insertAfter("#checkConfPassword"); // Inserts the error message after the checkbox
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass("error-input"); // Add red border on error
            },
            unhighlight: function(element) {
                $(element).removeClass("error-input"); // Remove red border when valid
            }
        });

        // Custom validation rule to prevent selecting the default option
        $.validator.addMethod("notDefault", function(value, element) {
            return value !== "default"; // Ensures "default" is not chosen
        }, "Please select Male or Female");
    });
</script>
<style>
    .error-input {
        border: 2px solid red !important;
        background-color: #ffe6e6;
        /* Light red background */
    }
</style>
<script>
    function updateProfile(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Check if the file is an image
            if (!file.type.startsWith('image/')) {
                alert("Please upload an image file.");
                input.value = ""; // Clear the file input
                return;
            }

            // Check if the image has a 1:1 aspect ratio
            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function() {
                const width = img.width;
                const height = img.height;

                if (width !== height) {
                    alert("The image must have a 1:1 aspect ratio (square).");
                    input.value = ""; // Clear the file input
                    return;
                }

                // If the image is valid, update the profile picture
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            };
        }
    }
</script>