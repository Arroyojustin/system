<div class="container-fluid p-0 m-0" id="front" style="display: none;">
        <h2>Add Coordinator</h2>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST" action="home.php">
            <div class="mb-3">
                <label for="coordinator_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="coordinator_name" name="coordinator_name" required>
            </div>
            <div class="mb-3">
                <label for="coordinator_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="coordinator_email" name="coordinator_email" required>
            </div>
            <div class="mb-3">
                <label for="coordinator_phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="coordinator_phone" name="coordinator_phone" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Coordinator</button>
        </form>

        <hr>

        <!-- You can display existing coordinators here -->
        <h3>Existing Coordinators</h3>
        <!-- Example table for displaying coordinators -->
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Uncomment and fill in if you want to display existing coordinators
                // while ($row = $result->fetch_assoc()) {
                //     echo "<tr>
                //             <td>{$row['name']}</td>
                //             <td>{$row['email']}</td>
                //             <td>{$row['phone']}</td>
                //           </tr>";
                // }
                ?>
            </tbody>
        </table>
    </div>

