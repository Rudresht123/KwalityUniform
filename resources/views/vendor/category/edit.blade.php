@extends('layouts.common')

@section('content')
<style>
    .category-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .btn-save-category:hover {
        transform: none !important;
        box-shadow: none !important;
    }
</style>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card category-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Edit Sub Category: {{ $category->category_name }}</div>
                <a href="{{ route('category.index') }}" class="btn btn-light btn-sm border">
                    <i class="ti ti-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('category.update', $category->category_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Sub Category Name</label>
                            <input type="text" name="category_name" value="{{ old('category_name', $category->category_name) }}" 
                                   class="form-control @error('category_name') is-invalid @enderror" 
                                   placeholder="e.g. Shirt, Trouser, Notebook" required>
                            @error('category_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Parent Category</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required>
                                @foreach(category(["vendor_id"=>auth()->user()->vendor->vendor_id ?? ""]) as $parent)
                                    <option value="{{ $parent->parent_id }}" {{ old('parent_id', $category->parent_id) == $parent->parent_id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', $category->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $category->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch mt-2">
                                <input type="hidden" name="requires_size" value="0">
                                <input class="form-check-input" type="checkbox" name="requires_size" value="1" id="sizeSwitch" 
                                       {{ old('requires_size', $category->requires_size ? '1' : '0') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="sizeSwitch">
                                    Requires Size Selection in UI
                                </label>
                                <p class="text-muted small mb-0">Enable this for items like Shirts/Shoes, disable for Pens/Bags.</p>
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm btn-save-category">
                                <i class="ti ti-check me-1"></i> Update Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
