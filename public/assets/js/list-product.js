$(document).ready(function() {
    let debounceTimer;

    loadProducts();
    var currentPage = 1;
    function loadProducts() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            let requests = {
                per_page: $('#rows-per-page').val(),
                category: $('#search-by-category').val(),
                status: $('#search-by-status').val(),
                key: $('#search-by-key').val(),
            };

            $.ajax({
                url: 'products/api/list?page=' + currentPage,
                type: 'GET',
                data: requests,
                success: function(response) {
                    var products = response.data;
                    var pagination = response.pagination;
                    var totalPages = pagination.last_page;
                    var html = '';
                    products.forEach(function(product) {
                        html += '<tr style="line-height: 100px;">';
                        html += '<td>' + product.id + '</td>';
                        html += '<td><img src="' + product.thumb + '"  alt="Thumbnail" style="height: 100px;"></td>';
                        html += '<td>' + product.name + '</td>';
                        html += '<td>' + product.sale_price + '</td>';
                        html += '<td>';
                        product.categories.forEach(function (category){
                            html+= '<span class="badge bg-info text-white mr-1">' + category.name + '</span>'
                        })
                        html += '</td>';
                        html += '<td>' + product.status + '</td>';
                        html += '<td>' + product.created_at + '</td>';
                        html += '<td>';
                        html += `<a class="action-icon see-product-detail" data-product-id="${product.id}" data-toggle="modal" data-target="#productModal"> <i class="mdi mdi-eye"></i></a>`;
                            if ($('#checkPermission').length > 0) {
                                html += `<a href="products/edit/${product.id}" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>`;
                            }
                        html += '</td>';
                        html += '</tr>';
                    });

                    $('#products-list tbody').html(html);

                    // Tao phan trang
                    var paginationHtml = '';
                    var visiblePages = 3; // Số lượng trang hiển thị
                    // Nút Previous
                    paginationHtml += '<li class="page-item"><a class="page-link" href="javascript: void(0);" data-page="' + (currentPage - 1) + '">Previous</a></li>';
                    // Các nút trang
                    var startPage = Math.max(1, currentPage - visiblePages);
                    var endPage = Math.min(totalPages, currentPage + visiblePages);
                    // Thêm nút trang đầu tiên nếu không phải là trang đầu tiên
                    if (startPage > 1) {
                        paginationHtml += '<li class="page-item"><a class="page-link" href="javascript: void(0);" data-page="1">1</a></li>';
                        if (startPage > 2) {
                            paginationHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }
                    // Duyệt qua các trang trong phạm vi hiển thị
                    for (var i = startPage; i <= endPage; i++) {
                        if (i === currentPage) {
                            paginationHtml += '<li class="page-item active"><a class="page-link" href="javascript: void(0);" data-page="' + i + '">' + i + '</a></li>';
                        } else {
                            paginationHtml += '<li class="page-item"><a class="page-link" href="javascript: void(0);" data-page="' + i + '">' + i + '</a></li>';
                        }
                    }
                    // Thêm nút trang cuối cùng nếu không phải là trang cuối cùng
                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            paginationHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        paginationHtml += '<li class="page-item"><a class="page-link" href="javascript: void(0);" data-page="' + totalPages + '">' + totalPages + '</a></li>';
                    }
                    // Nút Next
                    paginationHtml += '<li class="page-item"><a class="page-link" href="javascript: void(0);" data-page="' + (currentPage + 1) + '">Next</a></li>';
                    $('#pagination').html(paginationHtml);
                    // Xử lý sự kiện click trên nút phân trang
                    $('#pagination .page-link').click(function() {
                        var page = $(this).data('page');
                        if (page >= 1 && page <= totalPages) {
                            currentPage = page;
                            loadProducts();
                        }
                    });

                    // Xử lý sự kiện click cho nút xem chi tiết sản phẩm
                    $('.see-product-detail').click(function() {
                        var productId = $(this).data('product-id');
                        loadProductDetail(productId);
                    });
                }
            });
        }, 250); // Đặt thời gian debounce là 300ms
    }

    function loadProductDetail(productId) {
        $.ajax({
            url: 'products/' + productId,
            type: 'GET',
            success: function(response) {
                var product = response;
                let categoriesHtml= "";
                product.categories.forEach(function (category) {
                    categoriesHtml += `<span class="badge badge-primary mr-1">${category.name}</span>`;
                });
                console.log(categoriesHtml);
                // Đổ dữ liệu vào modal
                $('#product-image-detail').attr('src', product.thumb);
                $('#product-name-detail').text(product.name);
                $('#list-categories').html(categoriesHtml);
                $('#product-sale-price').text('$' + product.sale_price);
                $('#product-old-price').text('$' + product.old_price);
                $('#product-description-detail').html(product.description);
                $('#product-quantity-detail').text(product.quantity);
                $('#product-created-at').text(product.created_at);
                $('#product-updated-at').text(product.updated_at);

                // Hiển thị modal
                $('#productModal').modal('show');
            }
        });
    }

    $('#rows-per-page').on('change', loadProducts);
    $('#search-by-category').on('change', loadProducts);
    $('#search-by-status').on('change', loadProducts);
    $('#search-by-key').on('keyup', loadProducts);
});
