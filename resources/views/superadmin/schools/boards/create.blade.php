@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-semibold">
                                <i class="ti ti-list-details me-2"></i>
                                Create School Board
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('school-boards.store') }}" method="POST">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Board Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="e.g. CBSE, ICSE" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" rows="1" 
                                              placeholder="Optional board details" class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('school-boards.index') }}" class="btn btn-light">
                                    <i class="ti ti-x me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i> Save Board
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
