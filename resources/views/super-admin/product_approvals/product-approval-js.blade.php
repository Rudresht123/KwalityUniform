           <script> $(document).ready(function() {


                // --- Filters ---
                $('#btn-apply-filters').on('click', function() {
                    table.ajax.reload();
                    toastr.info('Filters applied successfully');
                });

                $('#btn-reset-filters').on('click', function() {
                    $('#filter-form')[0].reset();
                    table.ajax.reload();
                });

                // --- Checkbox Logic ---
                $('#select-all').on('click', function() {
                    $('.product-checkbox').prop('checked', this.checked);
                });

                // --- Single Actions ---
                $(document).on('click', '.btn-preview', function() {
                    const productId = $(this).data('id');
                    openDrawer(productId);
                });

                $(document).on('click', '.btn-approve', function() {
                    const productId = $(this).data('id');
                    if (confirm('Are you sure you want to approve this product?')) {
                        $.ajax({
                            url: '{{ url('/super-admin/product-approvals/approve') }}/' + productId,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                toastr.success(res.message);
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                toastr.error(xhr.responseJSON.message || 'Error');
                            }
                        });
                    }
                });

                $(document).on('click', '.btn-reject', function() {
                    const productId = $(this).data('id');
                    $('#rejectModal').modal('show');
                    $('#rejectModal').data('productId', productId);
                });

                $(document).on('click', '.btn-history', function() {

                    const productId = $(this).data('id');

                    let url = '{{ route('product.show', ':id') }}';

                    url = url.replace(':id', productId);

                    window.location.href = url;
                });

                // --- Bulk Actions ---
                $('#btn-bulk-approve').on('click', function() {
                    const selected = $('.product-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    if (selected.length === 0) return toastr.warning('Select products first');

                    $('#bulk-approve-count').text(selected.length);
                    $('#bulkApproveModal').modal('show');
                });

                $('#confirm-bulk-approve').on('click', function() {
                    const selected = $('.product-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    $.ajax({
                        url: '{{ url('/super-admin/product-approvals/approve') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            products: selected
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#bulkApproveModal').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON.message || 'Error');
                        }
                    });
                });

                $('#btn-bulk-reject').on('click', function() {
                    const selected = $('.product-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    if (selected.length === 0) return toastr.warning('Select products first');

                    $('#bulk-reject-count').text(selected.length);
                    $('#bulkRejectModal').modal('show');
                });

                $('#bulkRejectForm').on('submit', function(e) {
                    e.preventDefault();
                    const selected = $('.product-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    $.ajax({
                        url: '{{ url('/super-admin/product-approvals/reject') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            products: selected,
                            reason: $('#bulk_reject_reason').val()
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#bulkRejectModal').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON.message || 'Error');
                        }
                    });
                });

                // --- Reject Modal Submit ---
                $('#rejectForm').on('submit', function(e) {
                    e.preventDefault();
                    const productId = $('#rejectModal').data('productId');
                    $.ajax({
                        url: '{{ url('/super-admin/product-approvals/reject') }}/' + productId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            reason: $('#reject_reason').val()
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            $('#rejectModal').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON.message || 'Error');
                        }
                    });
                });

                // --- Side Drawer ---
                function openDrawer(productId) {
                    $('#drawer-overlay').fadeIn();
                    $('#approval-drawer').addClass('open');
                    $('#drawer-content').html(
                        '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">Loading details...</p></div>'
                    );
                    let url = '{{ route('product-approval.preview', ':id') }}';

                    url = url.replace(':id', productId);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(res) {
                            const p = res.data;
                            let variantsHtml = p.variants.map(v => `
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>${v.size?.size_name || 'N/A'} / ${v.color?.color_name || 'N/A'}</span>
                            <span class="fw-bold text-dark">$${v.selling_price}</span>
                        </div>
                    `).join('');

                            let historyHtml = p.approval_histories.map(h => `
                        <li class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="fw-bold small">${h.action_type.toUpperCase()}</div>
                                <div class="text-muted x-small">${h.remarks || 'No remarks'}</div>
                                <div class="text-muted x-small">${h.created_at} | ${h.performer?.name || 'System'}</div>
                            </div>
                        </li>
                    `).join('');

                            $('#drawer-content').html(`
                        <div class="text-center mb-4">
                            <img src="${p.primary_image_url || 'https://via.placeholder.com/150'}" class="rounded-3 shadow-sm mb-3" style="width:120px; height:120px; object-fit:cover; border: 1px solid var(--border-color);">
                            <h4 class="fw-bold text-dark">${p.product_name}</h4>
                            <span class="badge-soft-dark px-3 py-1">${p.category?.category_name || 'N/A'}</span>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="fw-bold text-muted text-uppercase extra-small mb-3">General Information</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="text-muted extra-small">SKU</div>
                                    <div class="fw-medium text-dark">${p.product_code}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted extra-small">Vendor</div>
                                    <div class="fw-medium text-dark">${p.vendor?.business_name || 'N/A'}</div>
                                </div>
                                <div class="col-12">
                                    <div class="text-muted extra-small">Description</div>
                                    <div class="text-muted small">${p.description || 'No description provided'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-muted text-uppercase extra-small mb-3">Variant Details</h6>
                            <div class="border rounded-3 p-3 bg-white">
                                ${variantsHtml}
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-muted text-uppercase extra-small mb-3">Approval Audit Trail</h6>
                            <ul class="timeline">${historyHtml}</ul>
                        </div>
                    `);
                        },
                        error: function() {
                            $('#drawer-content').html(
                                '<div class="text-center py-5 text-danger">Failed to load product details.</div>'
                            );
                        }
                    });
                }

                $('#close-drawer, #drawer-overlay').on('click', function() {
                    $('#approval-drawer').removeClass('open');
                    $('#drawer-overlay').fadeOut();
                });

                // KPI Update (Mockup based on DT records)
                function updateKpis() {
                    const data = table.ajax.json().data || [];
                    $('#pending-count').text(data.length);
                    $('#kpi-pending').text(data.length);
                }
            });

            </script>
