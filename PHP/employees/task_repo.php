<?php
// task_repo.php
session_start();
$email = $_SESSION['email'];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fromDate = $_POST['taskrepofrom'] ?? null;
    $toDate = $_POST['taskrepoto'] ?? null;

    // Validate dates
    if (empty($fromDate) || empty($toDate)) {
        die("Please provide both From and To dates.");
    }

    // Database connection details
    $host = "localhost"; // Database host
    $username = "root"; // Database username
    $password = ""; // Database password
    $database = "my_database2"; // Database name

    // Create a mysqli connection
    $mysqli = new mysqli($host, $username, $password, $database);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    // Fetch employee name based on email
    $queryEmp = "SELECT first_name, last_name FROM employees WHERE email = ?";
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

    // Concatenate full name
    $empName = $employee['first_name'] . " " . $employee['last_name'];

    // Fetch tasks assigned to this employee
    $query = "SELECT * FROM tasks WHERE DATE(StartTime) >= ? AND DATE(EndTime) <= ? AND AssignedTo = ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind the employee's full name as a string
    $stmt->bind_param("sss", $fromDate, $toDate, $empName);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $tasks = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $mysqli->close();
}
?>

<div class="card shadow mb-4 mx-4 mt-4 col-lg-8 col-12">
    <div class="card-body">
        <?php if (!empty($tasks)) : ?>
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
                                <th>Task ID</th>
                                <th>Task Title</th>
                                <th>Assigned To</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php foreach ($tasks as $task) : ?>
                                <tr>
                                    <td><?php echo $task['TaskID']; ?></td>
                                    <td><?php echo $task['Title']; ?></td>
                                    <td><?php echo $task['AssignedTo']; ?></td>
                                    <td><?php echo $task['StartTime']; ?></td>
                                    <td><?php echo $task['EndTime']; ?></td>
                                    <td><?php echo $task['Status']; ?></td>
                                    <td><?php echo "Action"; ?></td>
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
            <p class="text-center">No tasks found for the selected date range.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    let currentPage = 1;
    let rowsPerPage = 5;
    let data = <?php echo json_encode($tasks ?? []); ?>;

    function updateTable() {
        rowsPerPage = parseInt(document.getElementById("rowsPerPage").value);
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data.slice(start, end).forEach(task => {
            tableBody.innerHTML += `
            <tr>
                <td>${task.TaskID}</td>
                <td>${task.Title}</td>
                <td>${task.AssignedTo}</td>
                <td>${task.StartTime}</td>
                <td>${task.EndTime}</td>
                <td>${task.Status}</td>
                <td>
                    <button class="btn btn-outline-success">Complete</button>
                </td>
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