<?php
// $password = "HelloWorld!";

// // Encode using Base64
// $encoded = base64_encode($password);

// // Decode back to original
// $decoded = base64_decode($encoded);

// echo "🔑 Original: $password\n";
// echo "📜 Encoded (Base64): $encoded\n";
// echo "🔓 Decoded: $decoded\n";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .card-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .role-toggle {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .role-toggle .btn {
            border-radius: 20px;
            margin: 0 5px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .role-toggle .btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3>Welcome Back!</h3>
        </div>
        <div class="card-body">
            <!-- Role Toggle Buttons -->
            <div class="role-toggle">
                <button type="button" id="employeeBtn" class="btn btn-outline-primary active" onclick="setRole('employee')">Employee</button>
                <button type="button" id="adminBtn" class="btn btn-outline-primary" onclick="setRole('admin')">Admin</button>
            </div>

            <!-- Login Form -->
            <form action="login.php" method="post" id="loginForm">
                <input type="hidden" name="role" id="role" value="employee" required>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- Error Message -->
            <?php if (!empty($loginError)): ?>
                <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($loginError); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function setRole(role) {
            // Set the role in the hidden input field
            document.getElementById("role").value = role;

            // Toggle active state for buttons
            const employeeBtn = document.getElementById("employeeBtn");
            const adminBtn = document.getElementById("adminBtn");

            if (role === "employee") {
                employeeBtn.classList.add("active");
                adminBtn.classList.remove("active");
            } else {
                adminBtn.classList.add("active");
                employeeBtn.classList.remove("active");
            }
        }
    </script>
</body>

</html>