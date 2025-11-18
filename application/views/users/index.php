<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">User Management</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New User
                </a>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col-md-6">
                <?php echo form_open('users/search', array('class' => 'row g-3')); ?>
                    <div class="col-auto">
                        <input type="text" class="form-control" name="search_term" 
                               placeholder="Search by name or email..." 
                               value="<?php echo isset($search_term) ? $search_term : ''; ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                    <?php if(isset($search_term)): ?>
                    <div class="col-auto">
                        <a href="<?php echo site_url('users'); ?>" class="btn btn-outline-secondary">Clear</a>
                    </div>
                    <?php endif; ?>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Users Table -->
        <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                            </td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td>
                                <?php 
                                if (isset($user['created_at'])) {
                                    echo date('M j, Y', strtotime($user['created_at']));
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?php echo site_url('users/view/'.$user['id']); ?>" 
                                       class="btn btn-outline-info" title="View">
                                        👁️ View
                                    </a>
                                    <a href="<?php echo site_url('users/edit/'.$user['id']); ?>" 
                                       class="btn btn-outline-warning" title="Edit">
                                        ✏️ Edit
                                    </a>
                                    <a href="<?php echo site_url('users/delete/'.$user['id']); ?>" 
                                       class="btn btn-outline-danger" title="Delete"
                                       onclick="return confirmDelete('<?php echo htmlspecialchars($user['name']); ?>')">
                                        🗑️ Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-people" style="font-size: 4rem; color: #6c757d;"></i>
                </div>
                <h5 class="text-muted">No Users Found</h5>
                <p class="text-muted">
                    <?php if(isset($search_term)): ?>
                        No users match your search criteria. Try a different search term.
                    <?php else: ?>
                        Get started by adding your first user.
                    <?php endif; ?>
                </p>
                <a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary">
                    Add First User
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>