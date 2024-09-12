<?php $__env->startSection('content'); ?>
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>Create User</a>
    <form method="GET" action="<?php echo e(route('users.index')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
    <table id="users-list" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Create at</th>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-user')): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->id); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                        <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-info text-white"><?php echo e($role->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td><?php echo e($user->created_at); ?></td>
                    <td class="d-flex">
                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-user')): ?>
                        <a href="<?php echo e(route('users.edit', ['user' => $user->id])); ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'delete-user')): ?>
                        <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this user?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/users/index.blade.php ENDPATH**/ ?>