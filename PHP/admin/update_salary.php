<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        max-width: 600px;
        margin-top: 50px;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <div class="card shadow mb-4 mx-4 mt-4 col-3" style="padding: 20px;">
        <h2 class="text-center card-title" style="font-weight: 500;">Calculated Salary</h2>
        <hr>
        <div id="result card-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_id'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "my_database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("<div class='alert alert-danger'>Connection failed: " . $conn->connect_error . "</div>");
                }

                $employee_id = $_POST['employee_id'];
                $sql = "SELECT salary FROM employee WHERE id = '$employee_id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $salary = $row['salary'] ?? 0;

                $sql = "SELECT SUM(DATEDIFF(to_date, from_date) + 1) AS unpaid_leaves FROM leave_requests lr JOIN leaves l ON lr.leave_id = l.leave_id WHERE lr.employee_id = '$employee_id' AND l.is_paid = 0 AND lr.STATUS = 'Approved'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $unpaid_leaves = $row['unpaid_leaves'] ?? 0;

                $daily_salary = $salary / 365;
                $deduction = $unpaid_leaves * $daily_salary;
                $final_salary = $salary - $deduction;

                echo "<div class='alert alert-info'>";
                echo "<strong>Base Salary:</strong> $" . number_format($salary, 2) . "<br>";
                echo "<strong>Unpaid Leave Days:</strong> " . $unpaid_leaves . "<br>";
                echo "<strong>Deduction:</strong> $" . number_format($deduction, 2) . "<br>";
                echo "<strong>Final Salary:</strong> $" . number_format($final_salary, 2);
                echo "</div>";
            ?> <button type='button' class='btn btn-outline-dark w-100' onclick='$("#content").load("admin_manage_salary.php");'>Back</button>
            <?php

                $conn->close();
            }
            ?>
        </div>
    </div>
</body>