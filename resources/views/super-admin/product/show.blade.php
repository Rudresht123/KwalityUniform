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

                    {{-- Approval History Audit Trail --}}
                    <div class="mt-5">
                        <h5 class="mb-3">Approval History</h5>

                        <div class="table-responsive">
                            <table class="table table-sm table-hover border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Action</th>
                                        <th>From Status</th>
                                        <th>To Status</th>
                                        <th>Performed By</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($product->approvalHistories as $history)
                                        <tr>
                                            <td>{{ $history->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = match($history->action_type) {
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        'resubmitted' => 'info',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badgeClass }}">
                                                    {{ ucfirst($history->action_type) }}
                                                </span>
                                            </td>
                                            <td>{{ $history->old_status ?? 'N/A' }}</td>
                                            <td>{{ $history->new_status }}</td>
                                            <td>{{ $history->performer->name ?? 'System' }}</td>
                                            <td>{{ $history->remarks }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No approval history available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Stock History for Variants --}}
                    <div class="mt-5">
                        <h5 class="mb-3">Variant Stock History</h5>
                        
                        <div class="accordion" id="stockHistoryAccordion">
                            @foreach($product->variants as $variant)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $variant->variant_id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $variant->variant_id }}" aria-expanded="false" aria-controls="collapse-{{ $variant->variant_id }}">
                                            <strong>SKU: {{ $variant->sku }}</strong> - {{ $variant->size->size_name ?? 'N/A' }} / {{ $variant->color->color_name ?? 'N/A' }} 
                                            <span class="badge bg-secondary ms-2">Current Stock: {{ $variant->stock_qty }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $variant->variant_id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $variant->variant_id }}" data-bs-parent="#stockHistoryAccordion">
                                        <div class="accordion-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover border">
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
                                                        @forelse($variant->stockAdjustments as $adj)
                                                            <tr>
                                                                <td>{{ $adj->created_at->format('d M Y, h:i A') }}</td>
                                                                <td>{{ $adj->old_stock }}</td>
                                                                <td><span class="text-success">+{{ $adj->added_quantity }}</span></td>
                                                                <td>{{ $adj->new_stock }}</td>
                                                                <td>{{ $adj->user->name ?? 'System' }}</td>
                                                                <td>{{ $adj->remarks ?? 'N/A' }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center text-muted">No stock adjustments recorded.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
