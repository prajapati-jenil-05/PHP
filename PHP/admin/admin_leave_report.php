<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<div class="card shadow mb-4 mx-4 mt-4 col-12 col-lg-8">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Leave Report</h4>
        <hr>
        <!-- Remove action attribute from form -->
        <form id="leaveReportForm" method="post">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="leaverepofrom" class="form-label">From Date:</label>
                    <input type="date" class="form-control shadow-sm" id="leaverepofrom" name="leaverepofrom" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="leaverepoto" class="form-label">To Date:</label>
                    <input type="date" class="form-control shadow-sm" id="leaverepoto" name="leaverepoto" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-success w-100">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="contents" class="mt-4"></div>

<script>
    $(document).ready(function() {
        // Initialize validation first
        $.validator.addMethod("afterStartDate", function(value, element) {
            let startDate = $('#leaverepofrom').val();
            return this.optional(element) || new Date(value) >= new Date(startDate);
        }, "End date must be after or equal to start date");

        $('#leaveReportForm').validate({
            rules: {
                leaverepofrom: {
                    required: true,
                    date: true
                },
                leaverepoto: {
                    required: true,
                    date: true,
                    afterStartDate: true
                }
            },
            messages: {
                leaverepofrom: {
                    required: "Please select a start date",
                    date: "Please enter a valid date"
                },
                leaverepoto: {
                    required: "Please select an end date",
                    date: "Please enter a valid date",
                    afterStartDate: "End date must be after or equal to start date"
                }
            },
            errorPlacement: function(error, element) {
                error.addClass('text-danger small');
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                // Handle AJAX submission manually
                const formData = $(form).serialize();

                $.ajax({
                    url: "leave_repo.php", // Explicitly set URL here
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#contents").html(response);
                    },
                    error: function(xhr) {
                        $("#contents").html(
                            `<div class="alert alert-danger">
                                Error: ${xhr.statusText}
                            </div>`
                        );
                    }
                });
                return false; // Prevent default form submission
            }
        });
    });
</script>