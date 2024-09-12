<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <!-- Product image -->
                                        <a href="javascript: void(0);" class="text-center d-block mb-4">
                                            <img src="<?php echo e(asset('assets/admin/images/products/product-5.jpg')); ?>" id="product-image-detail" class="img-fluid" style="max-width: 300px;" alt="Product-img">
                                        </a>
                                    </div> <!-- end col -->

                                    <div class="col-lg-7">
                                        <div class="pl-lg-4">
                                            <!-- Product title -->
                                            <h3 class="mt-0" id="product-name-detail">Amazing Modern Chair (Orange) <a href="javascript: void(0);" class="text-muted"><i class="mdi mdi-square-edit-outline ml-2"></i></a> </h3>
                                            <div class="mt-3">
                                                <h4 id="list-categories"></h4>
                                            </div>
                                            <!-- Product description -->
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Price:</h6>
                                                        <h3 id="product-sale-price"> $139.58</h3>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Old Price:</h6>
                                                        <p id="product-old-price" class="font-20" style="text-decoration: line-through;"> $139.58</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product description -->
                                            <div class="mt-4">
                                                <h6 class="font-14">Description:</h6>
                                                <p id="product-description-detail">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                                            </div>

                                            <!-- Product information -->
                                            <div class="mt-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h6 class="font-14">Available Stock:</h6>
                                                        <p class="text-sm lh-150" id="product-quantity-detail">1784</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6 class="font-14">Added Date:</h6>
                                                        <p class="text-sm lh-150" id="product-created-at">09/12/2018</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6 class="font-14">Updated Date:</h6>
                                                        <p class="text-sm lh-150" id="product-updated-at">09/12/2018</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->

                                <!-- end table-responsive-->

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/resources/views/admin/products/detail.blade.php ENDPATH**/ ?>