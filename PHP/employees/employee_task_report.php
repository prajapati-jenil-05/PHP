<div class="card shadow mb-4 mx-4 mt-4 col-12 col-lg-8">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center; font-size: xx-large; font-weight: 600;">Task Report</h4>
        <hr>
        <!-- Form for filtering leave reports -->
        <form id="taskReportForm" method="post" action="task_repo.php">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <label for="taskrepofrom" class="form-label">From Date:</label>
                    <input type="date" class="form-control shadow-sm" id="taskrepofrom" name="taskrepofrom" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="taskrepoto" class="form-label">To Date:</label>
                    <input type="date" class="form-control shadow-sm" id="taskrepoto" name="taskrepoto" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-success w-100">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Container for displaying the report -->
<div id="contents" class="mt-4">
    <!-- The leave report will be loaded here -->
</div>
<script>
    $(document).ready(function() {
        $("#taskReportForm").on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = $(this).serialize();

            $.ajax({
                url: "task_repo.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    $("#contents").html(response); // Load response into the container
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    $("#contents").html("<p class='text-danger'>Failed to load report.</p>");
                }
            });
        });
    });
</script>


<style>
    /* Responsive design using CSS media queries */
    @media (max-width: 1000px) {
        .card {
            margin: 0 !important;
            width: 100% !important;
        }
    }
</style>