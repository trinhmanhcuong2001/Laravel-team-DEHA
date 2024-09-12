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
                    <a href="<?php echo e(route('roles.edit', $role->id)); ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/resources/views/admin/roles/result-search.blade.php ENDPATH**/ ?>