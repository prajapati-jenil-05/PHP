<div class="card shadow mb-4 mx-4 mt-4 col-lg-8 col-12">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Manage Employees</h4>
        <hr>
        <div class="container mt-4">
            <label for="rowsPerEmpPage">Row per page:</label>
            <select id="rowsPerEmpPage" class="form-select w-auto d-inline" onchange="updateTable_emp()">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>

            <input type="text" id="searchInput" class="form-control w-auto d-inline ms-3" placeholder="Search by name, email, or department..." oninput="updateTable_emp()">
            <select id="filterCountry" class="form-select w-auto d-inline ms-3" onchange="updateTable_emp()">
                <option value="">All Countries</option>
            </select>
            <select id="filterDepartment" class="form-select w-auto d-inline ms-3" onchange="updateTable_emp()">
                <option value="">All Departments</option>
            </select>

            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr.No.</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Country</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>
            <br>

            <!-- Pagination Container -->
            <div id="pagination_emp" class="d-flex justify-content-center"></div>

            <button class="btn btn-secondary ms-3" onclick="resetFilters()">Reset Filters</button>
        </div>
    </div>
</div>

<script>
    let currentEmpPage = 1;
    let rowsPerEmpPage = 5;
    let data_emp = [];

    async function fetchData_emp() {
        try {
            const response = await fetch("fetch_employees.php");
            data_emp = await response.json();

            // Save current filter selections
            const selectedCountry = document.getElementById("filterCountry").value;
            const selectedDepartment = document.getElementById("filterDepartment").value;

            // Populate filter dropdowns only if they are empty (first load)
            const filterCountry = document.getElementById("filterCountry");
            const filterDepartment = document.getElementById("filterDepartment");

            if (filterCountry.options.length === 1) { // Only populate if no dynamic options exist
                const countries = [...new Set(data_emp.map(employee => employee.country))];
                countries.forEach(country => {
                    filterCountry.innerHTML += `<option value="${country}">${country}</option>`;
                });
            }

            if (filterDepartment.options.length === 1) {
                const departments = [...new Set(data_emp.map(employee => employee.department))];
                departments.forEach(department => {
                    filterDepartment.innerHTML += `<option value="${department}">${department}</option>`;
                });
            }

            // Restore previous filter selections
            document.getElementById("filterCountry").value = selectedCountry;
            document.getElementById("filterDepartment").value = selectedDepartment;

            updateTable_emp(); // Refresh the table without resetting filters
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    function updateTable_emp() {
        rowsPerEmpPage = parseInt(document.getElementById("rowsPerEmpPage").value);
        const searchQuery = document.getElementById("searchInput").value.toLowerCase();
        const filterCountry = document.getElementById("filterCountry").value;
        const filterDepartment = document.getElementById("filterDepartment").value;

        const start = (currentEmpPage - 1) * rowsPerEmpPage;
        const end = start + rowsPerEmpPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        const filteredData = data_emp.filter(employee => {
            return (
                (employee.firstname.toLowerCase().includes(searchQuery) ||
                    employee.lastname.toLowerCase().includes(searchQuery) ||
                    employee.email.toLowerCase().includes(searchQuery) ||
                    employee.department.toLowerCase().includes(searchQuery)) &&
                (filterCountry ? employee.country === filterCountry : true) &&
                (filterDepartment ? employee.department === filterDepartment : true)
            );
        });

        filteredData.slice(start, end).forEach((employee, index) => {
            tableBody.innerHTML += `
                <tr>
                    <td>${start + index + 1}</td>
                    <td>${employee.id}</td>
                    <td>${employee.firstname} ${employee.lastname}</td>
                    <td>${employee.email}</td>
                    <td>${employee.mobile}</td>
                    <td>${employee.country}</td>
                    <td>${employee.department}</td>
                    <td>
                        <div class="btn-group w-100">
                            <button class="btn btn-outline-primary" onclick="viewEmployee(${employee.id})">View</button>
                            <button class="btn btn-outline-success" onclick="editEmployee(${employee.id})">Edit</button>
                            <button class="btn btn-outline-info" onclick="salaryEmployee(${employee.id})">Salary</button>
                            <button class="btn btn-outline-danger" onclick="deleteEmployee(${employee.id})">Delete</button>
                        </div>
                    </td>
                </tr>`;
        });

        // Update pagination
        updatePagination(filteredData.length);
    }

    function updatePagination(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerEmpPage);
        const paginationContainer = document.getElementById("pagination_emp");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentEmpPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentEmpPage = i;
                updateTable_emp();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    function resetFilters() {
        document.getElementById("searchInput").value = "";
        document.getElementById("filterCountry").value = "";
        document.getElementById("filterDepartment").value = "";
        updateTable_emp();
    }

    function viewEmployee(employeeId) {
        $('#content').load('admin_view_emp.php', {
            empid: employeeId
        });
    }

    function editEmployee(employeeId) {
        $('#content').load('admin_edit_emp.php', {
            empid: employeeId
        });
    }

    function salaryEmployee(employeeID) {
        $('#content').load('update_salary.php', {
            employee_id: employeeID
        });
    }

    function deleteEmployee(employeeID) {
        $('#content').load('delete_emp.php', {
            employee_id: employeeID
        });
    }

    $(document).ready(function() {
        function checkScreenWidth() {
            $(window).width() < 1000 ? $(".card").removeClass("mb-4 mx-4 col-lg-8") : $(".card").addClass("mb-4 mx-4 col-lg-8");
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);
        fetchData_emp();

        function autoRefreshData() {
            setInterval(fetchData_emp, 1000);
        }

        autoRefreshData(); // Start auto-refreshing every 1 second
        setInterval(fetchData_emp, 1000);
    });
</script>