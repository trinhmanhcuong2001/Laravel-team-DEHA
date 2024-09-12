<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo e($title); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('/assets/admin/images/favicon.ico')); ?>">

        <!-- third party css -->
        <link href="<?php echo e(asset('/assets/admin/css/vendor/jquery-jvectormap-1.2.2.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="<?php echo e(asset('/assets/admin/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('/assets/admin/css/app-creative.min.css')); ?>" rel="stylesheet" type="text/css" id="light-style" />
        <link href="<?php echo e(asset('/assets/admin/css/app-creative-dark.min.css')); ?>" rel="stylesheet" type="text/css" id="dark-style" />
        <?php echo $__env->yieldPushContent('css'); ?>
    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- end Topbar -->

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title"><?php echo e($title); ?></h4>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <?php if(session()->has('success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('success')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(session()->has('error')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('error')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php echo $__env->yieldContent('content'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <script src="<?php echo e(asset('/assets/admin/js/vendor.min.js')); ?>"></script>
        <script src="<?php echo e(asset('/assets/admin/js/app.min.js')); ?>"></script>

        <!-- third party js -->
        <script src="<?php echo e(asset('/assets/admin/js/vendor/apexcharts.min.js')); ?>"></script>
        <script src="<?php echo e(asset('/assets/admin/js/vendor/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
        <script src="<?php echo e(asset('/assets/admin/js/vendor/jquery-jvectormap-world-mill-en.js')); ?>"></script>
        <!-- third party js ends -->
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>
<?php /**PATH /var/www/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>