<div class="card shadow mb-4 mx-4 mt-4 col-lg-8 col-12">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Manage Salary</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerSalPage">Rows per page:</label>
            <select id="rowsPerSalPage" class="form-select w-auto d-inline" onchange="updateTable_salary()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>

            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <div id="pagination_sal" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentSalPage = 1;
    let rowsPerSalPage = 5;
    let data_sal = [];

    async function fetchData_salary() {
        try {
            const response = await fetch("fetch_salary.php");
            data_sal = await response.json();
            updateTable_salary();
        } catch (error) {
            console.error("Error fetching salary data:", error);
        }
    }

    function updateTable_salary() {
        rowsPerSalPage = parseInt(document.getElementById("rowsPerSalPage").value);
        const start = (currentSalPage - 1) * rowsPerSalPage;
        const end = start + rowsPerSalPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        const paginatedData = data_sal.slice(start, end);

        paginatedData.forEach(salary => {
            tableBody.innerHTML += `
                <tr>
                    <td>${salary.employee_id}</td>
                    <td>${salary.first_name} ${salary.last_name}</td>
                    <td>${salary.email}</td>
                    <td>${salary.mobile_number}</td>
                    <td>${salary.department}</td>
                    <td>${salary.salary}</td>
                    <td>
                        <button class="btn btn-outline-info btn-sm mt-1 mb-1 w-100" onclick="salaryEmployee(${salary.employee_id})">Calculate Salary</button>
                    </td>
                </tr>`;
        });

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(data_sal.length / rowsPerSalPage);
        const paginationContainer = document.getElementById("pagination_sal");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentSalPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentSalPage = i;
                updateTable_salary();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    function salaryEmployee(employeeId) {
        $('#content').load('update_salary.php', {
            employee_id: employeeId
        });
    }

    fetchData_salary();
</script>

<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            $(window).width() < 1000 ? $(".card").removeClass("mb-4 mx-4 col-lg-8") : $(".card").addClass("mb-4 mx-4 col-lg-8");
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        setInterval(fetchData_salary, 1000); // Auto refresh data every 10 seconds
        setInterval(updatePagination, 1000); // Auto refresh pagination every 10 seconds
    });
</script>