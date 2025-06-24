<div class="card shadow mb-4 mx-4 mt-4 col-8">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">All Leave Requests</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerAllReqPage">Rows per page:</label>
            <select id="rowsPerAllReqPage" class="form-select w-auto d-inline" onchange="updateTable_all_req()">
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
            <div id="pagination_all_req" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentAllReqPage = 1;
    let rowsPerAllReqPage = 5;
    let data_all_req = [];

    async function fetchData_all_req() {
        try {
            const response = await fetch("fetch_all_req.php");
            data_all_req = await response.json();
            updateTable_all_req();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_all_req() {
        rowsPerAllReqPage = parseInt(document.getElementById("rowsPerAllReqPage").value);
        const start = (currentAllReqPage - 1) * rowsPerAllReqPage;
        const end = start + rowsPerAllReqPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data_all_req.slice(start, end).forEach(leave_req => {
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
        const totalPages = Math.ceil(data_all_req.length / rowsPerAllReqPage);
        const paginationContainer = document.getElementById("pagination_all_req");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageAllButton = document.createElement("button");
            pageAllButton.className = `btn ${i === currentAllReqPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageAllButton.innerText = i;
            pageAllButton.onclick = () => {
                currentAllReqPage = i;
                updateTable_all_req();
            };
            paginationContainer.appendChild(pageAllButton);
        }
    }

    function leaveAction(leaveID) {
        $('#content').load('admin_edit_leave_req.php', {
            leaveid: leaveID
        });
    }

    fetchData_all_req();
</script>

<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            $(window).width() < 1100 ? $(".card").removeClass("mb-4 mx-4 col-8") : $(".card").addClass("mb-4 mx-4 col-8");
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        setInterval(fetchData_all_req, 3000);
        setInterval(updatePagination, 1000);
    });
</script>