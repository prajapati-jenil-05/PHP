<div class="card shadow mb-4 mx-4 mt-4 col-8">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">New Leave Requests</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerNewReqPage">Rows per page:</label>
            <select id="rowsPerNewReqPage" class="form-select w-auto d-inline" onchange="updateTable_new_req()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Leave Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Posting Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div id="pagination_new_req" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentNewReqPage = 1;
    let rowsPerNewReqPage = 5;
    let data_new_req = [];

    async function fetchData_new_req() {
        try {
            const response = await fetch("fetch_new_req.php");
            data_new_req = await response.json();
            updateTable_new_req();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_new_req() {
        rowsPerNewReqPage = parseInt(document.getElementById("rowsPerNewReqPage").value);
        const start = (currentNewReqPage - 1) * rowsPerNewReqPage;
        const end = start + rowsPerNewReqPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data_new_req.slice(start, end).forEach(leave_req => {
            const row = `<tr>
                            <td>${leave_req.id}</td>
                            <td>${leave_req.employee_id}</td>
                            <td>${leave_req.leave_type}</td>
                            <td>${leave_req.from_date}</td>
                            <td>${leave_req.to_date}</td>
                            <td>${leave_req.posting_date}</td>
                            <td>${leave_req.STATUS}</td>
                            <td>
                                <button class="btn btn-outline-warning" onclick="leaveAction(${leave_req.id})">Edit</button>
                            </td>
                        </tr>`;
            tableBody.innerHTML += row;
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(data_new_req.length / rowsPerNewReqPage);
        const paginationContainer = document.getElementById("pagination_new_req");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentNewReqPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentNewReqPage = i;
                updateTable_new_req();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    function leaveAction(leaveID) {
        $('#content').load('admin_edit_leave_req.php', {
            leaveid: leaveID
        });
    }

    fetchData_new_req();
</script>

<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            $(window).width() < 1100 ? $(".card").removeClass("mb-4 mx-4 col-8") : $(".card").addClass("mb-4 mx-4 col-8");
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        setInterval(fetchData_new_req, 3000);
        setInterval(updatePagination, 1000); // Auto refresh pagination every 10 seconds

    });
</script>