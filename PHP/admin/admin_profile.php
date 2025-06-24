<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "my_database");
$email = $_SESSION["email"];
$q = "SELECT * FROM `employee` WHERE email = '$email'";
$row = $con->query($q)->fetch_assoc();
?>
<div class="card shadow mb-4 mx-3 mt-3">
    <div class="card-header py-3" style="text-align: right;">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo "(" . ($_SESSION["role"]) . ")" . " " . $_SESSION["email"]; ?></h6>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 mb-3">
                    <img src="profile_pictures/<?php echo $row['photo']; ?>" style="width: 320px;" class="img-fluid mx-auto d-block rounded-circle shadow-lg" alt="Profile Picture">
                </div>
                <div class="col-sm-12 col-md-6 col-l-6 col-xl-6 row not-extra">
                    <div class="col-12 mb-3" style="margin-top: 15px;">
                        <label for="eid" class="form-label ">Employee ID:</label>
                        <input type="text" class="form-control shadow-sm" id="eid" placeholder="<?php echo $row['id']; ?>" name="eid" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="efname" class="form-label ">First Name:</label>
                        <input type="text" class="form-control shadow-sm" id="efname" placeholder="<?php echo $row['firstname']; ?>" name="efname" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="elname" class="form-label ">Last Name:</label>
                        <input type="text" class="form-control shadow-sm" id="elname" placeholder="<?php echo $row['lastname']; ?>" name="elname" disabled>
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
                            <option value="male" <?php
                                                    if ($row['gender'] == 'Male') {
                                                        echo "selected";
                                                    }
                                                    ?>>Male</option>
                            <option value="female" <?php
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
                        <input type="text" class="form-control shadow-sm" id="department" placeholder="<?php echo $row['department']; ?>" name="department" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="mobile" class="form-label ">Mobile No.:</label>
                        <input type="text" class="form-control shadow-sm" id="mobile" placeholder="<?php echo $row['mobile']; ?>" name="mobile" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="country" class="form-label ">Country:</label>
                        <input type="text" class="form-control shadow-sm" id="country" placeholder="<?php echo $row['country']; ?>" name="country" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="state" class="form-label ">State:</label>
                        <input type="text" class="form-control shadow-sm" id="state" placeholder="<?php echo $row['state']; ?>" name="state" disabled>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                        <label for="city" class="form-label ">City:</label>
                        <input type="text" class="form-control shadow-sm" id="city" placeholder="<?php echo $row['city']; ?>" name="city" disabled>
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
                        <textarea type="text" class="form-control shadow-sm" id="address" placeholder="<?php echo $row['address']; ?>" name="address" disabled></textarea>
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    </div>
                    <div class="col-l-6 col-xl-6 col-md-12 " style="text-align: left;">
                        <a href="#" class="btn btn-outline-warning font-weight-bold text-uppercase" style="padding: 5px 30px 5px 30px;" onclick="$('#content').load('admin_profile_update.php', { email: '<?php echo $email; ?>' })">
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