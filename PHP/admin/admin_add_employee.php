<?php
session_start();
?>
<div class="card shadow mb-4 mx-4 mt-4">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Add New Employee</h4>
        <hr>
        <form action="insert_emp.php" method="POST" id="form1" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                    <img id="profileImage" src="../images/employee.png" style="width: 320px; max-height: 320px;" class="img-fluid mx-auto d-block rounded rounded-circle shadow" alt="Profile Picture">
                </div>
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row">
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="efname" class="form-label ">First Name:</label>
                        <input type="text" class="form-control shadow-sm" id="efname" placeholder="Ex. Durgesh" name="efname" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="elname" class="form-label ">Last Name:</label>
                        <input type="text" class="form-control shadow-sm" id="elname" placeholder="Ex. Kanzariya" name="elname" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="email" class="form-label ">Email:</label>
                        <input type="text" class="form-control shadow-sm" id="email" placeholder="Ex. dkanzariya172@rku.ac.in" name="email" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="password" class="form-label ">Password:</label>
                        <div class="input-group" id="checkPassword">
                            <input type="password" class="form-control shadow-sm" id="password" name="password" placeholder="Ex. hakunamatata" required>
                            <div class="input-group-text">
                                <input type="checkbox" id="togglePassword" class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="salary" class="form-label ">Salary:</label>
                        <input type="text" class="form-control shadow-sm" id="salary" placeholder="Ex. Salary" name="salary" required>
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
                        <select class="form-select" name="gender" id="gender">
                            <option value="default">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 row extra-row">
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="department" class="form-label ">Department:</label>
                        <select class="form-select" name="department" id="department">
                            <option value="default">Select Department</option>
                            <?php
                            // Database connection details
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "my_database";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT dep_id, dep_name FROM department";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["dep_id"] . "'>" . $row["dep_name"] . "</option>";
                                }
                            } else {
                                echo "<option value='0'>No Departments Found</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="mobile" class="form-label ">Mobile No.:</label>
                        <input type="text" class="form-control shadow-sm" id="mobile" placeholder="Ex. 9054831231" name="mobile" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="country" class="form-label ">Country:</label>
                        <input type="text" class="form-control shadow-sm" id="country" placeholder="Ex. India" name="country" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="state" class="form-label ">State:</label>
                        <input type="text" class="form-control shadow-sm" id="state" placeholder="Ex. Gujarat" name="state" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="city" class="form-label ">City:</label>
                        <input type="text" class="form-control shadow-sm" id="city" placeholder="Ex. Rajkot" name="city" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control shadow-sm" id="dob" name="dob" min="1900-01-01" max="2023-12-31" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="doj" class="form-label ">Date of Joining:</label>
                        <input type="date" class="form-control shadow-sm" id="doj" placeholder="Ex. 13/11/2005" name="doj" required>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="address" class="form-label ">Address:</label><br>
                        <textarea type="text" class="form-control shadow-sm" id="address" placeholder="Ex. Whitehouse Block-A1" name="address" required></textarea>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <input type="file" name="profile_picture" id="profile_p" class="form-control shadow-sm" onchange="updateProfile(this);" accept="image/*">
                    </div>
                    <div class="col-l-6 col-xl-6 btn-group" style="text-align: left; max-height: 53px;">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="button" class="btn btn-outline-danger" onclick="$('#content').load('admin_dashboard.php')">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            if ($(window).width() < 1000) { // Change 768 to your desired breakpoint
                $(".card").removeClass("mb-4 mx-4");
            } else {
                $(".card").addClass("mb-4 mx-4"); // Re-add if needed on resize
            }
        }

        checkScreenWidth(); // Run on page load
        $(window).resize(checkScreenWidth); // Run on window resize

        // Toggle for password field
        $("#togglePassword").click(function() {
            let passwordField = $("#password");
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
            } else {
                passwordField.attr("type", "password");
            }
        });

        // Toggle for confirm password field
        $("#toggleConfPassword").click(function() {
            let passwordField = $("#confPassword"); // Corrected ID
            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
            } else {
                passwordField.attr("type", "password");
            }
        });
    });

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
<script>
    $(document).ready(function() {
        $('#form1').validate({
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
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/
                },
                confpassword: {
                    required: true,
                    equalTo: "#password"
                },
                salary: {
                    required: true,
                    digits: true
                },
                department: {
                    required: true,
                    notDefault: true // Add the notDefault rule here
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
                profile_picture: {
                    required: true
                },
                gender: {
                    required: true,
                    notDefault: true
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
                    required: "Password is required",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Password must be at most 20 characters",
                    pattern: "Password must contain uppercase, lowercase, number, and special character"
                },
                confpassword: {
                    required: "Confirm Password is required",
                    equalTo: "Passwords do not match"
                },
                salary: {
                    required: "Salary is required",
                    digits: "Salary must be a valid number"
                },
                department: {
                    required: "Department is required.",
                    notDefault: "Please select a department."
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
                profile_picture: {
                    required: "Profile picture is required."
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
                $(element).removeClass("success-input"); // Remove red border when valid
            },
            unhighlight: function(element) {
                $(element).removeClass("error-input"); // Remove red border when valid
                $(element).addClass("success-input"); // Remove red border when valid
            }
        });

        // Custom validation rule to prevent selecting the default option
        $.validator.addMethod("notDefault", function(value, element) {
            return value !== "default";
        }, "Please select an option."); // General message for notDefault
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

    .success-input {
        border: 2px solid green !important;
        background-color: rgb(232, 255, 230);
        /* Light green background */
    }
</style>