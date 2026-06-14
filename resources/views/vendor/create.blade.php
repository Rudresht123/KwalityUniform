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

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Business Information -->

                            <fieldset class="form-section">

                                <legend>
                                    <i class="ti ti-building-store me-2"></i>
                                    Business Information / Task & Registration
                                </legend>

                                <div class="row">

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Vendor Code
                                        </label>

                                        <input type="text" name="vendor_code" class="form-control" value="Auto Generated"
                                            readonly>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Business Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="business_name" class="form-control"
                                            placeholder="Enter business / shop name" required>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            GST Number
                                        </label>

                                        <input type="text" name="gst_number" class="form-control"
                                            placeholder="Enter GST Number">

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            PAN Number
                                        </label>

                                        <input type="text" name="pan_number" class="form-control"
                                            placeholder="Enter PAN Number">

                                    </div>

                                </div>

                            </fieldset>

                            <!-- Owner Information -->

                            <fieldset class="form-section">

                                <legend>
                                    <i class="ti ti-user me-2"></i>
                                    Owner Information / Contact Information
                                </legend>

                                <div class="row">

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Owner Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="owner_name" class="form-control"
                                            placeholder="Enter owner full name" required>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Mobile Number
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="owner_mobile" class="form-control"
                                            placeholder="Enter mobile number" required>

                                    </div>
                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Email Address
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter email address" required>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Alternate Phone
                                        </label>

                                        <input type="text" name="alternate_phone" class="form-control"
                                            placeholder="Enter alternate phone">

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

                                        <textarea rows="3" name="address" class="form-control" placeholder="Enter complete address" required></textarea>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            City
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="city" class="form-control" placeholder="City"
                                            required>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            State
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="state" class="form-control" placeholder="State"
                                            required>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Country
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="country" value="India" class="form-control" readonly>

                                    </div>

                                    <div class="col-md-3 fonts">

                                        <label class="form-label">
                                            Pincode
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" name="pincode" class="form-control" placeholder="Pincode"
                                            required>

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
                                    <div class="col-md-8">

                                        <div class="fonts">

                                            <label class="form-label">
                                                Vendor Logo
                                            </label>

                                            <input type="file" name="logo" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <label class="form-label">
                                            Status
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="status" class="form-select" required>

                                            <option value="1">
                                                Active
                                            </option>

                                            <option value="0">
                                                Inactive
                                            </option>

                                        </select>
                                    </div>
                                </div>


                            </fieldset>



                            <div class="text-end">

                                <a href="#" class="btn btn-light">
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
