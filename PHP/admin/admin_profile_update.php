<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "my_database");
$email = $_SESSION["email"];
$q = "SELECT * FROM `employee` WHERE email = '$email'";
$row = $con->query($q)->fetch_assoc();
?>
<style>
    /* Error message styling */
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }

    /* Highlight invalid fields */
    input.error,
    textarea.error {
        border: 2px solid red;
        background-color: #ffe6e6;
        /* Light red background */
    }

    /* Highlight valid fields */
    input.valid,
    textarea.valid {
        border: 2px solid green;
        background-color: #e6ffe6;
        /* Light green background */
    }
</style>

<body>
    <div class="card shadow mb-4 mx-3 mt-3">
        <div class="card-header py-3" style="text-align: right;">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo "(" . ($_SESSION["role"]) . ")" . " " . $_SESSION["email"]; ?></h6>
        </div>
        <div class="card-body">
            <form method="post" id="employeeForm" action="update_prof.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                        <img src="profile_pictures/<?php echo $row['photo']; ?>" id="profileImage" style="width: 320px;" class="img-fluid mx-auto d-block rounded shadow-lg rounded-circle" alt="Profile Picture">
                    </div>
                    <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row">
                        <div class="col-12 mb-3" style="margin-top: 15px;">
                            <label for="eid" class="form-label ">Employee ID:</label>
                            <input type="text" class="form-control shadow-sm" id="eid" placeholder="<?php echo $row['id']; ?>" name="eid" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="efname" class="form-label ">First Name:</label>
                            <input type="text" class="form-control shadow-sm" id="efname" value="<?php echo $row['firstname']; ?>" name="efname" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="elname" class="form-label ">Last Name:</label>
                            <input type="text" class="form-control shadow-sm" id="elname" value="<?php echo $row['lastname']; ?>" name="elname" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="email" class="form-label ">Email:</label>
                            <input type="text" class="form-control shadow-sm" id="email" placeholder="<?php echo $_SESSION["email"]; ?>" name="email" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="salary" class="form-label ">Salary:</label>
                            <input type="text" class="form-control shadow-sm" id="salary" placeholder="<?php echo $row["salary"]; ?>" name="salary" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="gender" class="form-label">Gender:</label>
                            <select class="form-select" name="gender" id="gender" disabled>
                                <option value="default">Select Gender</option>
                                <option value="Male" <?php
                                                        if ($row['gender'] == 'Male') {
                                                            echo "selected";
                                                        }
                                                        ?>>Male</option>
                                <option value="Female" <?php
                                                        if ($row['gender'] == 'Female') {
                                                            echo "selected";
                                                        }
                                                        ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 row extra-row">
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="department" class="form-label ">Department:</label>
                            <input type="department" class="form-control shadow-sm" id="department" placeholder="<?php echo $row['department']; ?>" name="department" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="mobile" class="form-label ">Mobile No.:</label>
                            <input type="text" class="form-control shadow-sm" id="mobile" value="<?php echo $row['mobile']; ?>" name="mobile" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="country" class="form-label ">Country:</label>
                            <input type="country" class="form-control shadow-sm" id="country" value="<?php echo $row['country']; ?>" name="country" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="state" class="form-label ">State:</label>
                            <input type="state" class="form-control shadow-sm" id="state" value="<?php echo $row['state']; ?>" name="state" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="city" class="form-label ">City:</label>
                            <input type="city" class="form-control shadow-sm" id="city" value="<?php echo $row['city']; ?>" name="city" required>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="dob" class="form-label ">Date of Birth:</label>
                            <input type="date" class="form-control shadow-sm" id="dob" value="<?php echo $row['date_of_birth']; ?>" name="dob" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="doj" class="form-label ">Date of Joining:</label>
                            <input type="date" class="form-control shadow-sm" id="doj" value="<?php echo $row['date_of_joining']; ?>" name="doj" disabled>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <label for="address" class="form-label ">Address:</label><br>
                            <textarea type="address" class="form-control shadow-sm" id="address" name="address" required><?php echo $row['address']; ?></textarea>
                        </div>
                        <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                            <input type="file" name="profile_picture" id="profile_p" class="form-control shadow-sm" onchange="updateProfile(this);" accept="image/*">
                        </div>
                        <div class="col-l-6 col-xl-6 btn-group" style="text-align: left;">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="button" class="btn btn-outline-danger" onclick="$('#content').load('admin_profile.php')">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize form validation
            $("#employeeForm").validate({
                rules: {
                    efname: {
                        required: true,
                        minlength: 2
                    },
                    elname: {
                        required: true,
                        minlength: 2
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    country: {
                        required: true,
                        minlength: 2
                    },
                    state: {
                        required: true,
                        minlength: 2
                    },
                    city: {
                        required: true,
                        minlength: 2
                    },
                    address: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    efname: {
                        required: "Please enter your first name.",
                        minlength: "First name must be at least 2 characters long."
                    },
                    elname: {
                        required: "Please enter your last name.",
                        minlength: "Last name must be at least 2 characters long."
                    },
                    mobile: {
                        required: "Please enter your mobile number.",
                        digits: "Please enter only digits.",
                        minlength: "Mobile number must be 10 digits long.",
                        maxlength: "Mobile number must be 10 digits long."
                    },
                    country: {
                        required: "Please enter your country.",
                        minlength: "Country must be at least 2 characters long."
                    },
                    state: {
                        required: "Please enter your state.",
                        minlength: "State must be at least 2 characters long."
                    },
                    city: {
                        required: "Please enter your city.",
                        minlength: "City must be at least 2 characters long."
                    },
                    address: {
                        required: "Please enter your address.",
                        minlength: "Address must be at least 10 characters long."
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
        });
    </script>
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

</body>