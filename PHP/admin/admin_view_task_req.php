<?php
require_once '../connect.php'; // Assuming this file establishes your database connection

$taskIdToDisplay = $_GET['taskid']; // Get the TaskID from the URL parameter
$requestId = $_GET['requestId'];
$sqlSelectTask = "SELECT * FROM tasks WHERE TaskID = ?";
$stmt = $con->prepare($sqlSelectTask);
$stmt->bind_param("s", $taskIdToDisplay); // Assuming TaskID is a string, adjust if it's an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $taskId = htmlspecialchars($row['TaskID']);
    $title = htmlspecialchars($row['Title']);
    $taskDescription = htmlspecialchars($row['TaskDescription']);
    $assignedTo = htmlspecialchars($row['AssignedTo']);
    $startTime = htmlspecialchars($row['StartTime']);
    $endTime = htmlspecialchars($row['EndTime']);
    $status = htmlspecialchars($row['Status']);
    $employeeId = htmlspecialchars($row['employee_id']);

    // Output the card HTML
?><center>
        <div class="mx-3 my-3">
            <h1 style="padding: 0 20px 0 20px;">View Task Details</h1>
            <hr>
        </div>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="card mb-3 mx-3 my-3 col-md-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Task ID: <?php echo $taskId; ?></h6>
                    <p class="card-text"><strong>Description:</strong> <?php echo $taskDescription; ?></p>
                    <p class="card-text"><strong>Assigned To:</strong> <?php echo $assignedTo; ?></p>
                    <p class="card-text"><strong>Start Time:</strong> <?php echo $startTime; ?></p>
                    <p class="card-text"><strong>End Time:</strong> <?php echo $endTime; ?></p>
                    <p class="card-text"><strong>Status:</strong> <?php echo $status; ?></p>
                    <p class="card-text"><strong>Employee ID:</strong> <?php echo $employeeId; ?></p>
                    <div class="btn-group mt-3">
                        <button class="btn btn-outline-success" type="button" onclick="approveRequest('<?php echo $requestId; ?>');">Approve</button>
                        <button class="btn btn-outline-secondary" type="button" onclick="$('#content').load('admin_task_req.php');">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function approveRequest(taskId) {
            $.ajax({
                url: 'approve_request.php',
                type: 'POST',
                data: {
                    requestId: taskId
                },
                success: function(response) {
                    alert(response);
                    $('#content').load('admin_task_req.php');
                },
                error: function(xhr, status, error) {
                    console.error("Error approving request:", error);
                    alert("Error approving request.");
                }
            });
        }
    </script>
<?php

} else {
    echo "<p>Task not found.</p>";
}

$stmt->close();
$con->close();
?>