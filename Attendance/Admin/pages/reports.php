<div class="container-fluid p-0 m-0" id="reports" style="display: none;">
    <h1 class="text-center mb-4">Attendance Report</h1>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Student ID</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($result) && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($row['date'])); ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No attendance records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
