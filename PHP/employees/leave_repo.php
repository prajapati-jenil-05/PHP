<?php
// leave_repo.php
session_start();
$email = $_SESSION['email'];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fromDate = $_POST['leaverepofrom'] ?? null;
    $toDate = $_POST['leaverepoto'] ?? null;

    // Validate dates
    if (empty($fromDate) || empty($toDate)) {
        die("Please provide both From and To dates.");
    }

    // Database connection details
    $host = "localhost"; // Database host
    $username = "root"; // Database username
    $password = ""; // Database password
    $database = "my_database"; // Database name

    // Create a mysqli connection
    $mysqli = new mysqli($host, $username, $password, $database);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    // Fetch employee_id based on email
    $queryEmp = "SELECT employee_id FROM employees WHERE email = ?";
    $stmtEmp = $mysqli->prepare($queryEmp);

    if (!$stmtEmp) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $stmtEmp->bind_param("s", $email);
    $stmtEmp->execute();
    $resultEmp = $stmtEmp->get_result();
    $employee = $resultEmp->fetch_assoc();
    $stmtEmp->close();

    if (!$employee) {
        die("No employee found with this email.");
    }

    $employeeId = $employee['employee_id'];

    // Now fetch leave requests using the retrieved employee_id
    $query = "SELECT * FROM leave_requests WHERE from_date >= ? AND to_date <= ? AND employee_id = ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $stmt->bind_param("ssi", $fromDate, $toDate, $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();
    $leaveRequests = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $mysqli->close();
}
?>

<div class="card shadow mb-4 mx-4 mt-4 col-lg-8 col-12">
    <div class="card-body">
        <?php if (!empty($leaveRequests)) : ?>
            <div class="container mt-4">
                <label for="rowsPerPage">Row per page:</label>
                <select id="rowsPerPage" class="form-select w-auto d-inline" onchange="updateTable()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

                <div class="table-responsive">
                    <table class="table table-hover mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Employee ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php foreach ($leaveRequests as $leave) : ?>
                                <tr>
                                    <td><?php echo $leave['employee_id']; ?></td>
                                    <td><?php echo $leave['from_date']; ?></td>
                                    <td><?php echo $leave['to_date']; ?></td>
                                    <td><?php echo $leave['leave_type']; ?></td>
                                    <td><?php echo $leave['STATUS']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>

                <button class="btn btn-primary me-2" onclick="prevPage()">Previous</button>
                <button class="btn btn-primary" onclick="nextPage()">Next</button>
            </div>
        <?php else : ?>
            <p class="text-center">No leave requests found for the selected date range.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    let currentPage = 1;
    let rowsPerPage = 5;
    let data = <?php echo json_encode($leaveRequests ?? []); ?>;

    function updateTable() {
        rowsPerPage = parseInt(document.getElementById("rowsPerPage").value);
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data.slice(start, end).forEach(leave => {
            tableBody.innerHTML += `
                <tr>
                    <td>${leave.employee_id}</td>
                    <td>${leave.from_date}</td>
                    <td>${leave.to_date}</td>
                    <td>${leave.leave_type}</td>
                    <td>${leave.STATUS}</td>
                </tr>`;
        });
    }

    function nextPage() {
        if ((currentPage * rowsPerPage) < data.length) {
            currentPage++;
            updateTable();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    }

    // Initial table update
    updateTable();
</script>