<div class="container-fluid p-0 m-0" id="profile" style="display: none;">
    <div class="row profile-container">
        <div class="col-md-4 left-section text-center">
            <div class="circle-container bg-dark text-white mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; border-radius: 50%; font-size: 36px; font-weight: bold;">
                <span class="initials"><?php echo $initials; ?></span>
            </div>

            <ul class="mt-3 list-unstyled">
                <li><strong><?php echo isset($admin_email) ? htmlspecialchars($admin_email) : ''; ?></strong></li>
                <li><a href="#" class="btn btn-link" id="changePasswordBtn">Change Password</a></li>
                <li><a href="#" class="btn btn-link text-danger" id="deleteAccountBtn">Delete Account</a></li>
            </ul>
        </div>

        <div class="col-md-8 right-section">
            <h4>Personal Information</h4>
            <form id="profileForm">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($admin_email) ? htmlspecialchars($admin_email) : ''; ?>" disabled>
                </div>


                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($phone_number) ? htmlspecialchars($phone_number) : ''; ?>" required>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="./coordinator.php" class="btn btn-secondary">Back to Home</a>
                </div>
            </form>
        </div>
    </div>
</div>