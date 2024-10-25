<?php
// Ensure that the database connection is included
// Assuming dbconn.php is already included in admin.php or another file before this

// Query the students table to get student attendance data
$students_query = "SELECT id, names FROM students"; // Adjust the table and fields according to your schema
$students_result = $conn->query($students_query);

if (!$students_result) {
    // Handle query error
    echo "Error: " . $conn->error;
}
?>

<div class="container-fluid p-4 m-0" id="attendance" style="display: none;">
    <div class="row">
        <div class="col-12">
            <h5 class="text-secondary">Student Attendance</h5>
            <div class="table-responsive" style="max-height: 900px; overflow-y: auto;">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody id="studentData">
                        <?php
                        if ($students_result->num_rows > 0) {
                            while ($row = $students_result->fetch_assoc()) {
                                echo "<tr data-id='{$row['id']}'>";
                                echo "<td class='student-name text-left'>" . ucfirst($row['names']) . "</td>";
                                echo "<td class='attendance-buttons text-center'>
                                    <div class='btn-group' role='group' aria-label='Attendance Status'>
                                        <button class='btn btn-success btn-sm attendance-btn' data-id='{$row['id']}' data-status='present'>Present</button>
                                        <button class='btn btn-danger btn-sm attendance-btn' data-id='{$row['id']}' data-status='absent'>Absent</button>
                                        <button class='btn btn-warning btn-sm attendance-btn' data-id='{$row['id']}' data-status='excuse'>Excuse</button>
                                    </div>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>No students found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>