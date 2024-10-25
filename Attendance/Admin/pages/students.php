<div class="container-fluid p-4" id="students" style="display: none; background-color: #f8f9fa;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-3">
        <a href="#" class="btn btn-success me-auto" id="showAddStudentModal">
            <i class="fas fa-plus me-2"></i>Add Student
        </a>

        <div class="input-group mb-4" style="max-width: 350px;">
            <input type="text" class="form-control" id="searchInput" placeholder="Search students...">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
        </div>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="sticky-top">Name</th>
                    <th scope="col" class="sticky-top">Position</th>
                    <th scope="col" class="sticky-top">Status</th>
                    <th scope="col" class="sticky-top">Actions</th>
                </tr>
            </thead>
            <tbody id="studentData">
                <?php
                $result = $conn->query("SELECT id, names, position, status FROM students");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = $row['status'] == 'active' ? 'status-active' : 'status-inactive';
                        
                        echo "<tr data-id='{$row['id']}'>";
                        echo "<td class='editable' data-field='names'><a href='javascript:void(0);' onclick='loadStudentInfo({$row['id']})'>" . ucfirst($row['names']) . "</a></td>";
                        echo "<td class='editable' data-field='position'>" . ucfirst($row['position']) . "</td>";
                        echo "<td class='editable' data-field='status'><span class='$statusClass'>" . ucfirst($row['status']) . "</span></td>";
                        echo "<td>
                              <button class='btn btn-warning btn-sm editStudent' data-id='{$row['id']}'>Edit</button>
                              <button class='btn btn-danger btn-sm deleteStudent' data-id='{$row['id']}'>Delete</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No students found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function loadStudentInfo(studentId) {
    $.ajax({
        url: 'pages/student_info.php', // Ensure this path is correct
        type: 'GET',
        data: { id: studentId },
        success: function (data) {
            $('#page-content').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error loading student info:', error);
        }
    });
}
</script>
