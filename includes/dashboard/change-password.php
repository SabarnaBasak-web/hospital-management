<div class="tab-pane fade pt-3" id="profile-change-password">
    <div class="alert alert-danger hide" role="alert" id="custom-alert"></div>
    <!-- Change Password Form -->
    <form id="change-password-form" name="change-password-form">
        <div class="row mb-3">
            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="newPassword" type="password" class="form-control" id="newPassword" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
            <div class="col-md-8 col-lg-9">
                <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
            </div>
        </div>

        <div class="text-center">
            <button id="change-pwd-btn" type="submit" class="btn btn-primary">Change Password</button>
        </div>
    </form><!-- End Change Password Form -->
</div>