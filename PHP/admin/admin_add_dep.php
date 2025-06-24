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
            <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Add New Department</h4>
            <hr>
            <form action="insert_dep.php" method="post" id="form1">
                <label for="add_dep" class="form-label mb-3">Department Name</label>
                <input type="text" class="form-control shadow-sm mb-3" name="add_dep" id="add_dep" required>
                <!-- Error message placeholder -->
                <div id="error-message" class="error mb-3"></div>
                <button type="submit" class="btn btn-outline-success mb-3" id="btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize form validation
            $("#form1").validate({
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