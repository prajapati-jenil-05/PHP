<?php
session_start();
// Get task ID from query parameter
$taskId = $_GET['task_id'];
print_r($_GET);
?>

<div class="card shadow mb-4 mx-4 mt-4 col-md-4">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Submit Task Completion Request</h4>
        <hr>
        <form id="requestForm" method="post" action="submit_request_backend.php">
            <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
            <label for="request_description" class="form-label mb-3">Description:</label><br>
            <textarea name="request_description" class="form-control shadow-sm mb-3" rows="4" cols="50"></textarea><br><br>
            <div class="btn-group w-100">
                <button type="submit" class="btn btn-outline-success mb-3">Submit Request</button>
                <button type="button" class="btn btn-outline-dark mb-3" onclick="$('#content').load('employee_tasks.php');">Back</button>
            </div>
        </form>
    </div>
</div>