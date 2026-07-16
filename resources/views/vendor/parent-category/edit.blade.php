@extends('layouts.common')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card custom-card category-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Edit Parent Category: {{ $parentCategory->name }}</div>
                <a href="{{ route('parent-category.index') }}" class="btn btn-light btn-sm border">
                    <i class="ti ti-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('parent-category.update', $parentCategory->parent_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Parent Category Name</label>
                            <input type="text" name="name" value="{{ old('name', $parentCategory->name) }}" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="e.g. Uniform, Stationery" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', $parentCategory->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $parentCategory->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm btn-save-category">
                                <i class="ti ti-check me-1"></i> Update Parent Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
