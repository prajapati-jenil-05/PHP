<?php
session_start();
include_once("config_reg_log.php");
if (isset($_SESSION["user_id"])) {
  // Database configuration
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "my_database";

  // Create connection
  $conn = mysqli_connect($host, $user, $password, $database);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Get user role
  $user_id = $_SESSION["user_id"];
  $query = "SELECT role FROM employee WHERE id = ?";

  // Prepare statement
  if ($stmt = mysqli_prepare($conn, $query)) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
      // Bind result variables
      mysqli_stmt_bind_result($stmt, $role);

      // Fetch value
      if (mysqli_stmt_fetch($stmt)) {
        // Redirect based on role
        if ($role === 'admin') {
          header("Location: admin/admin_panel.php");
        } else {
          header("Location: employee/employee_panel.php");
        }
        exit();
      } else {
        // User not found in database, destroy session
        session_unset();
        session_destroy();
      }
    }
    // Close statement
    mysqli_stmt_close($stmt);
  }
  // Close connection
  mysqli_close($conn);
}
// Database configuration
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$loginError = "";
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
// $delete_query = "DELETE FROM password_token WHERE expires_at < '$current_time'";
// $conn->query($delete_query);
$q = "UPDATE password_token SET otp_attempts = 0 WHERE TIMESTAMPDIFF(HOUR, last_resend, NOW()) >= 24";
$conn->query($q);
$remove_otp = "update password_token set otp=NULL WHERE expires_at < '$current_time'";
$conn->query($remove_otp);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  if (empty($email) || empty($password)) {
    $loginError = "Please fill in all fields.";
  } else {
    $stmt = $conn->prepare("SELECT id, email, password, role FROM employee WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($userId, $dbEmail, $hashedPassword, $role);
      $stmt->fetch();

      if (password_verify($password, $hashedPassword)) {
        session_regenerate_id(true); // Prevent session fixation
        $_SESSION["user_id"] = $userId;
        $_SESSION["email"] = $dbEmail;
        $_SESSION["role"] = $role;
        if ($role == 'admin') {
          header("Location: admin/admin_panel.php");
          exit();
        } elseif ($role == 'employee') {
          header("Location: employee/employee_panel.php");
          exit();
        }
      } else {
        $loginError = "Invalid email or password.";
      }
    } else {
      $loginError = "Invalid email or password.";
    }
    $stmt->close();
  }
}
$conn->close();
?>


<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
  }

  .card {
    width: 350px;
    border-radius: 15px;
    box-shadow: 3px 4px 10px rgba(0, 0, 0, 0.2);
  }

  .btn-selected {
    background-color: #000;
    color: white;
  }

  .disabled-link {
    pointer-events: none;
    color: gray !important;
    text-decoration: none;
    cursor: not-allowed;
  }
</style>
</head>

<body>
  <div class="card p-4">
    <h4 class="text-center mb-4">LOGIN</h4>
    <?php if (!empty($loginError)): ?>
      <div class="alert alert-danger"> <?php echo htmlspecialchars($loginError); ?> </div>
    <?php endif; ?>
    <form action="login.php" method="post" id="form1">
      <div class="mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>
      <div class="mb-3">
        <span style="margin-left: 5px;">Forgot Password ? </span><a href="forgot_password.php" style="text-decoration: none; color: red;">Click Here</a>
      </div>
      <div class="btn-group w-100">
        <button type="submit" class="btn btn-outline-dark w-100">Login</button>
        <button onclick="history.back()" class="btn btn-outline-secondary w-100">Back</button>
      </div>
    </form>
  </div>
  <script>
    $(document).ready(function() {
      $('#form1').validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
          }
        },
        messages: {
          email: {
            required: "Email is required field",
            email: "Invalid email address",
          },
          password: {
            required: "Password is required field"
          }
        }
      });
    });
  </script>