<div class="container-fluid p-0 m-0" id="home" style="display: none;">
    <div class="row">
        <div class="col-md-8"> <!-- Adjust the column width as needed -->
            <div class="table-responsive border bg-light shadow rounded p-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Estimation Date</th>
                            <th>Duration</th>
                            <th>Permission Details</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($result) && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['estimation_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['duration']); ?></td>
                                    <td><?php echo htmlspecialchars($row['permission_details']); ?></td>
                                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                                    <td>
                                        <div class="d-flex flex-column flex-sm-row">
                                            <?php if ($row['status'] === 'Pending'): ?>
                                                <form method="POST" class="mb-2 mb-sm-0 mr-sm-2">
                                                    <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm mb-2 mb-sm-0">Approve</button>
                                                </form>
                                                <form method="POST" class="mb-2 mb-sm-0">
                                                    <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="action" value="decline" class="btn btn-danger btn-sm">Decline</button>
                                                </form>
                                            <?php else: ?>
                                                <span><?php echo $row['status']; ?></span>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="attendance_id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="action" value="cancel" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4"> <!-- Adjust the column width as needed -->
            <!-- Recent History Container -->
            <div class="border bg-light shadow rounded p-2 mt-4" style="border: 1px solid rgba(0, 0, 0, 0.1);">
                <h5 class="mb-3">Recent History</h5>
                <ul class="list-unstyled">
                    <!-- Example of recent history items -->
                    <li class="py-1 border-bottom">Student Name 1 - Action Taken - Date</li>
                    <li class="py-1 border-bottom">Student Name 2 - Action Taken - Date</li>
                    <li class="py-1 border-bottom">Student Name 3 - Action Taken - Date</li>
                    <!-- More items can be dynamically generated here -->
                </ul>
            </div>
            <!-- End of Recent History Container -->
        </div>
    </div>
</div>
