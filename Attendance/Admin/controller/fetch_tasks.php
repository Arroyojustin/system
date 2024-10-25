<?php
require 'dbconn.php'; // Include the database connection

$stmt = $conn->query("SELECT * FROM activities ORDER BY id DESC");
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    $(document).ready(function() {
        const activities = <?php echo json_encode($activities); ?>;
        activities.forEach(activity => {
            $('#activity-list').append(`
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">${activity.activity}</h5>
                        <p class="card-text">${activity.description}</p>
                        <?php if (isset($activity['file'])) { ?>
                            <a href="uploads/${activity.file}" target="_blank">View Uploaded File</a>
                        <?php } ?>
                    </div>
                </div>
            `);
        });
    });
</script>
