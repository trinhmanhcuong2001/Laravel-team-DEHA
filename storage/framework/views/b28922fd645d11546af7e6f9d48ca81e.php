<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('assets/admin/css/vendor/summernote-bs4.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        .panel { max-width: 500px; text-align: center;}
        .button_outer {background: #83ccd3; border-radius:30px; text-align: center; height: 50px; width: 200px; display: inline-block; transition: .2s; position: relative; overflow: hidden;}
        .btn_upload {padding: 17px 30px 12px; color: #fff; text-align: center; position: relative; display: inline-block; overflow: hidden; z-index: 3; white-space: nowrap;}
        .btn_upload input {position: absolute; width: 100%; left: 0; top: 0; width: 100%; height: 105%; cursor: pointer; opacity: 0;}
        .file_uploading {width: 100%; height: 10px; margin-top: 20px; background: #ccc;}
        .file_uploading .btn_upload {display: none;}
        .processing_bar {position: absolute; left: 0; top: 0; width: 0; height: 100%; border-radius: 30px; background:#83ccd3; transition: 3s;}
        .file_uploading .processing_bar {width: 100%;}
        .success_box {display: none; width: 50px; height: 50px; position: relative;}
        .success_box:before {
            content: '';
            display: block;
            width: 12px;
            height: 20px;
            border-bottom: 5px solid #fff;
            border-right: 6px solid #fff;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            position: absolute;
            left: 19px;
            top: 12px;;}
        .file_uploaded .success_box {display: inline-block;}
        .file_uploaded {margin-top: 0; width: 50px; background:#83ccd3; height: 50px;}
        .uploaded_file_view {max-width: 300px; margin: 20px auto; text-align: center; position: relative; transition: .2s; opacity: 0; border: 2px solid #ddd; padding: 15px;}
        .file_remove{width: 30px; height: 30px; border-radius: 50%; display: block; position: absolute; background: #aaa; line-height: 30px; color: #fff; font-size: 12px; cursor: pointer; right: -15px; top: -15px;}
        .file_remove:hover {background: #222; transition: .2s;}
        .uploaded_file_view img {max-width: 100%;}
        .uploaded_file_view.show {opacity: 1;}
        .error_msg {text-align: center; color: #f00}
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card-body">

        <form action="<?php echo e(route('products.store')); ?>" enctype="multipart/form-data" method="post">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-xl-6" data-select2-id="6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" value="<?php echo e(old('name')); ?>" name="name" class="form-control" placeholder="Enter product name">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="summernote-basic" rows="5" placeholder="Enter description about project.."><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" min="0" value="<?php echo e(old('quantity')); ?>" name="quantity" class="form-control">
                        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-check">
                            <?php $__currentLoopData = $listStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="status"
                                    id="status<?php echo e($key); ?>"
                                    value="<?php echo e($key); ?>"
                                    <?php echo e($loop->first ? 'checked' : ''); ?>

                                >
                                <label class="form-check-label mr-5" for="status<?php echo e($key); ?>">
                                    <?php echo e($status); ?>

                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div> <!-- end col-->

                <div class="col-xl-6">

                    <div class="form-group">
                        <label for="old_price">Old Price</label>
                        <input type="number" id="old_price" value="<?php echo e(old('old_price')); ?>" name="old_price" class="form-control">
                        <?php $__errorArgs = ['old_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" id="sale_price" value="<?php echo e(old('sale_price')); ?>" name="sale_price" class="form-control">
                        <?php $__errorArgs = ['sale_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group" data-select2-id="5">
                        <label for="categories">Categories</label>

                        <select name="categories[]" class="form-control select2 select2-hidden-accessible" multiple data-toggle="select2" tabindex="-1" aria-hidden="true">
                            <?php $__currentLoopData = $listCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(in_array($category->id, old('categories', [])) ? 'selected' : ''); ?>

                                >
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group">
                        <label for="thumb">Image</label>
                        <main class="main_full">
                            <div class="container">
                                <div class="panel">
                                    <div class="button_outer">
                                        <div class="btn_upload">
                                            <input type="file" id="upload_file" name="thumb">
                                            Upload Image
                                        </div>
                                        <div class="processing_bar"></div>
                                        <div class="success_box"></div>
                                    </div>
                                </div>
                                <div class="error_msg"></div>
                                <div class="uploaded_file_view" id="uploaded_view">
                                    <span class="file_remove">X</span>
                                </div>
                            </div>
                        </main>
                        <?php $__errorArgs = ['thumb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span id="name-error" class="error text-danger" style="display: block"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div> <!-- end col-->

                <div class="col-xl-12">
                    <div class="form-group">
                        <input type="submit" class="form-control btn-primary" value="Create Product">
                    </div>
                </div>
            </div>
        </form>
        <!-- end row -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/vendor/summernote-bs4.min.js')); ?>"></script>
    <!-- Summernote demo -->
    <script src="<?php echo e(asset('assets/admin/js/pages/demo.summernote.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var btnUpload = $("#upload_file"),
                btnOuter = $(".button_outer");
            btnUpload.on("input", function(e){
                var ext = btnUpload.val().split('.').pop().toLowerCase();
                if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                    $(".error_msg").text("Not an Image...");
                } else {
                    $(".error_msg").text("");
                    btnOuter.addClass("file_uploading");
                    setTimeout(function(){
                        btnOuter.addClass("file_uploaded");
                    },1000);
                    var uploadedFile = URL.createObjectURL(e.target.files[0]);

                    setTimeout(function(){
                        $("#uploaded_view").append('<img src="'+uploadedFile+'" />').addClass("show");
                    },1100);
                }
            });
            $(".file_remove").on("click", function(e){
                // $("#uploaded_view").removeClass("show");
                // $("#uploaded_view").find("img").remove();
                // btnOuter.removeClass("file_uploading file_uploaded");
                var uploadedImg = $("#uploaded_view").find("img");
                if (uploadedImg.length > 0) {
                    var imgURL = uploadedImg.attr("src");
                    $("#uploaded_view").removeClass("show");
                    URL.revokeObjectURL(imgURL); // Thu hồi URL đối tượng
                    uploadedImg.remove(); // Xóa hình ảnh
                    btnOuter.removeClass("file_uploading file_uploaded");
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/admin/products/create.blade.php ENDPATH**/ ?>