@extends('layouts.common')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Create New Size</div>
                <a href="{{ route('size.index') }}" class="btn btn-light btn-sm border">
                    <i class="ti ti-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('size.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Size Name (Internal)</label>
                            <input type="text" name="size_name" value="{{ old('size_name') }}" 
                                   class="form-control @error('size_name') is-invalid @enderror" 
                                   placeholder="e.g. XL, 32, LARGE" required autofocus>
                            @error('size_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Display Name (User Visible)</label>
                            <input type="text" name="display_name" value="{{ old('display_name') }}" 
                                   class="form-control @error('display_name') is-invalid @enderror" 
                                   placeholder="e.g. Extra Large, 32 Inch" required>
                            @error('display_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', '0') }}" 
                                   class="form-control @error('sort_order') is-invalid @enderror" required>
                            @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm">
                                <i class="ti ti-check me-1"></i> Save Size
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
