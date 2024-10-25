<div class="container-fluid p-0 m-0" id="admin_tasks" style="display: none;">
    <div class="card p-4 mb-5">
        <!-- Form to add Event -->
        <form action="upload_event.php" method="POST" enctype="multipart/form-data">
            <h4>Add Event</h4>
            <div class="mb-3">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter event name" required>
            </div>
            <div class="mb-3">
                <label for="event_description" class="form-label">Event Description</label>
                <textarea class="form-control" id="event_description" name="event_description" rows="3" placeholder="Enter a brief description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required>
            </div>
            <div class="mb-3">
                <label for="event_time" class="form-label">Event Time</label>
                <input type="time" class="form-control" id="event_time" name="event_time" required>
            </div>
            <div class="mb-3">
                <label for="event_location" class="form-label">Event Location</label>
                <input type="text" class="form-control" id="event_location" name="event_location" placeholder="Enter event location" required>
            </div>
            <div class="mb-3">
                <label for="event_file" class="form-label">Upload File (Optional)</label>
                <input type="file" class="form-control" id="event_file" name="event_file">
            </div>
            <button type="submit" class="btn btn-primary w-100">SUBMIT EVENT</button>
        </form>
    </div>

    <div class="card p-4 mb-5">
        <!-- Form to add Game Schedule -->
        <form action="upload_game.php" method="POST">
            <h4>Schedule Game</h4>
            <div class="mb-3">
                <label for="game_date" class="form-label">Game Date</label>
                <input type="date" class="form-control" id="game_date" name="game_date" required>
            </div>
            <div class="mb-3">
                <label for="game_time" class="form-label">Game Time</label>
                <input type="time" class="form-control" id="game_time" name="game_time" required>
            </div>
            <div class="mb-3">
                <label for="opponent_team" class="form-label">Opponent Team</label>
                <input type="text" class="form-control" id="opponent_team" name="opponent_team" placeholder="Enter opponent team name" required>
            </div>
            <div class="mb-3">
                <label for="game_venue" class="form-label">Venue</label>
                <input type="text" class="form-control" id="game_venue" name="game_venue" placeholder="Enter game venue" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
        </form>
    </div>
</div>
