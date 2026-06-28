@extends('layouts.common')

@push('styles')
    <style>
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #6B62DD;
        }

        .form-section-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
            transition: transform 0.2s ease;
        }

        .form-section-card:hover {
            transform: translateY(-2px);
        }

        .media-upload-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-upload-box {
            position: relative;
            aspect-ratio: 1;
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
            overflow: hidden;
        }

        .image-upload-box:hover {
            border-color: #6B62DD;
            background: #f1f5f9;
        }

        .image-upload-box i {
            font-size: 2rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .image-upload-box span {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 44, 44, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: scale 0.2s ease;
        }

        .remove-preview:hover {
            scale: 1.1;
        }

        .upload-animation {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: #6B62DD;
            width: 0%;
            transition: width 0.4s ease;
        }

        .btn-sm-right {
            float: right;
            padding: 0.4rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .variant-table-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .variant-table-container thead {
            background: #f8fafc;
        }

        .variant-table-container th {
            font-weight: 600;
            color: #475569;
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .variant-table-container td {
            padding: 0.5rem 0.75rem;
            vertical-align: middle;
        }

        .variant-row .form-control,
        .variant-row .form-select {
            border-color: #e2e8f0;
            background: #fff;
        }

        /* Premium Action Buttons */
        .variant-action-group {
            display: inline-flex;
            background: #f1f5f9;
            border-radius: 6px;
            padding: 3px;
            border: 1px solid #e2e8f0;
        }

        .btn-variant {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-variant-danger {
            background: transparent;
            color: #ef4444;
        }

        .btn-variant-danger:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-variant-primary {
            background: #fff;
            color: #3b82f6;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn-variant-primary:hover {
            background: #eff6ff;
            color: #2563eb;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid pb-5">
        <form action="{{ route('product.update', $product->product_id) }}" method="POST" enctype="multipart/form-data"
            id="product-form">
            @csrf
            @method('PUT')

            <!-- Page Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    
                </div>
                <div class="btn-list">
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-sm border fw-bold">
                        <i class="ti ti-arrow-left me-1"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold shadow-sm px-4">
                        <i class="ti ti-check me-1"></i> Update Product
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <!-- Section 1: General Information -->
                    <div class="card form-section-card">
                        <div class="card-header border-bottom-0 pt-4 px-4">
                            <h5 class="section-title mb-0"><i class="ti ti-info-circle"></i> General Information</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-4">
                                @if (!auth()->user()->hasRole('vendor'))
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-13">Vendor Account</label>
                                        <select name="vendor_id"
                                            class="form-select form-select-sm @error('vendor_id') is-invalid @enderror"
                                            required>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->vendor_id }}"
                                                    {{ old('vendor_id', $product->vendor_id) == $vendor->vendor_id ? 'selected' : '' }}>
                                                    {{ $vendor->business_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vendor_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-md-{{ auth()->user()->hasRole('vendor') ? '12' : '6' }}">
                                    <label class="form-label fw-semibold fs-13">Sub Category</label>
                                    <select name="category_id"
                                        class="form-select form-select-sm @error('category_id') is-invalid @enderror"
                                        required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Product Code</label>
                                    <input type="text" name="product_code"
                                        value="{{ old('product_code', $product->product_code) }}"
                                        class="form-control form-control-sm @error('product_code') is-invalid @enderror"
                                        required>
                                    @error('product_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Product Name</label>
                                    <input type="text" name="product_name"
                                        value="{{ old('product_name', $product->product_name) }}"
                                        class="form-control form-control-sm @error('product_name') is-invalid @enderror"
                                        required>
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- SEO Section -->
                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">URL Slug</label>
                                    <input type="text" name="slug"
                                        value="{{ old('slug', $product->slug) }}"
                                        class="form-control form-control-sm @error('slug') is-invalid @enderror">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Meta Title</label>
                                    <input type="text" name="meta_title"
                                        value="{{ old('meta_title', $product->meta_title) }}"
                                        class="form-control form-control-sm @error('meta_title') is-invalid @enderror">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Meta Description</label>
                                    <textarea name="meta_description" class="form-control form-control-sm @error('meta_description') is-invalid @enderror"
                                        rows="2">{{ old('meta_description', $product->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Meta Keywords</label>
                                    <input type="text" name="meta_keywords"
                                        value="{{ old('meta_keywords', $product->meta_keywords) }}"
                                        class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Specifications -->
                    <div class="card form-section-card">
                        <div class="card-header border-bottom-0 pt-4 px-4">
                            <h5 class="section-title mb-0"><i class="ti ti-settings"></i> Product Specifications</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Description</label>
                                    <textarea name="description" class="form-control form-control-sm @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Fabric Composition</label>
                                    <input type="text" name="fabric_composition"
                                        value="{{ old('fabric_composition', $product->fabric_composition) }}"
                                        class="form-control form-control-sm @error('fabric_composition') is-invalid @enderror">
                                    @error('fabric_composition')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Gender Type</label>
                                    <select name="gender_type"
                                        class="form-select form-select-sm @error('gender_type') is-invalid @enderror"
                                        required>
                                        <option value="unisex"
                                            {{ old('gender_type', $product->gender_type) == 'unisex' ? 'selected' : '' }}>
                                            Unisex</option>
                                        <option value="boys"
                                            {{ old('gender_type', $product->gender_type) == 'boys' ? 'selected' : '' }}>
                                            Boys</option>
                                        <option value="girls"
                                            {{ old('gender_type', $product->gender_type) == 'girls' ? 'selected' : '' }}>
                                            Girls</option>
                                    </select>
                                    @error('gender_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <!-- Section 4: Publishing Details -->
                    <div class="card form-section-card">
                        <div class="card-header border-bottom-0 pt-4 px-4">
                            <h5 class="section-title mb-0"><i class="ti ti-send"></i> Publishing</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-4">
                                @if (!auth()->user()->hasRole('vendor'))
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold fs-13">Approval Status</label>
                                        <select name="approval_status"
                                            class="form-select form-select-sm @error('approval_status') is-invalid @enderror"
                                            required>
                                            <option value="pending"
                                                {{ old('approval_status', $product->approval_status) == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved"
                                                {{ old('approval_status', $product->approval_status) == 'approved' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option value="rejected"
                                                {{ old('approval_status', $product->approval_status) == 'rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                        @error('approval_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Visibility Status</label>
                                    <select name="is_active" class="form-select form-select-sm" required>
                                        <option value="1"
                                            {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Media Gallery -->
                    <div class="card form-section-card">
                        <div class="card-header border-bottom-0 pt-4 px-4">
                            <h5 class="section-title mb-0"><i class="ti ti-photo"></i> Media Gallery</h5>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <p class="text-muted fs-12 mb-3">Manage your product images. You can add more images below.</p>
                            <div class="media-upload-wrapper" id="media-preview-container"
                                style="grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));">
                                @foreach ($product->images as $image)
                                    <div class="preview-item">
                                        <img src="{{ $image->url }}">
                                        @if ($image->is_primary)
                                            <span
                                                class="badge bg-primary position-absolute bottom-0 start-0 m-2 fs-10">PRIMARY</span>
                                        @endif
                                    </div>
                                @endforeach
                                <label class="image-upload-box" id="upload-trigger">
                                    <i class="ti ti-cloud-upload"></i>
                                    <span>Add Images</span>
                                    <input type="file" name="images[]" id="images-input" multiple class="d-none"
                                        accept="image/*">
                                    <div class="upload-animation" id="global-upload-bar"></div>
                                </label>
                            </div>
                            @error('images')
                                <div class="text-danger fs-12 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 5: Variants (Full Width) -->
                <div class="col-12">
                    <div class="card form-section-card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between border-bottom-0 pt-4 px-4">
                            <h5 class="section-title mb-0"><i class="ti ti-layers-intersect"></i> Product Variants</h5>
                            <button type="button" class="btn btn-primary btn-sm-right shadow-sm" id="add-variant">
                                <i class="ti ti-plus me-1"></i> Add Variant
                            </button>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="table-responsive variant-table-container">
                                <table class="table text-nowrap mb-0" id="variants-table">
                                    <thead>
                                        <tr>
                                            <th>SKU <span class="text-danger">*</span></th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>MRP <span class="text-danger">*</span></th>
                                            <th>Selling Price <span class="text-danger">*</span></th>
                                            <th>Stock <span class="text-danger">*</span></th>
                                            <th>Alert</th>
                                            <th>Barcode</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $variants = old('variants', $product->variants); @endphp
                                        @foreach ($variants as $index => $variant)
                                            <tr class="variant-row">
                                                <input type="hidden" name="variants[{{ $index }}][variant_id]"
                                                    value="{{ is_array($variant) ? $variant['variant_id'] ?? '' : $variant->variant_id }}">
                                                <td><input type="text" name="variants[{{ $index }}][sku]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['sku'] : $variant->sku }}"
                                                        required></td>
                                                <td>
                                                    <select name="variants[{{ $index }}][size_id]"
                                                        class="form-select form-select-sm">
                                                        <option value="">N/A</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->size_id }}"
                                                                {{ (is_array($variant) ? $variant['size_id'] : $variant->size_id) == $size->size_id ? 'selected' : '' }}>
                                                                {{ $size->size_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="variants[{{ $index }}][color_id]"
                                                        class="form-select form-select-sm">
                                                        <option value="">N/A</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->color_id }}"
                                                                {{ (is_array($variant) ? $variant['color_id'] : $variant->color_id) == $color->color_id ? 'selected' : '' }}>
                                                                {{ $color->color_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" step="0.01"
                                                        name="variants[{{ $index }}][mrp]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['mrp'] : $variant->mrp }}"
                                                        required></td>
                                                <td><input type="number" step="0.01"
                                                        name="variants[{{ $index }}][selling_price]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['selling_price'] : $variant->selling_price }}"
                                                        required></td>
                                                <td><input type="number" name="variants[{{ $index }}][stock_qty]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['stock_qty'] : $variant->stock_qty }}"
                                                        required></td>
                                                <td><input type="number"
                                                        name="variants[{{ $index }}][low_stock_alert]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['low_stock_alert'] ?? 5 : $variant->low_stock_alert }}">
                                                </td>
                                                <td><input type="text" name="variants[{{ $index }}][barcode]"
                                                        class="form-control form-control-sm"
                                                        value="{{ is_array($variant) ? $variant['barcode'] ?? '' : $variant->barcode }}">
                                                </td>
                                                <input type="hidden" name="variants[{{ $index }}][is_active]"
                                                    value="1">
                                                <td class="text-center">
                                                    <div class="variant-action-group">
                                                        <button type="button"
                                                            class="btn-variant btn-variant-danger remove-variant"
                                                            title="Remove Row"><i class="ti-trash"></i></button>
                                                        <button type="button"
                                                            class="btn-variant btn-variant-primary add-variant-btn"
                                                            title="Add Row Below"><i class="ti-plus"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    window.productConfig = {
        variantIndex: {{ count($variants) }};
    };
</script>

@push('scripts')
    <script src="{{ asset('assets/js/custom/product-form.js') }}"></script>
@endpush
