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
                <div class="card-body">

                    {{-- Product Header --}}
                    <div class="bg-light rounded p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h3 class="mb-1">{{ $product->product_name }}</h3>

                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-primary">
                                        {{ $product->product_code }}
                                    </span>

                                    <span class="badge bg-info">
                                        {{ ucfirst($product->gender_type) }}
                                    </span>

                                    @if ($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row g-4">

                        {{-- Product Image --}}
                        <div class="col-lg-4">

                            @php
                                $primaryImage = $product->primaryImage;
                                $imageUrl = $primaryImage ? $primaryImage->url : asset('images/no_image.png');
                            @endphp

                            <div class="border rounded p-3 bg-light text-center">
                                <img src="{{ $imageUrl }}" class="img-fluid" style="height:350px;object-fit:contain;">
                            </div>

                        </div>

                        {{-- Product Details --}}
                        <div class="col-lg-8">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted">Vendor</small>
                                        <h6 class="mb-0 mt-1">
                                            {{ $product->vendor->business_name }}
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted">Category</small>
                                        <h6 class="mb-0 mt-1">
                                            {{ $product->category->category_name }}
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted">Fabric Composition</small>
                                        <h6 class="mb-0 mt-1">
                                            {{ $product->fabric_composition ?? 'N/A' }}
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted">Approval Status</small>

                                        @php
                                            $class = match ($product->approval_status) {
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                default => 'warning',
                                            };
                                        @endphp

                                        <div class="mt-1">
                                            <span class="badge bg-{{ $class }}">
                                                {{ strtoupper($product->approval_status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mt-5">
                        <h5>Description</h5>

                        <div class="border rounded p-3 bg-light">
                            {{ $product->description ?? 'No description available.' }}
                        </div>
                    </div>

                    {{-- Inventory Summary --}}
                    <div class="mt-5">

                        <h5 class="mb-3">Inventory Summary</h5>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <small class="text-muted">Variants</small>
                                    <h3>{{ $product->variants->count() }}</h3>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <small class="text-muted">Total Stock</small>
                                    <h3>{{ $product->variants->sum('stock_qty') }}</h3>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3 text-center">
                                    <small class="text-muted">Low Stock</small>

                                    <h3 class="text-danger">
                                        {{ $product->variants->filter(fn($v) => $v->stock_qty <= $v->low_stock_alert)->count() }}
                                    </h3>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
