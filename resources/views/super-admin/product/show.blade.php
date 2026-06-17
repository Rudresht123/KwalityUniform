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
                    <div class="col-md-4">
                        <div class="product-show-image-container mb-3">
                            @php
                                $primaryImage = $product->primaryImage;
                                $imageUrl = $primaryImage ? $primaryImage->url : asset('images/no_image.png');
                            @endphp
                            <img src="{{ $imageUrl }}" class="img-fluid rounded border shadow-sm main-product-image" id="main-image">
                        </div>
                        @if($product->images->count() > 1)
                            <div class="product-gallery d-flex gap-2 overflow-auto pb-2">
                                @foreach($product->images as $image)
                                    <img src="{{ $image->url }}" class="img-thumbnail cursor-pointer gallery-thumb {{ $image->is_primary ? 'border-primary' : '' }}" 
                                         style="width: 60px; height: 60px; object-fit: cover;"
                                         onclick="document.getElementById('main-image').src = this.src">
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
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
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <p class="mb-1 fw-bold text-muted">Description</p>
                        <p class="fs-14">{{ $product->description ?? 'No description provided.' }}</p>
                    </div>
...
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

                <div class="mt-5">
                    <h5 class="fw-bold text-primary mb-3"><i class="ti ti-layers-intersect me-1"></i> Product Variants</h5>
                    <div class="table-responsive border rounded">
                        <table class="table text-nowrap mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>SKU</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>MRP</th>
                                    <th>Selling Price</th>
                                    <th>Stock</th>
                                    <th>Alert Level</th>
                                    <th>Barcode</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product->variants as $variant)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $variant->sku }}</td>
                                        <td>{{ $variant->size->size_name ?? 'N/A' }}</td>
                                        <td>{{ $variant->color->color_name ?? 'N/A' }}</td>
                                        <td>{{ number_format($variant->mrp, 2) }}</td>
                                        <td>{{ number_format($variant->selling_price, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $variant->stock_qty <= $variant->low_stock_alert ? 'danger' : 'success' }}-transparent">
                                                {{ $variant->stock_qty }}
                                            </span>
                                        </td>
                                        <td>{{ $variant->low_stock_alert }}</td>
                                        <td>{{ $variant->barcode ?? 'N/A' }}</td>
                                        <td>
                                            @if($variant->is_active)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">No variants found for this product.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
