@extends('layouts.common')

@section('content')

    @php
        $primaryImage = $product->primaryImage;
        $imageUrl = $primaryImage ? $primaryImage->url : asset('images/no_image.png');

        $approvalBadge = match ($product->approval_status) {
            'approved' => 'success',
            'rejected' => 'danger',
            default => 'warning',
        };

        $lowStockCount = $product->variants->sum('low_stock_alert');
    @endphp

    {{-- ── Hero ── --}}
    <div class="card custom-card mb-3">
        <div class="card-body">
            <div
                class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">

                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $imageUrl }}" alt="{{ $product->product_name }}" class="rounded-3 border"
                        style="width:64px; height:64px; object-fit:cover; flex-shrink:0;">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $product->product_name }}</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary-subtle text-primary fw-semibold">
                                <i class="ti ti-tag me-1"></i>{{ $product->product_code }}
                            </span>
                            <span class="badge bg-info-subtle text-info fw-semibold">
                                {{ ucfirst($product->gender_type) }}
                            </span>
                            @if ($product->is_active)
                                <span class="badge bg-success-subtle text-success fw-semibold">
                                    <i class="ti ti-circle-check me-1"></i>Active
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger fw-semibold">
                                    <i class="ti ti-circle-x me-1"></i>Inactive
                                </span>
                            @endif
                            <span
                                class="badge bg-{{ $approvalBadge }}-subtle text-{{ $approvalBadge }} fw-semibold text-capitalize">
                                {{ $product->approval_status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-shrink-0">
                    <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-primary btn-sm fw-semibold">
                        <i class="ti ti-edit me-1"></i>Edit
                    </a>
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-sm border fw-semibold">
                        <i class="ti ti-arrow-left me-1"></i>Back
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- ── KPI Strip ── --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-4">
            <div class="card custom-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-primary-subtle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:46px; height:46px;">
                        <i class="ti ti-stack fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="text-muted fw-semibold text-uppercase" style="font-size:.68rem; letter-spacing:.06em;">
                            Variants</div>
                        <div class="h4 mb-0 fw-bold">{{ $product->variants->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="card custom-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-info-subtle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:46px; height:46px;">
                        <i class="ti-package fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="text-muted fw-semibold text-uppercase" style="font-size:.68rem; letter-spacing:.06em;">
                            Total Stock</div>
                        <div class="h4 mb-0 fw-bold">{{ $product->variants->sum('stock_qty') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card custom-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-danger-subtle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:46px; height:46px;">
                        <i class="ti ti-alert-triangle fs-4 text-danger"></i>
                    </div>
                    <div>
                        <div class="text-muted fw-semibold text-uppercase" style="font-size:.68rem; letter-spacing:.06em;">
                            Low Stock</div>
                        <div class="h4 mb-0 fw-bold {{ $lowStockCount > 0 ? 'text-danger' : '' }}">
                            {{ $lowStockCount }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Image + Info + Description ── --}}
    <div class="row g-4 mb-3">

        {{-- Image --}}
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card custom-card h-100">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ti ti-photo me-2 text-muted"></i>
                        Product Images
                    </div>
                </div>

                <div class="card-body p-2">

                    @if ($product->images->count())
                        <div id="productImageSlider" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner rounded-3">

                                @foreach ($product->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ getFileUrl($image->file_id) }}" class="d-block w-100 rounded-3"
                                            alt="Product Image" style="height:320px;object-fit:contain;background:#f8f9fa;">
                                    </div>
                                @endforeach

                            </div>

                            @if ($product->images->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productImageSlider"
                                    data-bs-slide="prev">

                                    <span class="carousel-control-prev-icon"></span>

                                </button>

                                <button class="carousel-control-next" type="button" data-bs-target="#productImageSlider"
                                    data-bs-slide="next">

                                    <span class="carousel-control-next-icon"></span>

                                </button>

                                <div class="carousel-indicators position-static mt-3">

                                    @foreach ($product->images as $index => $image)
                                        <button type="button" data-bs-target="#productImageSlider"
                                            data-bs-slide-to="{{ $index }}"
                                            class="{{ $index == 0 ? 'active' : '' }}">
                                        </button>
                                    @endforeach

                                </div>
                            @endif

                        </div>
                    @else
                        <div class="text-center py-5">
                            <img src="{{ asset('assets/images/no-image.png') }}" width="150" class="opacity-50">
                            <p class="text-muted mt-3 mb-0">
                                No Image Available
                            </p>
                        </div>

                    @endif

                </div>
            </div>
        </div>

        {{-- Info + Description --}}
        <div class="col-12 col-md-8 col-lg-9 d-flex flex-column gap-2">

            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ti ti-info-circle me-2 text-muted"></i>Product Information
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-lg-3">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <div class="text-muted fw-semibold text-uppercase mb-1"
                                    style="font-size:.68rem; letter-spacing:.06em;">Vendor</div>
                                <div class="fw-semibold">{{ $product->vendor->business_name }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <div class="text-muted fw-semibold text-uppercase mb-1"
                                    style="font-size:.68rem; letter-spacing:.06em;">Category</div>
                                <div class="fw-semibold">{{ $product->category->category_name ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <div class="text-muted fw-semibold text-uppercase mb-1"
                                    style="font-size:.68rem; letter-spacing:.06em;">Fabric</div>
                                <div class="fw-semibold">{{ $product->fabric_composition ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <div class="text-muted fw-semibold text-uppercase mb-1"
                                    style="font-size:.68rem; letter-spacing:.06em;">Approval</div>
                                <span class="badge bg-{{ $approvalBadge }} text-capitalize fs-6 px-3 py-2">
                                    {{ $product->approval_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card custom-card flex-grow-1">
                <div class="card-header">
                    <div class="card-title">
                        <i class="ti ti-file-description me-2 text-muted"></i>Description
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0" style="line-height:1.75;">
                        {{ $product->description ?? 'No description available.' }}
                    </p>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Approval History Timeline ── --}}
    <div class="card custom-card mb-3">
        <div class="card-header">
            <div class="card-title">
                <i class="ti ti-history me-2 text-muted"></i>Approval History
            </div>
        </div>
        <div class="card-body">
            @if ($product->approvalHistories->isEmpty())
                <p class="text-muted small mb-0">No approval history available.</p>
            @else
                <ul class="list-unstyled mb-0">
                    @foreach ($product->approvalHistories as $history)
                        @php
                            $dotColor = match ($history->action_type) {
                                'approved' => 'success',
                                'rejected' => 'danger',
                                'resubmitted' => 'info',
                                default => 'warning',
                            };
                        @endphp
                        <li class="d-flex gap-3 {{ !$loop->last ? 'mb-3' : '' }}">

                            <div class="d-flex flex-column align-items-center" style="width:20px; flex-shrink:0;">
                                <div class="rounded-circle bg-{{ $dotColor }}"
                                    style="width:10px; height:10px; margin-top:5px; flex-shrink:0;"></div>
                                @if (!$loop->last)
                                    <div class="border-start border-2 flex-grow-1 mt-1 ms-0"
                                        style="border-color:#dee2e6 !important;"></div>
                                @endif
                            </div>

                            <div class="flex-grow-1 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                    <span class="fw-bold">{{ ucfirst($history->action_type) }}</span>
                                    <span
                                        class="badge bg-{{ $dotColor }}-subtle text-{{ $dotColor }} fw-semibold">
                                        {{ $history->old_status ?? '—' }} → {{ $history->new_status }}
                                    </span>
                                </div>
                                <div class="small text-muted">
                                    <i class="ti ti-clock me-1"></i>{{ $history->created_at->format('d M Y, h:i A') }}
                                    &nbsp;·&nbsp;
                                    <i class="ti ti-user me-1"></i>{{ $history->performer->name ?? 'System' }}
                                    @if ($history->remarks)
                                        &nbsp;·&nbsp;"{{ $history->remarks }}"
                                    @endif
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- ── Variant Stock History Accordion ── --}}
    <div class="card custom-card mb-3">
        <div class="card-header">
            <div class="card-title">
                <i class="ti ti-stack me-2 text-muted"></i>Variant Stock History
            </div>
        </div>
        <div class="card-body p-0">
            <div class="accordion accordion-flush" id="stockAccordion">
                @foreach ($product->variants as $variant)
                    @php
                        $isLow = $variant->stock_qty <= $variant->low_stock_alert;
                        $isNear = $variant->stock_qty <= $variant->low_stock_alert * 2;
                        $stockBadge = $isLow ? 'danger' : ($isNear ? 'warning' : 'primary');
                    @endphp
                    <div class="accordion-item border-0 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <h2 class="accordion-header" id="head-{{ $variant->variant_id }}">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#body-{{ $variant->variant_id }}"
                                aria-expanded="false" aria-controls="body-{{ $variant->variant_id }}">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="badge bg-secondary-subtle text-secondary fw-semibold">
                                        {{ $variant->sku }}
                                    </span>
                                    <span class="text-muted fw-normal">
                                        {{ $variant->size->size_name ?? 'N/A' }} /
                                        {{ $variant->color->color_name ?? 'N/A' }}
                                    </span>
                                    <span
                                        class="badge bg-{{ $stockBadge }}-subtle text-{{ $stockBadge }} fw-semibold">
                                        <i class="ti ti-package me-1"></i>{{ $variant->stock_qty }}
                                    </span>
                                    @if ($isLow)
                                        <span class="badge bg-danger fw-semibold" style="font-size:.65rem;">Low
                                            Stock</span>
                                    @endif
                                </div>
                            </button>
                        </h2>
                        <div id="body-{{ $variant->variant_id }}" class="accordion-collapse collapse"
                            aria-labelledby="head-{{ $variant->variant_id }}" data-bs-parent="#stockAccordion">
                            <div class="accordion-body pt-0">
                                @if ($variant->stockAdjustments->isEmpty())
                                    <p class="text-muted small mb-0">No stock adjustments recorded.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Old Stock</th>
                                                    <th>Added</th>
                                                    <th>New Stock</th>
                                                    <th>Updated By</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($variant->stockAdjustments as $adj)
                                                    <tr>
                                                        <td class="text-nowrap">
                                                            {{ $adj->created_at->format('d M Y, h:i A') }}</td>
                                                        <td>{{ $adj->old_stock }}</td>
                                                        <td>
                                                            <span
                                                                class="fw-bold {{ $adj->added_quantity >= 0 ? 'text-success' : 'text-danger' }}">
                                                                {{ $adj->added_quantity >= 0 ? '+' : '' }}{{ $adj->added_quantity }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $adj->new_stock }}</td>
                                                        <td>{{ $adj->user->name ?? 'System' }}</td>
                                                        <td class="text-muted">{{ $adj->remarks ?? '—' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
