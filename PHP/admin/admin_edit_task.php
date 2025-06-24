<?php
$con = mysqli_connect("localhost", "root", "", "my_database") or die("Error connecting to database");
if (isset($_POST['taskid'])) {
    $taskid = $_POST['taskid'];
} else {
    echo "Task ID could not be fetched.";
    die();
}
$result = mysqli_query($con, "SELECT * FROM tasks WHERE TaskID=$taskid");
$task = mysqli_fetch_assoc($result);
?>

<div class="card shadow mb-4 mx-4 mt-4 col-3">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Edit Task Status</h4>
        <hr>
        <form action="update_task.php" method="post">
            <input type="hidden" name="taskid" value="<?php echo $task['TaskID']; ?>">
            <label for="status" class="form-label mb-3">Change status to:</label>
            <select class="form-control shadow-sm mb-3" name="status" required>
                <option value="Not Started" <?php if ($task['Status'] == 'Not Started') echo 'selected'; ?>>Not Started</option>
                <option value="In Progress" <?php if ($task['Status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if ($task['Status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
            <div class="btn-group w-100">
                <button type="submit" class="btn btn-outline-success mb-3">Submit</button>
                <button type="button" class="btn btn-outline-dark mb-3" onclick="$('#content').load('admin_manage_tasks.php');">Back</button>
            </div>
        </form>
    </div>
</div>