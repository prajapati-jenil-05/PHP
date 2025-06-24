<div class="card shadow mb-4 mx-4 mt-4 col-8 ">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Approved Leave Requests</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerApprovedReqPage">Rows per page:</label>
            <select id="rowsPerApprovedReqPage" class="form-select w-auto d-inline" onchange="updateTable_approved_req()">
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
            <div id="pagination_appro_req" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentApprovedReqPage = 1;
    let rowsPerApprovedReqPage = 5;
    let data_approved_req = [];

    async function fetchData_approved_req() {
        try {
            const response = await fetch("fetch_approved_req.php");
            data_approved_req = await response.json();
            updateTable_approved_req();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_approved_req() {
        rowsPerApprovedReqPage = parseInt(document.getElementById("rowsPerApprovedReqPage").value);
        const start = (currentApprovedReqPage - 1) * rowsPerApprovedReqPage;
        const end = start + rowsPerApprovedReqPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        const paginatedData = data_approved_req.slice(start, end);

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
        const totalPages = Math.ceil(data_approved_req.length / rowsPerApprovedReqPage);
        const paginationContainer = document.getElementById("pagination_appro_req");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentApprovedReqPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentApprovedReqPage = i;
                updateTable_approved_req();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    function leaveAction(leaveID) {
        $('#content').load('admin_edit_leave_req.php', {
            leaveid: leaveID
        });
    }

    fetchData_approved_req();
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

        setInterval(fetchData_approved_req, 3000);
        setInterval(updatePagination, 1000);
    });
</script>