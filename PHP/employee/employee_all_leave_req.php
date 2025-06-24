<?php
include '../connect.php';
session_start();
$email = $_SESSION['email'];
?>
<div class="card shadow mb-4 mx-4 mt-4 col-8 ">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Leave Request History</h4>
        <hr>
        <div class="container mt-4">
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Leave Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $empfind = "SELECT id FROM employee WHERE email = '$email';";
                    if ($result = $con->query($empfind)->fetch_assoc()) {
                        $empid = $result['id'];
                    } else {
                        exit();
                    }
                    $query = "SELECT * FROM leave_requests where employee_id = $empid";
                    $data = mysqli_query($con, $query);
                    $result = mysqli_num_rows($data);
                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                    ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['leave_type']; ?></td>
                                <td><?php echo $row['from_date']; ?></td>
                                <td><?php echo $row['to_date']; ?></td>
                                <td><?php echo $row['STATUS']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <br>
        </div>
    </div>
</div>