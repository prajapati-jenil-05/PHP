<?php
// leave_repo.php

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

    // Fetch leave requests from the database
    $query = "SELECT * FROM leave_requests WHERE from_date >= ? AND to_date <= ?";
    $stmt = $mysqli->prepare($query);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind parameters
    $stmt->bind_param("ss", $fromDate, $toDate);

    // Execute the query
    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();
    $leaveRequests = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement and connection
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

                <label for="statusFilter" class="ms-3">Filter by Status:</label>
                <select id="statusFilter" class="form-select w-auto d-inline" onchange="updateTable()">
                    <option value="">All</option>
                    <option value="New">New</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                </select>
                <button class="btn btn-secondary ms-2" onclick="clearFilter()">Clear Filter</button>

                <div class="table-responsive">
                    <table class="table table-hover mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Reason</th>
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
        const statusFilter = document.getElementById("statusFilter").value;
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        let filteredData = data;
        if (statusFilter) {
            filteredData = data.filter(leave => leave.STATUS === statusFilter);
        }

        filteredData.slice(start, end).forEach((leave, index) => {
            tableBody.innerHTML += `
                <tr>
                    <td>${start + index + 1}</td>
                    <td>${leave.employee_id}</td>
                    <td>${leave.from_date}</td>
                    <td>${leave.to_date}</td>
                    <td>${leave.leave_type}</td>
                    <td>${leave.STATUS}</td>
                </tr>`;
        });
    }

    function clearFilter() {
        document.getElementById("statusFilter").value = "";
        updateTable();
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