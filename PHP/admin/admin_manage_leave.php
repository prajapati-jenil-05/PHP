<div class="card shadow mb-4 mx-4 mt-4 col-6">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Manage Leave Types</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerLeavePage">Rows per page:</label>
            <select id="rowsPerLeavePage" class="form-select w-auto d-inline" onchange="updateTable_leave()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            <table class="table table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination buttons will be dynamically inserted here -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    let currentLeavePage = 1;
    let rowsPerLeavePage = 5;
    let data_leave = [];

    async function fetchData_leave() {
        try {
            const response = await fetch("fetch_leaves.php");
            data_leave = await response.json();
            updateTable_leave();
            updateLeavePagination();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_leave() {
        rowsPerLeavePage = parseInt(document.getElementById("rowsPerLeavePage").value);
        const start = (currentLeavePage - 1) * rowsPerLeavePage;
        const end = start + rowsPerLeavePage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data_leave.slice(start, end).forEach(leave => {
            const row = `<tr>
                            <td>${leave.leave_id}</td>
                            <td>${leave.leave_name}</td>
                            <td>
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-success" onclick="editLeave(${leave.leave_id})">Edit</button>
                                    <button class="btn btn-outline-danger" onclick="deleteLeave(${leave.leave_id})">Delete</button>
                                </div>
                            </td>
                        </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function updateLeavePagination() {
        const totalPages = Math.ceil(data_leave.length / rowsPerLeavePage);
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        // Previous Button
        pagination.innerHTML += `<li class="page-item ${currentLeavePage === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changeLeavePage(${currentLeavePage - 1})">Previous</a>
                                </li>`;

        // Page Numbers
        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `<li class="page-item ${i === currentLeavePage ? 'active' : ''}">
                                        <a class="page-link" href="#" onclick="changeLeavePage(${i})">${i}</a>
                                    </li>`;
        }

        // Next Button
        pagination.innerHTML += `<li class="page-item ${currentLeavePage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changeLeavePage(${currentLeavePage + 1})">Next</a>
                                </li>`;
    }

    function changeLeavePage(page) {
        if (page < 1 || page > Math.ceil(data_leave.length / rowsPerLeavePage)) return;
        currentLeavePage = page;
        updateTable_leave();
        updateLeavePagination();
    }

    function editLeave(leaveId) {
        $('#content').load('update_leave.php', {
            leaveid: leaveId
        });
    }

    function deleteLeave(leaveId) {
        $('#content').load('delete_leave.php', {
            leaveid: leaveId
        });
    }

    fetchData_leave();
</script>

<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            if ($(window).width() < 768) { // Change 768 to your desired breakpoint
                $(".card").removeClass("mb-4 mx-4 col-6");
            } else {
                $(".card").addClass("mb-4 mx-4 col-6");
            }
        }

        checkScreenWidth(); // Run on page load
        $(window).resize(checkScreenWidth); // Run on window resize

        let intervalId;
        let duration = 10;

        // Start the interval
        intervalId = setInterval(fetchData_leave, 1000);

        // Stop the interval after `duration` seconds
        setTimeout(() => {
            clearInterval(intervalId);
        }, duration * 1000);
    });
</script>