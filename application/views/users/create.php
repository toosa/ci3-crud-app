<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Create New User</h5>
            </div>
            <div class="card-body">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                
                <?php echo form_open('users/create'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?php echo set_value('name'); ?>" required>
                        <div class="form-text">Enter the full name of the user.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo set_value('email'); ?>" required>
                        <div class="form-text">Enter a valid email address.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               value="<?php echo set_value('phone'); ?>">
                        <div class="form-text">Enter phone number (optional).</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"><?php echo set_value('address'); ?></textarea>
                        <div class="form-text">Enter full address (optional).</div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="<?php echo site_url('users'); ?>" class="btn btn-secondary">
                            ← Back to Users
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create User
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>