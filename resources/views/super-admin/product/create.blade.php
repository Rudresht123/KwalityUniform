@extends('layouts.common')


@section('content')
    <div class="container-fluid pb-5">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
            @csrf

            <!-- Page Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addParentCategoryModal">+ Parent Category</button>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal">+ Sub Category</button>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addSizeModal">+ Size</button>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#addColorModal">+ Color</button>
                </div>
                <div class="btn-list">
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-sm border fw-bold">
                        <i class="ti ti-arrow-left me-1"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold shadow-sm px-4">
                        <i class="ti ti-check me-1"></i> Save Product
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
                                            <option value="" disabled selected>Select Vendor</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->vendor_id }}"
                                                    {{ old('vendor_id') == $vendor->vendor_id ? 'selected' : '' }}>
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
                                    <label class="form-label fw-semibold fs-13">Parent Category</label>
                                    <div class="d-flex gap-2">
                                        <div class="flex-grow-1">
                                            <select name="parent_id" id="parent_id" class="form-select form-select-sm">
                                                <option value="">Select Parent</option>
                                                @foreach ($parentCategories as $parent)
                                                    <option value="{{ $parent->parent_id }}">{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#addParentCategoryModal">+</button>
                                    </div>
                                </div>
                                <div class="col-md-{{ auth()->user()->hasRole('vendor') ? '12' : '6' }}">
                                    <label class="form-label fw-semibold fs-13">Sub Category</label>
                                    <div class="d-flex gap-2">
                                        <div class="flex-grow-1">
                                            <select name="category_id" id="category_id" class="form-select form-select-sm">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#addCategoryModal">+</button>
                                    </div>
                                    @error('category_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Product Code</label>
                                    <input type="text" name="product_code" value="{{ old('product_code') }}"
                                        class="form-control form-control-sm @error('product_code') is-invalid @enderror"
                                        placeholder="e.g. UN-SHT-001" required>
                                    @error('product_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Product Name</label>
                                    <input type="text" name="product_name" value="{{ old('product_name') }}"
                                        class="form-control form-control-sm @error('product_name') is-invalid @enderror"
                                        placeholder="e.g. White Formal Shirt" required>
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- SEO Section -->
                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">URL Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug') }}"
                                        class="form-control form-control-sm @error('slug') is-invalid @enderror"
                                        placeholder="e.g. white-formal-shirt">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                        class="form-control form-control-sm @error('meta_title') is-invalid @enderror"
                                        placeholder="SEO Title">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Meta Description</label>
                                    <textarea name="meta_description" class="form-control form-control-sm @error('meta_description') is-invalid @enderror"
                                        rows="2" placeholder="Brief SEO description...">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                        class="form-control form-control-sm @error('meta_keywords') is-invalid @enderror"
                                        placeholder="keyword1, keyword2, ...">
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
                                        rows="4" placeholder="Detailed product description...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Fabric Composition</label>
                                    <input type="text" name="fabric_composition"
                                        value="{{ old('fabric_composition') }}"
                                        class="form-control form-control-sm @error('fabric_composition') is-invalid @enderror"
                                        placeholder="e.g. 60% Cotton, 40% Polyester">
                                    @error('fabric_composition')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13">Gender Type</label>
                                    <select name="gender_type"
                                        class="form-select form-select-sm @error('gender_type') is-invalid @enderror"
                                        required>
                                        <option value="unisex" {{ old('gender_type') == 'unisex' ? 'selected' : '' }}>
                                            Unisex</option>
                                        <option value="boys" {{ old('gender_type') == 'boys' ? 'selected' : '' }}>Boys
                                        </option>
                                        <option value="girls" {{ old('gender_type') == 'girls' ? 'selected' : '' }}>Girls
                                        </option>
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
                                                {{ old('approval_status', 'pending') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved"
                                                {{ old('approval_status') == 'approved' ? 'selected' : '' }}>Approved
                                            </option>
                                            <option value="rejected"
                                                {{ old('approval_status') == 'rejected' ? 'selected' : '' }}>Rejected
                                            </option>
                                        </select>
                                        @error('approval_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13">Visibility Status</label>
                                    <select name="is_active" class="form-select form-select-sm" required>
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive
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
                            <p class="text-muted fs-12 mb-3">Upload multiple high-quality images. The first image will be
                                set as primary.</p>
                            <div class="media-upload-wrapper" id="media-preview-container"
                                style="grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));">
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
                            @error('images.*')
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
                                            <th>Vendor Price <span class="text-danger">*</span></th>
                                            <th>Selling Price <span class="text-danger">*</span></th>
                                            <th>Stock <span class="text-danger">*</span></th>
                                            <th>Alert</th>
                                            <th>Barcode</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (old('variants'))
                                            @foreach (old('variants') as $index => $variant)
                                                <tr class="variant-row">
                                                    <td><input type="text" name="variants[{{ $index }}][sku]"
                                                            class="form-control form-control-sm"
                                                            value="{{ $variant['sku'] }}" required></td>
                                                    <td>
                                                        <select name="variants[{{ $index }}][size_id]"
                                                            class="form-select form-select-sm size-select">
                                                            <option value="">N/A</option>
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size->size_id }}"
                                                                    {{ $variant['size_id'] == $size->size_id ? 'selected' : '' }}>
                                                                    {{ $size->size_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="variants[{{ $index }}][color_id]"
                                                            class="form-select form-select-sm color-select">
                                                            <option value="">N/A</option>
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color->color_id }}"
                                                                    {{ $variant['color_id'] == $color->color_id ? 'selected' : '' }}>
                                                                    {{ $color->color_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="number" step="0.01"
                                                            name="variants[{{ $index }}][mrp]"
                                                            class="form-control form-control-sm mrp"
                                                            value="{{ $variant['mrp'] }}" required></td>
                                                    <td><input type="number" step="0.01"
                                                            name="variants[{{ $index }}][vendor_price]"
                                                            class="form-control form-control-sm vendor_price"
                                                            value="{{ $variant['vendor_price'] }}" required></td>
                                                    <td><input type="number" step="0.01"
                                                            name="variants[{{ $index }}][selling_price]"
                                                            class="form-control form-control-sm selling_price"
                                                            value="{{ $variant['selling_price'] }}" required></td>
                                                    <td><input type="number"
                                                            name="variants[{{ $index }}][stock_qty]"
                                                            class="form-control form-control-sm"
                                                            value="{{ $variant['stock_qty'] }}" required></td>
                                                    <td><input type="number"
                                                            name="variants[{{ $index }}][low_stock_alert]"
                                                            class="form-control form-control-sm"
                                                            value="{{ $variant['low_stock_alert'] ?? 5 }}"></td>
                                                    <td><input type="text"
                                                            name="variants[{{ $index }}][barcode]"
                                                            class="form-control form-control-sm"
                                                            value="{{ $variant['barcode'] }}"></td>
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
                                        @else
                                            <tr class="variant-row">
                                                <td><input type="text" name="variants[0][sku]"
                                                        class="form-control form-control-sm" placeholder="SKU" required>
                                                </td>
                                                <td>
                                                    <select name="variants[0][size_id]" class="form-control select2 size-select">
                                                        <option value="">N/A</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->size_id }}">{{ $size->size_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="variants[0][color_id]" class="form-control select2 color-select">
                                                        <option value="">N/A</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->color_id }}">
                                                                {{ $color->color_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" step="0.01" name="variants[0][mrp]"
                                                        class="form-control form-control-sm mrp" placeholder="0.00"
                                                        required></td>
                                                <td><input type="number" step="0.01" name="variants[0][vendor_price]"
                                                        class="form-control form-control-sm vendor_price"
                                                        placeholder="0.00" required></td>
                                                <td><input type="number" step="0.01"
                                                        name="variants[0][selling_price]"
                                                        class="form-control form-control-sm selling_price"
                                                        placeholder="0.00" required></td>
                                                <td><input type="number" name="variants[0][stock_qty]"
                                                        class="form-control form-control-sm" placeholder="0" required>
                                                </td>
                                                <td><input type="number" name="variants[0][low_stock_alert]"
                                                        class="form-control form-control-sm" value="5"></td>
                                                <td><input type="text" name="variants[0][barcode]"
                                                        class="form-control form-control-sm" placeholder="Barcode"></td>
                                                <input type="hidden" name="variants[0][is_active]" value="1">
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
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Parent Category Modal -->
    <div class="modal fade" id="addParentCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="ajaxParentCategoryForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Parent Category</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Parent Category Name"
                        required>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
            </form>
        </div>
    </div>

    @include('super-admin.product.product-form')

    <!-- Attribute Modals -->
    <!-- Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="ajaxCategoryForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Category</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <select name="parent_id" class="form-select mb-2" required>
                        <option value="">Select Parent</option>
                        @foreach ($parentCategories as $parent)
                            <option value="{{ $parent->parent_id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="category_name" class="form-control" placeholder="Sub Category Name"
                        required>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
            </form>
        </div>
    </div>
    <!-- ... Size and Color Modals ... -->


    <!-- Size Modal -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="ajaxSizeForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Size</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="size_name" class="form-control" placeholder="Size Name" required>
                    <input type="number" name="sort_order" class="form-control mt-2" placeholder="Sort Order">
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
            </form>
        </div>
    </div>

    <!-- Color Modal -->
    <div class="modal fade" id="addColorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="ajaxColorForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add Color</h5><button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="color_name" class="form-control" placeholder="Color Name" required>
                    <input type="color" name="hex_code" class="form-control mt-2" placeholder="Hex Code">
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Parent -> Sub Category
            $('#parent_id').on('change', function() {

                let parentId = $(this).val();

                $('#category_id').html('<option value="">Loading...</option>');

                if (!parentId) {
                    $('#category_id').html('<option value="">Select Sub Category</option>');
                    return;
                }

                $.ajax({
                    url: '/shop/subcategories/' + parentId,
                    type: 'GET',
                    dataType: 'json',

                    success: function(response) {
                        let options = '<option value="">Select Sub Category</option>';
                        $.each(response.subCategories, function(index, item) {

                            options += `
                    <option value="${item.category_id}">
                        ${item.category_name }
                    </option>
                `;
                        });

                        $('#category_id').html(options);
                    },

                    error: function(xhr) {

                        $('#category_id').html(
                            '<option value="">No Sub Categories Found</option>');

                        console.error(xhr.responseText);

                        if (typeof toast !== 'undefined') {
                            toast.error('Failed to load sub categories.');
                        }
                    }
                });

            });

            // Helper for AJAX Forms
          function handleAjaxForm(formId, routeUrl, targetSelector, modalId, type) {

    $(formId).on('submit', function (e) {

        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('[type="submit"]');

        submitBtn.prop('disabled', true);
        $("#preloader").show();

        $.ajax({

            url: routeUrl,
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',

            success: function (res) {

                if (!res.success) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message ?? 'Something went wrong.'
                    });

                    return;
                }

                switch (type) {

                    case 'parent':

                        $('#parent_id').append(
                            `<option value="${res.parent.parent_id}" selected>
                                ${res.parent.name}
                            </option>`
                        );

                        break;

                    case 'subcat':

                        $('#category_id').append(
                            `<option value="${res.category.category_id}" selected>
                                ${res.category.category_name}
                            </option>`
                        );

                        break;

                    case 'size':

                        $('.size-select').append(
                            `<option value="${res.size.size_id}" selected>
                                ${res.size.size_name}
                            </option>`
                        );

                        break;

                    case 'color':

                        $('.color-select').append(
                            `<option value="${res.color.color_id}" selected>
                                ${res.color.color_name}
                            </option>`
                        );

                        break;
                }

                $(modalId).modal('hide');

                form[0].reset();

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message ?? 'Created successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });

            },

            error: function (xhr) {

                console.error(xhr);

                let message = 'Something went wrong. Please try again.';

                if (xhr.responseJSON) {

                    // Validation Errors
                    if (xhr.status === 422) {

                        if (xhr.responseJSON.errors) {

                            let errors = [];

                            $.each(xhr.responseJSON.errors, function (field, msgs) {
                                errors.push(msgs[0]);
                            });

                            message = errors.join('<br>');

                        } else if (xhr.responseJSON.message) {

                            message = xhr.responseJSON.message;
                        }
                    }

                    // Other Laravel JSON Errors
                    else if (xhr.responseJSON.message) {

                        message = xhr.responseJSON.message;
                    }
                }
                else if (xhr.responseText) {

                    message = xhr.responseText;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: message,
                    confirmButtonText: 'OK'
                });

            },

            complete: function () {

                submitBtn.prop('disabled', false);

                $("#preloader").hide();
            }

        });

    });

}

            // Initialize handlers
            handleAjaxForm('#ajaxParentCategoryForm', "{{ route('ajax.parent-category.store') }}", '#parent_id',
                '#addParentCategoryModal', 'parent');
            handleAjaxForm('#ajaxCategoryForm', "{{ route('ajax.category.store') }}", '#category_id',
                '#addCategoryModal', 'subcat');
            handleAjaxForm('#ajaxSizeForm', "{{ route('ajax.size.store') }}", '.size-select', '#addSizeModal',
                'size');
            handleAjaxForm('#ajaxColorForm', "{{ route('ajax.color.store') }}", '.color-select', '#addColorModal',
                'color');
        });

        window.productConfig = {
            variantIndex: {{ old('variants') ? count(old('variants')) : 1 }}
        };
    </script>
@endsection
