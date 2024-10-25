<?php
include '../dbconn.php';

// Check if the student ID is set in the query string
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    
    // Fetch student information along with game and education stats from the database
    $query = "
        SELECT s.names, s.position, s.status,
               gs.games_played, gs.points_scored, gs.assists,
               es.attendance_percentage
        FROM students s
        LEFT JOIN game_stats gs ON s.id = gs.student_id
        LEFT JOIN education_stats es ON s.id = es.student_id
        WHERE s.id = ?
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "<h3>Student not found.</h3>";
        exit();
    }
} else {
    echo "<h3>No student ID provided.</h3>";
    exit();
}

$conn->close();
?>
<div class="container-fluid p-0 m-0" id="students" style="display: none;">
    <h2>Student Information</h2>
    <div class="row">
        <!-- Profile photo column -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="profile-photo-container">
                        <img src="uploads/<?php echo $student_id; ?>.jpg" alt="Profile Photo" class="profile-photo">
                        <input type="file" id="photoUpload" accept="image/*" style="display:none;" onchange="uploadPhoto(this.files)">
                        <button class="upload-photo-button" onclick="document.getElementById('photoUpload').click();">
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                    <h5><?php echo ucfirst($student['names']); ?></h5>
                    <p><strong>Position:</strong> <?php echo ucfirst($student['position']); ?></p>
                    <p><strong>Status:</strong> <?php echo ucfirst($student['status']); ?></p>
                </div>
            </div>
        </div>

        <!-- Game and Education stats columns -->
        <div class="col-md-9">
            <div class="row">
                <!-- Game Stats -->
                <div class="col-md-6">
                    <h5>Game Stats</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">Games Played: <?php echo $student['games_played']; ?></li>
                        <li class="list-group-item">Points Scored: <?php echo $student['points_scored']; ?></li>
                        <li class="list-group-item">Assists: <?php echo $student['assists']; ?></li>
                    </ul>
                </div>

                <!-- Education Stats -->
                <div class="col-md-6">
                    <h5>Education Stats</h5>
                    <ul class="list-group mb-4">
                        <li class="list-group-item">Attendance Percentage: <?php echo $student['attendance_percentage']; ?>%</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0);" onclick="loadPage('students.php')" class="btn btn-secondary mt-0">Back to Students</a>
</div>


<script>
function uploadPhoto(files) {
    if (files.length > 0) {
        const file = files[0];
        // Handle the file upload logic here
        console.log('File selected:', file.name);
        
        // Implement AJAX here to send the file to the server
        const formData = new FormData();
        formData.append('photo', file);
        formData.append('student_id', '<?php echo $student_id; ?>'); // Include the student ID

        // Example AJAX request (use your own URL)
        fetch('upload_photo.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the profile photo displayed on the page
                document.querySelector('.profile-photo').src = `path_to_profile_photos/<?php echo $student_id; ?>.jpg?time=${new Date().getTime()}`;
            } else {
                alert('Photo upload failed: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>

</body>
</html>
