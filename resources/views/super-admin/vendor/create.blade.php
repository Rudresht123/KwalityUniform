@extends('layouts.common')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="card border-0 shadow-sm">

                    <div class="card-header ">

                        <h4 class="mb-0">
                            <i class="ti ti-building-store me-2"></i>
                            Create Vendor
                        </h4>

                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="mb-3">
                                <x-alert type="success" :message="session('success')" />
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-3">
                                <x-alert type="error" :message="session('error')" />
                            </div>
                        @endif

                        <form action="{{ route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="mb-3">
                                    <div class="alert alert-danger border-2 d-flex align-items-start gap-3" role="alert">
                                        <i class="ti ti-alert-circle text-danger fs-5"
                                            style="min-width: 24px; margin-top: 2px;"></i>
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

                                        <input type="text" name="business_name"
                                            class="form-control @error('business_name') is-invalid @enderror"
                                            placeholder="Enter business / shop name" value="{{ old('business_name') }}"
                                            required>

                                        @error('business_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Email Address
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter vendor email" value="{{ old('email') }}" required>

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

                                        <input type="text" name="owner_name"
                                            class="form-control @error('owner_name') is-invalid @enderror"
                                            placeholder="Enter owner full name" value="{{ old('owner_name') }}" required>

                                        @error('owner_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Phone Number
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter phone number" value="{{ old('phone') }}" required>

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
                                    <div class="col-md-12 fonts mb-3">
                                        <label class="form-label">
                                            Address
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea rows="3" name="address" class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter complete address" required>{{ old('address') }}</textarea>

                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            City
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="city"
                                            class="form-control @error('city') is-invalid @enderror" placeholder="City"
                                            value="{{ old('city') }}" required>

                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            State
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="state"
                                            class="form-control @error('state') is-invalid @enderror" placeholder="State"
                                            value="{{ old('state') }}" required>

                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            Pincode
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="pincode"
                                            class="form-control @error('pincode') is-invalid @enderror"
                                            placeholder="Pincode" value="{{ old('pincode') }}" required>

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

                                        <input type="text" name="gstin"
                                            class="form-control @error('gstin') is-invalid @enderror"
                                            placeholder="Enter 15-char GSTIN" value="{{ old('gstin') }}">

                                        @error('gstin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            PAN Number
                                        </label>

                                        <input type="text" name="pan_number"
                                            class="form-control @error('pan_number') is-invalid @enderror"
                                            placeholder="Enter 10-char PAN" value="{{ old('pan_number') }}">

                                        @error('pan_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 fonts">
                                        <label class="form-label">
                                            Commission Rate (%)
                                        </label>

                                        <input type="text" name="commission_rate"
                                            class="form-control @error('commission_rate') is-invalid @enderror"
                                            placeholder="0.00" value="{{ old('commission_rate') }}">

                                        @error('commission_rate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            Bank Account Number
                                        </label>

                                        <input type="text" name="bank_account_no"
                                            class="form-control @error('bank_account_no') is-invalid @enderror"
                                            placeholder="Enter bank account number" value="{{ old('bank_account_no') }}">

                                        @error('bank_account_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 fonts">
                                        <label class="form-label">
                                            IFSC Code
                                        </label>

                                        <input type="text" name="ifsc_code"
                                            class="form-control @error('ifsc_code') is-invalid @enderror"
                                            placeholder="Enter IFSC code" value="{{ old('ifsc_code') }}">

                                        @error('ifsc_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Branding -->
                            <fieldset class="form-section">
                                <legend>
                                    <i class="ti ti-photo me-2"></i>
                                    Branding / Account Status
                                </legend>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="fonts">
                                            <label class="form-label">
                                                Vendor Logo
                                            </label>

                                            <input type="file" name="logo"
                                                class="form-control @error('logo') is-invalid @enderror">

                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            required>
                                            <option value="pending"
                                                {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option value="suspended"
                                                {{ old('status') === 'suspended' ? 'selected' : '' }}>
                                                Suspended
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Account Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            required>
                                            <option value="pending" {{ old('status', '1') === '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                                In Active
                                            </option>
                                        </select>

                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <div class="text-end">
                                <a href="{{ route('vendor.index') }}" class="btn btn-light">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Save Vendor
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>



        </div>

    </div>
@endsection
