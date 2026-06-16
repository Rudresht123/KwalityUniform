@extends('layouts.common')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Edit Product</div>
                <a href="{{ route('product.index') }}" class="btn btn-light btn-sm border">
                    <i class="ti ti-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('product.update', $product->product_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Vendor</label>
                            <select name="vendor_id" class="form-select @error('vendor_id') is-invalid @enderror" required>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->vendor_id }}" {{ old('vendor_id', $product->vendor_id) == $vendor->vendor_id ? 'selected' : '' }}>
                                        {{ $vendor->business_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sub Category</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Code</label>
                            <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}" 
                                   class="form-control @error('product_code') is-invalid @enderror" required>
                            @error('product_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" 
                                   class="form-control @error('product_name') is-invalid @enderror" required>
                            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="3">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Fabric Composition</label>
                            <input type="text" name="fabric_composition" value="{{ old('fabric_composition', $product->fabric_composition) }}" 
                                   class="form-control @error('fabric_composition') is-invalid @enderror">
                            @error('fabric_composition') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gender Type</label>
                            <select name="gender_type" class="form-select @error('gender_type') is-invalid @enderror" required>
                                <option value="unisex" {{ old('gender_type', $product->gender_type) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                <option value="boys" {{ old('gender_type', $product->gender_type) == 'boys' ? 'selected' : '' }}>Boys</option>
                                <option value="girls" {{ old('gender_type', $product->gender_type) == 'girls' ? 'selected' : '' }}>Girls</option>
                            </select>
                            @error('gender_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Approval Status</label>
                            <select name="approval_status" class="form-select @error('approval_status') is-invalid @enderror" required>
                                <option value="pending" {{ old('approval_status', $product->approval_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('approval_status', $product->approval_status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('approval_status', $product->approval_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('approval_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm">
                                <i class="ti ti-check me-1"></i> Update Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
