<?php
// index.php
// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Requests Manager</title>
    <style>
        .status-badge {
            font-size: 0.8rem;
        }

        .message-cell {
            max-width: 300px;
            white-space: pre-wrap;
        }

        .email-link {
            word-break: break-all;
        }

        .card-header {
            background: #2c3e50;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-4 mb-5">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="bi bi-person-lines-fill"></i> Contact Requests</h3>
                <a href="https://mail.google.com" target="_blank" class="btn btn-light">
                    <i class="bi bi-envelope-plus"></i> Open Gmail
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Mobile</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM contact_request ORDER BY is_replied ASC, id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $status = $row['is_replied']
                                        ? '<span class="badge bg-success status-badge"><i class="bi bi-check-circle"></i> Replied ' . date('M j', strtotime($row['replied_at'])) . '</span>'
                                        : '<span class="badge bg-danger status-badge"><i class="bi bi-x-circle"></i> Pending</span>';

                                    echo '<tr data-id="' . $row['id'] . '">
                                        <td class="status-cell">' . $status . '</td>
                                        <td>' . htmlspecialchars($row['fullname']) . '</td>
                                        <td><a href="mailto:' . $row['email'] . '" class="email-link">' . $row['email'] . '</a></td>
                                        <td>' . htmlspecialchars($row['subject']) . '</td>
                                        <td>' . $row['mobile'] . '</td>
                                        <td class="message-cell">' . nl2br(htmlspecialchars($row['message'])) . '</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=' . $row["email"] . '&su=Re: ' . urlencode($row["subject"]) . '&body=Dear ' . urlencode($row["fullname"]) . ',%0A%0AYour message: ' . urlencode($row["message"]) . '%0A%0AMobile: ' . urlencode($row["mobile"]) . '"
                                                    target="_blank"
                                                    class="btn btn-sm ' . ($row['is_replied'] ? 'btn-outline-primary' : 'btn-primary') . ' reply-btn">
                                                    <i class="bi bi-reply"></i> ' . ($row['is_replied'] ? 'View' : 'Reply') . '
                                                </a>
                                                ' . ($row['is_replied'] ? '' : '
                                                <button type="button" class="btn btn-sm btn-success mark-replied-btn">
                                                    <i class="bi bi-check-lg"></i> Mark
                                                </button>
                                                ') . '
                                            </div>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center py-4">No contact requests found</td></tr>';
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.mark-replied-btn').forEach(button => {
            button.addEventListener('click', async () => {
                if (!confirm('Mark this request as replied?')) return;

                const row = button.closest('tr');
                const id = row.dataset.id;

                try {
                    const response = await fetch('api.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'id=' + encodeURIComponent(id)
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        // Update status badge
                        row.querySelector('.status-cell').innerHTML = `
                            <span class="badge bg-success status-badge">
                                <i class="bi bi-check-circle"></i> Replied ${result.date}
                            </span>
                        `;

                        // Update reply button
                        const replyBtn = row.querySelector('.reply-btn');
                        replyBtn.classList.replace('btn-primary', 'btn-outline-primary');
                        replyBtn.innerHTML = '<i class="bi bi-reply"></i> View';

                        // Remove mark button
                        button.remove();
                    } else {
                        alert('Error: ' + (result.message || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Request failed: ' + error.message);
                }
            });
        });
    </script>
</body>

</html>