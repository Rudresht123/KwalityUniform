@extends('layouts.common')

@section('content')
    <div class="container-fluid">

        <form action="{{ route('school.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-semibold">
                            <i class="ti ti-school me-2"></i>
                            Create School
                        </h4>

                    </div>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="fw-semibold mb-2">
                                Please correct the following errors:
                            </div>

                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    <fieldset class="form-section">

                        <legend>School Information</legend>
                        <div class="row">
                            {{-- School Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="school_name" class="form-label">
                                    School Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="school_name" name="school_name" value="{{ old('school_name') }}"
                                    placeholder="Enter school name" autocomplete="organization"
                                    class="form-control @error('school_name') is-invalid @enderror">

                                @error('school_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Principal Name --}}
                            <div class="col-md-6 mb-3">
                                <label for="principal_name" class="form-label">
                                    Principal Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="principal_name" name="principal_name"
                                    value="{{ old('principal_name') }}" placeholder="Enter principal name"
                                    autocomplete="name" class="form-control @error('principal_name') is-invalid @enderror">

                                @error('principal_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Affiliation Number --}}
                            <div class="col-md-6 mb-3">
                                <label for="affiliation_no" class="form-label">
                                    Affiliation Number
                                </label>

                                <input type="text" id="affiliation_no" name="affiliation_no"
                                    value="{{ old('affiliation_no') }}" placeholder="Enter affiliation number"
                                    class="form-control @error('affiliation_no') is-invalid @enderror">

                                @error('affiliation_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Logo --}}
                            <div class="col-md-6 mb-3">
                                <label for="logo" class="form-label">
                                    School Logo
                                </label>

                                <input type="file" id="logo" name="logo" accept=".jpg,.jpeg,.png,.webp"
                                    class="form-control @error('logo') is-invalid @enderror">

                                <small class="text-muted">
                                    Accepted formats: JPG, JPEG, PNG, WEBP (Max 2 MB)
                                </small>

                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>


                    <fieldset class="form-section">
                        <legend>Contact Information</legend>
                        <div class="row">
                            {{-- Email --}}
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    Email Address <span class="text-danger">*</span>
                                </label>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="school@example.com" autocomplete="email"
                                    class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    Phone Number <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="phone" name="phone" maxlength="15"
                                    value="{{ old('phone') }}" placeholder="9876543210" autocomplete="tel"
                                    class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">
                                    Address <span class="text-danger">*</span>
                                </label>

                                <textarea id="address" name="address" rows="3" placeholder="Enter complete school address"
                                    class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- City --}}
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">
                                    City <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="city" name="city" value="{{ old('city') }}"
                                    placeholder="e.g. Gurgaon" class="form-control @error('city') is-invalid @enderror">

                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- State --}}
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">
                                    State <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="state" name="state" value="{{ old('state') }}"
                                    placeholder="e.g. Haryana" class="form-control @error('state') is-invalid @enderror">

                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pincode --}}
                            <div class="col-md-4 mb-3">
                                <label for="pincode" class="form-label">
                                    Pincode <span class="text-danger">*</span>
                                </label>

                                <input type="text" id="pincode" name="pincode" maxlength="10"
                                    value="{{ old('pincode') }}" placeholder="122001"
                                    class="form-control @error('pincode') is-invalid @enderror">

                                @error('pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                    </fieldset>



                </div>

                <div class="card-footer bg-white">

                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('school.index') }}" class="btn btn-light">
                            <i class="ti ti-x me-1"></i>
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i>
                            Save School
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('input', '#phone', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 15);
        });

        $(document).on('input', '#pincode', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    </script>
@endpush
