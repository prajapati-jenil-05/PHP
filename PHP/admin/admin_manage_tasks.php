<div class="card shadow mb-4 mx-4 mt-4 col-lg-8 col-12">
    <div class="card-body">
        <h4 class="card-title text-center" style="font-size: xx-large; font-weight: 600;">Manage Tasks</h4>
        <hr>
        <div class="container mt-4">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <label for="rowsPerTaskPage">Rows per page:</label>
                <select id="rowsPerTaskPage" class="form-select w-auto d-inline" onchange="updateTable_task()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>

                <label for="taskFilter">Filter by Status:</label>
                <select id="taskFilter" class="form-select w-auto d-inline" onchange="updateTable_task()">
                    <option value="all">All</option>
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Task ID</th>
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <div id="pagination_task" class="d-flex justify-content-center mt-3"></div>
        </div>
    </div>
</div>

<script>
    let currentTaskPage = 1;
    let rowsPerTaskPage = 5;
    let data_task = [];

    async function fetchData_task() {
        try {
            const response = await fetch("fetch_tasks.php");
            data_task = await response.json();
            updateTable_task(); // This will automatically call updatePagination()
        } catch (error) {
            console.error("Error fetching task data:", error);
        }
    }


    function updateTable_task() {
        rowsPerTaskPage = parseInt(document.getElementById("rowsPerTaskPage").value);
        const filterValue = document.getElementById("taskFilter").value;

        let filteredData = data_task;
        if (filterValue !== "all") {
            filteredData = data_task.filter(task => task.Status === filterValue);
        }

        const start = (currentTaskPage - 1) * rowsPerTaskPage;
        const end = start + rowsPerTaskPage;
        const tableBody = document.getElementById("tableBody");
        tableBody.innerHTML = "";

        const paginatedData = filteredData.slice(start, end);

        paginatedData.forEach(task => {
            tableBody.innerHTML += `
                <tr>
                    <td>${task.TaskID}</td>
                    <td>${task.Title}</td>
                    <td>${task.AssignedTo}</td>
                    <td>${task.StartTime}</td>
                    <td>${task.EndTime}</td>
                    <td>${task.Status}</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm mt-1 mb-1 w-49" onclick="changeTaskStatus(${task.TaskID})">Change Status</button>
                        <button class="btn btn-outline-danger btn-sm mt-1 mb-1 w-49" onclick="deleteTask(${task.TaskID})">Delete</button>
                    </td>
                </tr>`;
        });

        updatePagination(filteredData.length);
    }

    function changeTaskStatus(taskID) {
        $('#content').load('admin_edit_task.php', {
            taskid: taskID
        });
    }

    function deleteTask(TaskId) {
        $('#content').load('delete_task.php', {
            taskid: TaskId
        });
    }

    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / rowsPerTaskPage);
        const paginationContainer = document.getElementById("pagination_task");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement("button");
            pageButton.className = `btn ${i === currentTaskPage ? "btn-primary" : "btn-outline-primary"} mx-1`;
            pageButton.innerText = i;
            pageButton.onclick = () => {
                currentTaskPage = i;
                updateTable_task();
            };
            paginationContainer.appendChild(pageButton);
        }
    }

    fetchData_task();
</script>

<script>
    $(document).ready(function() {
        function checkScreenWidth() {
            $(window).width() < 1000 ? $(".card").removeClass("mb-4 mx-4 col-lg-8") : $(".card").addClass("mb-4 mx-4 col-lg-8");
        }

        checkScreenWidth();
        $(window).resize(checkScreenWidth);

        setInterval(fetchData_task, 1000); // Auto-refresh task data every 10 seconds
    });
</script>