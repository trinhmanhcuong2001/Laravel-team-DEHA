<?php $__env->startSection('content'); ?>
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>Add New Category</a>
    <form method="GET" action="<?php echo e(route('categories.index')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Description" value="<?php echo e(request('search')); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
    <table id="categories-list" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Parent</th>
                <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-category')): ?>
                <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $displayedCategories = [];
            ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!in_array($category->id, $displayedCategories)): ?>
                <tr>
                    <td><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td><?php echo e($category->description); ?></td>
                    <td><?php echo e($category->parent ? $category->parent->name : 'None'); ?></td>
                    <td class="d-flex">
                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-category')): ?>
                        <a href="<?php echo e(route('categories.edit', $category->id)); ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'delete-category')): ?>
                        <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this category?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childKey => $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($child->parent_id === $category->id): ?>
                    <tr>
                        <td><?php echo e($child->id); ?></td>
                        <td>-- <?php echo e($child->name); ?></td>
                        <td><?php echo e($child->description); ?></td>
                        <td><?php echo e($child->parent->name); ?></td>
                        <td class="d-flex">
                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-category')): ?>
                                <a href="<?php echo e(route('categories.edit', $child->id)); ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                            <?php endif; ?>
                            <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'delete-category')): ?>
                                <form action="<?php echo e(route('categories.destroy', $child->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this category?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                                </form>
                            <?php endif; ?>
                        </td>
                        
                    </tr>
                    <?php
                        $displayedCategories[] = $child->id;
                    ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>