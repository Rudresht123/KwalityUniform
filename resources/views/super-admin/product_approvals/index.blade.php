@extends('layouts.common')

@push('styles')
    <style>
        /* ─── Reset & base ─────────────────────────────────────────────── */
        .pa-wrap {
            font-family: inherit;
        }

        /* ─── Hero ─────────────────────────────────────────────────────── */
        .pa-hero {
            background: #6259ca;
            border-radius: 16px;
            padding: 2rem 2.25rem 1.75rem;
            color: #fff;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .pa-hero::after {
            content: '';
            position: absolute;
            top: -70px;
            right: -50px;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            pointer-events: none;
        }

        .pa-hero h1 {
            font-size: 1.55rem;
            font-weight: 600;
            letter-spacing: -0.015em;
            color: #fff;
            margin: 0 0 4px;
        }

        .pa-hero p {
            font-size: 0.875rem;
            opacity: 0.75;
            margin: 0;
        }

        .pa-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 0.78rem;
            margin-top: 12px;
            font-weight: 500;
        }

        .pa-hero-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            z-index: 1;
            flex-shrink: 0;
        }

        .pa-hero .btn-light {
            background: #fff;
            color: #6259ca;
            border: none;
            font-weight: 600;
            font-size: 0.825rem;
            padding: 7px 16px;
            border-radius: 9px;
        }

        .pa-hero .btn-outline-light {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 0.825rem;
            padding: 7px 14px;
            border-radius: 9px;
        }

        /* ─── KPI cards ─────────────────────────────────────────────────── */
        .pa-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 1.5rem;
        }

        .pa-kpi {
            background: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 14px;
            padding: 1.1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }

        .pa-kpi:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        }

        .pa-kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .kpi-orange {
            background: rgba(253, 126, 20, .10);
            color: #fd7e14;
        }

        .kpi-blue {
            background: rgba(1, 184, 255, .10);
            color: #01b8ff;
        }

        .kpi-purple {
            background: rgba(98, 89, 202, .10);
            color: #6259ca;
        }

        .kpi-green {
            background: rgba(25, 177, 89, .10);
            color: #19b159;
        }

        .pa-kpi-label {
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #888;
            font-weight: 600;
        }

        .pa-kpi-value {
            font-size: 1.55rem;
            font-weight: 700;
            color: #1a1a2e;
            line-height: 1.1;
            margin-top: 2px;
        }

        /* ─── Cards ─────────────────────────────────────────────────────── */
        .pa-card {
            background: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.07);
            border-radius: 14px;
            margin-bottom: 1.4rem;
            overflow: hidden;
        }

        .pa-card-header {
            padding: 1rem 1.5rem;
            border-bottom: 0.5px solid rgba(0, 0, 0, 0.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pa-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .pa-card-body {
            padding: 1.25rem 1.5rem;
        }

        /* ─── Filter bar ─────────────────────────────────────────────────── */
        .pa-filter-label {
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #888;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .pa-filter-bar .form-select,
        .pa-filter-bar .form-control {
            border-radius: 9px;
            border: 0.5px solid rgba(0, 0, 0, 0.12);
            font-size: 0.83rem;
            height: 36px;
        }

        .pa-filter-bar .input-group-text {
            border-radius: 9px 0 0 9px;
            border-color: rgba(0, 0, 0, 0.12);
            background: #fff;
        }

        .pa-filter-bar .input-group .form-control {
            border-radius: 0 9px 9px 0;
            border-left: none;
        }

        /* ─── Table ──────────────────────────────────────────────────────── */
        #approval-table thead th {
            font-size: 0.67rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #888;
            font-weight: 600;
            padding: 10px 12px;
            border-bottom: 0.5px solid rgba(0, 0, 0, 0.07);
            white-space: nowrap;
        }

        #approval-table tbody td {
            padding: 11px 12px;
            vertical-align: middle;
            border-bottom: 0.5px solid rgba(0, 0, 0, 0.05);
            font-size: 0.83rem;
            color: #333;
        }

        #approval-table tbody tr:last-child td {
            border-bottom: none;
        }

        #approval-table tbody tr:hover {
            background: #fafafa;
        }

        .pa-product-thumb {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            object-fit: cover;
        }

        .pa-product-name {
            font-weight: 600;
            font-size: 0.84rem;
            color: #1a1a2e;
        }

        .pa-product-sku {
            font-size: 0.71rem;
            color: #999;
            margin-top: 1px;
        }

        /* ─── Badges ─────────────────────────────────────────────────────── */
        .pa-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .pa-badge-pending {
            background: rgba(253, 126, 20, .12);
            color: #9c5200;
        }

        .pa-badge-approved {
            background: rgba(25, 177, 89, .12);
            color: #0a6e32;
        }

        .pa-badge-new {
            background: rgba(1, 184, 255, .12);
            color: #006b91;
        }

        .pa-badge-cat {
            background: rgba(98, 89, 202, .10);
            color: #3c3489;
        }

        .pa-badge-var {
            background: rgba(98, 89, 202, .08);
            color: #534ab7;
        }

        /* ─── Priority indicators ─────────────────────────────────────────── */
        .pa-priority-high {
            color: #c0392b;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pa-priority-med {
            color: #b7770d;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pa-priority-low {
            color: #1d7a4a;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ─── Action buttons ─────────────────────────────────────────────── */
        .pa-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border-radius: 7px;
            padding: 5px 10px;
            font-size: 0.78rem;
            font-weight: 500;
            border: 0.5px solid rgba(0, 0, 0, 0.1);
            background: #fff;
            color: #555;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .pa-action-btn:hover {
            background: #f5f5f8;
            color: #333;
        }

        .pa-action-btn.approve {
            background: rgba(25, 177, 89, .08);
            border-color: rgba(25, 177, 89, .25);
            color: #0a6e32;
        }

        .pa-action-btn.reject {
            background: rgba(220, 53, 69, .07);
            border-color: rgba(220, 53, 69, .25);
            color: #a32d2d;
        }

        .pa-action-btn.approve:hover {
            background: rgba(25, 177, 89, .15);
        }

        .pa-action-btn.reject:hover {
            background: rgba(220, 53, 69, .13);
        }

        /* ─── Side drawer ─────────────────────────────────────────────────── */
        .drawer-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1040;
            backdrop-filter: blur(2px);
        }

        .approval-drawer {
            position: fixed;
            top: 0;
            right: -480px;
            width: 460px;
            height: 100vh;
            background: #fff;
            z-index: 1050;
            box-shadow: -8px 0 40px rgba(0, 0, 0, 0.12);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            border-radius: 20px 0 0 20px;
        }

        .approval-drawer.open {
            right: 0;
        }

        .drawer-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .drawer-content .timeline {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .drawer-content .timeline-item {
            display: flex;
            gap: 12px;
            padding: 8px 0;
            position: relative;
        }

        .drawer-content .timeline-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #6259ca;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .drawer-content .timeline-content .fw-bold {
            font-size: 0.8rem;
            color: #1a1a2e;
        }

        .drawer-content .x-small {
            font-size: 0.73rem;
            color: #888;
        }

        /* ─── Modals ─────────────────────────────────────────────────────── */
        .modal-content {
            border-radius: 18px !important;
            border: none !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12) !important;
        }

        .modal-header {
            border-bottom: none !important;
        }

        .modal-footer {
            border-top: none !important;
        }

        #rejectModal .modal-header h5 {
            color: #dc3545;
            font-weight: 700;
        }

        #bulkApproveModal .modal-header h5 {
            color: #6259ca;
            font-weight: 700;
        }

        #bulkRejectModal .modal-header h5 {
            color: #dc3545;
            font-weight: 700;
        }

        .alert-danger-light {
            background: rgba(220, 53, 69, .07);
            border: 0.5px solid rgba(220, 53, 69, .15) !important;
        }

        .modal-content .form-control {
            border-radius: 10px;
            border: 0.5px solid rgba(0, 0, 0, .12);
            font-size: 0.83rem;
        }

        /* ─── Empty state ─────────────────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state img {
            width: 80px;
            opacity: 0.45;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            font-weight: 700;
            color: #333;
        }

        .empty-state p {
            color: #999;
            font-size: 0.875rem;
        }

        /* ─── Misc helpers ───────────────────────────────────────────────── */
        .x-small {
            font-size: 0.75rem !important;
        }

        .extra-small {
            font-size: 0.68rem !important;
        }

        .badge-soft-dark {
            background: rgba(0, 0, 0, 0.06);
            color: #444;
            padding: 4px 12px;
            border-radius: 50rem;
            font-size: 0.8rem;
        }
    </style>
@endpush



@section('content')
    <div class="pa-wrap">

        {{-- ── Hero ── --}}
        <div class="pa-hero">
            <div>
                <h1>Product Approval Center</h1>
                <p>Review vendor submissions and maintain catalog quality before publication.</p>
                <div class="pa-hero-badge">
                    <i class="ti ti-alert-circle"></i>
                    <span id="pending-count">...</span>&nbsp;Pending Review
                </div>
            </div>
            <div class="pa-hero-actions">
                <button type="button" class="btn btn-light d-flex align-items-center gap-1" id="btn-bulk-approve">
                    <i class="ti ti-check"></i> Bulk Approve
                </button>
                <button type="button" class="btn btn-outline-light d-flex align-items-center gap-1" id="btn-bulk-reject">
                    <i class="ti ti-x"></i> Bulk Reject
                </button>
                <button type="button" class="btn btn-outline-light px-2" onclick="location.reload()" title="Refresh">
                    <i class="ti ti-refresh"></i>
                </button>
            </div>
        </div>

        {{-- ── KPI Cards ── --}}
        <div class="pa-kpi-grid">
            <div class="pa-kpi">
                <div class="pa-kpi-icon kpi-orange"><i class="ti ti-clock"></i></div>
                <div>
                    <div class="pa-kpi-label">Pending Products</div>
                    <div class="pa-kpi-value" id="kpi-pending">...</div>
                </div>
            </div>
            <div class="pa-kpi">
                <div class="pa-kpi-icon kpi-blue"><i class="ti ti-calendar"></i></div>
                <div>
                    <div class="pa-kpi-label">Submitted Today</div>
                    <div class="pa-kpi-value" id="kpi-today">...</div>
                </div>
            </div>
            <div class="pa-kpi">
                <div class="pa-kpi-icon kpi-purple"><i class="ti ti-building"></i></div>
                <div>
                    <div class="pa-kpi-label">Waiting Vendors</div>
                    <div class="pa-kpi-value" id="kpi-vendors">...</div>
                </div>
            </div>
            <div class="pa-kpi">
                <div class="pa-kpi-icon kpi-green"><i class="ti ti-activity"></i></div>
                <div>
                    <div class="pa-kpi-label">Average Approval</div>
                    <div class="pa-kpi-value" id="kpi-avg">2.4d</div>
                </div>
            </div>
        </div>

        {{-- ── Filter Bar ── --}}
        <div class="pa-card">
            <div class="pa-card-body">
                <form id="filter-form" method="GET" action="{{ route('product-approval.index') }}"
                    class="row g-3 align-items-end pa-filter-bar">
                    <input type="hidden" name="is_search" value="1">
                    {{-- Vendor --}}
                    @if(!auth()->user()->hasRole('vendor'))
                        <div class="col-md-3">
                            <label class="pa-filter-label mb-2">
                                Vendor
                            </label>

                            @include('custom-component.vendor', [
                                'id' => 'vendor_id',
                                'name' => 'vendor_id',
                                'valueField' => 'vendor_id',
                                'textField' => 'business_name',
                                'selected' => request('vendor_id'),
                                'placeholder' => 'All Vendors',
                            ])
                        </div>
                    @endif

                    {{-- Category --}}
                    <div class="col-md-3">
                        <label class="pa-filter-label mb-2">
                            Category
                        </label>

                        @include('custom-component.subCategory', [
                            'name' => 'category_id',
                            'id' => 'category_id',
                            'selected' => request('category_id'),
                            'placeholder' => 'All Categories',
                        ])
                        
                    </div>

                    {{-- Search --}}
                    <div class="col-md-4">
                        <label class="pa-filter-label mb-2">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>

                            <input type="text" name="search" class="form-control border-start-0"
                                value="{{ request('search') }}" placeholder="Search product name, SKU...">

                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-md-2">

                        <div class="d-flex gap-2">

                            <button type="submit" class="btn pa-btn-filter flex-fill">

                                <i class="ti ti-filter me-1"></i>
                                Apply

                            </button>

                            <a href="{{ route('product-approval.index') }}" class="btn btn-light border pa-btn-reset">

                                <i class="ti ti-refresh"></i>

                            </a>

                        </div>

                    </div>

                </form>
            </div>
        </div>

        {{-- ── Approval Queue Table ── --}}
        <div class="pa-card">
            <div class="pa-card-header">
                <span class="pa-card-title">Review Queue</span>
                <span class="x-small text-muted">Showing pending submissions</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    @if (count($products) == 0)
                        @include('components.empty-state')
                    @else
                        <table id="" class=" datatable w-100 mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:44px;">
                                        <input type="checkbox" id="select-all" class="form-check-input">
                                    </th>
                                    <th>Product</th>
                                    <th>Vendor</th>
                                    <th>Category</th>
                                    <th>Variants</th>
                                    <th>Submitted</th>
                                    <th>Status</th>
                                    <th class="text-end" style="padding-right:1.5rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($products as $product)
                                    <tr>

                                        <td>
                                            <input type="checkbox" class="product-checkbox form-check-input"
                                                value="{{ $product->product_id }}">
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">

                                                <img src="{{ $product->firstImage() }}" class="rounded-3 me-3"
                                                    width="42" height="42">

                                                <div>
                                                    <div class="fw-semibold">
                                                        {{ $product->product_name }}
                                                    </div>

                                                    <small class="text-muted">
                                                        {{ $product->product_code }}
                                                    </small>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            {{ $product->vendor->business_name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $product->category->category_name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $product->variants_count }}
                                        </td>

                                        <td>
                                            {{ $product->created_at->format('d M Y') }}
                                        </td>

                                        <td>
                                            <span class="badge-soft-warning">
                                                Pending
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown text-center">

                                                <button class="btn action-badge view-badge" data-bs-toggle="dropdown">

                                                    <i class="ti ti-dots"></i>

                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li>
                                                        <button class="dropdown-item btn-preview"
                                                            data-id="{{ $product->product_id }}">
                                                            Preview
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <button class="dropdown-item btn-approve"
                                                            data-id="{{ $product->product_id }}">
                                                            Approve
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <button class="dropdown-item btn-reject"
                                                            data-id="{{ $product->product_id }}">
                                                            Reject
                                                        </button>
                                                    </li>

                                                </ul>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            No products found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

    </div>{{-- /pa-wrap --}}

    {{-- ── Side Drawer ── --}}
    <div class="drawer-overlay" id="drawer-overlay"></div>
    <div class="approval-drawer" id="approval-drawer">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-4">
            <h5 class="mb-0 fw-bold text-dark">Product Preview</h5>
            <button type="button" class="btn-close" id="close-drawer"></button>
        </div>
        <div class="drawer-content" id="drawer-content">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-muted small">Loading details...</p>
            </div>
        </div>
    </div>

    {{-- ── Reject Modal ── --}}
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pt-4 px-4">
                    <h5 class="mb-0">Reject Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm">
                    <div class="modal-body px-4">
                        <div class="alert alert-danger-light rounded-3 mb-4 border-0">
                            <div class="d-flex align-items-center gap-2">
                                <i class="ti ti-alert-triangle fs-5 text-danger"></i>
                                <span class="small text-muted">
                                    This action will notify the vendor. The product will be marked as rejected.
                                </span>
                            </div>
                        </div>
                        <label class="form-label fw-medium small">Reason for Rejection</label>
                        <textarea name="reason" id="reject_reason" class="form-control" rows="4"
                            placeholder="Specify why the product is being rejected…" required minlength="10"></textarea>
                        <div class="form-text text-muted mt-1">Minimum 10 characters required.</div>
                    </div>
                    <div class="modal-footer pb-4 px-4">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm px-4 fw-bold">Reject Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── Bulk Approve Modal ── --}}
    <div class="modal fade" id="bulkApproveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pt-4 px-4">
                    <h5 class="mb-0">Bulk Approve Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 text-center">
                    <i class="ti ti-circle-check text-primary mb-3" style="font-size:3.5rem;"></i>
                    <p class="fs-6 mb-1">
                        Approve <span id="bulk-approve-count" class="fw-bold text-primary">0</span> selected products?
                    </p>
                    <p class="text-muted small">These products will be immediately published to the catalog.</p>
                </div>
                <div class="modal-footer pb-4 px-4">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-bulk-approve" class="btn btn-primary btn-sm px-4 fw-bold">Yes,
                        Approve All</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Bulk Reject Modal ── --}}
    <div class="modal fade" id="bulkRejectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pt-4 px-4">
                    <h5 class="mb-0">Bulk Reject Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="bulkRejectForm">
                    <div class="modal-body px-4">
                        <p class="text-center mb-3">
                            Reject <span id="bulk-reject-count" class="fw-bold text-danger">0</span> selected products.
                        </p>
                        <label class="form-label fw-medium small">Rejection Reason</label>
                        <textarea name="reason" id="bulk_reject_reason" class="form-control" rows="4"
                            placeholder="Provide a reason for all selected products…" required minlength="10"></textarea>
                        <div class="form-text text-muted mt-1">Minimum 10 characters required.</div>
                    </div>
                    <div class="modal-footer pb-4 px-4">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm px-4 fw-bold">Reject All Products</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        @include('super-admin.product_approvals.product-approval-js')
    @endpush
@endsection
