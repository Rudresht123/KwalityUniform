@extends('layouts.common')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="card border-0 shadow-sm">

                    <div class="card-header">

                        <h4 class="mb-0">
                            <i class="ti ti-building-store me-2"></i>
                            Edit Vendor
                        </h4>

                    </div>

                    <div class="card-body">

                        <form action="{{ route('vendor.update', $vendor) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="mb-3">
                                    <div class="alert alert-danger border-2 d-flex align-items-start gap-3" role="alert">
                                        <i class="ti ti-alert-circle text-danger fs-5" style="min-width: 24px; margin-top: 2px;"></i>
                                        <div class="flex-grow-1">
                                            <strong class="d-block mb-2">Validation Errors!</strong>
                                            <ul class="mb-0 ms-3">
                                                @foreach ($errors->all() as $error)
                                                    <li class="mb-1">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Business Information -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-building-store me-2"></i>
                                    Business Information
                                </legend>

                                <div class="row">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Business Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror"
                                            placeholder="Enter business / shop name" value="{{ old('business_name', $vendor->business_name) }}" required>

                                        @error('business_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Email Address
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter vendor email" value="{{ old('email', $vendor->email) }}" required>

                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Owner & Contact -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-user me-2"></i>
                                    Owner & Contact Information
                                </legend>

                                <div class="row">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Owner Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror"
                                            placeholder="Enter owner full name" value="{{ old('owner_name', $vendor->owner_name) }}" required>

                                        @error('owner_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Phone Number
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter phone number" value="{{ old('phone', $vendor->phone) }}" required>

                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Address -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-map-pin me-2"></i>
                                    Address Information
                                </legend>

                                <div class="row">
                                    <div class="col-md-12 fonts">
                                        <label class="form-label">
                                            Address
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea rows="3" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter complete address" required>{{ old('address', $vendor->address) }}</textarea>

                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            City
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="City"
                                            value="{{ old('city', $vendor->city) }}" required>

                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            State
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="State"
                                            value="{{ old('state', $vendor->state) }}" required>

                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            Pincode
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" placeholder="Pincode"
                                            value="{{ old('pincode', $vendor->pincode) }}" required>

                                        @error('pincode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Tax & Bank -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-file-text me-2"></i>
                                    Tax, Bank & Commission
                                </legend>

                                <div class="row">
                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            GSTIN
                                        </label>

                                        <input type="text" name="gstin" class="form-control @error('gstin') is-invalid @enderror"
                                            placeholder="Enter 15-char GSTIN" value="{{ old('gstin', $vendor->gstin) }}">

                                        @error('gstin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            PAN Number
                                        </label>

                                        <input type="text" name="pan_number" class="form-control @error('pan_number') is-invalid @enderror"
                                            placeholder="Enter PAN number" value="{{ old('pan_number', $vendor->pan_number) }}">

                                        @error('pan_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            Commission Rate (%)
                                        </label>

                                        <input type="number" name="commission_rate" class="form-control @error('commission_rate') is-invalid @enderror"
                                            placeholder="0.00" step="0.01" min="0" max="100" value="{{ old('commission_rate', $vendor->commission_rate) }}">

                                        @error('commission_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Banking Details -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-building-bank me-2"></i>
                                    Banking Details
                                </legend>

                                <div class="row">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Bank Account Number
                                        </label>

                                        <input type="text" name="bank_account_no" class="form-control @error('bank_account_no') is-invalid @enderror"
                                            placeholder="Enter bank account number" value="{{ old('bank_account_no', $vendor->bank_account_no) }}">

                                        @error('bank_account_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            IFSC Code
                                        </label>

                                        <input type="text" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror"
                                            placeholder="Enter IFSC code" value="{{ old('ifsc_code', $vendor->ifsc_code) }}">

                                        @error('ifsc_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Status -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-badge me-2"></i>
                                    Status
                                </legend>

                                <div class="row">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Vendor Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="status" class="form-select form-control @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="pending" {{ old('status', $vendor->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ old('status', $vendor->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="suspended" {{ old('status', $vendor->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                     <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Vendor Acount Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="is_active" class="form-select form-control @error('is_active') is-invalid @enderror" required>
                                            <option value="">Select Acount Status</option>
                                            <option value="1" {{ old('is_active', $vendor->is_active) === "1" ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('is_active', $vendor->is_active) === "0" ? 'selected' : '' }}>In Active</option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Logo -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-photo me-2"></i>
                                    Logo
                                </legend>

                                <div class="row">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Upload Logo
                                        </label>

                                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">

                                        <small class="text-muted d-block mt-1">Supported formats: JPG, PNG, GIF (Max: 2MB)</small>

                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                           @if ($vendor->getRawOriginal('logo_url'))
                                            <div class="mt-3">
                                                <p class="mb-2 fs-14"><strong>Current Logo:</strong></p>
                                                <img src="{{ getFileUrl($vendor->logo_url) }}" alt="Vendor Logo" class="img-thumbnail shadow-sm" style="max-width: 150px; height: auto;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Form Actions -->
                            <div class="form-section d-flex gap-2 justify-content-end">
                                <a href="{{ route('vendor.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="ti ti-x me-1"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="ti ti-device-floppy me-1"></i>
                                    Update Vendor
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
