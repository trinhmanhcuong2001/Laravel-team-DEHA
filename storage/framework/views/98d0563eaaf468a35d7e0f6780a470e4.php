<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success mb-2"><i
                                    class="mdi mdi-plus-circle mr-2"></i>Create Product</a>
                        </div>
                    </div>
                    
                    <div id="searchForm" class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="status">Per page</label>
                                <select id="rows-per-page" class="select2 form-control select2-multiple" name="per_page"
                                    data-toggle="select2" data-placeholder="Choose ...">
                                    <option value="1">1</option>
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="status">Category</label>
                                <select id="search-by-category" class="select2 form-control select2-multiple"
                                    name="category" data-toggle="select2" data-placeholder="Choose ...">
                                    <option value="all" selected>All</option>
                                    <?php $__currentLoopData = $listCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <!-- Multiple Select -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="search-by-status" class="select2 form-control select2-multiple" name="status"
                                    data-toggle="select2" data-placeholder="Choose ...">
                                    <option value="all" selected>All</option>
                                    <?php $__currentLoopData = $listStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>">
                                            <?php echo e($status); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="key">Search by name... </label>
                                <input type="text" id="search-by-key" class="form-control" placeholder="Tìm kiếm ..."
                                    value="<?php echo e(request()->get('key')); ?>" name="key">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped text-center" id="products-list">
                        <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'edit-product')): ?>
                        <input type="hidden" id="checkPermission">
                        <?php endif; ?>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Thumb</th>
                                <th>Name</th>
                                <th>Sale price</th>
                                <th>Categories</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <!-- end card-body-->
                <!-- Pagination -->
                <nav>
                    <ul id="pagination" class="pagination pagination-rounded mb-0">
                        <!-- Nút Previous -->
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <!-- Các nút phân trang sẽ được thêm vào đây -->

                        <!-- Nút Next -->
                        <li class="page-item">
                            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

    <?php echo $__env->make('admin.products.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('/assets/js/list-product.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/products/index.blade.php ENDPATH**/ ?>