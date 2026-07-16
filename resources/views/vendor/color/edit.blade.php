@extends('layouts.common')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Edit Color</div>
                <a href="{{ route('color.index') }}" class="btn btn-light btn-sm border">
                    <i class="ti ti-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('color.update', $color->color_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Color Name</label>
                            <input type="text" name="color_name" value="{{ old('color_name', $color->color_name) }}" 
                                   class="form-control @error('color_name') is-invalid @enderror" 
                                   placeholder="e.g. Royal Blue, Crimson Red" required>
                            @error('color_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Hex Code</label>
                            <input type="text" name="hex_code" value="{{ old('hex_code', $color->hex_code) }}" 
                                   class="form-control @error('hex_code') is-invalid @enderror" 
                                   placeholder="e.g. #FFFFFF">
                            @error('hex_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ old('is_active', $color->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $color->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm">
                                <i class="ti ti-check me-1"></i> Update Color
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
