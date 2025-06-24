<div class="card shadow mb-4 mx-4 mt-4 col-6">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Manage Departments</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerDepPage">Row per page:</label>
            <select id="rowsPerDepPage" class="form-select w-auto d-inline" onchange="updateTable_dep()">
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
    let currentDepPage = 1;
    let rowsPerDepPage = 5;
    let data_dep = [];

    async function fetchData_dep() {
        try {
            const response = await fetch("fetch_departments.php");
            data_dep = await response.json();
            updateTable_dep();
            updateDepartmnetPagination();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_dep() {
        rowsPerDepPage = parseInt(document.getElementById("rowsPerDepPage").value);
        const start = (currentDepPage - 1) * rowsPerDepPage;
        const end = start + rowsPerDepPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        data_dep.slice(start, end).forEach(departments => {
            const row = `<tr>
                            <td>${departments.dep_id}</td>
                            <td>${departments.dep_name}</td>
                            <td>
                                <div class="btn-group w-100">
                                    <button class="btn btn-outline-success" onclick="editDepartment(${departments.dep_id})">Edit</button>
                                    <button class="btn btn-outline-danger" onclick="deleteDepartment(${departments.dep_id})">Delete</button>
                                </div>
                            </td>
                        </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function updateDepartmnetPagination() {
        const totalPages = Math.ceil(data_dep.length / rowsPerDepPage);
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        // Previous Button
        pagination.innerHTML += `<li class="page-item ${currentDepPage === 1 ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changeDepartmentPage(${currentDepPage - 1})">Previous</a>
                                </li>`;

        // Page Numbers
        for (let i = 1; i <= totalPages; i++) {
            pagination.innerHTML += `<li class="page-item ${i === currentDepPage ? 'active' : ''}">
                                        <a class="page-link" href="#" onclick="changeDepartmentPage(${i})">${i}</a>
                                    </li>`;
        }

        // Next Button
        pagination.innerHTML += `<li class="page-item ${currentDepPage === totalPages ? 'disabled' : ''}">
                                    <a class="page-link" href="#" onclick="changeDepartmentPage(${currentDepPage + 1})">Next</a>
                                </li>`;
    }

    function changeDepartmentPage(page) {
        if (page < 1 || page > Math.ceil(data_dep.length / rowsPerDepPage)) return;
        currentDepPage = page;
        updateTable_dep();
        updateDepartmnetPagination();
    }

    function editDepartment(departmentId) {
        $('#content').load('update_department.php', {
            depid: departmentId
        });
    }

    function deleteDepartment(departmentId) {
        $('#content').load('delete_dep.php', {
            depid: departmentId
        });
    }

    fetchData_dep();
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
        intervalId = setInterval(fetchData_dep, 1000);

        // Stop the interval after `duration` seconds
        setTimeout(() => {
            clearInterval(intervalId);
        }, duration * 1000);
    });
</script>