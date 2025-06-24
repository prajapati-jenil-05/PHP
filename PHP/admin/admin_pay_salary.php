<?php
session_start();

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'empid' is set in the POST request
if (isset($_POST['empid'])) {
    $empId = $_POST['empid'];

    // Fetch employee data from the database based on empId
    $sql = "SELECT * FROM employees WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter to the SQL query
        $stmt->bind_param("i", $empId);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if data is found
        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
            $employee['password'] = base64_decode($employee['password']);
        } else {
            echo "No employee found with the provided ID.";
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
        exit();
    }
} else {
    // Redirect to an error page or show a message if no ID is passed
    echo "No employee ID provided.";
    exit();
}
?>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-center bg-primary text-white">
            <h2>Salary Payment</h2>
        </div>
        <div class="card-body">
            <form id="salaryForm">
                <div class="mb-3">
                    <label for="employee" class="form-label">Select Employee</label>
                    <input type="efname" class="form-control shadow-sm" id="efname" placeholder="<?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?>" name="efname" disabled>
                </div>

                <div class="mb-3">
                    <label for="basicSalary" class="form-label">Basic Salary</label>
                    <input type="number" id="basicSalary" class="form-control" value="<?php echo $employee['salary'] ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="deductions" class="form-label">Deductions</label>
                    <input type="number" id="deductions" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="netSalary" class="form-label">Net Salary</label>
                    <input type="number" id="netSalary" class="form-control" value="<?php echo $employee['salary'] ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select id="paymentMethod" class="form-select" required>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Process Payment</button><br><br>
                <a href="#" class="btn btn-outline-danger w-100" onclick="$('#content').load('admin_manage_employee.php');">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("salaryForm").addEventListener("input", function() {
        const basicSalary = parseFloat(document.getElementById("basicSalary").value) || 0;
        const deductions = parseFloat(document.getElementById("deductions").value) || 0;
        document.getElementById("netSalary").value = basicSalary - deductions;
    });

    document.getElementById("salaryForm").addEventListener("submit", function(event) {
        event.preventDefault();
        alert("Salary Payment Processed Successfully!");
    });
</script>