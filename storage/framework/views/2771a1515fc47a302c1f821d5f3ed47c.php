<?php $__env->startSection('content'); ?>
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a class="text-black btn btn-success" href="<?php echo e(URL::to('roles/create')); ?>" >Create new role</a>
    <label>
        <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="selection-datatable" id="keyword"  name="keyword">
        <input type="hidden" value="<?php echo e(route('roles.search')); ?>" id="url" >
    </label>
</div>
    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Created At</th>
                <th>Updated At</th>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-role')): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody id="role-table-body">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($role->name); ?></td>
                <td><?php echo e($role->description); ?></td>
                <td class="w-25">
                    <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-info text-white"><?php echo e($permission->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td><?php echo e($role->created_at); ?></td>
                <td><?php echo e($role->updated_at); ?></td>
                <td class="d-flex">
                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-role')): ?>
                    <a href="<?php echo e(route('roles.edit', $role->id)); ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    <?php endif; ?>
                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'delete-role')): ?>
                    <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="module" src="<?php echo e(asset('/assets/js/app.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/roles/index.blade.php ENDPATH**/ ?>