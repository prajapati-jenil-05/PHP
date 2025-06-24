<?php
// task_repo.php

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromDate = $_POST['taskrepofrom'] ?? null;
    $toDate = $_POST['taskrepoto'] ?? null;

    if (empty($fromDate) || empty($toDate)) {
        die("Please provide both From and To dates.");
    }

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "my_database";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
    }

    $query = "SELECT * FROM tasks WHERE DATE(StartTime) >= ? AND DATE(EndTime) <= ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $fromDate, $toDate);

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
                <label for="rowsPerPage">Rows per page:</label>
                <select id="rowsPerPage" class="form-select w-auto d-inline" onchange="updateTable()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

                <label for="statusFilter" class="ms-3">Filter by Status:</label>
                <select id="statusFilter" class="form-select w-auto d-inline" onchange="updateTable()">
                    <option value="">All</option>
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
                <button class="btn btn-secondary ms-2" onclick="clearFilter()">Clear Filter</button>

                <div class="table-responsive">
                    <table class="table table-hover mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Sr. No</th>
                                <th>Task ID</th>
                                <th>Task Title</th>
                                <th>Assigned To</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
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
        const statusFilter = document.getElementById("statusFilter").value;
        let filteredData = data;

        if (statusFilter) {
            filteredData = data.filter(task => task.Status === statusFilter);
        }

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        filteredData.slice(start, end).forEach((task, index) => {
            tableBody.innerHTML += `
            <tr>
                <td>${start + index + 1}</td>
                <td>${task.TaskID}</td>
                <td>${task.Title}</td>
                <td>${task.AssignedTo}</td>
                <td>${task.StartTime}</td>
                <td>${task.EndTime}</td>
                <td>${task.Status}</td>
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

    function clearFilter() {
        document.getElementById("statusFilter").value = "";
        updateTable();
    }

    updateTable();
</script>