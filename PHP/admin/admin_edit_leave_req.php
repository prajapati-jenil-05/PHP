<!-- Edit Leave Request Page -->
<?php
$con = mysqli_connect("localhost", "root", "", "my_database") or die("Error connecting to database");
if (isset($_POST['leaveid'])) {
    $leaveid = $_POST['leaveid'];
} else {
    echo "Leave Id could not fetch.";
    die();
}
$result = mysqli_query($con, "SELECT * FROM leave_requests WHERE id='$leaveid'");
$leave = mysqli_fetch_assoc($result);
?>

<div class="card shadow mb-4 mx-4 mt-4 col-3">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Edit Leave Status</h4>
        <hr>
        <form action="update_lev.php" method="post">
            <input type="hidden" name="leaveid" value="<?php echo $leave['id']; ?>">
            <label for="status" class="form-label mb-3">Change status to:</label>
            <select class="form-control shadow-sm mb-3" name="status" required>
                <option value="Approved" <?php if ($leave['STATUS'] == 'Approved') echo 'selected'; ?>>Approved</option>
                <option value="Rejected" <?php if ($leave['STATUS'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
            </select>
            <div class="btn-group w-100">
                <button type="submit" class="btn btn-outline-success mb-3">Submit</button>
                <button type="button" class="btn btn-outline-dark mb-3" onclick="$('#content').load('admin_all_req.php');">Back</button>
            </div>
        </form>
    </div>
</div>