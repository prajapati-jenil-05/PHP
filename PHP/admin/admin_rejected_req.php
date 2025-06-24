<div class="card shadow mb-4 mx-4 mt-4 col-8 ">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Rejected Leave Requests</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerRejectedReqPage">Rows per page:</label>
            <select id="rowsPerRejectedReqPage" class="form-select w-auto d-inline" onchange="updateTable_rejected_req()">
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
            <div id="pagination_reg_req" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentRejectedReqPage = 1;
    let rowsPerRejectedReqPage = 5;
    let data_rejected_req = [];

    async function fetchData_rejected_req() {
        try {
            const response = await fetch("fetch_rejected_req.php");
            data_rejected_req = await response.json();
            updateTable_rejected_req();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_rejected_req() {
        rowsPerRejectedReqPage = parseInt(document.getElementById("rowsPerRejectedReqPage").value);
        const start = (currentRejectedReqPage - 1) * rowsPerRejectedReqPage;
        const end = start + rowsPerRejectedReqPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        const paginatedData = data_rejected_req.slice(start, end);

        paginatedData.forEach(leave_req => {
            tableBody.innerHTML += `
                <tr>
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
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(data_rejected_req.length / rowsPerRejectedReqPage);
        const paginationContainer = document.getElementById("pagination_reg_req");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentRejectedReqPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentRejectedReqPage = i;
                updateTable_rejected_req();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    function leaveAction(leaveID) {
        $('#content').load('admin_edit_leave_req.php', {
            leaveid: leaveID
        });
    }

    fetchData_rejected_req();
</script>
<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            if ($(window).width() < 1100) {
                $(".card").removeClass("mb-4 mx-4 col-8");
            } else {
                $(".card").addClass("mb-4 mx-4 col-8");
            }
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        setInterval(fetchData_rejected_req, 3000);
        setInterval(updatePagination, 1000);
    });
</script>