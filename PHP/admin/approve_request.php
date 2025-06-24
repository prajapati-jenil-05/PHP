<?php
require_once '../connect.php';

if (isset($_POST['requestId'])) {
    $requestId = $_POST['requestId'];

    $stmt = $con->prepare("SELECT TaskID FROM task_completion_requests WHERE RequestID = ?");
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $taskID = $row['TaskID'];

        $con->begin_transaction(); // Start transaction for atomicity

        $stmt1 = $con->prepare("UPDATE task_completion_requests SET Status = 'Approved' WHERE RequestID = ?");
        $stmt1->bind_param("i", $requestId);
        $stmt1->execute();

        $stmt2 = $con->prepare("UPDATE tasks SET Status = 'Completed' WHERE TaskID = ?");
        $stmt2->bind_param("i", $taskID);
        $stmt2->execute();

        if ($stmt1->affected_rows > 0 && $stmt2->affected_rows > 0) {
            $con->commit(); // Commit if both updates succeeded
            echo "Request and task updated successfully.";
        } else {
            $con->rollback(); // Rollback if either update failed
            echo "Failed to update request or task.";
        }

        $stmt2->close();
        $stmt1->close();
    } else {
        echo "Request ID not found.";
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid request.";
}
