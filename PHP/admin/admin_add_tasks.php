<div class="card shadow mb-4 mx-4 mt-4 col-6">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Assign New Task</h4>
        <hr>
        <form id="taskForm" action="insert_task.php" method="post">
            <div class="col-12 row extra-row">
                <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    <label for="taskname" class="form-label">Task Name:</label>
                    <input type="text" class="form-control shadow-sm" id="taskname" name="taskname" required>
                </div>
                <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    <label for="taskdesc" class="form-label">Task Description:</label>
                    <textarea class="form-control shadow-sm" id="taskdesc" name="taskdesc" required></textarea>
                </div>
                <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    <label for="startdate" class="form-label">Start Date:</label>
                    <input type="date" class="form-control shadow-sm" id="startdate" name="startdate" required>
                </div>
                <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    <label for="enddate" class="form-label">End Date:</label>
                    <input type="date" class="form-control shadow-sm" id="enddate" name="enddate" required>
                </div>
                <div class="col-l-6 col-xl-6 col-md-12 mb-3">
                    <label for="assignto" class="form-label">Assigned To:</label>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "my_database");

                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT id, firstname FROM employee";
                    $result = $con->query($query);
                    ?>
                    <select class="form-select" id="assignto" name="assignto" required>
                        <option value="">Select Employee</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . "ID: " . $row['id'] . " Name: " . $row['firstname'] . "</option>";
                        }
                        ?>
                    </select>
                    <?php
                    mysqli_close($con); // Use $con, not $conn
                    ?>
                </div>
                <div class="col-lg-6 col-xl-6 col-md-12 mb-3">
                    <button type="submit" class="btn btn-outline-success mb-3 w-100" id="btn" style="margin-top: 32px;">Submit</button>
                </div>

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
        function checkScreenWidth() {
            if ($(window).width() < 1000) {
                $(".card").removeClass("mb-4 mx-4 col-6");
            } else {
                $(".card").addClass("mb-4 mx-4 col-6");
            }
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        // jQuery Validation
        $("#taskForm").validate({
            rules: {
                taskname: {
                    required: true,
                    minlength: 3
                },
                taskdesc: {
                    required: true,
                    minlength: 10
                },
                startdate: "required",
                enddate: {
                    required: true,
                    greaterThan: "#startdate"
                },
                assignto: {
                    required: true
                }
            },
            messages: {
                taskname: {
                    required: "Please enter a task name",
                    minlength: "Task name must be at least 3 characters long"
                },
                taskdesc: {
                    required: "Please enter a task description",
                    minlength: "Task description must be at least 10 characters long"
                },
                startdate: "Please select a start date",
                enddate: {
                    required: "Please select an end date",
                    greaterThan: "End date must be after start date"
                },
                assignto: "Please select an employee"
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
                $('#content').load('admin_add_tasks.php');
            }
        });

        $.validator.addMethod("greaterThan", function(value, element, param) {
            return this.optional(element) || new Date(value) > new Date($(param).val());
        }, "End date must be after start date");
    });
</script>