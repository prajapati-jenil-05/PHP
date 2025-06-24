<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

// Function to calculate payroll based on leaves
function calculatePayroll($employeeID, $month, $year, $mysqli)
{
    // Fetch employee details
    $employeeQuery = "SELECT salary FROM employees WHERE employee_id = ?";
    $stmt = $mysqli->prepare($employeeQuery);
    $stmt->bind_param("i", $employeeID);
    $stmt->execute();
    $employeeResult = $stmt->get_result();
    $employee = $employeeResult->fetch_assoc();

    if (!$employee) {
        return "Employee not found.";
    }

    $monthlySalary = $employee['salary'];
    $dailyWage = $monthlySalary / 30; // Assuming 30 working days in a month

    // Fetch leaves for the given month and year
    $leaveQuery = "SELECT leave_type, from_date, to_date FROM leave_requests 
                   WHERE employee_id = ? 
                   AND MONTH(from_date) = ? AND YEAR(from_date) = ?";
    $stmt = $mysqli->prepare($leaveQuery);
    $stmt->bind_param("iii", $employeeID, $month, $year);
    $stmt->execute();
    $leaveResult = $stmt->get_result();

    $totalDeductions = 0;

    // Calculate deductions based on leaves
    while ($leave = $leaveResult->fetch_assoc()) {
        $startDate = new DateTime($leave['from_date']);
        $endDate = new DateTime($leave['to_date']);
        $interval = $startDate->diff($endDate);
        $leaveDays = $interval->days + 1; // Include both start and end dates

        // Check leave type and apply deductions accordingly
        switch ($leave['leave_type']) {
            case 'Sick Leave':
            case 'Casual Leave':
            case 'Annual Leave':
            case 'Maternity Leave':
            case 'Paternity Leave':
                // These are paid leaves, so no deduction
                break;
            default:
                // For any other leave type (e.g., Unpaid Leave), deduct daily wage
                $totalDeductions += $leaveDays * $dailyWage;
                break;
        }
    }

    // Calculate final payroll
    $finalPayroll = $monthlySalary - $totalDeductions;

    return [
        'employee_id' => $employeeID,
        'BaseSalary' => $monthlySalary,
        'DailyWage' => $dailyWage,
        'TotalDeductions' => $totalDeductions,
        'FinalPayroll' => $finalPayroll
    ];
}

// Example usage
$employeeID = 1; // Employee ID to calculate payroll for
$month = 10;     // October
$year = 2023;    // Year 2023

$payroll = calculatePayroll($employeeID, $month, $year, $mysqli);

echo "<pre>";
print_r($payroll);
echo "</pre>";

$mysqli->close();
