@extends('layouts.common')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Product Details: {{ $product->product_code }}</div>
                <div class="btn-list">
                    <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-primary btn-sm border">
                        <i class="ti ti-edit me-1"></i> Edit
                    </a>
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-sm border">
                        <i class="ti ti-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Product Name</p>
                        <p class="fs-16">{{ $product->product_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Product Code</p>
                        <p class="fs-16">{{ $product->product_code }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Vendor</p>
                        <p class="fs-16">{{ $product->vendor->business_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Category</p>
                        <p class="fs-16">{{ $product->category->category_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Gender Type</p>
                        <p class="fs-16 text-capitalize">{{ $product->gender_type }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 fw-bold text-muted">Fabric Composition</p>
                        <p class="fs-16">{{ $product->fabric_composition ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-12">
                        <p class="mb-1 fw-bold text-muted">Description</p>
                        <p class="fs-14">{{ $product->description ?? 'No description provided.' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 fw-bold text-muted">Approval Status</p>
                        @php
                            $class = match ($product->approval_status) {
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'warning',
                            };
                        @endphp
                        <span class="badge bg-{{ $class }}-transparent">{{ strtoupper($product->approval_status) }}</span>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 fw-bold text-muted">Status</p>
                        @if($product->is_active)
                            <span class="badge bg-success">ACTIVE</span>
                        @else
                            <span class="badge bg-danger">INACTIVE</span>
                        @endif
                    </div>
                </div>

                <hr class="my-5">

                <div class="row g-4">
                    <div class="col-md-4">
                        <p class="mb-1 fw-bold text-muted fs-11">Created By</p>
                        <p>{{ $product->creator->name ?? 'System' }}</p>
                        <p class="text-muted fs-11">{{ $product->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1 fw-bold text-muted fs-11">Last Updated By</p>
                        <p>{{ $product->updater->name ?? 'System' }}</p>
                        <p class="text-muted fs-11">{{ $product->updated_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
