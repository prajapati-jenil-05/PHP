<center class="mx-3 my-3">
    <h1 style="padding: 0 20px 0 20px;">Task Completion Requests</h1>
    <hr>
</center>
<?php
require_once '../connect.php';

$sqlselect = "SELECT * FROM task_completion_requests";
$result = $con->query($sqlselect);

function displayTaskCompletionRequestCard($row)
{
    if (!is_array($row) || empty($row)) {
        return '<div class="card"><div class="card-body">No data available.</div></div>';
    }

    $requestId = htmlspecialchars($row['RequestID'] ?? 'N/A');
    $taskId = htmlspecialchars($row['TaskID'] ?? 'N/A');
    $employeeId = htmlspecialchars($row['EmployeeID'] ?? 'N/A');
    $requestTime = htmlspecialchars($row['RequestTime'] ?? 'N/A');
    $requestDescription = htmlspecialchars($row['RequestDescription'] ?? 'N/A');
    $status = htmlspecialchars($row['Status'] ?? 'N/A');

    $card = '<div class="card mb-3">';
    $card .= '<div class="card-body">';
    $card .= '<h5 class="card-title">Task Completion Request Details</h5>';
    $card .= '<p class="card-text"><strong>Request ID:</strong> ' . $requestId . '</p>';
    $card .= '<p class="card-text"><strong>Task ID:</strong> ' . $taskId . '</p>';
    $card .= '<p class="card-text"><strong>Employee ID:</strong> ' . $employeeId . '</p>';
    $card .= '<p class="card-text"><strong>Request Time:</strong> ' . $requestTime . '</p>';
    $card .= '<p class="card-text"><strong>Request Description:</strong> ' . $requestDescription . '</p>';
    $card .= '<p class="card-text"><strong>Status:</strong> ' . $status . '</p>';
    $card .= '<div class="btn-group mt-3">';
    $card .= '<button type="button" onclick="$(\'#content\').load(\'admin_view_task_req.php?taskid=' . $taskId . '&requestId=' . $requestId . '\')" class="btn btn-outline-primary btn-sm mr-2">View Task</button>';
    $card .= '<button type="button" onclick="approveRequest(\'' . $requestId . '\')" class="btn btn-outline-success btn-sm">Approve</button>';
    $card .= '</div>';
    $card .= '</div>';
    $card .= '</div>';

    return $card;
}
?>

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">';
                echo displayTaskCompletionRequestCard($row);
                echo '</div>';
            }
        } else {
            echo "<p>No task completion requests found.</p>";
        }

        $con->close();
        ?>
    </div>
</div>

<script>
    function approveRequest(requestId) {
        // Implement your approval logic here.
        // This could involve an AJAX call to a PHP script that updates the database.
        console.log("Approve button clicked for Request ID: " + requestId);

        // Example AJAX call (you'll need to create 'approve_request.php'):
        $.ajax({
            url: 'approve_request.php',
            type: 'POST',
            data: {
                requestId: requestId
            },
            success: function(response) {
                alert(response); // Show a message to the user
                // Optionally, reload the task requests or update the UI
                $('#content').load('admin_task_req.php');
            },
            error: function(xhr, status, error) {
                console.error("Error approving request:", error);
                alert("Error approving request.");
            }
        });
    }
</script>