<script>
    $(function() {
        'use strict';

        const csrfToken = '{{ csrf_token() }}';

        const routes = {
            approve: '{{ route('product-approval.approve') }}',
            reject: '{{ route('product-approval.reject') }}',
            preview: '{{ route('product-approval.preview', ':id') }}',
            history: '{{ route('product.show', ':id') }}',
        };

        function buildUrl(route, id = null) {
            return id ? route.replace(':id', id) : route;
        }

        function getSelectedProducts() {
            return $('.product-checkbox:checked')
                .map(function() {
                    return $(this).val();
                })
                .get();
        }

        function ajaxRequest({
            url,
            method = 'POST',
            data = {},
            successMessage = null,
            onSuccess = null
        }) {

            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: csrfToken,
                    ...data
                },

                success(response) {

    Swal.close();

    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: successMessage || response.message || 'Operation completed successfully.',
        confirmButtonText: 'OK',
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {

        if (result.isConfirmed) {

            if (typeof onSuccess === 'function') {
                onSuccess(response);
            }

            location.reload();
        }

    });

},

                error(xhr) {

                    Swal.close();

                    showError(
                        xhr.responseJSON?.message ||
                        'Something went wrong. Please try again.'
                    );
                }
            });
        }

        function confirmApprove(callback) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to approve this product?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            });
        }
        /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

        $('#btn-apply-filters').on('click', function() {

            reloadTable();

            toastr.info('Filters applied successfully');
        });

        $('#btn-reset-filters').on('click', function() {

            $('#filter-form')[0].reset();

            reloadTable();
        });


        /*
        |--------------------------------------------------------------------------
        | Checkbox Selection
        |--------------------------------------------------------------------------
        */

        $('#select-all').on('change', function() {

            $('.product-checkbox').prop('checked', this.checked);

        });

        $(document).on('change', '.product-checkbox', function() {

            $('#select-all').prop(
                'checked',
                $('.product-checkbox').length === $('.product-checkbox:checked').length
            );

        });

        /*
    |--------------------------------------------------------------------------
    | Product Actions
    |--------------------------------------------------------------------------
    */

        $(document).on('click', '.btn-preview', function() {

            openDrawer($(this).data('id'));

        });


        $(document).on('click', '.btn-history', function() {

            window.location.href = buildUrl(
                routes.history,
                $(this).data('id')
            );

        });


        $(document).on('click', '.btn-approve', function() {

            const id = $(this).data('id');

            confirmApprove(function() {

                ajaxRequest({

                    url: routes.approve,

                    data: {
                        products: [id]
                    }

                });

            });

        });


        $(document).on('click', '.btn-reject', function() {

            $('#rejectModal')
                .data('productId', $(this).data('id'))
                .modal('show');

        });


        $('#rejectForm').on('submit', function(e) {

            e.preventDefault();

            ajaxRequest({

                url: routes.reject,

                data: {
                    products: [$('#rejectModal').data('productId')],
                    reason: $('#reject_reason').val()
                },

                onSuccess() {

                    $('#rejectModal').modal('hide');

                }

            });

        });
        /*
    |--------------------------------------------------------------------------
    | Bulk Approve
    |--------------------------------------------------------------------------
    */

        $('#btn-bulk-approve').on('click', function() {

            const selected = getSelectedProducts();

            if (!selected.length) {
                return toastr.warning('Please select at least one product.');
            }

            $('#bulk-approve-count').text(selected.length);

            $('#bulkApproveModal').modal('show');

        });


        $('#confirm-bulk-approve').on('click', function() {

            ajaxRequest({

                url: routes.approve,

                data: {
                    products: getSelectedProducts()
                },

                onSuccess() {

                    $('#bulkApproveModal').modal('hide');

                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | Bulk Reject
        |--------------------------------------------------------------------------
        */

        $('#btn-bulk-reject').on('click', function() {

            const selected = getSelectedProducts();

            if (!selected.length) {
                return toastr.warning('Please select at least one product.');
            }

            $('#bulk-reject-count').text(selected.length);

            $('#bulkRejectModal').modal('show');

        });


        $('#bulkRejectForm').on('submit', function(e) {

            e.preventDefault();

            ajaxRequest({

                url: routes.reject,

                data: {
                    products: getSelectedProducts(),
                    reason: $('#bulk_reject_reason').val()
                },

                onSuccess() {

                    $('#bulkRejectModal').modal('hide');

                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | Drawer
        |--------------------------------------------------------------------------
        */

        function openDrawer(productId) {

            $('#drawer-overlay').fadeIn();
            $('#approval-drawer').addClass('open');

            $('#drawer-content').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-3 text-muted">Loading product details...</p>
        </div>
    `);

            $.ajax({

                url: buildUrl(routes.preview, productId),
                type: 'GET',

                success: function(response) {

                    const p = response.data;

                    const variantsHtml = (p.variants || []).length ?
                        p.variants.map(v => `
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>
                            ${v.size?.size_name || 'N/A'}
                            /
                            ${v.color?.color_name || 'N/A'}
                        </span>

                        <span class="fw-semibold">
                            ₹${v.selling_price ?? '-'}
                        </span>
                    </div>
                `).join('') :
                        `<div class="text-muted">No variants available.</div>`;

                    const historyHtml = (p.approval_histories || []).length ?
                        p.approval_histories.map(h => `
                    <li class="timeline-item">

                        <div class="timeline-dot"></div>

                        <div class="timeline-content">

                            <div class="fw-bold small text-capitalize">
                                ${h.action_type}
                            </div>

                            <div class="text-muted small">
                                ${h.remarks || 'No remarks'}
                            </div>

                            <div class="text-muted extra-small">
                                ${h.created_at}
                                •
                                ${h.performer?.name || 'System'}
                            </div>

                        </div>

                    </li>
                `).join('') :
                        `<div class="text-muted">No approval history found.</div>`;

                    $('#drawer-content').html(`

                <div class="text-center mb-4">

                    <img
                        src="${p.primary_image_url || 'https://via.placeholder.com/150'}"
                        class="rounded-3 shadow-sm mb-3"
                        style="width:120px;height:120px;object-fit:cover;"
                    >

                    <h4 class="fw-bold mb-1">
                        ${p.product_name}
                    </h4>

                    <span class="badge-soft-dark px-3 py-1">
                        ${p.category?.category_name || 'N/A'}
                    </span>

                </div>

                <div class="mb-4">

                    <h6 class="fw-bold text-uppercase text-muted mb-3">
                        General Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-6">
                            <div class="text-muted extra-small">
                                Product Code
                            </div>

                            <div class="fw-semibold">
                                ${p.product_code || '-'}
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted extra-small">
                                Vendor
                            </div>

                            <div class="fw-semibold">
                                ${p.vendor?.business_name || '-'}
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-muted extra-small">
                                Description
                            </div>

                            <div class="small">
                                ${p.description || 'No description available.'}
                            </div>
                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <h6 class="fw-bold text-uppercase text-muted mb-3">
                        Product Variants
                    </h6>

                    <div class="border rounded-3 p-3">

                        ${variantsHtml}

                    </div>

                </div>

                <div>

                    <h6 class="fw-bold text-uppercase text-muted mb-3">
                        Approval History
                    </h6>

                    <ul class="timeline">

                        ${historyHtml}

                    </ul>

                </div>

            `);

                },

                error: function() {

                    $('#drawer-content').html(`

                <div class="text-center py-5">

                    <i class="ti ti-alert-circle text-danger" style="font-size:42px;"></i>

                    <p class="mt-3 text-danger">
                        Failed to load product details.
                    </p>

                </div>

            `);

                }

            });

        }


        $('#close-drawer, #drawer-overlay').on('click', function() {

            $('#approval-drawer').removeClass('open');

            $('#drawer-overlay').fadeOut();

        });

    });
</script>
