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

<body>
    <div class="card shadow mb-4 mx-4 mt-4 col-6">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Add New Leave Type</h4>
            <hr>
            <form action="insert_leave.php" method="post" id="leaveForm">
                <label for="add_leave" class="form-label mb-3">Leave Type</label>
                <input type="text" class="form-control shadow-sm mb-3" name="add_leave" id="add_leave" required>
                <!-- Error message placeholder -->
                <div id="error-message" class="error mb-3"></div>
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control mb-3" name="leave_desc" id="description" rows="3"></textarea>
                <div class="form-check">
                    <input class="form-check-input shadow-sm mb-3" type="checkbox" name="is_paid" id="is_paid" value=1 id="isPaidCheckBox">
                    <label class="form-check-label" for="isPaidCheckBox">
                        Is Paid
                    </label>
                </div>
                <button type="submit" class="btn btn-outline-success mb-3" id="btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize form validation
            $("#leaveForm").validate({
                rules: {
                    add_leave: {
                        required: true,
                        minlength: 3, // Minimum length of 3 characters
                        maxlength: 50 // Maximum length of 50 characters
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
                        required: "Leave Description is required.",
                        minlength: "Description must be atleast 3 characters long.",
                        maxlength: "Description cannot exceed 100 characters."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element); // Places error after other fields
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

            // Screen width adjustment
            function checkScreenWidth() {
                if ($(window).width() < 1000) { // Change 768 to your desired breakpoint
                    $(".card").removeClass("mb-4 mx-4 col-6");
                } else {
                    $(".card").addClass("mb-4 mx-4 col-6"); // Re-add if needed on resize
                }
            }

            checkScreenWidth(); // Run on page load
            $(window).resize(checkScreenWidth); // Run on window resize
        });
    </script>
</body>