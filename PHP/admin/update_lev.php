<!-- PHP Script to Update Status -->
<?php
try {
    $con = mysqli_connect("localhost", "root", "", "my_database");
} catch (Exception $E) {
    echo "Error in connecting to database.";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leaveid = $_POST['leaveid'];
    $status = $_POST['status'];

    $query = "UPDATE leave_requests SET status='$status' WHERE id='$leaveid'";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Status updated successfully!'); window.location.href='admin_panel.php?load=leaveReq';</script>";
    } else {
        echo "<script>alert('Error updating status!');</script>";
    }
}
?>