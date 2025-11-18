<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">ID:</dt>
                            <dd class="col-sm-8"><?php echo $user['id']; ?></dd>
                            
                            <dt class="col-sm-4">Name:</dt>
                            <dd class="col-sm-8">
                                <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                            </dd>
                            
                            <dt class="col-sm-4">Email:</dt>
                            <dd class="col-sm-8">
                                <a href="mailto:<?php echo $user['email']; ?>">
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </a>
                            </dd>
                            
                            <dt class="col-sm-4">Phone:</dt>
                            <dd class="col-sm-8">
                                <?php if (!empty($user['phone'])): ?>
                                    <a href="tel:<?php echo $user['phone']; ?>">
                                        <?php echo htmlspecialchars($user['phone']); ?>
                                    </a>
                                <?php else: ?>
                                    <em class="text-muted">Not provided</em>
                                <?php endif; ?>
                            </dd>
                        </dl>
                    </div>
                    
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Address:</dt>
                            <dd class="col-sm-8">
                                <?php if (!empty($user['address'])): ?>
                                    <?php echo nl2br(htmlspecialchars($user['address'])); ?>
                                <?php else: ?>
                                    <em class="text-muted">Not provided</em>
                                <?php endif; ?>
                            </dd>
                            
                            <dt class="col-sm-4">Created:</dt>
                            <dd class="col-sm-8">
                                <?php 
                                if (isset($user['created_at'])) {
                                    echo date('M j, Y g:i A', strtotime($user['created_at']));
                                } else {
                                    echo '<em class="text-muted">N/A</em>';
                                }
                                ?>
                            </dd>
                            
                            <dt class="col-sm-4">Last Updated:</dt>
                            <dd class="col-sm-8">
                                <?php 
                                if (isset($user['updated_at'])) {
                                    echo date('M j, Y g:i A', strtotime($user['updated_at']));
                                } else {
                                    echo '<em class="text-muted">N/A</em>';
                                }
                                ?>
                            </dd>
                        </dl>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo site_url('users'); ?>" class="btn btn-secondary">
                        ← Back to Users
                    </a>
                    <div>
                        <a href="<?php echo site_url('users/edit/'.$user['id']); ?>" class="btn btn-warning me-2">
                            ✏️ Edit User
                        </a>
                        <a href="<?php echo site_url('users/delete/'.$user['id']); ?>" 
                           class="btn btn-danger"
                           onclick="return confirmDelete('<?php echo htmlspecialchars($user['name']); ?>')">
                            🗑️ Delete User
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Information Card -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <?php if (!empty($user['email'])): ?>
                        <a href="mailto:<?php echo $user['email']; ?>" class="btn btn-outline-primary btn-sm d-block">
                            📧 Send Email
                        </a>
                        <?php else: ?>
                        <span class="text-muted small">No email</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <?php if (!empty($user['phone'])): ?>
                        <a href="tel:<?php echo $user['phone']; ?>" class="btn btn-outline-success btn-sm d-block">
                            📞 Call
                        </a>
                        <?php else: ?>
                        <span class="text-muted small">No phone</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo site_url('users/create'); ?>" class="btn btn-outline-info btn-sm d-block">
                            ➕ Add New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>